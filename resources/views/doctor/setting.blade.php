@extends('layouts.app')

@section('content')
    <div class="container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        诊室设置
                    </div>
                    <div class="panel-body">
                        <form action="{{ url('doctors/setting') }}" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="id">诊所选择:</label>
                                <select name="id" id="id" autofocus class="form-control">
                                    <option value="1">诊室1</option>
                                    <option value="2">诊室2</option>
                                    <option value="3">诊室3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">医师姓名:</label>
                                <input type="text" name="name" id="name" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="category">专业:</label>
                                <select name="category" id="category" autofocus class="form-control">
                                    <option value="中医内科">中医内科</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="img">医师图片(可为空)：</label>
                                <input type="file" name="img" id="img" class="form-control"
                                       accept="image/jpg,image/png,image/jpeg">
                            </div>
                            <div class="form-group">
                                <label for="info">医师简介:</label>
                                <textarea class="form-control" name="info" id="info" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">提交</button>
                            <button type="reset" class="btn btn-warning">重置</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
