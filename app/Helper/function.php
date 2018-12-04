<?php

/*
  |--------------------------------------------------------------------------
  | 助手函数
  |--------------------------------------------------------------------------
 */

//引用
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

//model
use App\Models\Log;
use App\Models\Users;

/**
 * curl请求
 */
function curl_post($url, $postFields) {
//初始化curl
    //初始化curl
    $ch = curl_init();
    //参数设置
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($result, true);

    return $data;
}
/**
 * get_current_url
 * 获取当前路由信息
 *
 * @access public
 * @param type $param remark
 * @return array
 * @author melon<melonchild@outlook.com>
 */
function get_current_url() {
    $action = Route::current()->getActionName();
    list($class, $method) = explode('@', $action);
    $class = str_replace('Controller', '', substr(strrchr($class, '\\'), 1));

    return ['controller' => $class, 'action' => $method];
}

/**
 * get_model_instance
 * 获取model实例
 *
 * @access public
 * @param type $param remark
 * @return array
 * @author melon<melonchild@outlook.com>
 */
function get_model_instance() {
    $url = get_current_url();
    $controller = strtolower($url['controller']);

    //实例model
    $use = '\App\Models\\' . $url['controller'];

    return new $use;
}

/**
 * send_sms
 * 发送短信
 *
 * @access public
 * @param type $param remark
 * @return array
 * @author melon<melonchild@outlook.com>
 */
function send_sms($phone, $datas, $tempId = '') {
    $return['errno'] = 1;
    $return['message'] = "手机号有误";

    //判断手机号
    if (!preg_match("/^1[34578]{1}\d{9}$/", $phone)) {
        return $return;
    }

    // 初始化REST SDK
    $accountSid = config('common.sms.sid');
    $accountToken = config('common.sms.token');
    $appId = config('common.sms.appid');
    $serverIP = 'app.cloopen.com';
    $serverPort = '8883';
    $softVersion = '2013-12-26';
    $tempId = $tempId ? $tempId : config('common.sms.temp');

    $rest = new \REST($serverIP, $serverPort, $softVersion);
    $rest->setAccount($accountSid, $accountToken);
    $rest->setAppId($appId);

    // 发送模板短信
    $result = $rest->sendTemplateSMS($phone, $datas, $tempId);
    if ($result == NULL) {
        $return['errno'] = 2;
        $return['message'] = "短信服务器出错";

        return $return;
    }
    if ($result->statusCode != 0) {
        $return['errno'] = 3;
        $return['message'] = "短信服务器：" . $result->statusMsg;
    } else {
        $return['errno'] = 0;
        $return['message'] = "发送成功";
    }

    return $return;
}

/**
 * send_verify_code
 * 发送短信验证码
 *
 * @access public
 * @param type $phone 手机号
 * @param type $time 有效时间 默认4分钟
 * @return array
 * @author melon<melonchild@outlook.com>
 */
function send_verify_code($phone, $time = 5) {
    $return['errno'] = 1;
    $return['message'] = "手机号有误";

    if ($phone && preg_match("/^1[34578]{1}\d{9}$/", $phone)) {
        //生成验证码
        $data['code'] = rand(1000, 9999);
        $data['phone'] = $phone;
        $data['created_at'] = time() + $time * 60;

        DB::table('code')->where('phone', $phone)->delete();
        $code = DB::table('code')->insert($data);

        if ($code) {
            $datas = array($data['code'], $time);
            $return = send_sms($phone, $datas);
        } else {
            $return['errno'] = 4;
            $return['message'] = "生成验证码失败";
        }
    }

    return $return;
}

/**
 * check_verify_code
 * 发送短信验证码
 *
 * @access public
 * @param type $phone 手机号
 * @param type $code 验证码
 * @return array
 * @author melon<melonchild@outlook.com>
 */
function check_verify_code($phone, $code = 0) {
    $return['errno'] = 1;
    $return['message'] = "手机号有误";

    if ($phone && preg_match("/^1[34578]{1}\d{9}$/", $phone)) {
        //验证验证码
        $verifycode = DB::table('code')->where('phone', $phone)->first();

        if ($verifycode && time() < $verifycode->created_at && $code == $verifycode->code) {
            DB::table('code')->where('phone', $phone)->delete();
            $return['errno'] = 0;
            $return['message'] = "验证码正确";
        } else {
            $return['errno'] = 2;
            $return['message'] = "验证码不正确";
        }

        //苹果验证
        if ($phone == 15151866990) {
            DB::table('code')->where('phone', $phone)->delete();
            $return['errno'] = 0;
            $return['message'] = "验证码正确";
        }
    }

    return $return;
}

/**
 * generate_formate_data
 * 生成指定数组
 *
 * @access public
 * @param type $arrays 原有数组
 * @param type $fills 填充数组
 * @return array
 * @author melon<melonchild@outlook.com>
 */
function generate_formate_data($model, $arrays = '', $guardeds = array('id')) {

    $return['errno'] = 1;
    $return['message'] = "数据不存在";

    if (is_array($arrays)) {
        //获取字段值
        $columns = Schema::getColumnListing($model);

        foreach ($columns as $key => $value) {
            isset($arrays[$value]) && ($data[$value] = $arrays[$value]);
        }
        //剔除指定字段
        $data = array_except($data, $guardeds);

        $return['errno'] = 0;
        $return['data'] = $data;
        $return['message'] = "成功";
    }

    return $return;
}

/**
 * 判断是否手机访问
 *
 * @return boolean
 */
function isMobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset($_SERVER['HTTP_VIA'])) {
        //找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    //脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = [
            'nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile',
        ];
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }

    return false;
}

/**
 * log
 * 日志
 *
 * @access public
 * @param int $type 1登录 2新增 3编辑 4删除 5退出
 * @param string $mark
 * @return array
 * @author melon<melonchild@outlook.com>
 */
function generate_log($type = 1, $mark = '')
{
    $user = session('adminUser', '');

    if ($user) {
       // dd($user->id);
        $data['user_id'] = $user['id'];
        $data['username'] = $user['username'];
        $data['type'] = $type;
        $data['mark'] = $user['username'] . '于' . date('Y-m-d H:i:s').':'.$mark;

        //登录
        if ($type == 1) {

            if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
                $cip = $_SERVER["HTTP_CLIENT_IP"];
            } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } elseif (!empty($_SERVER["REMOTE_ADDR"])) {
                $cip = $_SERVER["REMOTE_ADDR"];
            } else {
                $cip = "无法获取！";
            }
            $data['mark'] = $data['mark'] . '登录了系统，登录ip为：' . $cip;
        }
        //退出
        if ($type == 5) {
            $data['mark'] = $data['mark'] . '退出了系统。';
        }
        //登录seo站点
        if ($type == 2) {
        }
        Log::create($data);
    }

    return true;
}


/**
 * curl请求
 */
function curl_request($url, $postFields, $post = true)
{
//初始化curl

    $ch = curl_init();
    // $postFields = arr2xml($postFields);
    //参数设置
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, $post);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));


    $result = curl_exec($ch);

    curl_close($ch);
    return $result;
}

