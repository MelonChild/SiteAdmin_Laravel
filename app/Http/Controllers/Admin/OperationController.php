<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Menu;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class OperationController extends ResourceController
{

    /**
     * beforeStore
     * 组合需要更新的数组
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeStore(Request $request, $datas)
    {
        $returnData['status'] = true;
        $returnData['msg'] = 'success';

        // 查看是否可存
        $model = new $this->model;
        $has = $model->where('named', $datas['named'])->first();

        if ($has) {
            $returnData['status'] = false;
            $returnData['msg'] = '该操作已存在';
            return $returnData;
        }

        $returnData['data'] = $datas;
        return $returnData;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function afterStore(Request $request, $returnData, $data)
    {
        $model = new $this->model;

        //如果新增成功，创建各个文件
        if ($returnData['status']) {
            $success = false;

            $named = strtolower($data['named']);
            $className = ucfirst($named);
            $tableName = $routeName = $named . 's';

            //创建数据表
            if(isset($data['database'])){
                $result = Schema::create($tableName, function (Blueprint $table) {
                    $table->engine = 'InnoDB';
                    $table->charset = 'utf8';
                    $table->collation = 'utf8_general_ci';
                    $table->increments('id')->comment('主键');
                    $table->string('name',255);
                    $table->string('keywords',255)->nullable();
                    $table->string('desc',255)->nullable();
                    $table->string('imgpath')->comment('图片路径')->nullable();
                    $table->tinyInteger('active')->comment('1激活0未激活')->default(1);
                    $table->string('created_at');
                    $table->string('updated_at');
                });
            }

            //生成Model文件
            if(isset($data['model'])){
                $content = Storage::disk('app')->get('Demo/Model.php');
                $content = str_replace(['CLASSNAME', 'TABLENAME'], [$className, $tableName], $content);
                $result = Storage::disk('app')->put('Models/' . $className . '.php', $content);
                if(!$result){
                    Storage::disk('app')->delete('Models/' . $className . '.php');
                    $model->where('named', $data['named'])->delete();
                    $returnData['status'] = false;
                    $returnData['msg'] = '创建model出错';
                    return $returnData;
                }
            }
            
            //生成控制器文件
            $content = Storage::disk('app')->get('Demo/Controller.php');
            $content = str_replace(['CLASSNAME'], [$className], $content);
            $result = Storage::disk('app')->put('Http/Controllers/Admin/' . $className . 'Controller.php', $content);
            if(!$result){
                Storage::disk('app')->delete('Models/' . $className . '.php');
                Storage::disk('app')->delete('Http/Controllers/Admin/' . $className . 'Controller.php');
                $model->where('named', $data['named'])->delete();
                $returnData['status'] = false;
                $returnData['msg'] = '创建controller出错';
                return $returnData;
            }

            // 生成视图文件
            Storage::disk('root')->exists('/resources/views/admin/' . $named) || mkdir(base_path() . '/resources/views/admin/' . $named);
            $content = Storage::disk('app')->get('Demo/views/index.blade.php');
            $content = str_replace(['ROUTENAME','NAMED'], [$routeName,$named], $content);
            $result = Storage::disk('root')->put('resources/views/admin/' . $named . '/index.blade.php', $content);
            $content = Storage::disk('app')->get('Demo/views/create.blade.php');
            $content = str_replace(['ROUTENAME','NAMED'], [$routeName,$named], $content);
            $result = Storage::disk('root')->put('resources/views/admin/' . $named . '/create.blade.php', $content);
            $content = Storage::disk('app')->get('Demo/views/edit.blade.php');
            $content = str_replace(['ROUTENAME','NAMED'], [$routeName,$named], $content);
            $result = Storage::disk('root')->put('resources/views/admin/' . $named . '/edit.blade.php', $content);
            $content = Storage::disk('app')->get('Demo/views/show.blade.php');
            $result = Storage::disk('root')->put('resources/views/admin/' . $named . '/show.blade.php', $content);
           
            if(!$result){
                Storage::disk('app')->delete('Models/' . $className . '.php');
                Storage::disk('app')->delete('Http/Controllers/Admin/' . $className . 'Controller.php');
                Storage::disk('root')->delete('resources/views/admin/' . $named . '/index.blade.php');
                Storage::disk('root')->delete('resources/views/admin/' . $named . '/create.blade.php');
                Storage::disk('root')->delete('resources/views/admin/' . $named . '/edit.blade.php');
                Storage::disk('root')->delete('resources/views/admin/' . $named . '/show.blade.php');
                rmdir(base_path() . '/resources/views/admin/' . $named);
                $model->where('named', $data['named'])->delete();
                $returnData['status'] = false;
                $returnData['msg'] = '创建view出错';
                return $returnData;
            }

            //生成路由文件
            $route = "//" . $named . " manage" . PHP_EOL
                . "    Route::get('" . $routeName . "/getList','" . $className . "Controller@getList')->name('" . $routeName . ".getList');" . PHP_EOL
                . "    Route::post('" . $routeName . "/delete','" . $className . "Controller@delete')->name('" . $routeName . ".delete');" . PHP_EOL
                . "    Route::resource('" . $routeName . "', '" . $className . "Controller',['parameters' => [" . PHP_EOL
                . "        '".$named."' => 'id'" . PHP_EOL
                . "    ]]);" . PHP_EOL . PHP_EOL
                . "    //auto generate routes";
            $content = Storage::disk('root')->get('routes/admin.php');
            $content = str_replace('//auto generate routes', $route, $content);
            $result = Storage::disk('root')->put('routes/admin.php', $content);

            //生成菜单记录
            $menuData['href'] = '/admins/'.$routeName;
            $menuData['name'] = $menuData['title'] = $data['name'];
            $menuData['icon'] =$data['icon'];
            $menuData['pid'] =20; //默认添加至网站管理
            Menu::create($menuData);
        }

        return $returnData;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function afterDelete(Request $request, $result, $detail)
    {
        //
        if ($result) {
            $named = strtolower($detail['named']);
            $className = ucfirst($named);
            Storage::exists($detail['icon']) || Storage::delete($detail['icon']);
            Storage::disk('app')->delete('Models/' . $className . '.php');
            Storage::disk('app')->delete('Http/Controllers/Admin/' . $className . 'Controller.php');
            Storage::disk('root')->delete('resources/views/admin/' . $named . '/index.blade.php');
            Storage::disk('root')->delete('resources/views/admin/' . $named . '/create.blade.php');
            Storage::disk('root')->delete('resources/views/admin/' . $named . '/edit.blade.php');
            Storage::disk('root')->delete('resources/views/admin/' . $named . '/show.blade.php');
            rmdir(base_path() . '/resources/views/admin/' . $named);

            //删除菜单
            Menu::where('pageURL','/admins/'.$named.'s')->delete();

            //删除数据库
            //Schema::dropIfExists($named.'s');
        }
        return true;
    }

    
    /**
     * formatData
     *
     * @return \Illuminate\Http\Response
     */
    public function formatData($data)
    {
        //
        foreach ($data as $key => $value) {
            $data[$key]['created_at'] = date('Y-m-d H:i');
        }
        return $data;
    }

}
