<?php

namespace App\Admin\Controllers;

use App\Models\Stock;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class Stock2Controller extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Stock::class, function (Grid $grid) {
            $grid->disableCreation();
            $grid->disableExport();
            $grid->disableFilter();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });


            $grid->column('gift8', '野外全自动帐篷');
            $grid->column('gift9', '旅行魔术靠枕');
            $grid->column('gift10', '趣奇拍立得');
            $grid->column('gift11', '无线蓝牙耳机');
            $grid->column('gift12', '360全景相机');
            $grid->column('gift13', '雷朋墨镜');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Stock::class, function (Form $form) {

            $form->number('gift8', '野外全自动帐篷');
            $form->number('gift9', '旅行魔术靠枕');
            $form->number('gift10', '趣奇拍立得');
            $form->number('gift11', '无线蓝牙耳机');
            $form->number('gift12', '360全景相机');
            $form->number('gift13', '雷朋墨镜');
        });
    }
}
