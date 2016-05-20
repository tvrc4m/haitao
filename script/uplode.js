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
            $("input[data-id="+a+"]").attr("value" ,msg.key);
            $("input[data-id="+a+"]").next().attr("src", msg.key);
        },
        error: function (e) {
        }
    });
}
function handleFiles (files, stype,rename) {
    for (var i = 0; i < files.length; i++) {
        var fd = new FormData();
        if (files[i].type.match('image.*')) {
            fd.append('file', files[i])
            fd.append('stype', stype)
            fd.append('rename', rename)
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
    $('.input').bind('change', function (e) {
        var stype = $(this).attr('stype');
        var rename = $(this).attr('rename');
        var fs = e.target.files || e.dataTransfer && e.dataTransfer.files;
        handleFiles(fs,stype,rename);
    })

    $('.drag').bind('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).parent().find("input").trigger('click');
        a=$(this).attr("data-id");
    });


    $('.drag').bind('dragenter', function(e) {
        e.stopPropagation();
        e.preventDefault();
    });

    $('.drag').bind('dragover', function(e) {
        e.stopPropagation();
        e.preventDefault();
    });

    $('.drag').bind('drop', function(e) {
        e.stopPropagation();
        e.preventDefault();
        var a = e.originalEvent;
        var fs = a.target.files || a.dataTransfer && a.dataTransfer.files;
        handleFiles(fs);
    });
})
