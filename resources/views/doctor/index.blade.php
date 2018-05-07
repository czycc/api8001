@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-0 col-lg-10">
                <div class="table-responsive">
                    <table class="table" style="font-size: large">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>诊室</th>
                            <th>专业</th>
                            <th>医师</th>
                            <th>姓名</th>
                            <th>就诊中</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($patients as $patient)
                            <tr>
                                <th>0{{ $patient->clinic }}0{{ $index + $loop->index }}</th>
                                <th>{{ $patient->clinic }}</th>
                                <th>{{ $patient->category }}</th>
                                <th>{{ $patient->doctor }}</th>
                                <th>{{ $patient->name }}</th>
                                @if($loop->first)
                                    <th>正在就诊</th>
                                    <th>
                                        <button type="button" class="btn btn-warning"
                                                onclick="delete_post('{{ $patient->id }}', '{{ $patient->clinic }}')">
                                            就诊完成
                                        </button>
                                    </th>
                                @else
                                    <th>等待中</th>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="application/javascript">
        function delete_post(id, clinic) {
            $.ajax({
                url: '{{ url('api/doctors/delete') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                data: {id: id, clinic: clinic}
            }).done(function (res) {
                console.log(res);
                alert('操作成功');
                window.location.reload();
            }).fail(function (msg) {
                alert(msg);
            })
        }

        setTimeout(function () {
            window.location.reload();
        }, 5000)
    </script>
@endsection
