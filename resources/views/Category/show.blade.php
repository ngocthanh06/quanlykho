<?php $open = 'listCategory' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5 style="margin-top:10px">Danh sách Loại Hàng </h5>
            <a href="{{asset('/addCate')}}" style="margin-left: 10px;"class="btn btn-success">Thêm Loại Hàng</a>
        </div>
        <div class="ibox-content">
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Loại Hàng</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($cate as $key=>$ct)
                    <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$ct->name}}</td>
                    <td>{{$ct->created_at}}</td>
                    <td>{{$ct->updated_at}}</td>
                    <td>
                     
                        <a href="{{asset('/editCate/'.$ct->id)}}" class="btn btn-sm btn-danger">Sửa</a>
                        <a href="{{asset('/delCate/'.$ct->id)}}" class="btn btn-info btn-sm" >Xóa</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align:center">
                {{$cate->links()}}
            </div>
        </div>
    </div>
@stop
