<?php $open = 'account' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox-title">
        <h5><a href="{{asset('admin/user')}}"> <i> <small> Danh sách Nhà Cung Cấp </small> </i> </a></h5>
        <h5>&nbsp;/&nbsp;</h5>
        {!! $open == 'account' ? '
        <h5>Sửa Nhà Cung Cấp</h5>
        ':''!!}
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên Nhà Cung Cấp</label>
                <div class="col-sm-10">
                    <input type="text" required value="{{$supp->TenNCC}}" name="TenNCC" placeholder="Tên Nhà Cung Cấp" class="form-control">
                    <span id="errorTenNCC" ></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" required value="{{$supp->Email}}" name="Email" placeholder="Email Nhà Cung Cấp" class="form-control">
                    <span id="errorEmail" ></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">SĐT</label>
                <div class="col-sm-10">
                    <input type="text" required value="{{$supp->SDT}}" name="SDT" placeholder="SDT Nhà Cung Cấp" class="form-control">
                    <span id="errorSDT" ></span>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group" style="text-align:right">
                <div class="col-sm-9 col-sm-offset-2">
                    <a class="btn btn-white" href="{{asset('/listsupplier')}}">Hủy</a>
                    {!! Form::submit('Sửa', array('class'=>'btn btn-primary')) !!}
                </div>
            </div>
        </form>
    </div>
@stop
