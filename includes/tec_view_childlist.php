<script type="text/javascript" charset="utf-8">
// ****************************** Extract Children Data **************************************
    // console.log("ARRIVED at tec_view_childlist script");
    var jQ15 = jQuery.noConflict();
    jQ15(document).ready(function () {
        var DTRequest = jQ15('#childdata').DataTable({
        //"processing": true,
        //"serverSide": true,
        "ajax": {
            url: '../services/tec_getchildlist.php',
            type: 'GET',
		        dataType: 'json',
            data: { profile_id: $profile_id }
            },
        "order": [[ 4, 'desc' ]],
        "bAutoWidth": true,
        "responsive": true,
        columnDefs: [ {
            // className: 'dtr-control',
            orderable: false,
            targets:  [ 0 ]
        }
    ]
        });
    });
</script>