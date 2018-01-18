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
                        default:
                            $item['gift'] = '象印多功能电火锅';
                    }
                    return array_only($item, ['id', 'code', 'name', 'phone', 'postcode', 'location', 'gift', 'created_at']);
                });

                $sheet->rows($rows);

            });

        })->export('xls');
    }
}
