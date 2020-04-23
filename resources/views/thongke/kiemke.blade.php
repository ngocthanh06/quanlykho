<?php $open = 'thongkesp' ?>
@extends('Admin.layout')
@section('content')

       <div class="wrapper wrapper-content">
   <div class="row">
               <div class="col-lg-3">
                   <div class="ibox float-e-margins">
                       <div class="ibox-title">
                           <span class="label label-success pull-right">Monthly</span>
                           <h5>Số lượng sản phẩm</h5>
                       </div>
                       <div class="ibox-content">
                           <h1 class="no-margins">{{number_format($slSP)}}</h1>
                           <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                           <small>Sản phẩm</small>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3">
                   <div class="ibox float-e-margins">
                       <div class="ibox-title">
                           <span class="label label-info pull-right">Annual</span>
                           <h5>Đang kinh doanh</h5>
                       </div>
                       <div class="ibox-content">
                           <h1 class="no-margins">{{number_format($dangkd)}}</h1>
                           <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                           <small>Sản phẩm</small>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3">
                   <div class="ibox float-e-margins">
                       <div class="ibox-title">
                           <span class="label label-primary pull-right">Today</span>
                           <h5>Ngừng kinh doanh</h5>
                       </div>
                       <div class="ibox-content">
                           <h1 class="no-margins">{{number_format($ngungkd)}}</h1>
                           <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                           <small>Sản phẩm</small>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3">
                   <div class="ibox float-e-margins">
                       <div class="ibox-title">
                           <span class="label label-danger pull-right">Low value</span>
                           <h5>Sản phẩm sắp hết hạn</h5>
                       </div>
                       <div class="ibox-content">
                           <h1 class="no-margins">{{number_format($saphh)}}</h1>
                           <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                           <small>Sản phẩm</small>
                       </div>
                   </div>
       </div>
   </div>
   <div class="row">
      <div class="col-lg-3">
          <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <span class="label label-success pull-right">Monthly</span>
                  <h5>Sản phẩm nhập kho</h5>
              </div>
              <div class="ibox-content">
              <h1 class="no-margins">{{number_format($slNhap)}}</h1>
                  <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                  <small>Sản phẩm</small>
              </div>
          </div>
      </div>
      <div class="col-lg-3">
          <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <span class="label label-info pull-right">Annual</span>
                  <h5>Sản phẩm xuất kho</h5>
              </div>
              <div class="ibox-content">
                  <h1 class="no-margins">{{number_format($slXuat)}}</h1>
                  <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                  <small>Sản phẩm</small>
              </div>
          </div>
      </div>
      <div class="col-lg-3">
          <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <span class="label label-primary pull-right">Today</span>
                  <h5>Doanh thu nhập kho</h5>
              </div>
              <div class="ibox-content">
                  <h1 class="no-margins">{{number_format($dtNhap)}}</h1>
                  <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                  <small>New visits</small>
              </div>
          </div>
      </div>
      <div class="col-lg-3">
          <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <span class="label label-danger pull-right">Low value</span>
                  <h5>Doanh thu xuất kho</h5>
              </div>
              <div class="ibox-content">
                  <h1 class="no-margins">{{number_format($dtXuat)}}</h1>
                  <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                  <small>In first month</small>
              </div>
          </div>
</div>
</div>
   <div class="row">


           <div class="row">

               <div class="col-lg-12">

                   <div class="row">
                       <div class="col-lg-6">
                           <div class="ibox float-e-margins">
                               <div class="ibox-title">
                                   <h5>Danh sách sản phẩm xuất kho <span class="label label-danger pull-right">NEW</span></h5>
                                   <div class="ibox-tools">
                                       <a class="collapse-link">
                                           <i class="fa fa-chevron-up"></i>
                                       </a>
                                       <a class="close-link">
                                           <i class="fa fa-times"></i>
                                       </a>
                                   </div>
                               </div>
                               <div class="ibox-content">
                                   <table class="table table-hover no-margins">
                                       <thead>
                                       <tr>
                                           <th>STT</th>
                                           <th>Sản phẩm</th>
                                           <th>Số lượng</th>
                                           <th>Giá xuất</th>
                                           <th>Ngày xuất</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                          @foreach($xuat as $key => $x)
                                       <tr>
                                       <td>{{$key + 1}}</td>
                                       <td><span class="label label-primary">{{$x->product->name}}</span> </td>
                                       <td> {{$x->sl}}</td>
                                       <td>{{$x->giaxuat}}</td>
                                       <td><i class="fa fa-clock-o"></i> {{$x->created_at}}</td>
                                       </tr>
                                          @endforeach
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-6">
                           <div class="ibox float-e-margins">
                               <div class="ibox-title">
                                   <h5>Danh sách sản phẩm nhập kho <span class="label label-danger pull-right">NEW</span></h5>
                                   <div class="ibox-tools">
                                       <a class="collapse-link">
                                           <i class="fa fa-chevron-up"></i>
                                       </a>
                                       <a class="close-link">
                                           <i class="fa fa-times"></i>
                                       </a>
                                   </div>
                               </div>
                               <div class="ibox-content">
                                 <table class="table table-hover no-margins">
                                    <thead>
                                    <tr>
                                       <th>STT</th>
                                       <th>Sản phẩm</th>
                                       <th>Số lượng</th>
                                       <th>Giá nhập</th>
                                       <th>Ngày xuất</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                       @foreach($nhap as $key => $x)
                                       <tr>
                                       <td>{{$key + 1}}</td>
                                       <td><span class="label label-warning">{{$x->product->name}}</span> </td>
                                       <td> {{$x->sl}}</td>
                                       <td>{{$x->gianhap}}</td>
                                       <td><i class="fa fa-clock-o"></i> {{$x->created_at}}</td>
                                       </tr>
                                          @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-lg-12">
                           <div class="ibox float-e-margins">
                               <div class="ibox-title">
                                   <h5>Danh sách khách hàng mua sản phẩm <span class="label label-danger pull-right">NEW</span></h5>
                                   <div class="ibox-tools">
                                       <a class="collapse-link">
                                           <i class="fa fa-chevron-up"></i>
                                       </a>
                                       <a class="close-link">
                                           <i class="fa fa-times"></i>
                                       </a>
                                   </div>
                               </div>
                               <div class="ibox-content">

                                   <div class="row">
                                       <div class="col-lg-12">
                                           <table class="table table-hover margin bottom">
                                               <thead>
                                               <tr>
                                                   <th style="width: 1%" class="text-center">STT</th>
                                                   <th>Họ tên khách hàng</th>
                                                   <th class="text-center">Số điện thoại</th>
                                                   <th class="text-center">Địa chỉ</th>
                                                   <th class="text-center">Email</th>
                                                   <th class="text-center">Sản phẩm mua</th>
                                                   <th class="text-center">Nội dung</th>
                                                   <th class="text-center">Ngày mua</th>
                                                   <th class="text-center">Tổng tiền</th>
                                                </tr>
                                               </thead>
                                               <tbody>
                                                  @foreach($client as $key => $cl)
                                               <tr>
                                               <td class="text-center">{{$key + 1}}</td>
                                                   <td> {{$cl->client->name}}</td>
                                               <td class="text-center">{{$cl->client->phone}}</td>
                                                   <td class="text-center"> {{$cl->client->address}}</td>
                                                   <td class="text-center"> {{$cl->client->email}}</td>
                                                   <td class="text-center"> {{count($cl->detaixuatkho)}}</td>
                                                   <td class="text-center small">{{$cl->Noidung}}</td>
                                                   <td class="text-center">{{$cl->created_at}}</td>
                                                   <td class="text-center"> <span class="label label-primary">{{$cl->Tongtien}}</span></td>
                                               </tr>
                                                   @endforeach
                                               </tbody>
                                           </table>
                                       </div>
                                       <div class="col-lg-6">
                                           <div id="world-map" style="height: 300px;"></div>
                                       </div>
                               </div>
                               </div>
                           </div>
                       </div>
                   </div>

               </div>


           </div>
           </div>
@stop