$(document).ready(function () {
    "use strict";

    // Datatables initialization
    let table = $('#deliveries-table').DataTable({
    	"scrollX": "true",
    	"oLanguage": { "sEmptyTable": "No messages are available." },
        "columnDefs": [{ 
            type: 'date-eu', 
            targets: 0 
        }],
        "order": [[ 0, "desc" ]]
    });

    // Add event listener for opening and closing details
    $('#deliveries-table').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format() ).show();
            tr.addClass('shown');
        }
    } );

    /* Formatting function for row details - modify as you need */
    function format ( ) {
        return '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui animi neque suscipit provident accusamus ipsum cupiditate deleniti, illum. Vitae praesentium illo est tenetur accusantium maiores incidunt excepturi nisi quis quam.</p>';
    }
    
});
