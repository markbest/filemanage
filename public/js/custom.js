$(function(){
    $('.left-menu-aside dt').click(function(){
        if($(this).hasClass('selected')){
            $(this).removeClass('selected');
            $(this).parent().find('dd').slideUp('fast');
        }else{
            $(this).addClass('selected');
            $('.left-menu-aside dd').slideUp('fast');
            $(this).parent().find('dd').slideDown('fast');
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