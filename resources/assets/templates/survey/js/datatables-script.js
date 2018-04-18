$(document).ready(function() {
    var share = $('#share-language').attr('share');
    var dataUrl = $('#list-survey').attr('data-url');
    var send = $('#send-survey').attr('data');
    var linkShare = $('#share-language').attr('data-url');

    var language = {
        'sProcessing': Lang.get('datatable.sProcessing'),
        'sLengthMenu': Lang.get('datatable.sLengthMenu'),
        'sZeroRecords': Lang.get('datatable.sZeroRecords'),
        'sInfo': Lang.get('datatable.sInfo'),
        'sInfoEmpty': Lang.get('datatable.sInfoEmpty'),
        'sInfoFiltered': Lang.get('datatable.sInfoFiltered'),
        'searchPlaceholder': Lang.get('datatable.searchPlaceholder'),
        'sSearch': '',
        'oPaginate': {
            'sFirst': Lang.get('datatable.sFirst'),
            'sPrevious': Lang.get('datatable.sPrevious'),
            'sNext': Lang.get('datatable.sNext'),
            'sLast': Lang.get('datatable.sLast'),
        }
    };

    var tableSurvey = $('#list-survey').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: dataUrl,
        },
        columns: [
            {data: ''},
            {data: 'title'},
            {data: 'status_custom'},
            {data: ''},
            {data: 'token'},
            {data: 'created_at'},
        ],
        aoColumnDefs: [
            {
                aTargets: [0],
                searchable: false,
                orderable: false,
                mRender: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                aTargets: [1],
                searchable: false,
                orderable: false,
                mRender: function (title, type, full) {
                    return `<a href="">${title}</a>`;
                }
            },
            {
                aTargets: [2],
                mRender: function(statusCustom, type, full) {
                    return `<span style="color: #4786ff">
                        ${statusCustom} </span>`;
                }
            },
            {
                aTargets: [3],
                searchable: false,
                orderable: false,
                mRender: function (data, type, full) {
                    return `<a href="#" data-toggle="modal" data-target="#pupup-send-survey" 
                        onclick="showLinkShare()" 
                        id="send_mail" token="${full.token}">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i> 
                        ${Lang.get('profile.send')}</a>`;
                }
            },
            {
                aTargets: [4],
                searchable: false,
                mRender: function(data, type, full) {
                    return `<a class="share-facebook" href="${linkShare}">
                        <i class="fa fa-facebook-square"></i>
                        ${Lang.get('profile.share')}</a>`;
                }
            },
            {
                aTargets: [5],
                sType: 'date',
                mRender: function(date, type, full) {
                    return date;
                }
            },
        ],
        order: [5, 'desc'],
        language: language,
    });

    if ($('#list-survey_filter').length) {
        $('#list-survey_filter').prepend(`<label>
                <select name="list-survey_length" aria-controls="list-survey"
                    class="select-status select-status-survey">
                    <option value="0">${Lang.get('profile.all')}</option>
                    <option value="1">${Lang.get('profile.public')}</option>
                    <option value="2">${Lang.get('profile.private')}</option>
                    <option value="3">${Lang.get('profile.closed')}</option>
                    <option value="4">${Lang.get('profile.draft')}</option>
                </select>
            </label>`);
    }

    $('.select-status-survey').change(function(event) {
        if ($(this).val() == 0) {
            tableSurvey.columns(2).search('^.*$', true, false).draw();
        } else {
            var status = $('.select-status-survey option:selected').text();
            tableSurvey.columns(2).search(status).draw();
        }
    });

    $('#auto-focus-table').on('click', function() {  
        $('html, body').animate({scrollTop: $(this.hash).offset().top - 80}, 1200);

        return false;
    });

    if ($('#tag-link-table-survey').length) {
        $('#auto-focus-table').click();
    }

    // process send mail
    var emails = new Array();

    $('.type-email-send').keyup(function(event) {
        if (event.keyCode === 13) {
            var email = $(this).val().trim();

            if (email) {
                emails.splice(0, emails.length)
                $('.label-show-email').each(function() {
                    emails.push($(this).data('val'));
                });

                if (isEmail(email) && emails.indexOf(email) < 0) {
                    addLabelEmail(email);
                }

                $(this).val('');
                $(this).focus();
            }
        }
    });

    $('#btn-submit-send-mail').click(function(event) {
        emails.splice(0, emails.length)
        $('.label-show-email').each(function() {
            emails.push($(this).data('val'));
        });

        return false;
    });

    $('input[name="background_cover"]').click(function(event) {
        if ($(this).is(':checked')) {
            $('.btn.btn-confirm.btn-lg-profile.btn-half-width-cover').removeAttr('disabled');
        }
    });
});

function addLabelEmail(value) {
    $('.div-show-all-email').append(`<label data-val="${value}" class="label-show-email">
            ${value} <i class="fa fa-times" id="delete-label-email" onclick="deleteEmail(event)"></i>
        </label>`);
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    return regex.test(email);
}

function deleteEmail(e) {
    e.target.parentNode.remove();
}

function copyLink() {
    var $temp = $('<input>');
    $('body').append($temp);
    $temp.val($('#link-share').text()).select();
    document.execCommand('copy');
    $temp.remove();
}

function showLinkShare() {
    var token = $('#send_mail').attr('token');
    $('.link-share').text(token);
    $('.label-show-email').remove();

    return false;
}
