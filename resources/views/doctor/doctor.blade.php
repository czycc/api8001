<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('res/doctor/css/reset2.css') }}">
    <link rel="stylesheet" href="{{ asset('res/doctor/css/index2.css') }}">
    <title>医生简介页面</title>
</head>
<body>
<section>
    <div class="title">
        <div class="offcice">
            {{ !empty($doctor) ? $doctor->category : '中医外科' }}
        </div>
    </div>
    <div class="content" id="app">
        <div class="left">
            <img src="{{ asset('res/doctor/img/celebrated.png') }}" alt="">
        </div>
        <div class="center">
            <img src="{{ asset('upload/doctors') }}/doctor_{{ !empty($doctor) ? $doctor->id : '0'}}.jpg" alt="">
        </div>
        <div class="right">
            <div class="t">
                <div class="name">{{ !empty($doctor) ? $doctor->name : '某某某'}}</div>
                <p>简介：{{ !empty($doctor) ? $doctor->info : '这里有一段简介！'}}</p>
            </div>
            <div class="h">
                @if(empty($patient) || empty($doctor))
                    <p><span class="design">当前号</span> <span class="mask_one" id="mask_one">空闲</span></p>
                    <p><span class="design">下一位</span> <span class="mask_two" id="mask_two">空闲</span></p>
                @else
                    <p>
                        <span class="design">当前号</span>
                        <span class="mask_one" id="mask_one">0{{ $patient[0][0]->clinic }}0{{ $index }} {{ $patient[0][0]->name }}</span>
                    </p>
                    <p>
                        <span class="design">下一位</span>
                        @if(!isset($patient[1][0]))
                            <span class="mask_two" id="mask_two">空闲</span>
                        @else
                            <span class="mask_two" id="mask_two">0{{ $patient[1][0]->clinic }}0{{ $index+1 }} {{ $patient[1][0]->name }}</span>
                        @endif
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>
</body>
<script src="{{ env('APP_URL') }}:3000/socket.io/socket.io.js"></script>
<script src="{{ asset('js/echo.js') }}" type="text/javascript" charset="utf-8"></script>

<script type="application/javascript">
    Echo.channel('patient').listen('Patient', (e) => {
        console.log(e);
        if (e.clinic == '{{ $doctor->id }}') {
            if (e.index1 > 0) {
                document.getElementById('mask_one').innerHTML =  e.index1 + ' ' + e.name1;
            }else {
                document.getElementById('mask_one').innerHTML = '空闲';
            }
            if (e.index2 > 0) {
                document.getElementById('mask_two').innerHTML =  e.index2 + ' ' + e.name2;
            }else {
                document.getElementById('mask_two').innerHTML = '空闲';
            }
        }
    });
</script>
</html>
