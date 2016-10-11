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
    $('.del-data').each(function(){
        $(this).click(function(){
            if(confirm("确定要删除数据吗")){
                $(this).parent().submit();
            }
        });
    });
    $("a[rel=group]").fancybox({
        'transitionIn'	: 'elastic',
        'transitionOut'	: 'elastic',
        'titlePosition' : 'inside'
    });
    $('.album-img-list img').click(function(){
        if($(this).hasClass('selected')){
            $(this).removeClass('selected');
        }else{
            $(this).addClass('selected');
        }
    });
    $('.album-list-container h3').click(function(){
        if($(this).parent().hasClass('open')){
            $(this).parent().removeClass('open').addClass('closed');
        }else{
            $(this).parent().removeClass('closed').addClass('open');
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