<?php $open = 'Xuatkho' ?>
@extends('Admin.layout')
@section('content')
<div class="ibox float-e-margins">
   <div class="ibox-title">
      <h5 style="margin-top:10px">Đơn nhập hàng </h5>
      @if(Auth::user()->role_id == 1)
      <a href="{{asset('/addxuat')}}" style="margin-left: 10px;"class="btn btn-success">Xuất kho</a>
      @endif
      <a href="{{asset('/listSpxuatKho')}}" style="margin-left: 10px;"class="btn btn-primary">Danh sách sản phẩm xuất kho</a>
   </div>
   <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
         <div class="col-lg-12">
            <div class="ibox float-e-margins">
               <div class="ibox-title">
                  <h5>Bảng xuất hàng khỏi kho</h5>
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
                              <th>Mã xuất kho</th>
                              <th>Khách hàng</th>
                              <th>Nội dung</th>
                              <th>Người nhập</th>
                              <th>Số lượng sản phẩm xuất</th>
                              <th>Tổng Tiền</th>
                              <th>Ngày tạo</th>
                              <th>Tùy chọn</th>
                           </tr>
                        </thead>
                        <tbody>
                          @foreach($xuat as $key=>$nk)
                          <tr class="gradeX">
                            <td>{{$key+1}}</td>
                            <td>{{$nk->id}}</td>
                            <td>{{$nk->client->name}}</td>
                            <td>{{$nk->Noidung}}</td>
                            <td>{{$nk->user->name}}</td>
                            <td>{{count($nk->detaixuatkho)}}</td>
                            <td>{{number_format($nk->Tongtien)}}</td>
                            <td>{{$nk->created_at}}</td>
                            <td>
                               <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal{{$nk->id}}">Chi tiết</a>
                               @if(Auth::user()->role_id == 1)
                               <a href="{{asset('/editxuat/'.$nk->id)}}" class="btn btn-sm btn-danger">Sửa</a>
                               <a href="{{asset('/delxuat/'.$nk->id)}}" class="btn btn-info btn-sm" >Xóa</a>
                               @endif
                               <div id="myModal{{$nk->id}}" class="modal fade" role="dialog">
                                  <div class="modal-dialog modal-lg">
                                     <!-- Modal content-->
                                     <div class="modal-content">
                                        <div class="modal-header">
                                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                                           <h4 class="modal-title">Sản phẩm xuất kho mã số {{$nk->id}}</h4>
                                        </div>
                                        <div class="modal-body">
                                           <div class="wrapper animated fadeInRight">
                                              <div class="row">
                                                 <div class="col-sm-12">
                                                    <h4>Đơn xuất kho mã 
                                                       <span class="text-navy">{{$nk->id}}</span>
                                                    </h4>
                                                    <address>
                                                       <h4><b style="color: #428C48">Tên khách hàng: {{$nk->client->name}}</b></h4>
                                                       <p><i>Địa chỉ: {{$nk->client->address}}</i> </p>
                                                       <p><i>Số điện thoại: {{$nk->client->phone}}</i> </p>
                                                       <p><i>Email: {{$nk->client->email}}</i></p>
                                                       <strong>Ngày nhập</strong><br>
                                                       {{$nk->created_at}}<br>
                                                       Số lượng loại sản phẩm {{count($nk->detaixuatkho)}}<br>
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
                                                          <th>Tổng cộng</th>
                                                          <th>Ngày nhập</th>
                                                       </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?php foreach($nk->detaixuatkho as $key => $value){ ?>
                                                       <?php if($value->product){ ?>
                                                       <tr>
                                                          <td>{{$key + 1}}</td>
                                                          <td>{{$value->product->name}}</td>
                                                          <td>{{$value->product->category->name}}</td>
                                                          <td>{{$value->product->supplier->TenNCC}}</td>
                                                          <td>{{$value->sl}}</td>
                                                          <td>{{number_format($value->giaxuat). $value->dvt}}</td>
                                                          <td>{{number_format($value->sl * $value->giaxuat)}}</td>
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
                               </div>
                            </td>
                          </tr>
                          @endforeach

                        </tbody>
                        <tfoot>
                           <tr>
                              <th>STT</th>
                              <th>Mã xuất kho</th>
                              <th>Khách hàng</th>
                              <th>Nội dung</th>
                              <th>Người nhập</th>
                              <th>Số lượng sản phẩm xuất</th>
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