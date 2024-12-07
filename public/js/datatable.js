$(document).ready(function() {
    $('#dataTable').DataTable( {
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "pageLength": 20
        });
    });