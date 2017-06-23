$(function() {
    $("#file_upload").uploadify({
        'swf'             : SCOPE.uploadify_swf,
        'uploader'        : SCOPE.image_upload,
        'buttonText'      : "图片上传",
        'fileTypeDesc'    : "Image files",
        'fileObjName'     : 'file',
        'fileTypeExts'    : '*.gif; *.jpg; *.png',
        'onUploadSuccess' : function(file, data, response) {
        if(response){
            var obj = JSON.parse(data);
            //console.log(data);
            $('#upload_org_code_img').attr("src",obj.data);
            $('#upload_org_code_img').attr("style",'width:280px');
            $('#file_upload_image').attr("value",obj.data);
            $('#upload_org_code_img').show();
            }
        }
    });

    $("#file_upload_other").uploadify({
        'swf'             : SCOPE.uploadify_swf,
        'uploader'        : SCOPE.image_upload,
        'buttonText'      : "图片上传",
        'fileTypeDesc'    : "Image files",
        'fileObjName'     : 'file',
        'fileTypeExts'    : '*.gif; *.jpg; *.png',
        'onUploadSuccess' : function(file, data, response) {
        if(response){
            var obj = JSON.parse(data);
            $('#upload_org_code_img_other').attr("src",obj.data);
            $('#upload_org_code_img_other').attr("style",'width:280px');
            $('#file_upload_image_other').attr("value",obj.data);
            $('#upload_org_code_img_other').show();
            }
        }
    });
});