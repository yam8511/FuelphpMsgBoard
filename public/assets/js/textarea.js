$(document).ready(function(){
    $("textarea.auto-height").css("overflow", "hidden").bind("keydown keyup", function(){
        $(this).height('0px').height($(this).prop("scrollHeight") + 'px');
    }).keydown();
});