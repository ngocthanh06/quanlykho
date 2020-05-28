<?php $open = 'Xuatkho' ?>
@extends('Admin.layout')
@section('content')
<div class="ibox-title">
   <h5><a href="{{asset('admin/user')}}"> <i> <small> Xuất kho </small> </i> </a></h5>
   <h5>&nbsp;/&nbsp; Thêm mới xuất kho</h5>
   {!! $open == 'nhapkho' ? '
   <h5>Thêm nhập kho</h5>
   ':''!!}
</div>
<div class="ibox-content">
   <form method="post" class="form-horizontal">
      {{ csrf_field() }}
      <div class="form-group">
         <label class="col-sm-1 control-label">Tên khách hàng</label>
         <div class="col-sm-10">
            <select name="name" id="nameClient" onchange="loadClient()" required class="form-control js-example-tags">
              <option value="" selected disabled>Chọn khách hàng</option>
              <?php foreach($client as $c) { ?>
               <option value="{{$c->id}}" >{{$c->name}}</option>
              <?php } ?>
            </select>
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-1 control-label">Số điện thoại</label>
         <div class="col-sm-10">
           <input class="form-control" type="number" name="phone" id="phoneClient" placeholder="Nhập số điện thoại khách hàng" required>
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-1 control-label">Địa chỉ</label>
         <div class="col-sm-10">
           <input class="form-control" id="addressClient" type="text" name="address" placeholder="Nhập địa chỉ khách hàng" required>
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-1 control-label">Email</label>
         <div class="col-sm-10">
           <input class="form-control" type="email" name="email" id="emailClient" placeholder="Nhập địa chỉ email khách hàng">
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-1 control-label">Nội dung</label>
         <div class="col-sm-10">
            {{ Form::textarea('Noidung', old('Noidung'), array('required','placeholder'=>'Nội dung','class'=>'form-control')) }}
            <span id="errorname" ></span>
         </div>
      </div>
      <div class="row addProduct "   >
         <div class="detainProd row" style='padding: 0 15px'>
            <div class="form-group col-sm-3">
               <label class="col-sm-4 control-label">Tên sản phẩm</label>
               <div class="col-sm-8">
                  <select name="idSP" id='idProduct' onchange='loadProducts(this)' class="form-control idProduct" required>
                    <option value='' selected disabled style='background: #eee'>Chọn sản phẩm</option>
                     <?php foreach($prod as $p){ ?>
                     <option value="{{$p->id}}" >{{$p->name}}</option>
                     <?php } ?> 
                  </select>
               </div>
            </div>
            <div class="form-group col-sm-3">
               <label class="col-sm-4 control-label">Số lượng</label>
               <div class="col-sm-8">
                  <input  onchange="loadChangeProduct(this)" type="number" name="sl" placeholder="Số lượng" class="form-control" min="1" value="1">
               </div>
            </div>
            <div class='form-group col-sm-3 radio-giaxuat'>
              <div class='0' onchange="changePrice(this)" style='display: flex; justify-content: space-around'>
                <div class="radio radio-danger radioXuat">
                    <input type="text" class="0" style="display: none"">
                    <input type='radio' class="gianhap" name='giaxuat' id='rdio' value=''>
                    <label for="rdio">
                        Giá nhập
                    </label>
                </div>
                <div class="radio radio-danger  radioXuat">
                    <input type='radio' class="giaxuat" name='giaxuat' id='radio' value='' checked>
                    <label for="radio">
                        Giá xuất
                    </label>
                </div>
            </div>
            </div>
            <div class=" col-sm-1 form-group removeBtn">
               <input type="button" class="btn btn-danger RmBtnXuat" id="rmBtn" value="Xóa">
            </div>
         </div>
      </div>
      <div style="display: flex; padding: 10px 180px; justify-content: flex-end;">
         <input type="button" class="btn btn-success" id="addBtnXuat" value="Thêm">
      </div>
      <div class="form-group">
         <label class="col-sm-1 control-label">Tổng tiền</label>
         <div class="col-sm-10">
            <input type="text" id="totalTienXuat" value="" name="Tongtien" readonly required placeholder ='Tổng tiền' class='form-control'>
            <span id="errorname" ></span>
         </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group" style="text-align:right">
         <div class="col-sm-9 col-sm-offset-2">
            <a class="btn btn-white" href="{{asset('/listCategory')}}">Hủy</a>
            {!! Form::submit('Thêm mới', array('class'=>'btn btn-primary','id' =>'addBtnxuatkho' )) !!}
         </div>
      </div>
   </form>
</div>
@stop