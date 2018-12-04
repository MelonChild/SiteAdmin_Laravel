<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ResourceController extends BaseController
{
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeIndex(Request $request)
    {
        //
        return [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //取得路由信息
        $route = session('route');

        //无权限，转至403页面
        if (Gate::denies('permission-check', strtolower($route['controller']) . '.index')) {
            abort(403);
        }

        $datas = $this->beforeIndex($request);

        //视图渲染
        if ($route['controller']) {
            return view('admin.' . strtolower($route['controller']) . '.index')->with($datas);
        } else {
            abort(404);
        }
    }

    /**
     * getListCondition
     * 创建查找条件
     *
     * @return \Illuminate\Http\Response
     */
    public function getListCondition(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $return = [];
        if ($keyword) {
            $return[0] = ['name', 'like', '%' . $keyword . '%'];
        }
        return $return;
    }

    /**
     * getList
     * 首页列表显示数据
     *
     * @return \Illuminate\Http\Response
     */
    public function getList(Request $request)
    {
        //无权限，返回无权限信息
        if (Gate::denies('permission-check', strtolower($this->controller) . '.list')) {
            $returnData['code'] = 0;
            $returnData['msg'] = 'msg';
            $returnData['count'] = 0;
            $returnData['data'] = [];

            return $returnData;
        }

        $model = new $this->model;

        $page = (int) ($request->input('page', 1));
        $limit = (int) ($request->input('limit', 15));

        $where = $this->getListCondition($request);

        $count = $model->where($where)->count();
        $data = $model->where($where)->skip(($page - 1) * $limit)->take($limit)->orderBy('id', 'desc')->get();

        $data = $this->formatData($data);

        $returnData['code'] = 0;
        $returnData['msg'] = '';
        $returnData['count'] = $count;
        $returnData['data'] = $data;

        return $returnData;
    }

    /**
     * formatData
     * 格式化显示数据
     *
     * @return \Illuminate\Http\Response
     */
    public function formatData($data)
    {
        //
        return $data->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeCreate(Request $request)
    {
        //
        return [];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $datas = $this->beforeCreate($request);
        $route = session('route');

        return view('admin.' . strtolower($route['controller']) . '.create')->with($datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeStore(Request $request, $datas)
    {
        //
        $returnData['status'] = true;
        $returnData['msg'] = 'success';
        $returnData['data'] = $datas;
        return $returnData;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //返回信息
        $returnData['status'] = false;
        $returnData['msg'] = 'fail';

        //无权限，返回无权限信息
        if (Gate::denies('permission-check', strtolower($this->controller) . '.add')) {
            $returnData['msg'] = '暂无权限';
            return $returnData;
        }

        //获取数据
        $datas = $request->except(['_token', '_method', 'file']);
        $model = new $this->model;

        $before = $this->beforeStore($request, $datas);

        if ($before['status']) {
            //保存信息
            $datas = $before['data'];
            $result = $model->create($before['data']);

            if ($result != false) {
                $returnData['status'] = true;
                $returnData['msg'] = 'success';
            }

        } else {
            $returnData['msg'] = $before['msg'];
        }

        $returnData = $this->afterStore($request, $returnData, $datas);

        return $returnData;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function afterStore(Request $request, $returnData, $data)
    {
        //
        return $returnData;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeShow(Request $request, $id)
    {
        //
        return [];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //获取其他数据
        $datas = $this->beforeShow($request, $id);
        $route = session('route');

        //无权限，转至403页面
        if (Gate::denies('permission-check', strtolower($route['controller']) . '.show')) {
            abort(403);
        }

        $model = new $this->model;
        $datas['id'] = $id;
        $datas['detail'] = $model->findOrFail($id);

        return view('admin.' . strtolower($route['controller']) . '.show')->with($datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeEdit(Request $request, $id)
    {
        //
        return [];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //获取其他数据
        $datas = $this->beforeEdit($request, $id);
        $route = session('route');

        $model = new $this->model;
        $datas['id'] = $id;
        $datas['detail'] = $model->findOrFail($id);

        return view('admin.' . strtolower($route['controller']) . '.edit')->with($datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeUpdate(Request $request, $datas, $detail)
    {
        //
        $returnData['status'] = true;
        $returnData['msg'] = 'success';
        $returnData['data'] = $datas;
        return $returnData;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //返回信息
        $returnData['status'] = false;
        $returnData['msg'] = 'fail';

        //无权限，返回无权限信息
        if (Gate::denies('permission-check', strtolower($this->controller) . '.edit')) {
            $returnData['msg'] = '暂无权限';
            return $returnData;
        }

        //获取数据
        $datas = $request->except(['_token', '_method', 'file']);
        $model = new $this->model;
        $detail = $model->where('id', $id)->first()->toArray();
        $before = $this->beforeUpdate($request, $datas, $detail);

        if ($before['status']) {
            //保存信息
            $result = $model->where('id', $id)->update($before['data']);

            if ($result !== false) {
                $returnData['status'] = true;
                $returnData['msg'] = 'success';
            }

        } else {
            $returnData['msg'] = $before['msg'];
        }

        $returnData = $this->afterUpdate($request, $returnData, $detail);

        return $returnData;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function afterUpdate(Request $request, $returnData, $detail)
    {
        //
        return $returnData;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $returnData['status'] = false;
        $returnData['msg'] = '删除失败';

        //无权限，返回无权限信息
        if(Gate::denies('permission-check', strtolower($this->controller).'.delete')){
            $returnData['msg'] = '暂无权限';
            return $returnData;
        }
        //
        $ids = $request->input('ids', '');

        $arrIds = explode(',', $ids);
        $model = new $this->model;

        foreach ($arrIds as $key => $id) {
            if ($id) {
                $detail = $model->where('id', $id)->first()->toArray();
                $result = $model->destroy($id);
                $this->afterDelete($request, $result, $detail);
            }
        }
        $returnData['status'] = true;
        $returnData['msg'] = '删除成功';
        generate_log(4,'删除数据ID：'.$ids.',控制器为：'.$this->controller);

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
        return true;
    }
}
