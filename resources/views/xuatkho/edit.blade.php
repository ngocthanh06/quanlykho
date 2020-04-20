<?php $open = 'Xuatkho' ?>
@extends('Admin.layout')
@section('content')
<div class="ibox-title">
   <h5><a href="{{asset('admin/user')}}"> <i> <small> Nhập kho </small> </i> </a></h5>
   <h5>&nbsp;/&nbsp; Sửa xuất kho</h5>
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
               <option value="{{$c->id}}" <?php echo $detail->client->id == $c->id ? 'selected' : '' ?> >{{$c->name}}</option>
              <?php } ?>
            </select>
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-1 control-label">Số điện thoại</label>
         <div class="col-sm-10">
         <input class="form-control" type="number" disabled value="{{$detail->client->phone}}" name="phone" id="phoneClient" placeholder="Nhập số điện thoại khách hàng" required>
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-1 control-label">Địa chỉ</label>
         <div class="col-sm-10">
         <input class="form-control" disabled id="addressClient" type="text" value="{{$detail->client->address}}" name="address" placeholder="Nhập địa chỉ khách hàng" required>
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-1 control-label">Email</label>
         <div class="col-sm-10">
         <input class="form-control" disabled type="email" value="{{$detail->client->email}}" name="email" id="emailClient" placeholder="Nhập địa chỉ email khách hàng">
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-1 control-label">Nội dung</label>
         <div class="col-sm-10">
         <textarea name="Noidung" id="" class="form-control" placeholder="Nội dung" cols="30" rows="10">{{$detail->Noidung}}</textarea>
            <span id="errorname" ></span>
         </div>
      </div>
      <div class="row addProduct " >
        <?php foreach($detail->detaixuatkho as $key => $dt ){ ?>
         <div class="detainProd row" style='padding: 0 15px'>
            <div class="form-group col-sm-3">
               <label class="col-sm-4 control-label">Tên sản phẩm</label>
               <div class="col-sm-8">
                  <select name="idSP<?php echo $key!=0 ? $key : '' ?>" id='idProduct<?php echo $key!=0 ? $key : '' ?>' onchange='loadProducts(this)' class="form-control idProduct" required>
                    <option value='' selected disabled style='background: #eee'>Chọn sản phẩm</option>
                     <?php foreach($prod as $p){ ?>
                     <option value="{{$p->id}}" <?php echo $dt->id_SP == $p->id ? 'selected' : '' ?> >{{$p->name}}</option>
                     <?php } ?> 
                  </select>
               </div>
            </div>
            <div class="form-group col-sm-3">
               <label class="col-sm-4 control-label">Số lượng</label>
               <div class="col-sm-8">
                  <input onchange="loadChangeProduct(this)" type="number" id='idProducts<?php echo $key!=0 ? $key : '' ?>' name="sl<?php echo $key!=0 ? $key : '' ?>" placeholder="Số lượng" class="form-control soluong" min="1" value="<?php echo $dt->sl ?>">
               </div>
            </div>
            <div class='form-group col-sm-3 radio-giaxuat'>
              <div class='0' onchange="changePrice(this)" style='display: flex; justify-content: space-around'>
                <div class="radio radio-danger radioXuat">
                    <input type="text" class="<?php echo $key ?>" style="display: none"">
                    <input type='radio' class="gianhap <?php echo $dt->giaxuat ?>" name='giaxuat<?php echo $key!=0 ? $key : '' ?>' id='rdio<?php echo $key!=0 ? $key : '' ?>' value=''>
                    <label for="rdio<?php echo $key!=0 ? $key : '' ?>">
                        Giá nhập
                    </label>
                </div>
                <div class="radio radio-danger  radioXuat">
                    <input type='radio' class="giaxuat <?php echo $dt->giaxuat ?>" name='giaxuat<?php echo $key!=0 ? $key : '' ?>' id='radio<?php echo $key!=0 ? $key : '' ?>' value=''>
                    <label for="radio<?php echo $key!=0 ? $key : '' ?>">
                        Giá xuất
                    </label>
                </div>
            </div>
            </div>
            <div class=" col-sm-1 form-group removeBtn">
               <input type="button" class="btn btn-danger RmBtnXuatEdit" id="<?php echo $key!=0 ? $key : '' ?>" name="{{$id}}" id="rmBtn" value="Xóa">
            </div>
         </div>
         <script>
            var valsanpham = $('.detainProd:last').find('.idProduct').val();
            var idgianhap = $('.detainProd:last').find('.gianhap').attr('id');
            var idgiaxuat = $('.detainProd:last').find('.giaxuat').attr('id');
            var SL = $('.detainProd:last').find('.soluong').val();
            var idSL = $('.detainProd:last').find('.soluong').attr('id');
            callValueSp(valsanpham, idgianhap, idgiaxuat, SL, idSL);
         </script>
        <?php }?>
        </div>
      <div style="display: flex; padding: 10px 180px; justify-content: flex-end;">
         <input type="button" class="btn btn-success" id="addBtnXuat" value="Thêm">
      </div>
      <div class="form-group">
         <label class="col-sm-1 control-label">Tổng tiền</label>
         <div class="col-sm-10">
            <input type="text" id="totalTienXuat" value="{{$detail->Tongtien}}" name="Tongtien" readonly required placeholder ='Tổng tiền' class='form-control'>
            <span id="errorname" ></span>
         </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group" style="text-align:right">
         <div class="col-sm-9 col-sm-offset-2">
            <a class="btn btn-white" href="{{asset('/listCategory')}}">Hủy</a>
            {!! Form::submit('Sửa', array('class'=>'btn btn-primary','id' =>'addBtnxuatkho' )) !!}
         </div>
      </div>
   </form>
</div>
@stop
<script>
  function callValueSp(valsanpham, idgianhap, idgiaxuat, SL, idSL) {
    $.get(`/api/checkLoadProd/${valsanpham}`).then((res) => {
            res.soluong == 0 ? $(`#${idSL}`).attr('readonly','readonly') : $(`#${idSL}`).removeAttr('readonly');
            $('#addBtnxuatkho').removeAttr('disabled');
            $(`#${idgianhap}`).val(res.price_before);
            $(`#${idgiaxuat}`).val(res.price_after);
            let giaxuat = $(`#${idgianhap}`).attr('class').slice(8);
            if($(`#${idgianhap}`).val() == giaxuat){
              $('#' + idgianhap).attr('checked', 'checked');
            }
            if($(`#${idgiaxuat}`).val() == giaxuat){
              let name = $('#' + idgiaxuat).attr("id")
              $('#' + idgiaxuat).attr('checked', 'checked');
            }
    })
}
</script>