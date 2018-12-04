<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Menu;
use App\Models\Users;
use App\Models\Config;
use App\Models\Article;


class IndexController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Index Controller
    |--------------------------------------------------------------------------
    |
    | 首页控制器，首页及仪表盘页面及其他
    |
     */

    /**
     * frame page
     *
     * @param Request $request
     * @return Response
     * @author MelonChild
     */
    public function index(Request $request)
    {
        //获取顶部菜单显示
        $menus = Menu::where('pid', 0)->where('active', 1)->orderBy('sort')->get();

        //获取公告
        $announce = Config::where('name', 'notice')->value('content');
        $canAlert = Config::where('name', 'canalert')->value('content');

        return view('admin.index.index', compact('menus','announce','canAlert'));
    }

    /**
     * dashboard page
     *
     * @param Request $request
     * @return Response
     * @author MelonChild
     */
    public function dashboard(Request $request)
    {
        //7日发文统计
        $begin = $request->input('begin', date('Y-m-d'));
        $data['begin'] = $begin;
        $begin = Carbon::createFromTimestamp(strtotime($begin) > time() ? strtotime(date('Y-m-d')) : strtotime($begin));
        $begintime = $begin->modify('-1 days')->timestamp;

        //网站配置项
        $configs = Config::whereIn('name', ['webname','domain'])->pluck('content','name')->toArray();

        //获取最新5篇文章
        $articles = Article::orderBy('id','desc')->pluck('name')->toArray();

        //文章分类,这里只是演示，具体需要查询相关数据
        $cates = ['资讯', '新闻'];
        for ($key = 0; $key < count($cates); $key++) {
            $x[$key] = $cates[$key];
            $time = $begintime; //重置开始时间以查询分类下数据
            for ($i = 0; $i < 7; $i++) {
                $y[$i] = date('y-m-d', $time);
                $count = rand(9, 99);
                $datas[] = [$i, $key, $count];
                $time = $time - 24 * 3600;
            }
        }

        //统计数据传值
        $data['x'] = $x;
        $data['y'] = $y;
        $data['data'] = $datas;

        return view('admin.index.dashboard', compact('data','configs','articles'));
    }

    /**
     * 加载页面
     *
     * @param Request $request
     * @return Response
     * @author MelonChild
     */
    public function loadShow(Request $request, $site)
    {
        $user = session('adminUser');
        //查看是否存在改站点权限
        $has = DB::table('user_site')->where('user_id', $user['id'])->where('site_id', $site)->first();
        $site = $user->sites()->where('site_id', $site)->first();
        $return = '站点不存在，请先创建站点';
        if ($site) {
            //跳转 登录
            $timestap = time();
            $token = md5($site['domain'] . $site['salt'] . $timestap) . $timestap;
            $result = curl_request($site['manageurl'], ['token' => $token, 'role' => $user['role_id']]);
            if ($result) {
                $result = json_decode($result, true);
                if ($result['status'] > 0) {
                    $return = $result['msg'];
                } else {
                    generate_log(2, '登录' . $site['name'] . ',身份为：' . $user['role_id']);
                    return redirect($result['login']);
                }
            }
            $return = '远程登录失败，请稍候再试！';
        }
        //错误
        return view('admin.index.login')->with(['msg' => $return]);
    }

    /**
     * getMenu
     *
     * @param Request $request
     * @param int $type 1顶级目录 2全部目录
     * @return Response
     * @author MelonChild
     */
    public function getMenu(Request $request, $pid = 0)
    {
        //获取登录用户
        $user = session('adminUser');
        $user = Users::find(1);

        //根据用户角色查找显示菜单
        $menus = $user->role->menus()->where('pid', $pid)->where('active',1)->orderBy('sort')->get();

        $return["status"] = true;
        $return["msg"] = "成功";
        $return["data"] = $pid == 0 ? $menus->toArray() : $menus->load('children')->toArray();

        return $return;
    }

}
