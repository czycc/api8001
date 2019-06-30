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
            <div class="col-lg-6 col-lg-offset-3">
                <form method="post" action="{{ url('doctors/create') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="id">诊室选择：</label>
                        <select name="id" id="id" autofocus class="form-control">
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">诊室{{ $doctor->id }}</option>
                            @endforeach
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
