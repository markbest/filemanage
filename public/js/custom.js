$(function(){
    $('.left-menu-aside dt').click(function(){
        if($(this).hasClass('selected')){
            $(this).removeClass('selected');
            $(this).parent().find('dd').slideUp('fast');
        }else{
            $('.left-menu-aside dt').removeClass('selected');
            $('.left-menu-aside dd').slideUp('fast');
            $(this).addClass('selected');
            $(this).parent().find('dd').slideDown('fast');
        }
    });
    $('.left-menu-aside li a').click(function(){
        $('.left-menu-aside li').removeClass('current');
        $(this).parent().addClass('current');
    });
    $('.del-data').each(function(){
        $(this).click(function(){
            if(confirm("确定要删除数据吗")){
                $(this).parent().submit();
            }
        });
    });
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
            $('.btn-download-pic').show();
        }else{
            $('.btn-move-album').hide();
            $('.btn-delete-pic').hide();
            $('.btn-download-pic').hide();
        }
        updateSelectDate();
    });
    $('.album-list-container h3').click(function(){
        if($(this).parent().hasClass('open')){
            $(this).parent().removeClass('open').addClass('closed');
        }else{
            $(this).parent().removeClass('closed').addClass('open');
        }
    });
    $('.btn-delete-pic').click(function(){
        var num = $('.album-img-list input:checked').length;
        if(confirm("确定要删除选中的" + num + "张图片吗")){
            $('#del-pictures').submit();
        }
    });
    $('.all_checked').click(function(){
        $(this).parents('.album-list-container').find('img').click();
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
function updateSelectDate(){
    var boxes = $('.album-img-list input');
    var selected = [];
    for(var i=0;i<boxes.length;i++){
        if(boxes[i].checked == true){
            selected.push(boxes[i].value);
        }
    }
    $('input[name=del-pic-ids]').val(selected);
}