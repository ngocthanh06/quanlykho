<?php $open = 'account' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox-title">
        <h5><a href="{{asset('admin/user')}}"> <i> <small> Danh sách Nhà Cung Cấp </small> </i> </a></h5>
        <h5>&nbsp;/&nbsp;</h5>
        {!! $open == 'account' ? '
        <h5>Thêm Nhà Cung Cấp</h5>
        ':''!!}
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên Nhà Cung Cấp</label>
                <div class="col-sm-10">
                    {{ Form::text('TenNCC', old('TenNCC'), array('required','placeholder'=>'','class'=>'form-control')) }}
                    <span id="errorTenNCC" ></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    {{ Form::text('Email', old('Email'), array('required','placeholder'=>'','class'=>'form-control')) }}
                    <span id="errorEmail" ></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">SĐT</label>
                <div class="col-sm-10">
                    {{ Form::text('SDT', old('SDT'), array('required','placeholder'=>'','class'=>'form-control')) }}
                    <span id="errorSDT" ></span>
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group" style="text-align:right">
                <div class="col-sm-9 col-sm-offset-2">
                    <a class="btn btn-white" href="{{asset('/listsupplier')}}">Hủy</a>
                    {!! Form::submit('Thêm mới', array('class'=>'btn btn-primary')) !!}
                </div>
            </div>
        </form>
    </div>
@stop
