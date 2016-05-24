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
            $("input[data-id="+a+"]").attr("value",msg.key);
            $("input[data-id="+a+"]").next().attr("src", '../'+msg.key);


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
            if(stype != ''){
                fd.append('stype', stype)
            }
            fd.append('rename', rename)
            fd.append('fileurl', "uploadfile/member/"+year+month+day + "/")
            sendFile(fd);
            console.log(fd)
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
        console.log(fs)
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
