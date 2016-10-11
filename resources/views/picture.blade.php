@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-admin">
                    <div class="panel-heading">
                        <div class="col-sm-4"><i class="fa fa-home"></i><b>图片管理</b> > 图片管理</div>
                        <div class="col-sm-8 align-right">
                            <button type="button" class="admin-btn btn btn-primary" data-toggle="modal" data-target="#move_item"><i class="fa fa-hand-rock-o"></i>添加到相册</button>
                            <button type="button" class="admin-btn btn btn-primary" data-toggle="modal" data-target="#add_item"><i class="fa fa-plus-circle"></i>添加图片</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        @foreach($pictures as $picture)
                            <div class="album-list-container">
                                <div class="col-sm-12 open">
                                    <h3>{{ $picture['name'] }}<i class="fa fa-chevron-down"></i><em>{{ count($picture['src']) }}张</em></h3>
                                    <div class="album-img-list">
                                        @foreach($picture['src'] as $id => $pic)
                                        <a rel="group" href="{{ asset($pic) }}"><img src="{{ asset($pic) }}"></a>
                                        <input type="checkbox" name="pic[]" value="{{ $id }}" form="move-albums" />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">上传图片</h4>
                                </div>
                                <div class="col-md-12">
                                    <div id="drag-and-drop-zone" class="uploader">
                                        <div>Drag &amp; Drop Images Here</div>
                                        <div class="or">-or-</div>
                                        <div class="browser">
                                            <label>
                                                <span>Click to open the file Browser</span>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <input type="file" name="files" accept="image/*" multiple="multiple" title='Click to add Images'>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="panel panel-default" style="display:none;">
                                        <div class="panel-heading"><h3 class="panel-title">Debug</h3></div>
                                        <div class="panel-body panel-debug">
                                            <ul id="debug-container"></ul>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><h3 class="panel-title">Uploads</h3></div>
                                        <div class="panel-body panel-files" id='files-container'>
                                            <span class="note-container">No Files have been selected/droped yet...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="admin-btn btn btn-default" data-dismiss="modal">取消</button>
                                    <button type="submit" class="admin-btn btn btn-primary"><i class="fa fa-floppy-o"></i>保存</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="move_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel"><label>添加相册</label></h4>
                                </div>
                                <form class="form-horizontal" id="move-albums" action="{{ url('pictures/move')}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label">选择相册：</label>
                                            <div class="control-content">
                                                <select name="album" class="form-control" required="required">
                                                    <option value=""></option>
                                                    @foreach($albums as $album)
                                                    <option value="{{ $album->id }}">{{ $album->name }}</option>
                                                    @endforeach
                                                </select>
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
