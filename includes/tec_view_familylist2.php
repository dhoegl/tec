<script type="text/javascript" charset="utf-8">
// ****************************** Extract Children Data **************************************
// Called by tec_family (directory)
    // console.log("ARRIVED at tec_view_familylist2 script");
    var jQ15 = jQuery.noConflict();
    jQ15(document).ready(function () {
        var DTRequest = jQ15('#familytable2').DataTable({
        //"processing": true,
        //"serverSide": true,
        "ajax": {
            url: 'includes/tec_getfamilylist2.php',
            type: 'GET',
            },
        "order": [[ 2, 'asc' ]],
        "bAutoWidth": true,
        "responsive": true,
    //     "columns": [
    //   {
    //     "className": "details-control",
    //     "orderable": false,
    //     "data": null,
    //     "defaultContent": ""
    //   },
    //   null,
    //   null,
    //   null,
    //   null,
    //   null,
    // ],
        columnDefs: [ 
            {
        //     className: 'dtr-control',
            // classname: 'details-control',
            // responsivePriority: 1,
            orderable: false,
            targets:   [ 0 ]
        },
        {
    //         classname: 'dirviewname',
    //         visible: true,
    //         responsivePriority: 1,
            orderable: false,
            targets:    [ 1 ]
        }
     ]
        });
    });
</script>