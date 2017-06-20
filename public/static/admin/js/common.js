$('.listorder input').blur(function(){
    var id = $(this).attr('attr-id');
    var listorder = $(this).val();
    var postData = {
        'id' : id,
        'listorder' : listorder,
    };
    var url = SCOPE.listorder_url;
    $.post(url,postData,function(result){
        if(result.code==200){
            location.href=result.data;
        }else{
            alert(result.msg);
        }
    },"json")
})