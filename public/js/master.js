webpackJsonp([2],{

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(47);


/***/ }),

/***/ 47:
/***/ (function(module, exports) {

$(document).ready(function () {
    "use strict";

    // -- Datatables configurations -- //

    // Users table

    $('#users-table').DataTable({
        "scrollX": "true",
        "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'All']],
        "pageLength": 20,
        "oLanguage": { "sEmptyTable": "No users are available." },
        "order": [[1, "desc"]]
    });

    // deliveries table
    var table = $('#deliveries-table').DataTable({
        "scrollX": "true",
        "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'All']],
        "pageLength": 20,
        "oLanguage": { "sEmptyTable": "No deliveries are available." },
        "columnDefs": [{
            type: 'date-eu',
            targets: 0
        }, {
            "targets": [8, 9, 10, 11],
            "visible": false
        }],
        "order": [[1, "desc"]]
    });

    // Add event listener for opening and closing details
    $('#deliveries-table').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    /* Formatting function for row details - modify as you need */
    function format(data) {
        var columns = data.slice(Math.max(data.length - 4, 1));
        return "\n            <table class=\"table w-100 my-5\">\n                <tr>\n                    <td>Sender Phone Number</td>\n                    <td>" + columns[0] + "</td>\n                </tr>\n                <tr>\n                    <td>Recipient Phone Number</td>\n                    <td>" + columns[1] + "</td>\n                </tr>\n                <tr>\n                    <td>Agent Name</td>\n                    <td>" + columns[2] + "</td>\n                </tr>\n                <tr>\n                    <td>Details of the Goods</td>\n                    <td>" + columns[3] + "</td>\n                </tr>\n            </table>";
    }

    // -- Deliveries filter handling -- //
    $('#filter-form').on('submit', function () {
        // Get the values of the location checkbox
        var parameters = '';
        var locations = [];

        // Get the status of transactions
        var status = $('input[name=status]:checked').val();

        // Get all checked values
        $.each($('input[name="locations"]:checked'), function () {
            locations.push($(this).val());
        });

        // Update Query String
        locations.length ? parameters += "location=" + locations.join(',') : '';
        status ? parameters += "&status=" + status : '';

        // Redirect to parsed location
        window.location = location.protocol + '//' + location.host + location.pathname + ("?" + parameters);
        return false;
    });
});

/***/ })

},[46]);