$('#register_user_form').submit(function(e) {
    e.preventDefault();
    var formData = new FormData($("#register_user_form")[0]);
    var InvoiceTypeForm = $(this);
    jQuery.ajax({
        dataType: 'json',
        type: 'POST',
        url: InvoiceTypeForm.attr('action'),
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        mimeType: "multipart/form-data",
        success: function(response) {          
            if (response.status == 'success') {
                $('form#register_user_form').trigger('reset');
                swal({
                    title: "success",
                    text: response.msg,
                    icon: "success",
                    dangerMode: true,
                    timer: 1500
                });
            } else if (response.status == 'failure') {
                error_msg(response.error)
            } 
        },
        error: function(error, message) {

        }
    });
    return false;
});