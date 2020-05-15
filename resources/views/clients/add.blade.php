<?php $open = 'client' ?>
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
                <label class="col-sm-2 control-label">Tên Khách Hàng </label>
                <div class="col-sm-10">
                    {{ Form::text('name', old('name'), array('required','placeholder'=>'Tên Khách Hàng','class'=>'form-control')) }}
                    <span id="errorname" ></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Địa Chỉ: </label>
                <div class="col-sm-10">
                    {{ Form::text('address', old('name'), array('required','placeholder'=>'Địa Chỉ ','class'=>'form-control')) }}
                    <span id="errorname" ></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email: </label>
                <div class="col-sm-10">
                    {{ Form::email('email', old('name'), array('required','placeholder'=>'email','class'=>'form-control')) }}
                    <span id="errorname" ></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Phone: </label>
                <div class="col-sm-10">
                    {{ Form::number('phone', old('name'), array('required','placeholder'=>'Phone','class'=>'form-control')) }}
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
