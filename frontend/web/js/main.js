$('#update-user-settings-form').on('beforeSubmit', function(event, jqXHR, settings) {
    var form = $(this);
    if(form.find('.has-error').length) {
        return false;
    }
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function(data) {
            alert(data.message);
            location.reload();
        }
    });
    return false;
});

$('#update-user-password-form').on('beforeSubmit', function(event, jqXHR, settings) {
    var form = $(this);
    if(form.find('.has-error').length) {
        return false;
    }
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function(data) {
            alert(data.message);
        }
    });
    return false;
});

