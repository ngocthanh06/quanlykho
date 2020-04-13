<?php $open = 'listProduct' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5 style="margin-top:10px">Danh sách Sản Phẩm </h5>
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
                    <th>Nhà Cung Cấp</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
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
                        <td>{{$pr->created_at}}</td>
                        <td>{{$pr->updated_at}}</td>
                    <td>
                        <a href="{{asset('/editProd/'.$pr->id)}}" class="btn btn-sm btn-danger">Sửa</a>
                        <a href="{{asset('/delProd/'.$pr->id)}}" class="btn btn-info btn-sm" >Xóa</a>
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
