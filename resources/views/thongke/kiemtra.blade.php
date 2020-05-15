<?php $open ='kiemke' ?>
@extends('Admin.layout')
@section('content')
<div class="ibox float-e-margins">
   <div class="ibox-title">
      <h5 style="margin-top:10px">Kiểm kê sản phẩm tháng </h5>
      <div class="container">
         <div class="row">
            <form method="post">
               @csrf
               <div class='col-sm-2'>
                  <div class="form-group">
                     <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" name="date" value={{date("m-Y")}} />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                     </div>
                  </div>
               </div>
               <input type="submit" style="margin-left: 10px;"class="btn btn-danger" value="Tìm kiếm">
            </form>
            
         </div>
      </div>
   </div>
   <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
         <div class="col-lg-12">
            <div class="ibox float-e-margins">
               <div class="ibox-title">
               <h5>Bảng chi tiết thống kê sản phẩm theo tháng <?php if(isset($month)) echo $month; ?></h5>
               
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
                              <th>Nhà cung cấp</th>
                              <th>Số lượng hiện có</th>
                              <th>Số lượng thực tế</th>
                              <th>Số lượng chênh lệch</th>
                              <th>Lựa chọn</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($product)){ ?>
                           <?php foreach($product as $key => $tk){ ?>
                           <tr class="gradeX">
                              <td>{{$key + 1}}</td>
                              <td>{{$tk->name}}</td>
                              <td>{{$tk->category->name}}</td>
                              <td>{{$tk->supplier->TenNCC}}</td>
                              <td>{{$tk->soluong}}</td>
                              <td><?php if(isset($tk->kiemke))
                                    echo $tk->kiemke->soluong;
                                    ?>
                              </td>
                              <td>
                                  <?php if(isset($tk->kiemke))
                                  echo $tk->soluong - $tk->kiemke->soluong; ?>
                              </td>
                              <td>
                                <a href="{{asset('/kiemke/addThucte/'.$tk->id)}}" class="btn btn-warning btn-sm">Thêm </a>
                                <?php  if(isset($tk->kiemke)) { ?>
                                <a href="{{asset('/kiemke/editThucte/'.$tk->id)}}" class="btn btn-danger btn-sm">Sửa</a>
                                <?php }?>
                               </td>
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