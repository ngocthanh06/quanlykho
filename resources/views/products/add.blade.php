<?php $open = 'account' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox-title">
        <h5><a href="{{asset('admin/user')}}"> <i> <small> Danh sách Sản Phẩm </small> </i> </a></h5>
        <h5>&nbsp;/&nbsp;</h5>
        {!! $open == 'account' ? '
        <h5>Thêm Sản Phẩm</h5>
        ':''!!}
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên Sản Phẩm</label>
                <div class="col-sm-10">
                    {{ Form::text('name', old('name'), array('required','placeholder'=>'','class'=>'form-control')) }}
                    <span id="errorname" ></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Loại hàng</label>
                <div class="col-sm-10">
                    <select class="form-control" name="id_category">
                        @foreach($cate as $cate)
                        <option value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach
                      </select>
                    <span id="errorid" ></span>
                </div>
            </div>

            
            <div class="form-group">
                <label class="col-sm-2 control-label">DVT</label>
                <div class="col-sm-10">
                    {{ Form::text('dvt', old('dvt'), array('required','placeholder'=>'','class'=>'form-control')) }}
                    <span id="errordvt" ></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Giá nhập</label>
                <div class="col-sm-10">
                    {{ Form::number('price_after', old('price_after'), array('required','placeholder'=>'','class'=>'form-control')) }}
                    <span id="errorprice_after" ></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">số lượng</label>
                <div class="col-sm-10">
                    {{ Form::number('soluong', old('soluong'), array('required','placeholder'=>'','class'=>'form-control', 'min' => '1', 'required')) }}
                    <span id="errorsoluong" ></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Giá bán</label>
                <div class="col-sm-10">
                    {{ Form::number('price_before', old('price_before'), array('required','placeholder'=>'','class'=>'form-control')) }}
                    <span id="errorprice_before" ></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Nhà Cung Cấp</label>
                <div class="col-sm-10">
                        <select class="form-control" name="id_supplier">
                            @foreach($supplier as $sup)
                            <option value="{{$sup->id}}">{{$sup->TenNCC}}</option>
                            @endforeach
                          </select>
                    <span id="errorsupplier" ></span>
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group" style="text-align:right">
                <div class="col-sm-9 col-sm-offset-2">
                    <a class="btn btn-white" href="{{asset('/listProduct')}}">Hủy</a>
                    {!! Form::submit('Thêm mới', array('class'=>'btn btn-primary')) !!}
                </div>
            </div>
        </form>
    </div>
@stop
