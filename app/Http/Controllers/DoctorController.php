<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\Patient;
use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Events\Patient as PatientEvent;

class DoctorController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * 在外部大屏显示通知排队信息，显示每个队列第一位
     * 排队思路：以时间戳为权进行队列排序，
     */
    public function waiting()
    {
        $today = Carbon::today()->timestamp;
        $tomorrow = Carbon::tomorrow()->timestamp;
        $date = Redis::get('doctor_queue_date');
        if ($today > $date) {
            //每日第一次打开清空队列数据
            for ($i = 1; $i <= 7; $i++) {
                Redis::zremrangebyscore('doctor_queue_list' . $i, 0, $today);
                Redis::set('doctor_queue_id' . $i, 0);//队列编号
            }
            Redis::set('doctor_queue_date', $today);
        }

        //获取诊室队列数据
        for ($i = 1; $i <= 7; $i++) {
            $index[$i] = Redis::get('doctor_queue_id' . $i);//队列编号
            $count[$i] = Redis::zcount("doctor_queue_list{$i}", $today, $tomorrow);//用以显示是否有下一位
            //当前队列人员
            $id = Redis::zrange("doctor_queue_list{$i}", 0, 0);
            $patient[$i] = Patient::find($id);
        }
        $doctors = Doctors::all();

        return view('doctor.waiting', compact('index', 'count', 'patient', 'doctors'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * 查看诊室队列
     */
    public function index($id)
    {
        $today = Carbon::today()->timestamp;
        $date = Redis::get('doctor_queue_date');
        if ($today > $date) {
            //每日第一次打开清空队列数据
            for ($i = 1; $i <= 7; $i++) {
                Redis::zremrangebyscore('doctor_queue_list' . $i, 0, $today);
                Redis::set('doctor_queue_id' . $i, 0);//队列编号
            }
            Redis::set('doctor_queue_date', $today);
        }

        //获取当前排队号和排队列表
        $index = Redis::get('doctor_queue_id' . $id);
        $k = Redis::zrange("doctor_queue_list{$id}", 0, -1);
        $patients = array();
        foreach ($k as $key) {
            $patients[] = Patient::find($key);
        }
        return view('doctor.index', compact('patients', 'index'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * 排队登记
     */
    public function create()
    {
        $doctors = Doctors::all();
        return view('doctor.create', compact('doctors'));
    }

    public function store(Request $request)
    {

        $name = $request->name;//姓名
        $id = $request->id;//诊室id
        $category = $request->category;//门诊类别
        $info = Doctors::find($id);
        $doctor = $info->name;

        //录入数据库
        $patient = new Patient();
        $patient->category = $category;
        $patient->name = $name;
        $patient->clinic = $id;
        $patient->doctor = $doctor;
        $patient->save();

        //录入队列,判断是否广播
        $today = Carbon::today()->timestamp;
        $tomorrow = Carbon::tomorrow()->timestamp;
        $count = Redis::zcount("doctor_queue_list{$id}", $today, $tomorrow);
        if ($count==0) {
            $k = Redis::get('doctor_queue_id' . $id);
            event(new PatientEvent($k, $name, '-1', '', $id));
        }
        Redis::zadd("doctor_queue_list{$id}", time(), $patient->id);

        return back()->with('success', '提交成功');
    }

    public function setting()
    {
        $infos = Doctors::all();
        return view('doctor.setting', compact('infos'));
    }

    public function set(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'id' => 'required',
            'category' => 'required',
            'info' => 'required'
        ]);
        if (!empty($request->img)) {
            $path = Storage::disk('public_path')
                ->putFileAs('doctors', new File($request->img), 'doctor_' . $request->id . '.jpg');
        }

        Doctors::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->name,
                'category' => $request->category,
                'info' => $request->info,
            ]
        );

        return back()->with('success', '提交成功');
    }

    /**
     * @param Request $request
     * @return mixed
     *
     * 队列移除
     */
    public function delete(Request $request)
    {
        $bool = Redis::zrem('doctor_queue_list' . $request->clinic, $request->id);
        $today = Carbon::today()->timestamp;
        $tomorrow = Carbon::tomorrow()->timestamp;
        //判断是否有下一位
        $count = Redis::zcount("doctor_queue_list{$request->clinic}", $today, $tomorrow);
        if ($count > 0) {
            //广播挂号
            $id1 = Redis::zrange('doctor_queue_list' . $request->clinic, 0, 0);
            $patient1 = Patient::find($id1);
            $name1 = $patient1[0]->name;
            $k = Redis::incr('doctor_queue_id' . $request->clinic);
            $k1 = "0" . $request->clinic . "0" . $k;//编号
            //判断是否有下下位
            if ($count > 1) {
                $id2 = Redis::zrange('doctor_queue_list' . $request->clinic, 1, 1);
                $patient2 = Patient::find($id2);
                $name2 = $patient2[0]->name;
                $k += 1;
                $k2 = "0" . $request->clinic . "0{$k}";//编号
            } else {
                $k2 = -1;
                $name2 = '';
            }

        } else {
            Redis::incr('doctor_queue_id' . $request->clinic);
            $k1 = -1;
            $name1 = '';
            $k2 = -1;
            $name2 = '';
        }
        event(new PatientEvent($k1, $name1, $k2, $name2, $request->clinic));
        return $bool;
    }

    public function doctorShow($i)
    {

        $today = Carbon::today()->timestamp;
        $tomorrow = Carbon::tomorrow()->timestamp;
        $date = Redis::get('doctor_queue_date');
        if ($today > $date) {
            //每日第一次打开清空队列数据
            for ($i = 1; $i <= 7; $i++) {
                Redis::zremrangebyscore('doctor_queue_list' . $i, 0, $today);
                Redis::set('doctor_queue_id' . $i, 0);//队列编号
            }
            Redis::set('doctor_queue_date', $today);
        }

        $index = Redis::get('doctor_queue_id' . $i);//队列编号
        $count = Redis::zcount("doctor_queue_list{$i}", $today, $tomorrow);//用以显示是否有下一位
        //当前队列人员
        $patient = Array();
        if ($count>0) {
            $id = Redis::zrange("doctor_queue_list{$i}", 0, 0);
            $patient[] = Patient::find($id);
        }
        if ($count > 1) {
            //获取下一位
            $id = Redis::zrange("doctor_queue_list{$i}", 1, 1);
            $patient[] = Patient::find($id);
        }
        $doctor = Doctors::find($i);
        return view('doctor.doctor', compact('doctor', 'index', 'patient'));
    }
}
