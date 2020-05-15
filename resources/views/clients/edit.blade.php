<?php $open = 'client' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox-title">
        <h5><a href="{{asset('/listClient')}}"> <i> <small> Danh sách Khách Hàng </small> </i> </a></h5>
        <h5>&nbsp;/&nbsp;</h5>
        {!! $open == 'clients' ? '
        <h5>Sửa Loại Hàng</h5>
        ':''!!}
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên Khách Hàng</label>
                <div class="col-sm-10">
                    <input type="text" required value="{{$client->name}}" name="name" placeholder="Tên Khách Hàng" class="form-control">
                    <span id="errorname" ></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Address:</label>
                <div class="col-sm-10">
                    <input type="text" required value="{{$client->address}}" name="address" placeholder="Địa Chỉ" class="form-control">
                    <span id="errorname" ></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <input type="number" required value="{{$client->phone}}" name="phone" placeholder="Số Điện Thoại" class="form-control">
                    <span id="errorname" ></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" required value="{{$client->email}}" name="email" placeholder="Email" class="form-control">
                    <span id="errorname" ></span>
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group" style="text-align:right">
                <div class="col-sm-9 col-sm-offset-2">
                    <a class="btn btn-white" href="{{asset('/listClient')}}">Hủy</a>
                    {!! Form::submit('Sửa', array('class'=>'btn btn-primary')) !!}
                </div>
            </div>
        </form>
    </div>
@stop
