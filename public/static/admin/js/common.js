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
            $('.se_city_id').html('');
        }
    },'json');
    
});

/**分类选择**/
$('.category_id').change(function(){
    category_id=$(this).val();
    url = SCOPE.category_url;
    data = {'id':category_id};
    $.post(url,data,function(result){
        if(result.status==200){
            data=result.data;
            category_html = '';
           $(data.data).each(function(){
               category_html +="<input name='se_category_id[]' type='checkbox' id='checkbox-moban' value='"+this.id+"'/>"+this.name;
               category_html +="<label for='checkbox-moban'>&nbsp;</label>";
           });
            $('.se_category_id').html(category_html);
        }else if(result.status==400) {
            $('.se_category_id').html('');
        }
    },'json');
    
});

function selecttime(flag){
    if(flag==1){
        var endTime = $("#countTimeend").val();
        if(endTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',maxDate:endTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }else{
        var startTime = $("#countTimestart").val();
        if(startTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',minDate:startTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }
 }
