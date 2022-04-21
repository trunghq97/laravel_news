<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel;
use App\Http\Requests\CategoryRequest as MainRequest;

class CategoryController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController   = 'admin.pages.category.';
        $this->controllerName       = 'category';
        $this->model = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 10;
        parent::__construct();
    }   

    public function save(MainRequest $request)
    {   
        if($request->method() == 'POST'){
            $params = $request->all();

            $task   = 'add-item';
            $notify = 'Thêm phần tử thành công!';

            if($params['id'] !== NULL){
                $task   = 'edit-item';
                $notify = 'Cập nhật phần tử thành công!';
            }
            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName)->with('zvn_notify', $notify);
        }
    }

    public function isHome(Request $request)
    {
        $params['currentIsHome']    = $request->isHome;
        $params['id']               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-is-home']);

        $isHome = $request->isHome == 'yes' ? 'no' : 'yes';
        $link                   = route($this->controllerName . '/isHome', ['id' => $request->id, 'isHome' => $isHome]);
        

        return response()->json([
            'isHomeObj' => config('zvn.template.is_home')[$isHome],
            'link'   => $link,
        ]);
    }

    public function display(Request $request)
    {
        $params['currentDisplay']   = $request->display;
        $params['id']               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-display']);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
