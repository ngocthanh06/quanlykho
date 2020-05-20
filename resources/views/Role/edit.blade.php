
<?php $open = 'listrole' ?>
@extends('Admin.layout')
@section('content')
    <div class="ibox-title">
        <h5><a href="{{asset('admin/user')}}"> <i> <small> Danh sách quyền  </small> </i> </a></h5>
        <h5>&nbsp;/&nbsp;</h5>
        {!! $open == 'clients' ? '
        <h5>Thêm quyền</h5>
        ':''!!}
    </div>
    <div class="ibox-content">
        <form method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên quyền </label>
                <div class="col-sm-10">
                <input class="form-control" value="{{$role->name}}" type="text" placeholder="Tên quyền" name="name" id="">
                </div>
            </div>
           
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Ghi chú: </label>
                <div class="col-sm-10">
                <textarea class="form-control" name="desc" placeholder="Thêm nội dung phân quyền" cols="30" rows="10">{{$role->desc}}</textarea>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group" style="text-align:right">
                <div class="col-sm-9 col-sm-offset-2">
                    <a class="btn btn-white" href="{{asset('/listCategory')}}">Hủy</a>
                    {!! Form::submit('Sửa', array('class'=>'btn btn-primary')) !!}
                </div>
            </div>
        </form>
    </div>
@stop
