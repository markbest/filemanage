@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-admin">
                    <div class="panel-heading">
                        <div class="col-sm-4"><i class="fa fa-home"></i><b>图片管理</b> > 图片管理</div>
                        <div class="col-sm-8 align-right">
                            <button type="button" class="btn-delete-pic admin-btn btn btn-danger"><i class="fa fa-trash"></i>删除</button>
                            <button type="button" class="btn-download-pic admin-btn btn btn-primary"><i class="fa fa-download"></i>下载</button>
                            <button type="button" class="btn-move-album admin-btn btn btn-primary" data-toggle="modal" data-target="#move_item"><i class="fa fa-hand-rock-o"></i>移动到相册</button>
                            <button type="button" class="admin-btn btn btn-primary" data-toggle="modal" data-target="#add_item"><i class="fa fa-plus-circle"></i>上传图片</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        @foreach($pictures as $key=>$picture)
                            <div class="album-list-container">
                                <div class="col-sm-12 open">
                                    <h3>
                                        <div class="left">
                                            {{ $picture['name'] }}
                                            <i class="fa fa-chevron-down"></i>
                                            <em>{{ count($picture['src']) }}张</em>
                                        </div>
                                        <div class="right">
                                            <input type="checkbox" class="all-check" id="all_checked_{{ $key }}"><label for="all_checked_{{ $key }}">全选</label>
                                        </div>
                                    </h3>
                                    <div class="album-img-list">
                                        @foreach($picture['src'] as $id => $pic)
                                        <a href="javascript:void(0);" data-link="{{ asset($pic) }}">
                                            <img src="{{ asset($pic) }}">
                                            <input style="display:none;" type="checkbox" name="pic[]" value="{{ $id }}" form="move-albums" />
                                        </a>
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
                                <div class="modal-footer"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="move_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel"><label>移动到相册</label></h4>
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
                    <form id="del-pictures" action="{{ url('pictures/delete')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="del-pic-ids" type="hidden" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}" />
    <script src="{{ asset('js/dmuploader-preview.js') }}"></script>
    <script src="{{ asset('js/dmuploader.js') }}"></script>
    <script src="{{ asset('js/jquery.fancybox.js') }}"></script>
    <script>
        $(function(){
            $('#drag-and-drop-zone').dmUploader({
                url: '{{ URL("pictures/upload")}}',
                dataType: 'json',
                extraData:{'_token': $('input[name="_token"]').val()},
                allowedTypes: 'image/*',
                onInit: function(){
                    $.daniuploader.addLog('#debug-container', 'default', 'Plugin initialized correctly');
                },
                onBeforeUpload: function(id){
                    $.daniuploader.addLog('#debug-container', 'default', 'Starting the upload of #' + id);
                    $.daniuploader.updateFileStatus(id, 'default', 'Uploading...');
                },
                onNewFile: function(id, file){
                    $.daniuploader.addFile('#files-container', id, file);
                    if(typeof FileReader !== "undefined"){
                        var reader = new FileReader();
                        var img = $('#files-container').find('.uploader-image-preview').eq(0);
                        reader.onload = function (e){
                            img.attr('src', e.target.result);
                        }
                        reader.readAsDataURL(file);
                    }else{
                        $('#uploader-files').find('.uploader-image-preview').remove();
                    }
                },
                onComplete: function(){
                    $.daniuploader.addLog('#debug-container', 'default', 'All pending tranfers completed');
                    location.reload();
                },
                onUploadProgress: function(id, percent){
                    var percentStr = percent + '%';
                    $.daniuploader.updateFileProgress(id, percentStr);
                },
                onUploadSuccess: function(id, data){
                    $.daniuploader.addLog('#debug-container', 'success', 'Upload of file #' + id + ' completed');
                    $.daniuploader.addLog('#debug-container', 'info', 'Server Response for file #' + id + ': ' + JSON.stringify(data));
                    $.daniuploader.updateFileStatus(id, 'success', 'Upload Complete');
                    $.daniuploader.updateFileProgress(id, '100%');
                },
                onUploadError: function(id, message){
                    $.daniuploader.updateFileStatus(id, 'error', message);
                    $.daniuploader.addLog('#debug-container', 'error', 'Failed to Upload file #' + id + ': ' + message);
                },
                onFileTypeError: function(file){
                    $.daniuploader.addLog('#debug-container', 'error', 'File \'' + file.name + '\' cannot be added: must be an image');
                },
                onFileSizeError: function(file){
                    $.daniuploader.addLog('#debug-container', 'error', 'File \'' + file.name + '\' cannot be added: size excess limit');
                },
                onFallbackMode: function(message){
                    $.daniuploader.addLog('#debug-container', 'info', 'Browser not supported(do something else here!): ' + message);
                }
            });
        });
    </script>
@endsection
