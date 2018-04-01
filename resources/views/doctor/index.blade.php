@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-1 col-lg-8">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>诊室</th>
                            <th>专业</th>
                            <th>医师</th>
                            <th>姓名</th>
                            <th>编号</th>
                            <th>就诊中</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($id=0;$id<7;$id++)
                            @php($k=0)
                            @foreach($lists as $list)
                                @if(!empty($list)&&$loop->index ==$id)
                                    @foreach($list as $item)
                                        <tr>
                                            <th>{{ json_decode($item)->id }}</th>
                                            <th>{{ json_decode($item)->category }}</th>
                                            <th>{{ json_decode($item)->doctor }}</th>
                                            <th>{{ json_decode($item)->name }}</th>
                                            <th>{{ json_decode($item)->id }}0{{$index[$id+1]+$k}}</th>
                                            @php($k++)
                                            @if($loop->first)
                                                <th>正在就诊</th>
                                                <th>
                                                    <button type="button" class="btn btn-info"
                                                            onclick="delete_post('{{ json_decode($item)->name }}','{{ json_decode($item)->id }}',
                                                                '{{ json_decode($item)->category }}', '{{ json_decode($item)->doctor }}', 1)">
                                                        就诊完成
                                                    </button>
                                                </th>
                                            @else
                                                <th>等待中</th>
                                                <th>
                                                    <button type="button" class="btn btn-warning"
                                                            onclick="delete_post('{{ json_decode($item)->name }}','{{ json_decode($item)->id }}',
                                                                '{{ json_decode($item)->category }}', '{{ json_decode($item)->doctor }}', 0)">
                                                        移除
                                                    </button>
                                                </th>

                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="application/javascript">
        function delete_post(name, id, category, doctor, status) {
            $.ajax({
                url: '{{ url('api/doctors/delete') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                data: {name: name, id: id, category: category, doctor: doctor, status: status},
            }).done(function (res) {
                console.log(res);
                alert('操作成功');
                window.location.reload();
            }).fail(function (msg) {
                alert(msg);
            })
        }
    </script>
@endsection
