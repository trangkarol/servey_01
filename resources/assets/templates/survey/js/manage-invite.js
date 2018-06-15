$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    var emailInviteds;
    var emailAnswereds;
    var emails;

    $(document).on('click', '.process-bar-survey', function(event) {
        event.preventDefault();
        emailInviteds = $(this).data('emails').split('/');
        emailAnswereds = $(this).data('emails-answered').split('/');
        emails = [...new Set([...emailInviteds ,...emailAnswereds])];
        $('.search-mail-invite').val('');
        showStatusAnswer(emails, emailAnswereds);
    });

    $(document).on('click', '.emails-not-answer', function(event) {
        event.preventDefault();
        showStatusAnswer(emailInviteds);
    });

    $(document).on('click', '.emails-answered', function(event) {
        event.preventDefault();
        showStatusAnswer(emailAnswereds, emailAnswereds);
    });

    $(document).on('click', '.all-email', function(event) {
        event.preventDefault();
        emails = [...new Set([...emailInviteds ,...emailAnswereds])];
        showStatusAnswer(emails, emailAnswereds);
    });

    $(document).on('keyup', '.search-mail-invite', function(event) {
        event.preventDefault();
        var text = $(this).val();
        var results = find(text, emails);
        showStatusAnswer(results, emailAnswereds);
    });

    function showStatusAnswer(array, answereds = null) {
        array = array.filter(function(val) {
            return val !== '';
        }).sort();
        $('.body-table-invite-status').empty();

        if (array.length) {
            $('.notice-data-empty').hide();
            $('.table-invite').show();

            array.forEach(function(item, index) {
                var element = $.inArray(item, answereds) > -1
                    ? `<span class="fa fa-circle green"></span>`
                    : `<span class="fa fa-circle blue">`;

                $('.body-table-invite-status').append(`
                    <tr>
                        <td width="20%">${index + 1}</td>
                        <td>${item}</td>
                        <td width="20%"><span class="inviter-description">${element}</span></td>
                    </tr>
                `);
            });
        } else {
            $('.notice-data-empty').show();
            $('.table-invite').hide();
        }
    }

    function find(text, array) {
        var result = [];

        for (var index in array) {
            if (array[index].indexOf(text) >= 0) {
                result.push(array[index]);
            }
        }

        return result;
    }
});
