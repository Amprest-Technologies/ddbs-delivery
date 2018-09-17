webpackJsonp([2],{

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(47);


/***/ }),

/***/ 47:
/***/ (function(module, exports) {

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
        "order": [[0, "desc"]]
    });
});

/***/ })

},[46]);