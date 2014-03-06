    var imageUpload = function(){
        //把图片换成正在上传gif图片
        $("#thepic").attr('src','{$config_siteurl}statics/images/loading.gif').addClass('loadingimage');
        $("#uploadImages").submit();
    }
    var updataface = function(data){
        $("#thumb").val(data.url);
        $("#thepic").removeClass('loadingimage').attr('src',data.url);
    }
