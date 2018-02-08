@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <form method="post" action="{{ url('doctors/create') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="id">诊室选择：</label>
                        <select name="id" id="id" autofocus class="form-control">
                            <option value="1">诊室1号</option>
                            <option value="2">诊室2号</option>
                            <option value="3">诊室3号</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">姓名：</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="category">专业:</label>
                        <select name="category" id="category" autofocus class="form-control">
                            <option value="中医内科">中医内科</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-default">提交</button>
                    <button type="reset" class="btn btn-danger">重置</button>
                </form>
            </div>
        </div>
    </div>
@endsection
