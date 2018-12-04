<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Geetest\geetest;
use App\Models\Users;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | 登录控制器，登录页面展示，极验验证，登出等操作
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admins';

    /**
     * 定义看守器
     *
     * @var string
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * 登录用户名
     *
     * @return
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Login page
     *
     * @param Request $request
     * @return Response
     * @author MelonChild
     */
    public function index(Request $request)
    {
        //打印加密后的值
        // dump(Hash::make('wemax001'));
        return view('admin.login.index');
    }

    /**
     * 极验展示
     *
     * @return
     */
    public function geetest()
    {

        // 实例化极验
        $geetest = new \GeetestLib('21c9c9f206ceee4ab79010e720923934', '684188e5cd83b45d87bc60142f726444');
        $data = array(
            "user_id" => "test", # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => "127.0.0.1", # 请在此处传输用户请求验证时所携带的IP
        );

        $status = $geetest->pre_process($data, 1);
        $session['gtserver'] = $status;
        $session['user_id'] = $data['user_id'];
        session($session);

        return $geetest->get_response_str();
    }

    /**
     * 极验验证
     *
     * @return
     */
    public function verifyGeetest(Request $request)
    {

        //获取客户端传入值
        $input = $request->all();

        //返回值
        $return['status'] = 'fail';

        if ($request->isMethod('post')) {
            //实例化极验
            $geetest = new \GeetestLib('21c9c9f206ceee4ab79010e720923934', '684188e5cd83b45d87bc60142f726444');

            //获取参考值
            $data = array(
                "user_id" => session('user_id'), # 网站用户id
                "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
                "ip_address" => "127.0.0.1", # 请在此处传输用户请求验证时所携带的IP
            );

            //服务器正常
            if (session('gtserver') == 1) {
                $result = $geetest->success_validate($input['geetest_challenge'], $input['geetest_validate'], $input['geetest_seccode'], $data);
                if (!$result) {
                    return $return;
                }
            } else { //服务器宕机,走failback模式
                $result = $geetest->fail_validate($input['geetest_challenge'], $input['geetest_validate'], $input['geetest_seccode']);
                if (!$result) {
                    return $return;
                }
            }

            //用户账号密码判断
            if (Auth::guard('admin')->attempt(['username' => $input['username'], 'password' => $input['password'], 'active' => 1])) {

                $user = Auth::guard('admin')->user();
                session(['adminUser' => $user]);
                generate_log();
                //更新用户登录信息
                if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
                    $cip = $_SERVER["HTTP_CLIENT_IP"];
                } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                    $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                } elseif (!empty($_SERVER["REMOTE_ADDR"])) {
                    $cip = $_SERVER["REMOTE_ADDR"];
                } else {
                    $cip = "unknown";
                }
                $newData['last_login'] = $user['this_login'];
                $newData['last_ip'] = $user['this_ip'];
                $newData['this_login'] = time();
                $newData['this_ip'] = $cip;
                $newData['logins'] = $user['logins'] + 1;
                Users::where('username', $input['username'])->update($newData);

                //用户登录成功
                $return['status'] = 'success';
            } else {
                $return['status'] = 'fail1';
            }
        }

        return $return;
    }

    /**
     * 登出
     *
     * @return
     */
    public function logout()
    {
        generate_log(5);
        //注销用户
        session(['adminUser' => null]);
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }

}
