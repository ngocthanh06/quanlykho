<?php $open = 'Nhapkho' ?>
@extends('Admin.layout')
@section('content')
<div class="ibox float-e-margins">
   <div class="ibox-title">
      <h5 style="margin-top:10px">Đơn nhập hàng </h5>
      <a href="{{asset('/addNhap')}}" style="margin-left: 10px;"class="btn btn-success">Tạo mới đơn hàng</a>
      <a href="{{asset('/listSpNhapKho')}}" style="margin-left: 10px;"class="btn btn-primary">Danh sách sản phẩm nhập kho</a>
   </div>
   <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
         <div class="col-lg-12">
            <div class="ibox float-e-margins">
               <div class="ibox-title">
                  <h5>Bảng đơn nhập hàng vào trong kho</h5>
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
                              <th>Mã nhập kho</th>
                              <th>Nội dung</th>
                              <th>Người nhập</th>
                              <th>Số lượng sản phẩm nhập</th>
                              <th>Tổng Tiền</th>
                              <th>Ngày tạo</th>
                              <th>Tùy chọn</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($Nhap as $key=>$nk)
                           <tr class="gradeX">
                              <td>{{$key+1}}</td>
                              <td>{{$nk->id}}</td>
                              <td>{{$nk->Noidung}}</td>
                              <td>{{$nk->user->name}}</td>
                              <td>{{count($nk->chitietnhapkho)}}</td>
                              <td>{{number_format($nk->Tongtien)}}</td>
                              <td>{{$nk->created_at}}</td>
                              <td>
                                 <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal{{$nk->id}}">Chi tiết</a>
                                 <a href="{{asset('/editNhap/'.$nk->id)}}" class="btn btn-sm btn-danger">Sửa</a>
                                 <a href="{{asset('/delNhap/'.$nk->id)}}" class="btn btn-info btn-sm" >Xóa</a>
                                 <div id="myModal{{$nk->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                       <!-- Modal content-->
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                                             <h4 class="modal-title">Sản phẩm nhập kho mã số {{$nk->id}}</h4>
                                          </div>
                                          <div class="modal-body">
                                             <div class="wrapper animated fadeInRight">
                                                <div class="row">
                                                   <div class="col-sm-12">
                                                      <h4>Đơn nhập kho mã 
                                                         <span class="text-navy">{{$nk->id}}</span>
                                                      </h4>
                                                      <address>
                                                         <strong>Ngày nhập</strong><br>
                                                         {{$nk->created_at}}<br>
                                                         Số lượng loại sản phẩm {{count($nk->chitietnhapkho)}}<br>
                                                      </address>
                                                   </div>
                                                </div>
                                                <div class="table-responsive m-t">
                                                   <table class="table invoice-table">
                                                      <thead>
                                                         <tr>
                                                            <th>STT</th>
                                                            <th>Tên sản phẩm</th>
                                                            <th>Danh mục</th>
                                                            <th>Nhà sản xuất</th>
                                                            <th>Số lượng</th>
                                                            <th>Giá nhập</th>
                                                            <th>Ngày nhập</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>
                                                         <?php foreach($nk->chitietnhapkho as $key => $value){ ?>
                                                         <?php if($value->product){ ?>
                                                         <tr>
                                                            <td>{{$key + 1}}</td>
                                                            <td>{{$value->product->name}}</td>
                                                            <td>{{$value->product->category->name}}</td>
                                                            <td>{{$value->product->supplier->TenNCC}}</td>
                                                            <td>{{$value->sl}}</td>
                                                            <td>{{number_format($value->gianhap)}}</td>
                                                            <td>{{$value->created_at}}</td>
                                                         </tr>
                                                         <?php } } ?>
                                                      </tbody>
                                                   </table>
                                                </div>
                                                <!-- /table-responsive -->
                                                <table class="table invoice-total">
                                                   <tbody>
                                                      <tr>
                                                         <td><strong>Tổng hóa đơn :</strong></td>
                                                         <td>{{number_format($nk->Tongtien)}}</td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          </div>
                                       </div>
                                    </div>
                              </td>
                           </tr>
                           </div>
                           @endforeach
                        </tbody>
                        <tfoot>
                           <tr>
                              <th>STT</th>
                              <th>Mã đơn hàng</th>
                              <th>Nội dung</th>
                              <th>Người nhập</th>
                              <th>Số lượng sản phẩm nhập</th>
                              <th>Tổng Tiền</th>
                              <th>Ngày tạo</th>
                              <th>Tùy chọn</th>
                           </tr>
                        </tfoot>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop