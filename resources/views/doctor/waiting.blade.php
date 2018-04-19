<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('res/doctor/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('res/doctor/css/index.css') }}">
    <title>医疗问询系统大屏显示</title>
</head>
<body>
<section>
    <audio id="audio" src="">
    </audio>
    <div id="headline">
        {{----}}
        <p style="font-size: 60px" id="warning">请 <span>xxxx</span>号 到<span>x</span>号诊室 就诊</p>
    </div>
    <div class="main">
        <ul id="title">
            <li class="consult_room">诊室号</li>
            <li class="major">专业</li>
            <li class="doctor">医师</li>
            <li class="doctor_see">就诊中</li>
            <li class="doctor_plan">准备中</li>
        </ul>
        <div class="content">
            @foreach($doctors as $doctor)
                @php($k = $index[$doctor->id]+1)
                <ul>
                    <li class="consult_room">{{ $doctor->id }}</li>
                    <li class="major">{{ $doctor->category }}</li>
                    <li class="doctor">{{ $doctor->name }}</li>
                    <li class="doctor_see" id="index{{ $doctor->id }}">
                        {{ empty($patient[$doctor->id][0]) ? '空闲' : "0{$doctor->id}0{$index[$doctor->id]}号 {$patient[$doctor->id][0]->name}" }}
                    </li>
                    <li class="doctor_plan" id="next{{ $doctor->id }}">
                        {{ $count[$doctor->id] > 1 ? "0{$doctor->id}0{$k}号" : '空闲'}}
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
</section>
</body>
<script src="//127.0.0.1:6001/socket.io/socket.io.js"></script>
<script src="{{ asset('js/echo.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>

<script type="application/javascript">
    var lock = false;
    function audioPlay(text) {
        var audio = document.getElementById('audio');
        $.get('https://api.shanghaichujie.com/api/baidu/voice?text='+text, function (res) {
            audio.src=res;
            audio.play();
        })
    }
    Echo.channel('patient').listen('Patient', (e) => {
        var text = '';
        if (e.index1 > 0) {
            document.getElementById('index' + e.clinic).innerHTML =  e.index1 + ' ' + e.name1;
            text = '请'+ e.index1 +'号'+e.name1+'到'+e.clinic+'号诊室就诊';
            // document.getElementById('warning').innerHTML = text;
        }else {
            document.getElementById('index' + e.clinic).innerHTML = '空闲';
        }
        if (e.index2 > 0) {
            document.getElementById('next'+e.clinic).innerHTML =  e.index2 +' '+e.name2;
            text = text + ' 请'+e.index2+'号'+e.name2+'准备';
        }else {
            document.getElementById('next'+e.clinic).innerHTML = '空闲';
        }
        audioPlay(text);
        console.log(text);
    });

</script>
</html>


