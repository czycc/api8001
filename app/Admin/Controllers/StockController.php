<?php

namespace App\Admin\Controllers;

use App\Models\Stock;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class StockController extends Controller
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

            $grid->column('gift1', '万福如意礼盒');
            $grid->column('gift2', '世界花卉精选外币');
            $grid->column('gift3', '乐柏美保冰保温箱');
            $grid->column('gift4', '碧然德电热滤水壶');
            $grid->column('gift5', '佳能手机照片打印机');
            $grid->column('gift6', '科沃斯扫地机器人');
//            $grid->column('gift7', '象印多功能电火锅');
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
            $form->number('gift1','万福如意礼盒');
            $form->number('gift2','世界花卉精选外币');
            $form->number('gift3','乐柏美保冰保温箱');
            $form->number('gift4','碧然德电热滤水壶');
            $form->number('gift5','佳能手机照片打印机');
            $form->number('gift6','科沃斯扫地机器人');
//            $form->number('gift7','象印多功能电火锅');
            $form->number('gift8', '野外全自动帐篷');
            $form->number('gift9', '旅行魔术靠枕');
            $form->number('gift10', '趣奇拍立得');
            $form->number('gift11', '无线蓝牙耳机');
            $form->number('gift12', '360全景相机');
            $form->number('gift13', '雷朋墨镜');
        });
    }
}
