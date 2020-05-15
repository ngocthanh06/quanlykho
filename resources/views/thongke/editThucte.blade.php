<?php $open1 = 'thongkesp'; $open ='kiemke' ?>
@extends('Admin.layout')
@section('content')
<div class="ibox-title">
   <h5><a href="{{asset('kiemke')}}"> <i> <small> Kiểm kê </small> </i> </a></h5>
</div>
<div class="ibox-content">
   <form method="post" class="form-horizontal">
      {{ csrf_field() }}
      <div class="form-group">
         <label class="col-sm-1 control-label">Tên sản phẩm</label>
         <div class="col-sm-10">
            <input class="form-control" type="text" disabled value="{{$kiemke->product->name}}" name="id_sp" id="phoneClient" placeholder="Nhập tên sản phẩm" required>
            
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-1 control-label">Số lượng thực tế</label>
         <div class="col-sm-10">
         <input class="form-control" type="number" value="{{$kiemke->soluong}}" name="soluong" id="phoneClient" placeholder="Nhập số lượng thực tế" required>
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-1 control-label">Nội dung</label>
         <div class="col-sm-10">
         <textarea name="noidung" placeholder="Nội dung" class = 'form-control' cols="30" rows="10">{{$kiemke->noidung}}</textarea>
            <span id="errorname" ></span>
         </div>
      </div>
      
      <div class="hr-line-dashed"></div>
      <div class="form-group" style="text-align:right">
         <div class="col-sm-9 col-sm-offset-2">
            <a class="btn btn-white" href="{{asset('/kiemke')}}">Hủy</a>
            {!! Form::submit('Sửa', array('class'=>'btn btn-primary','id' =>'addBtnxuatkho' )) !!}
         </div>
      </div>
   </form>
</div>
@stop