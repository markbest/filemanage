@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-admin">
                    <div class="panel-heading">
                        <div class="col-sm-4"><i class="fa fa-home"></i><b>文件管理</b> > 文件夹管理</div>
                        <div class="col-sm-8 align-right">
                            <button type="button" class="admin-btn btn btn-primary" data-toggle="modal" data-target="#add_item"><i class="fa fa-plus-circle"></i>添加文件夹</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th class="col-sm-1 align-center">#</th>
                                                <th class="col-sm-1 align-center">文件夹名称</th>
                                                <th class="col-sm-2 align-center">文件夹描述</th>
                                                <th class="col-sm-1 align-center">创建时间</th>
                                                <th class="col-sm-1 align-right"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($folders as $folder)
                                                <tr>
                                                    <td class="align-center">{{ $folder->id }}</td>
                                                    <td class="align-center">{{ $folder->name }}</td>
                                                    <td class="align-center">{{ $folder->description }}</td>
                                                    <td class="align-center">{{ $folder->created_at }}</td>
                                                    <td class="align-right">
                                                        <form action="{{ URL('folders/'.$folder->id) }}" method="POST" style="display:inline;">
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <button type="button" class="btn btn-danger del-data"><i class="fa fa-trash"></i>删除</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel"><label>添加文件夹</label></h4>
                                </div>
                                <form class="form-horizontal" action="{{ url('folders')}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label">文件夹名称：</label>
                                            <div class="control-content">
                                                <input type="text" name="name" class="form-control" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">文件夹描述：</label>
                                            <div class="control-content">
                                                <textarea name="description" class="form-control" required="required"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="admin-btn btn btn-default" data-dismiss="modal">取消</button>
                                        <button type="submit" class="admin-btn btn btn-primary"><i class="fa fa-floppy-o"></i>保存</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
