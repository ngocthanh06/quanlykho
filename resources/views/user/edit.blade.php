<?php $open = 'users'; $open1 = 'editUser'?>
@extends('Admin.layout')
@section('content')
    <div class="ibox-title">
        <h5><a href="{{asset('admin/user')}}"> <i> <small> Chỉnh sửa thông tin</small> </i> </a></h5>
        <h5>&nbsp;/&nbsp;</h5>
        {!! $open == 'clients' ? '
        <h5>Sửa Loại Hàng</h5>
        ':''!!}
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">Quyền người dùng </label>
                <div class="col-sm-10">
                    <select <?php echo Auth::user()->role_id != 1 ? 'disabled' : ''  ?>  required class="form-control" name="role_id" id="">
                        <option hidden value>Chọn quyền người dùng</option>
                        @foreach($role as $rl)
                            <option value="{{$rl->id}}" <?php echo $user->role_id == $rl->id ? 'selected' : '' ?> >{{$rl->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên Đăng Nhập</label>
                <div class="col-sm-10">
                    <input type="text"  required value="{{$user->name}}" name="name" placeholder="Tên Khách Hàng" class="form-control">
                    <span id="errorname" ></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" required readonly value="{{$user->email}}" name="email" placeholder="Tên Khách Hàng" class="form-control">
                    <span id="errorname" ></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" required value="{{$user->password}}" name="password" placeholder="Tên Khách Hàng" class="form-control">
                    <span id="errorname" ></span>
                </div>
            </div>
            

            <div class="hr-line-dashed"></div>
            <div class="form-group" style="text-align:right">
                <div class="col-sm-9 col-sm-offset-2">
                    <a class="btn btn-white" href="{{asset('/listusers')}}">Hủy</a>
                    {!! Form::submit('Sửa', array('class'=>'btn btn-primary')) !!}
                </div>
            </div>
        </form>
    </div>
@stop
