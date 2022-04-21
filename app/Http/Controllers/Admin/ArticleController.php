<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ArticleModel as MainModel;
use App\Http\Requests\ArticleRequest as MainRequest;
use App\Models\CategoryModel;
class ArticleController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController   = 'admin.pages.article.';
        $this->controllerName       = 'article';
        $this->model = new MainModel();
        $this->params['pagination']['totalItemsPerPage'] = 5;
        parent::__construct();
    }   

    public function form(Request $request)
    {   
        $item = null;
        if($request->id !== null){
            $params['id'] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }

        $categoryModel = new CategoryModel();
        $itemsCategory = $categoryModel->listItems(null, ['task' => 'admin-list-items-in-selectbox']);

        return view($this->pathViewController . 'form', [
            'item'          => $item,
            'itemsCategory' => $itemsCategory
        ]);
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

    public function type(Request $request)
    {
        $params['currentType']      = $request->type;
        $params['id']               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-type']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Cập nhật kiểu bài viết thành công!');
    }
}
