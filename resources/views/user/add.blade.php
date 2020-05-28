<?php $open = 'users'; $open = 'editUser' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox-title">
        <h5><a href="{{asset('admin/user')}}"> <i> <small> Danh sách Khách Hàng  </small> </i> </a></h5>
        <h5>&nbsp;/&nbsp;</h5>
        {!! $open == 'clients' ? '
        <h5>Thêm Khách Hàng</h5>
        ':''!!}
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">Quyền người dùng </label>
                <div class="col-sm-10">
                    <select required class="form-control" name="role_id" id="">
                        <option hidden value>Chọn quyền người dùng</option>
                        @foreach($role as $rl)
                            <option value="{{$rl->id}}">{{$rl->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên Người dùng </label>
                <div class="col-sm-10">
                    {{ Form::text('name', old('name'), array('required','placeholder'=>'Tên Người Dùng','class'=>'form-control')) }}
                    <span id="errorname" ></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Mật khẩu: </label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email: </label>
                <div class="col-sm-10">
                    {{ Form::email('email', old('email'), array('required','placeholder'=>'email','class'=>'form-control')) }}
                    <span id="errorname" ></span>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group" style="text-align:right">
                <div class="col-sm-9 col-sm-offset-2">
                    <a class="btn btn-white" href="{{asset('/listCategory')}}">Hủy</a>
                    {!! Form::submit('Thêm mới', array('class'=>'btn btn-primary')) !!}
                </div>
            </div>
        </form>
    </div>
@stop
