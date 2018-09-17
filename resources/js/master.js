$(document).ready(function () {
    "use strict";

    // Datatables initialization
    $('#deliveries-table').DataTable({
    	"scrollX": "true",
    	"oLanguage": { "sEmptyTable": "No messages are available." },
        "columnDefs": [{ 
            type: 'date-eu', 
            targets: 0 
        }],
        "order": [[ 0, "desc" ]]
    });
    
});
