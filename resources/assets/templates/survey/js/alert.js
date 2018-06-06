function baseConfirm(data, callback) {
    if (typeof callback === 'undefined' && !$.isFunction(callback)) {
        return false;
    }

    data.title = '';
    data.text = data.message;
    data.buttons = true,
    data.confirmButtonText = data.confirmText;

    swal(data).then(iscomfirm => {
        if (iscomfirm) {
            callback();
        }
    });
}

function baseAlert(data, callback = null) {
    data.title = '';
    data.text = data.message;
    data.confirmButtonText = data.buttonText;
    data.allowOutsideClick = true;

    swal(data).then(callback);
}

function confirmInfo(data, callback) {
    data.icon = 'info';
    data.confirmButtonClass = 'btn-info';
    baseConfirm(data, callback);
}

function confirmWarning(data, callback) {
    data.icon = 'warning';
    data.confirmButtonClass = 'btn-warning';
    baseConfirm(data, callback);
}

function confirmDanger(data, callback) {
    data.icon = 'error';
    data.confirmButtonClass = 'btn-danger';
    baseConfirm(data, callback);
}

function alertSuccess(data, callback = null) {
    data.icon = 'success';
    data.confirmButtonClass = "btn-success";
    baseAlert(data, callback);
}

function alertInfo(data, callback = null) {
    data.icon = 'info';
    data.confirmButtonClass = 'btn-info';
    baseAlert(data, callback);
}

function alertWarning(data, callback = null) {
    data.icon = 'warning';
    data.confirmButtonClass = 'btn-warning';
    baseAlert(data, callback);
}

function alertDanger(data, callback = null) {
    data.icon = 'error';
    data.confirmButtonClass = 'btn-danger';
    baseAlert(data, callback);
}
