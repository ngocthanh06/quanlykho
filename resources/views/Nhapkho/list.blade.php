<?php $open = 'Nhapkho' ?>
@extends('Admin.layout')
@section('content')
<div class="ibox float-e-margins">
   <div class="ibox-title">
      <h5 style="margin-top:10px">Đơn nhập hàng </h5>
      <a href="{{asset('/Nhapkho')}}" style="margin-left: 10px;"class="btn btn-danger">Quay lại</a>
      <a href="{{asset('/addNhap')}}" style="margin-left: 10px;"class="btn btn-success">Tạo mới đơn hàng</a>
   </div>
   <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
         <div class="col-lg-12">
            <div class="ibox float-e-margins">
               <div class="ibox-title">
                  <h5>Bảng chi tiết sản phẩm nhập kho</h5>
                  <div class="ibox-tools">
                     <a class="collapse-link">
                     <i class="fa fa-chevron-up"></i>
                     </a>
                     <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                     <i class="fa fa-wrench"></i>
                     </a>
                     <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="ibox-content">
                  <div class="table-responsive">
                     <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                           <tr>
                              <th>STT</th>
                              <th>Sản phẩm</th>
                              <th>Nhà cung cấp</th>
                              <th>Số lượng</th>
                              <th>Giá nhập</th>
                              <th>Ngày tạo</th>
                              <th>Ngày cập nhật</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($list as $key=>$nk)
                           <tr class="gradeX">
                              <td>{{$key+1}}</td>
                              <td>{{$nk->product->name}}</td>
                              <td>{{$nk->product->supplier->TenNCC}}</td>
                              <td>{{$nk->sl}}</td>
                              <td>{{$nk->gianhap}}</td>
                              <td>{{$nk->created_at}}</td>
                              <td>{{$nk->updated_at}}</td>
                           </tr>
                           </div>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop