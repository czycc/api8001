<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExpoter extends AbstractExporter
{
    public function export()
    {
        Excel::create('order', function ($excel) {

            $excel->sheet('order', function ($sheet) {

                // 这段逻辑是从表格数据中取出需要导出的字段
                $rows = collect($this->getData())->map(function ($item) {
                    switch ($item['gift']) {
                        //第一季
                        case 'gift1':
                            $item['gift'] = '万福如意礼盒';
                            break;
                        case 'gift2':
                            $item['gift'] = '世界花卉精选外币';
                            break;
                        case 'gift3':
                            $item['gift'] = '乐柏美保冰保温箱';
                            break;
                        case 'gift4':
                            $item['gift'] = '碧然德电热滤水壶';
                            break;
                        case 'gift5':
                            $item['gift'] = '佳能手机照片打印机';
                            break;
                        case 'gift6':
                            $item['gift'] = '科沃斯智能扫地机器人超薄二代';
                            break;

                        //第二季
                        case 'gift8':
                            $item['gift'] = '野外全自动帐篷';
                            break;
                        case 'gift9':
                            $item['gift'] = '旅行魔术靠枕';
                            break;
                        case 'gift10':
                            $item['gift'] = '趣奇拍立得';
                            break;
                        case 'gift11':
                            $item['gift'] = '飞利浦蓝牙耳机';
                            break;
                        case 'gift12':
                            $item['gift'] = '360全景相机';
                            break;
                        case 'gift13':
                            $item['gift'] = '雷朋墨镜';
                            break;

                        //第三季
                        case 'gift15':
                            $item['gift'] = '主题钱币';
                            break;
                        case 'gift16':
                            $item['gift'] = '太阳能车载空气净化器';
                            break;
                        case 'gift17':
                            $item['gift'] = 'JBL 蓝牙音箱';
                            break;
                        case 'gift18':
                            $item['gift'] = 'VR全景相机';
                            break;
                        case 'gift19':
                            $item['gift'] = 'kindle';
                            break;
                    }
                    return array_only($item, ['id', 'code', 'name', 'phone', 'postcode', 'location', 'gift', 'created_at']);
                });

                $sheet->rows($rows);

            });

        })->export('xls');
    }
}
