$(document).ready(function () {
    "use strict"

    // Bootstrap popovers.
    $(function () {
        $('[data-toggle="popover"]').popover()
    })

    // Users table
    $('#users-table').DataTable({
        "scrollX": "true",
        "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'All']],
        "pageLength": 20,
        "oLanguage": { "sEmptyTable": "No users are available." },
        "order": [[ 1, "desc" ]]
    })

    // deliveries table
    let table = $('#deliveries-table').DataTable({
    	"scrollX": "true",
        "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'All']],
        "pageLength": 20,
    	"oLanguage": { "sEmptyTable": "No deliveries are available." },
        "columnDefs": [{
            type: 'date-eu',
            targets: 0
        },
        {
            "targets": [ 8, 9, 10, 11 ],
            "visible": false
        }],
        "order": [[ 1, "desc" ]]
    })

    // Add event listener for opening and closing details
    $('#deliveries-table').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr')
        var row = table.row( tr )

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide()
            tr.removeClass('shown')
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show()
            tr.addClass('shown')
        }
    } )

    /* Formatting function for row details - modify as you need */
    function format (data) {
        let columns = data.slice(Math.max(data.length - 4, 1))
        return `
            <table class="table w-100 my-5">
                <tr>
                    <td>Sender Phone Number</td>
                    <td>${ columns[0] }</td>
                </tr>
                <tr>
                    <td>Recipient Phone Number</td>
                    <td>${ columns[1] }</td>
                </tr>
                <tr>
                    <td>Agent Name</td>
                    <td>${ columns[2] }</td>
                </tr>
                <tr>
                    <td>Details of the Goods</td>
                    <td>${ columns[3] }</td>
                </tr>
            </table>`
    }

    // -- Deliveries filter handling -- //
    $('#delivery-filter-form, #user-filter-form').on('submit', function() {
        // Get the values of the location checkbox
        var parameters = ''
        var locations = []

        // Get the status of transactions
        var status = $('input[name=status]:checked').val()

        // Get all checked values
        $.each($('input[name="locations"]:checked'), function() {
            locations.push($(this).val())
        })

        // Update Query String
        locations.length ? parameters += `location=${ locations.join(',') }` : ''
        status ?  parameters += `&status=${ status }` : ''

        // Redirect to parsed location
        window.location = location.protocol + '//' + location.host + location.pathname + `?${ parameters }`
        return false
    })
})
