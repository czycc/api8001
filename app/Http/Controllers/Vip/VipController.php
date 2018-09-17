<?php

namespace App\Http\Controllers\Vip;

use App\Models\News;
use App\Models\Stock;
use App\Models\Vvip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Validator;

class VipController extends Controller
{
    public function index()
    {
        $stock = Stock::first();
        $news = News::first();
        return view('vvip', compact('stock', 'news'));
    }

    /**
     * @param Request $request
     * @return string
     *
     * 验证兑奖码是否有效
     */
    public function code(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|size:8',//兑奖码
        ]);
        $code = $request->code;
        $res = Vvip::where('code', $code)
            ->where('used', 0)
            ->first();
        if (is_null($res)) {
            return 'false';
        }
        return 'true';
    }

    public function order(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|size:8',//兑奖码
            'username' => 'required|max:10',//姓名
            'phone' => 'required|size:11',//手机号
            'postcode' => 'required|size:6',//邮编
            'location' => 'required|max:100',//地址
            'gift' => 'required',//兑奖码
            'remarks' => 'nullable'
        ]);
//        $validator = Validator::make($request->all(), [
//            'code' => 'required|size:8',//兑奖码
//            'username' => 'required|max:10',//姓名
//            'phone' => 'required|size:11',//手机号
//            'postcode' => 'required|size:6',//邮编
//            'location' => 'required|max:100',//地址
//            'gift' => 'required'//礼品码
//        ]);
//        if ($validator->fails()) {
//            return response()->json([
//                'status' => false,
//                'reason' => '表单输入有误'
//            ]);
//        }

        //判断库存是否足够
        $stock = Stock::first();
        if ($stock->{$request->gift} == 0) {
            return response()->json([
                'status' => false,
                'reason' => '该礼品库存不足'
            ]);
        }

        //处理兑换码
        $code = Vvip::where('code', $request->code)
            ->where('used', 0)
            ->first();
        if (is_null($code)) {
            return response()->json([
                'status' => false,
                'reason' => '兑换码有误'
            ]);
        }
        $code->used = 1;
        $code->save();

        //保存订单信息
        $order = new Order();
        $order->name = $request->username;
        $order->phone = $request->phone;
        $order->location = $request->location;
        $order->gift = $request->gift;
        $order->postcode = $request->postcode;
        $order->code = $request->code;
        $order->remarks = $request->remarks;
        $order->save();

        //更新礼品数量
        $stock->{$request->gift} -= 1;
        $stock->save();

        //返回正确和订单id
        return response()->json([
            'status' => true,
            'id' => $order->id
        ]);
    }
}
