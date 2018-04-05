$(document).ready(function() {
    var share = $('#share-language').attr('share');
    var dataUrl = $('#list-survey').attr('data-url');
    var language = {
        "sProcessing": Lang.get('lang.sProcessing'),
        "sLengthMenu": Lang.get('lang.sLengthMenu'),
        "sZeroRecords": Lang.get('lang.sZeroRecords'),
        "sInfo": Lang.get('lang.sInfo'),
        "sInfoEmpty": Lang.get('lang.sInfoEmpty'),
        "sInfoFiltered": Lang.get('lang.sInfoFiltered'),
        "searchPlaceholder": Lang.get('lang.searchPlaceholder'),
        "sSearch": Lang.get('lang.sSearch'),
        "oPaginate": {
            "sFirst": Lang.get('lang.sFirst'),
            "sPrevious": Lang.get('lang.sPrevious'),
            "sNext":Lang.get('lang.sNext'),
            "sLast": Lang.get('lang.sLast'),
        }
    };

    $('#list-survey').DataTable({
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
                aTargets: [2],
                mRender: function(status_custom, type, full) {
                    var color = full.status ? 'green' : 'red';
                    var icon = full.status ? "<i class='fa fa-check'></i> " :
                    "<i class='fa fa-times'></i> ";

                    return "<span style='color: " + color + "'>"
                    + icon + status_custom
                    + "</span>";
                }
            },
            {
                aTargets: [3],
                searchable: false,
                mRender: function(status_custom, type, full) {
                    return "<a class='share-facebook' href=''>"
                        + "<i class='fa fa-facebook-square'></i> "
                        + share + "</a>";
                }
            },
            {
                aTargets: [4],
                sType: 'date',
                mRender: function(date, type, full) {
                    return date;
                }
            },
        ],
        order: [4, 'desc'],
        language: language,
    });

    $('#auto-focus-table').on('click', function() {  
        $('html, body').animate({scrollTop: $(this.hash).offset().top - 80}, 1200);
        return false;
    });

    if ($("#tag-link-table-survey").length) {
        $('#auto-focus-table').click();
    }
});
