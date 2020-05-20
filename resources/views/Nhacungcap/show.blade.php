<?php $open = 'listnhacungcap' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5 style="margin-top:10px">Danh sách Nhà Cung Cấp </h5>
            @if(Auth::user()->role_id == 1)
            <a href="{{asset('/addnhasx')}}" style="margin-left: 10px;"class="btn btn-success">Thêm Nhà Cung Cấp</a>
            @endif
        </div>
        <div class="ibox-content">
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Nhà Cung Cấp</th>
                    <th>Email</th>
                    <th>SDT</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($supp as $key=>$su)
                    <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$su->TenNSX}}</td>
                    <td>{{$su->Email}}</td>
                    <td>{{$su->SDT}}</td>
                    <td>{{$su->created_at}}</td>
                    <td>{{$su->updated_at}}</td>
                    <td>
                        @if(Auth::user()->role_id == 1)
                        <a href="{{asset('/editnhasx/'.$su->id)}}" class="btn btn-sm btn-danger">Sửa</a>
                        <a href="{{asset('/delnhasx/'.$su->id)}}" class="btn btn-info btn-sm" >Xóa</a>
                        @endif
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align:center">
                {{$supp->links()}}
            </div>
        </div>
    </div>
@stop
