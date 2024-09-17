function store(element){
    var button = new Button(element);
    button.process();
    clearErrors();
    var form = element.closest('form'); 
    var formData = new FormData(form);
    var url = form.getAttribute('action');
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(response) {
            Toastify({
                text: response.message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                className: response.class,
            }).showToast();
            if (!response.error) {
                setTimeout(function(){
                    window.location.href = response.call_back;
                }, 500);
            }
            setTimeout(function(){
                button.normal();
            }, 500);
        },
        error: function(error) {
            button.normal();
            handleErrors(error.responseJSON);
        }
    });
}