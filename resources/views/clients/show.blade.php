<?php $open = 'client' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5 style="margin-top:10px">Danh sách Khách Hàng</h5>
            @if(Auth::user()->role_id == 1)
            <a href="{{asset('/addClient')}}" style="margin-left: 10px;"class="btn btn-success">Thêm Khách Hàng</a>
            @endif
        </div>
        <div class="ibox-content">
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Khách Hàng </th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($client as $key=>$ct)
                    <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$ct->name}}</td>
                    <td>{{$ct->created_at}}</td>
                    <td>{{$ct->updated_at}}</td>
                    <td>
                        @if(Auth::user()->role_id == 1)
                        <a href="{{asset('/editClient/'.$ct->id)}}" class="btn btn-sm btn-danger">Sửa</a>
                        <a href="{{asset('/delClient/'.$ct->id)}}" class="btn btn-info btn-sm" >Xóa</a>
                        @else 
                        <a style="color:red" disabled>Không được cấp quyền</a>
                        @endif
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align:center">
                {{$client->links()}}
            </div>
        </div>
    </div>
@stop
