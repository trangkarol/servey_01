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

function baseAlert(data) {
    data.title = '';
    data.text = data.message;
    data.confirmButtonText = data.buttonText;
    data.allowOutsideClick = true;

    swal(data);
}

function confirmInfo(event, element, data) {
    data.icon = 'info';
    data.confirmButtonClass = 'btn-info';
    baseConfirm(data, callback);
}

function confirmWarning(event, element, data) {
    data.icon = 'warning';
    data.confirmButtonClass = 'btn-warning';
    baseConfirm(data, callback);
}

function confirmDanger(data, callback) {
    data.icon = 'error';
    data.confirmButtonClass = 'btn-danger';
    baseConfirm(data, callback);
}

function alertSuccess(data) {
    data.icon = 'success';
    data.confirmButtonClass = "btn-success";
    baseAlert(data);
}

function alertInfo(data) {
    data.icon = 'info';
    data.confirmButtonClass = 'btn-info';
    baseAlert(data);
}

function alertWarning(data) {
    data.icon = 'warning';
    data.confirmButtonClass = 'btn-warning';
    baseAlert(data);
}

function alertDanger(data) {
    data.icon = 'error';
    data.confirmButtonClass = 'btn-danger';
    baseAlert(data);
}
