<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('res/doctor/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('res/doctor/css/index.css') }}">
    <title>医疗问询系统</title>
</head>
<body>
<section>
    <div id="headline">
        {{----}}
        @php($status=1)
        @php($id=random_int(0,6))
        @foreach($lists as $list)
            @if(!empty($list)&&$status&&$loop->index ==$id)
                @php($status=0)
                <p>请 <span>{{ json_decode($list[0])->id }}0{{$index[$id+1]}}</span>号 到
                    <span>{{ json_decode($list[0])->id }}</span>号诊室 就诊</p>
            @endif
        @endforeach
    </div>
    <div class="main">
        <ul id="title">
            <li class="consult_room">诊室</li>
            <li class="major">专业</li>
            <li class="doctor">医师</li>
            <li class="doctor_see">就诊中</li>
            <li class="doctor_plan">准备中</li>
        </ul>
        <div class="content">
            @for($id=0;$id<7;$id++)
                @foreach($lists as $list)
                    @if(!empty($list))
                        @if($loop->index == $id)
                            <ul>
                                <li class="consult_room">{{ json_decode($list[0])->id }}</li>
                                <li class="major">{{ json_decode($list[0])->category }}</li>
                                <li class="doctor">{{ json_decode($list[0])->doctor }}</li>
                                <li class="doctor_see">{{ json_decode($list[0])->name}} 就诊中</li>
                                <li class="doctor_plan">请{{ json_decode($list[0])->id }}0{{$index[$id+1]+1}}
                                    号{{ json_decode($list[1])->name}} 准备
                                </li>
                            </ul>
                        @endif
                    @endif
                @endforeach
            @endfor
        </div>
    </div>
</section>
</body>
<script type="application/javascript">
    setTimeout(function () {
        window.location.reload();
    }, 5000);
</script>
</html>


