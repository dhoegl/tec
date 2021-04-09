<script type="text/javascript">
// ****************************** Show Active Prayer Data **************************************
// Called by tec_prayer.php
var jQ8 = jQuery.noConflict();
jQ8(document).ready(function() {
    jQ8('#activeprayertable').DataTable({
//			"processing": true,
//			"serverSide": true,
        "ajax": {
            url: 'tec_getactiveprayer2.php',
            type: 'GET',
            },
//			"bJQueryUI": true,
//			"sScrollY": "600px",
//			"bPaginate": true,
//			"aaSorting": [[ 1, "asc" ]],
//			"ordering": true,
			"order": [[ 2, 'desc' ]],
//			"iDisplayLength": 100,
//			"bLengthChange": false,
//			"bFilter": true,
//			"bSort": true,
//			"bInfo": false,
            "bAutoWidth": true,
            "responsive": true,
//			"sWrapper": "25px",
//			"orderClasses": false,
			"columnDefs": [ 
            {
                orderable: false,
                targets:   [ 0 ]
            },
			{
        		className: "full_text", "visible": false,
        		targets: [ -0 ] 
        	}
        ]

    });
});
</script>

