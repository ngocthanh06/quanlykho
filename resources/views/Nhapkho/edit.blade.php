<?php $open = 'account' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox-title">
        <h5><a href="{{asset('admin/user')}}"> <i> <small> Nhập kho </small> </i> </a></h5>
        <h5>&nbsp;/&nbsp; Sửa chi tiết nhập kho</h5>
        {!! $open == 'nhapkho' ? '
        <h5>Thêm nhập kho</h5>
        ':''!!}
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal">
            {{ csrf_field() }}
                <div class="row addProduct"   > 
                  <?php foreach($nhapkho as $nk){ ?>
                    <?php foreach($nk->chitietnhapkho as $key=>$n){ ?> 
                    <div class="detainProd row" style='padding: 0 15px'>
                        <div class="form-group col-sm-3">
                            <label class="col-sm-4 control-label">Tên sản phẩm</label>
                            <div class="col-sm-8">
                                    <select name="idSP<?php echo $key!=0 ? $key : '' ?>" class="form-control">
                                         <?php foreach($prod as $p){ ?>
                                            <option <?php echo $n->id_SP == $p->id ? 'selected' : '' ?> value="{{$p->id}}" >{{$p->name}}</option>
                                         <?php } ?> 
                                    </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="col-sm-4 control-label">Số lượng</label>
                            <div class="col-sm-8">
                            <input onchange="setValue()" type="number" name="sl<?php echo $key!=0 ? $key : '' ?>" placeholder="Số lượng" class="form-control" min="1" value="{{$n->sl}}">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="col-sm-4 control-label">Giá nhập</label>
                            <div class="col-sm-8">
                            <input onchange="setValue()" type="number" class="form-control" name="gianhap<?php echo $key!=0 ? $key : '' ?>" placeholder="Giá nhập" min="1" value="{{$n->gianhap}}">
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="col-sm-4 control-label">ĐVT</label>
                            <div class="col-sm-8">
                            <input type="text" required name="dvt<?php echo $key!=0 ? $key : '' ?>" value="{{$n->dvt}}" class="form-control" placeholder="Đơn vị tính"">
                            </div>
                        </div>   
                        <div class=" col-sm-1 form-group removeBtn">
                            <input type="button" class="btn btn-danger rmBtnEdit" id="<?php echo $key!=0 ? $key : '' ?>" name="{{$id}}"" value="Xóa">
                        </div>
                    </div>
                  <?php } }?>
                </div>         
            <div style="display: flex; padding: 10px 180px; justify-content: flex-end;">
            <input type="button" class="btn btn-success" id="addBtn" value="Thêm">
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">Nội dung</label>
                <div class="col-sm-10">
                <textarea class="form-control"  cols="30" rows="10" placeholder="Nội dung" required name="Noidung">@foreach($nhapkho as $nk){{$nk->Noidung}}@endforeach</textarea>
                    <span id="errorname" ></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">Tổng tiền</label>
                <div class="col-sm-10">
                <input type="text" id="totalTien" value="@foreach($nhapkho as $nk){{$nk->Tongtien}}@endforeach" name="Tongtien" readonly required placeholder ='Tổng tiền' class='form-control'>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group" style="text-align:right">
                <div class="col-sm-9 col-sm-offset-2">
                    <a class="btn btn-white" href="{{asset('/listCategory')}}">Hủy</a>
                    {!! Form::submit('Sửa', array('class'=>'btn btn-primary')) !!}
                </div>
            </div>
        </form>
    </div>
@stop

