$("#register_user_form").submit(function(e) {
    var class_list =[]
    e.preventDefault();
    var formData = new FormData($("#register_user_form")[0]);
    var attributeForm = $(this);
   
    jQuery.ajax({
        dataType: "json",
        type: "POST",
        url: attributeForm.attr("action"),
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        mimeType: "multipart/form-data",
        beforeSend: function() {
           
        },
        success: function(response) {
            console.log(response);
          if (response.status == 'success') {
             swal({
              title: "saved",
              text: response.status.msg,
              icon: "success",
              dangerMode: true,
              timer: 1500
           });
           window.location.reload(true);
            } else if (response.status == 'failure') {
             error_msg(response.error);
             swal({
              title: "Warning",
              text: response.error.msg,
              icon: "warning",
              dangerMode: true,
              timer: 1500
           });
            }  
        },
        error: function(error, message) {},
    });


 });