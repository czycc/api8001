<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use App\Admin\Extensions\ExcelExpoter;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class OrderController extends Controller
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

            $content->header('兑换详情');
            $content->description('兑换详情');

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

            $content->header('兑换详情');
            $content->description('兑换详情');

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

            $content->header('兑换详情');
            $content->description('兑换详情');

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
        return Admin::grid(Order::class, function (Grid $grid) {
            $grid->exporter(new ExcelExpoter());
            $grid->model()->orderBy('id', 'desc');
            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });
            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();

                // 在这里添加字段过滤器
                $filter->like('code', '兑奖码');
                $filter->like('name', '姓名');
                $filter->like('phone', '联系方式');
                $filter->like('gift', '礼物种类');
            });
            $grid->id('ID')->sortable();
            $grid->column('code','兑换码');
            $grid->column('name', '姓名');
            $grid->column('phone', '联系方式');
            $grid->column('postcode','邮政编码');
            $grid->column('location', '地址');
            $grid->column('gift', '礼物种类')->display(function ($gift){
                switch ($gift) {
                    case 'gift1':
                        $gift = '万福如意礼盒';
                        break;
                    case 'gift2':
                        $gift = '世界花卉精选外币';
                        break;
                    case 'gift3':
                        $gift = '乐柏美保冰保温箱';
                        break;
                    case 'gift4':
                        $gift = '碧然德电热滤水壶';
                        break;
                    case 'gift5':
                        $gift = '佳能手机照片打印机';
                        break;
                    case 'gift6':
                        $gift = '科沃斯智能扫地机器人超薄二代';
                        break;
                    default:
                        $gift = '象印多功能电火锅';
                }
                return $gift;
            });
            $grid->created_at('创建时间')->sortable();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Order::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->display('created_at', '创建时间');
        });
    }
}
