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
    var uploadUrl = '/upload.php';
    $.ajax({
        url: uploadUrl,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false,
        data: f,
        success: function (e) {
            //msg = JSON.parse(e);
            // $("#img_show").attr("src", 'images/'+msg.key);
        },
        error: function (e) {
            alert(1)
        }
    });
}
function handleFiles (files) {
    for (var i = 0; i < files.length; i++) {
        var fd = new FormData();
        if (files[i].type.match('image.*')) {
            fd.append('file', files[i])
            sendFile(fd);
            break;
        }
    }
}


$('#input').live('change', function (e) {
    var fs = e.target.files || e.dataTransfer && e.dataTransfer.files;
    handleFiles(fs);
})


$('#drag').live('click', function (e) {
    e.stopPropagation();
    e.preventDefault();
    $('#input').trigger('click');
});


$('#drag').live('dragenter', function(e) {
    e.stopPropagation();
    e.preventDefault();
});

$('#drag').live('dragover', function(e) {
    e.stopPropagation();
    e.preventDefault();
});

$('#drag').live('drop', function(e) {
    e.stopPropagation();
    e.preventDefault();
    var a = e.originalEvent;
    var fs = a.target.files || a.dataTransfer && a.dataTransfer.files;
    handleFiles(fs);
});


