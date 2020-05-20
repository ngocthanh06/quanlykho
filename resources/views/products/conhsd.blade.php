<?php $open = 'conhsd'; $open1 = 'Product' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5 style="margin-top:10px">Danh sách Sản Phẩm Còn Hạn Sử Dụng </h5>
            <a href="{{asset('/addProd')}}" style="margin-left: 10px;"class="btn btn-success">Thêm Sản Phẩm</a>
        </div>
        <div class="ibox-content">
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Loại Hàng</th>
                    <th>Đơn vị tính</th>
                    <th>Số lượng</th>
                    <th>Giá nhập</th>
                    <th>Giá bán</th>
                    <th>Nhà sản xuất</th>
                    <th>Hạn sử dụng</th>
                    <th>Trạng thái</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($prod as $key=>$pr)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$pr->name}}</td>
                        <td>{{$pr->category->name}}</td>
                        <td>{{$pr->dvt}}</td>
                        <td>{{$pr->soluong}}</td>
                        <td>{{$pr->price_after}}</td>
                        <td>{{$pr->price_before}}</td>
                        <td>{{$pr->supplier->TenNCC}}</td>
                        <td>
                                @if(strtotime($pr->ngayhh) - strtotime(date('Y-m-d')) > 0)
                                <span class="badge badge-primary">Còn hạn</span>
                                @elseif(strtotime($pr->ngayhh) - strtotime(date('Y-m-d')) == 0)
                                <span class="badge badge-warning">Sắp hết hạn</span>
                                @else
                                <span class="badge badge-danger">Hết hạn</span>
                                @endif
                        </td>
                        <td>
                            @if($pr->status == 0)
                                <a href="{{asset('/changeStatusProduct/'.$pr->id)}}" class="btn btn-sm btn-link" style="color: red;text-decoration: line-through; ">Ngừng kinh doanh</a>
                            @else 
                                <a href="{{asset('/changeStatusProduct/'.$pr->id)}}" class="btn btn-sm btn-link">Đang kinh doanh</a>
                            @endif
                        </td>
                    <td>
                        <a href="{{asset('/editProd/'.$pr->id)}}" class="btn btn-sm btn-success">Sửa</a>
                        <a href="{{asset('/delProd/'.$pr->id)}}" class="btn btn-warning btn-sm" >Xóa</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align:center">
                {{$prod->links()}}
            </div>
        </div>
    </div>
@stop
