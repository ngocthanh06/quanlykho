<?php $open = 'account' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox-title">
        <h5><a href="{{asset('admin/user')}}"> <i> <small> Nhập kho </small> </i> </a></h5>
        <h5>&nbsp;/&nbsp; Thêm mới nhập kho</h5>
        {!! $open == 'nhapkho' ? '
        <h5>Thêm nhập kho</h5>
        ':''!!}
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal">
            {{ csrf_field() }}
                <div class="row addProduct"   > 
                    <div class="detainProd row" style='padding: 0 15px'>
                        <div class="form-group col-sm-3">
                            <label class="col-sm-4 control-label">Tên sản phẩm</label>
                            <div class="col-sm-8">
                                    <select name="idSP" class="form-control">
                                         <?php foreach($prod as $p){ ?>
                                            <option value="{{$p->id}}" >{{$p->name}}</option>
                                         <?php } ?> 
                                    </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="col-sm-4 control-label">Số lượng</label>
                            <div class="col-sm-8">
                                <input onchange="setValue()" type="number" name="sl" placeholder="Số lượng" class="form-control" min="1" value="1">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="col-sm-4 control-label">Giá nhập</label>
                            <div class="col-sm-8">
                                <input onchange="setValue()" type="number" class="form-control" name="gianhap" placeholder="Giá nhập" min="1" value="10000">
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="col-sm-4 control-label">ĐVT</label>
                            <div class="col-sm-8">
                                <input type="text" required name="dvt" class="form-control" placeholder="Đơn vị tính"">
                            </div>
                        </div>   
                        <div class=" col-sm-1 form-group removeBtn">
                            <input type="button" class="btn btn-danger RmBtn" id="rmBtn" value="Xóa">
                        </div>
                    </div>
                </div>         
            <div style="display: flex; padding: 10px 180px; justify-content: flex-end;">
            <input type="button" class="btn btn-success" id="addBtn" value="Thêm">
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">Nội dung</label>
                <div class="col-sm-10">
                    {{ Form::textarea('Noidung', old('Noidung'), array('required','placeholder'=>'Nội dung','class'=>'form-control')) }}
                    <span id="errorname" ></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">Tổng tiền</label>
                <div class="col-sm-10">
                    <input type="text" id="totalTien" value="" name="Tongtien" readonly required placeholder ='Tổng tiền' class='form-control'>
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

