$(function(){
    /* 左侧导航栏效果 */
    $('.left-menu-aside dt').click(function(){
        if($(this).parent().hasClass('active')){
            $(this).parent().removeClass('active');
            $(this).parent().find('dd').slideUp('fast');
        }else{
            $('.left-menu-aside dl').removeClass('active');
            $('.left-menu-aside dd').slideUp('fast');
            $(this).parent().addClass('active');
            $(this).parent().find('dd').slideDown('fast');
        }
    });

    /* 删除文件再确认提示框 */
    $('.del-data').each(function(){
        $(this).click(function(){
            if(confirm("确定要删除数据吗")){
                $(this).parent().submit();
            }
        });
    });

    /* 图片选中效果 */
    $('.album-img-list img').click(function(){
        if($(this).hasClass('selected')){
            $(this).next('input').prop("checked", false);
            $(this).removeClass('selected');
        }else{
            $(this).next('input').prop('checked',true);
            $(this).addClass('selected');
        }

        if($('.album-img-list input:checked').length){
            $('.btn-move-album').show();
            $('.btn-delete-pic').show();
        }else{
            $('.btn-move-album').hide();
            $('.btn-delete-pic').hide();
        }
        updatePicSelectData();
    });

    /* 相册伸缩效果 */
    $('.album-list-container h3').click(function(){
        if($(this).parent().hasClass('open')){
            $(this).parent().removeClass('open').addClass('closed');
        }else{
            $(this).parent().removeClass('closed').addClass('open');
        }
    });

    /* 图片批量删除确认提示框 */
    $('.btn-delete-pic').click(function(){
        var num = $('.album-img-list input:checked').length;
        if(confirm("确定要删除选中的" + num + "张图片吗")){
            $('#del-pictures').submit();
        }
    });

    /* 图片全选效果 */
    $('.all-check').click(function(){
        $(this).parents('.album-list-container').find('img').click();
    });

    /* 文件选中效果 */
    $('.files-selected').click(function(){
        if($('.file-list-container input:checked').length){
            $('.btn-move-file').show();
            $('.btn-delete-file').show();
        }else{
            $('.btn-move-file').hide();
            $('.btn-delete-file').hide();
        }
        updateFileSelectData();
    });

    /* 文件批量删除确认提示框 */
    $('.btn-delete-file').click(function(){
        var num = $('.file-list-container input:checked').length;
        if(confirm("确定要删除选中的" + num + "个文件吗")){
            $('#del-files').submit();
        }
    });
});

function displaynavbar(obj){
    if($(obj).hasClass("open")){
        $(obj).removeClass("open");
        $("body").removeClass("big-page");
    }else{
        $(obj).addClass("open");
        $("body").addClass("big-page");
    }
}
function updatePicSelectData(){
    var boxes = $('.album-img-list input');
    var selected = [];
    for(var i=0;i<boxes.length;i++){
        if(boxes[i].checked == true){
            selected.push(boxes[i].value);
        }
    }
    $('input[name=del-pic-ids]').val(selected);
}
function updateFileSelectData(){
    var boxes = $('.file-list-container input[class=files-selected]');
    var selected = [];
    for(var i=0;i<boxes.length;i++){
        if(boxes[i].checked == true){
            selected.push(boxes[i].value);
        }
    }
    $('input[name=del-file-ids]').val(selected);
}