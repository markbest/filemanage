@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-admin">
                    <div class="panel-heading">
                        <div class="col-sm-4"><i class="fa fa-home"></i>文件管理</div>
                        <div class="col-sm-8 align-right">
                            <button type="button" class="btn-delete-file admin-btn btn btn-danger"><i class="fa fa-trash"></i>删除</button>
                            <button type="button" class="btn-move-file admin-btn btn btn-primary" data-toggle="modal" data-target="#move_item"><i class="fa fa-hand-rock-o"></i>移动到</button>
                            <button type="button" class="admin-btn btn btn-primary" data-toggle="modal" data-target="#add_folder"><i class="fa fa-plus-circle"></i>添加文件夹</button>
                            <button type="button" class="admin-btn btn btn-primary" data-toggle="modal" data-target="#add_item"><i class="fa fa-plus-circle"></i>上传文件</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped file-list-container">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-4 align-center">文件名</th>
                                                    <th class="col-sm-1 align-center">大小</th>
                                                    <th class="col-sm-1 align-center">修改日期</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(strpos(Request::getRequestUri(),'/folder/'))
                                                    <tr>
                                                        <td class="align-center">
                                                            <input type="checkbox" disabled />
                                                            <img src="{{ asset('images/file.png') }}">
                                                            @if($parent_id)
                                                            <label><a href="{{ url('files/folder/'.$parent_id) }}">...</a></label>
                                                            @else
                                                            <label><a href="{{ url('files') }}">...</a></label>
                                                            @endif
                                                        </td>
                                                        <td class="align-center"> - </td>
                                                        <td class="align-center"> - </td>
                                                    </tr>
                                                @endif

                                                @if(count($folders))
                                                    @foreach ($folders as $folder)
                                                    <tr>
                                                        <td class="align-center fold-list" data-id="{{ $folder->id }}">
                                                            <input type="checkbox" disabled class="folder-selected" name="folders[]" id="fold_{{ $folder->id }}"/>
                                                            <img src="{{ asset('images/folder.png') }}">
                                                            <label for="fold_{{ $folder->id }}"><a title="{{ $folder->name }}" href="{{ url('files/folder/'.$folder->id) }}">{{ $folder->name }}</a></label>
                                                        </td>
                                                        <td class="align-center"> - </td>
                                                        <td class="align-center">{{ $folder->created_at }}</td>
                                                    </tr>
                                                    @endforeach
                                                @endif

                                                @foreach ($files as $file)
                                                <tr>
                                                    <td class="align-center file-list" data-id="{{ $file->id }}">
                                                        <input type="checkbox" class="files-selected" name="files[]" value="{{ $file->id }}" id="file_{{ $file->id }}" form="move-folders"/>
                                                        <img src="{{ asset('images/file.png') }}"><label for="file_{{ $file->id }}">{{ $file->name }}</label>
                                                    </td>
                                                    <td class="align-center">{{ $file->size }}</td>
                                                    <td class="align-center">{{ $file->created_at }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="move_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel"><label>移动到</label></h4>
                                </div>
                                <form class="form-horizontal" id="move-folders" action="{{ url('files/move')}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label">选择文件夹：</label>
                                            <div class="control-content">
                                                {!! getAllFolderSelectList() !!}
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
                    <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">上传文件</h4>
                                </div>
                                <div class="col-md-12">
                                    <div id="drag-and-drop-zone" class="uploader">
                                        <div>Drag &amp; Drop Files Here</div>
                                        <div class="or">-or-</div>
                                        <div class="browser">
                                            <label>
                                                <span>Click to open the file Browser</span>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <input type="file" name="files" accept="*" multiple="multiple" title='Click to add files'>
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
                    <div class="modal fade" id="add_folder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                <input style="display:none;" type="text" name="parent_id" value="{{ $current_id }}" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">文件夹描述：</label>
                                            <div class="control-content">
                                                <textarea name="description" class="form-control"></textarea>
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
                    <form id="del-files" action="{{ url('files/delete')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="del-file-ids" type="hidden" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/dmuploader-preview.js') }}"></script>
    <script src="{{ asset('js/dmuploader.js') }}"></script>
    <script src="{{ asset('js/BootstrapMenu.min.js') }}"></script>
    <script>
        var fold = new BootstrapMenu('.fold-list', {
            fetchElementData: function($rowElem) {
                return $rowElem;
            },
            actions: [{
                name: '删除文件夹',
                iconClass: 'fa-trash',
                onClick: function($row) {
                    var id = $row.attr('data-id');
                    location.href = "{{ asset('folders/delete') }}" + '/' + id;
                }
            }]
        });
        var file = new BootstrapMenu('.file-list', {
            fetchElementData: function($rowElem) {
                return $rowElem;
            },
            actions: [{
                name: '下载',
                iconClass: 'fa-download',
                onClick: function($row) {
                    var id = $row.attr('data-id');
                    location.href = "{{ asset('files/download') }}" + '/' + id;
                }
            }]
        });
        $(function(){
            $('#drag-and-drop-zone').dmUploader({
                url: '{{ URL("files/upload")}}',
                dataType: 'json',
                extraData:{'_token': $('input[name="_token"]').val()},
                allowedTypes: '*',
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
