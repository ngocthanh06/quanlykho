<?php $open = 'listrole' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5 style="margin-top:10px">Danh sách phân quyền người dùng</h5>
            @if(Auth::user()->role_id == 1)
            <a href="{{asset('/addrole')}}" style="margin-left: 10px;"class="btn btn-success">Thêm quyền</a>
            @endif
        </div>
        <div class="ibox-content">
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên quyền </th>
                    <th>Nội dung</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($role as $key=>$ct)
                    <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$ct->name}}</td>
                    <td>{{$ct->desc}}</td>
                    <td>{{$ct->created_at}}</td>
                    <td>{{$ct->updated_at}}</td>
                    <td>
                        @if(Auth::user()->role_id == 1)
                        <a href="{{asset('/editrole/'.$ct->id)}}" class="btn btn-sm btn-danger">Sửa</a>
                        <a href="{{asset('/delrole/'.$ct->id)}}" class="btn btn-info btn-sm" >Xóa</a>
                        @else 
                        <a style="color:red" disabled>Không được cấp quyền</a>
                        @endif
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align:center">
                {{$role->links()}}
            </div>
        </div>
    </div>
@stop
