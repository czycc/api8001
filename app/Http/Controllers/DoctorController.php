<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\Record;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * 返回总排队，显示在外部大屏
     * 排队思路：根据时间在redis中存储队列当前index和队列list信息，一共三个诊室
     */
    public function waiting()
    {
        $date = date('Ymd');
        for ($id = 1; $id <= 3; $id++) {
            Redis::setnx('Doctor_' . $id . '_' . $date . '_index', 0);
            $index[$id] = Redis::get('Doctor_' . $id . '_' . $date . '_index');
            $lists[$id] = Redis::lrange('Doctor_' . $id . '_' . $date, $index[$id], -1);
        }
        return view('doctor.waiting', compact('lists', 'index'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 查看排队列
     */
    public function index()
    {
        $date = date('Ymd');
        //获取当前排队号和排队列表
        for ($id = 1; $id <= 3; $id++) {
            Redis::setnx('Doctor_' . $id . '_' . $date . '_index', 0);
            $index[$id] = Redis::get('Doctor_' . $id . '_' . $date . '_index');
            $lists[$id] = Redis::lrange('Doctor_' . $id . '_' . $date, $index[$id], -1);
        }

//        dd($lists);
        return view('doctor.index', compact('lists', 'index'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * 排队登记
     */
    public function create()
    {
        return view('doctor.create');
    }

    public function store(Request $request)
    {
        $date = date('Ymd');

        $name = $request->name;//姓名
        $id = $request->id;//诊室id
        $category = $request->category;//门诊类别
        $doctor = Redis::get('Doctor_' . $id);
        $str = json_encode([
            'name' => $name,
            'id' => $id,
            'category' => $category,
            'doctor' => $doctor,
        ]);
        Redis::rpush('Doctor_' . $id . '_' . $date, $str);

        return 'true';
    }

    public function setting()
    {
        $infos = Doctors::all();
        return view('doctor.setting', compact('infos'));
    }

    public function set(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'id' => 'required',
            'category' => 'required',
            'info' => 'required'
        ]);
        if (!empty($request->img)){
            $path = Storage::disk('public_path')
                ->putFileAs('doctors', new File($request->img), 'doctor_'.$request->id . '.jpg');
        }

        $doctor = Doctors::find($request->id);
        $doctor->name = $request->name;
        $doctor->category = $request->category;
        $doctor->info = $request->info;
        $doctor->save();

        return back()->with('success', '提交成功');
    }

    /**
     * @param Request $request
     * @return mixed
     *
     *
     */
    public function delete(Request $request)
    {
        $date = date('Ymd');
        //根据status判断是已经完成就诊还是移除
        if ($request->status) {
            //已经完成，提升index值，录入日志
            $res = Redis::incr('Doctor_' . $request->id . '_' . $date . '_index');
            $record = new Record();
            $record->doctor_id = $request->id;
            $record->name=$request->name;
            $record->category=$request->category;
            $record->doctor=$request->doctor;
            $record->save();

        } else {
            //从队列移除，不改变index
            $str = json_encode([
                'name' => $request->name,
                'id' => (int)($request->id),
                'category' => $request->category,
                'doctor' => $request->doctor,
            ]);
            $res = Redis::lrem('Doctor_' . $request->id . '_' . $date, -1, $str);
        }
        return $res;
    }

    public function doctorShow($id)
    {
        $date = date('Ymd');
        Redis::setnx('Doctor_' . $id . '_' . $date . '_index', 0);
        $index = Redis::get('Doctor_' . $id . '_' . $date . '_index');
        $list = Redis::lrange('Doctor_' . $id . '_' . $date, $index, -1);

        $doctor = Doctors::find($id);
        return view('doctor.doctor', compact('doctor','index', 'list'));
    }

    public function init()
    {
        $date = date('Ymd');
        for ($id = 1; $id <= 3; $id++) {
            Redis::setnx('Doctor_' . $id . '_' . $date . '_index', 0);
            $index[$id] = Redis::get('Doctor_' . $id . '_' . $date . '_index');
            $str = json_encode([
                'name' => '牛一',
                'id' => $id,
                'category' => '内科',
                'doctor' => 'aa'
            ]);
            Redis::rpush('Doctor_' . $id . '_' . $date, $str);
            $str = json_encode([
                'name' => '张三',
                'id' => $id,
                'category' => '内科',
                'doctor' => 'aa'
            ]);
            Redis::rpush('Doctor_' . $id . '_' . $date, $str);
            $str = json_encode([
                'name' => '李四',
                'id' => $id,
                'category' => '内科',
                'doctor' => 'aa'
            ]);
            Redis::rpush('Doctor_' . $id . '_' . $date, $str);
            $str = json_encode([
                'name' => '王五',
                'id' => $id,
                'category' => '内科',
                'doctor' => 'aa'
            ]);
            Redis::rpush('Doctor_' . $id . '_' . $date, $str);
            $str = json_encode([
                'name' => '陈留',
                'id' => $id,
                'category' => '内科',
                'doctor' => 'aa'
            ]);
            Redis::rpush('Doctor_' . $id . '_' . $date, $str);
        }
        return 'true';
    }

}
