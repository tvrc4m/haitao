function setProgress (p) {
    if (p < 0) {
        $('#iconLoading').height(0);
        $('#process').text('');
    }
    else {
        p = p+'%';
        $('#iconLoading').height(p);
        $('#process').text('文件已上传'+p);
    }
}
function sendFile (f) {
    var uploadUrl = '/ajaxupload.php';
    $.ajax({
        url: uploadUrl,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false,
        data: f,
        success: function (e) {
            msg = JSON.parse(e);
            if(msg.key.indexOf("front") > 0){
                $("input[data-id='img1']").attr("value",msg.key);
                $("input[data-id='img1']").next().attr("src", '../'+msg.key);

            }else{
                $("input[data-id='img2']").attr("value",msg.key);
                $("input[data-id='img2']").next().attr("src", '../'+msg.key);

            }
        },
        error: function (e) {
        }
    });
}
function handleFiles (files, stype,rename) {
    var tim = new Date();
    var day = tim.getDate();
    var year = tim.getFullYear();
    var month = tim.getMonth()+1;
    month = month < 10 ? '0' + month : month;
    for (var i = 0; i < files.length; i++) {
        var fd = new FormData();
        if (files[i].type.match('image.*')) {
            fd.append('file', files[i])
            fd.append('stype', stype)
            fd.append('rename', rename)
            fd.append('fileurl', "uploadfile/member/"+year+month+day + "/")
            sendFile(fd);
            break;
        }
    }
}


/*$('#input').on('change', function (e) {
    var stype = $(this).attr('stype');
    var fs = e.target.files || e.dataTransfer && e.dataTransfer.files;
    handleFiles(fs,stype);
})*/
$(function(){
    $('.input').on('change', function (e) {
        var stype = $(this).attr('stype');
        var rename = $(this).attr('rename');
        var fs = e.target.files || e.dataTransfer && e.dataTransfer.files;
        handleFiles(fs,stype,rename);
    })


    $('.drag').on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).parent().find("input").trigger('click');
    });


    $('.drag').on('dragenter', function(e) {
        e.stopPropagation();
        e.preventDefault();
    });

    $('.drag').on('dragover', function(e) {
        e.stopPropagation();
        e.preventDefault();
    });

    $('.drag').on('drop', function(e) {
        e.stopPropagation();
        e.preventDefault();
        var a = e.originalEvent;
        var fs = a.target.files || a.dataTransfer && a.dataTransfer.files;
        handleFiles(fs);
    });
})
