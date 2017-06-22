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

/**城市地址选择**/
$('.city_id').change(function(){
    city_id=$(this).val();
    url = SCOPE.city_id;
    data = {'id':city_id};
    $.post(url,data,function(result){
        if(result.status==200){
            data=result.data;
            city_html = '';
            $(data).each(function(){
                city_html +="<option value=' "+this.id+" '>"+this.name+"</option>";
            });
            $('.se_city_id').html(city_html);
        }else if(result.status==400) {
            alert(result.message);
            return;
        }
    },'json');
    
});