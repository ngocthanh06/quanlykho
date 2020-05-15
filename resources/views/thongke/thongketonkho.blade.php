<?php $open1 = 'thongkesp'; $open ='kiemhang' ?>
@extends('Admin.layout')
@section('content')
<div class="ibox float-e-margins">
   <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
         <div class="col-lg-12">
            <div class="ibox float-e-margins">
               <div class="ibox-title">
               <h5>Bảng chi tiết thống kê sản phẩm tồn kho</h5>
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
                              <th>Danh mục</th>
                              <th>Giá nhập</th>
                              <th>Số lượng tồn</th>
                              <th>Tổng tiền</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($product)){ ?>
                           <?php foreach($product as $key => $tk){ ?>
                           <tr class="gradeX">
                              <td>{{$key + 1}}</td>
                              <td>{{$tk->name}}</td>
                              <td>{{$tk->category->name}}</td>
                              <td>{{$tk->price_before}}</td>
                            <td>{{$tk->soluong}}</td>
                            <td>{{$tk->soluong * $tk->price_before}}</td>
                           </tr>
                           <?php }} ?>
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