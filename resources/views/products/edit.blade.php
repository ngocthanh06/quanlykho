<?php $open = 'account' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox-title">
        <h5><a href="{{asset('admin/user')}}"> <i> <small> Danh sách Sản Phẩm </small> </i> </a></h5>
        <h5>&nbsp;/&nbsp;</h5>
        {!! $open == 'account' ? '
        <h5>Sửa Sản Phẩm</h5>
        ':''!!}
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên Sản Phẩm</label>
                <div class="col-sm-10">
                    <input type="text" required value="{{$prod->name}}" name="name" placeholder="Nhập tên sản phẩm" class="form-control">
                    <span id="errorname" ></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Loại hàng</label>
                <div class="col-sm-10">
                    <select class="form-control" name="id_category">
                        @foreach($cate as $cate)
                        <option value="{{$cate->id}}" {{$prod->category->id == $cate->id ? 'selected' : ''}} >{{$cate->name}}</option>
                        @endforeach
                      </select>
                    <span id="errorid" ></span>
                </div>
            </div>

            
            <div class="form-group">
                <label class="col-sm-2 control-label">DVT</label>
                <div class="col-sm-10">
                    <input type="text" required value="{{$prod->dvt}}" name="dvt" placeholder="Nhập đơn vị tính" class="form-control">
                    <span id="errordvt" ></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Giá nhập</label>
                <div class="col-sm-10">
                    <input type="number" required value="{{$prod->price_after}}" name="price_after" placeholder="Nhập giá nhập" class="form-control">
                    <span id="errorprice_after" ></span>
                </div>
            </div>

            {{-- <div class="form-group">
                <label class="col-sm-2 control-label">số lượng</label>
                <div class="col-sm-10">
                    <input type="number" required value="{{$prod->soluong}}" min="1" name="soluong" placeholder="Nhập giá nhập" class="form-control">
                    <span id="errorsoluong" ></span>
                </div>
            </div> --}}

            <div class="form-group">
                <label class="col-sm-2 control-label">Giá bán</label>
                <div class="col-sm-10">
                    <input type="text" required value="{{$prod->price_before}}" name="price_before" placeholder="Nhập số lượng" class="form-control">
                    <span id="errorprice_before" ></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Ngày sản xuất</label>
                <div class="col-sm-10">
                    <div class='input-group date' id='ngaysx'>
                        <input type='text' class="form-control" name="ngaysx" value="{{$prod->ngaysx}}" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                     </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Hạn sử dụng</label>
                <div class="col-sm-10">
                     <div class='input-group date' id='hansudung'>
                        <input type='text' class="form-control" name="hansudung" value="{{$prod->ngayhh}}" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                     </div>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label">Nhà Cung Cấp</label>
                <div class="col-sm-10">
                        <select class="form-control" name="id_supplier">
                            @foreach($supplier as $sup)
                            <option value="{{$sup->id}}" {{$prod->supplier->id == $sup->id? 'selected': ''}}>{{$sup->TenNCC}}</option>
                            @endforeach
                          </select>
                    <span id="errorsupplier" ></span>
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group" style="text-align:right">
                <div class="col-sm-9 col-sm-offset-2">
                    <a class="btn btn-white" href="{{asset('/listProduct')}}">Hủy</a>
                    {!! Form::submit('Sửa', array('class'=>'btn btn-primary')) !!}
                </div>
            </div>
        </form>
    </div>
@stop
