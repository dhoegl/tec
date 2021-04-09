<script type="text/javascript">
// ****************************** Extract Actkve Prayer Data **************************************
// Called by tec_prayer.php
var jQ8 = jQuery.noConflict();
jQ8(document).ready(function() {
    jQ8('#activeprayertable').DataTable({
//			"processing": true,
//			"serverSide": true,
        "ajax": "tec_getactiveprayer.php",
//			"bJQueryUI": true,
//			"sScrollY": "600px",
//			"bPaginate": true,
//			"aaSorting": [[ 1, "asc" ]],
//			"ordering": true,
			"order": [[ 0, 'desc' ]],
//			"iDisplayLength": 100,
//			"bLengthChange": false,
//			"bFilter": true,
//			"bSort": true,
//			"bInfo": false,
//			"bAutoWidth": true,
//			"sWrapper": "25px",
//			"orderClasses": false,
			"columnDefs": [ 
			{
            "targets": -2,
            "data": null,
            "defaultContent": "<a class='btn btn-success'>Details</a>"
			},
			{
        		className: "indexcol",
        		"targets": [ 0 ] 
        	},
			{
       		className: "prayer_update",
       		"targets": [ 1 ] 
       		},
			{
       		className: "prayer_id",
       		"targets": [ 2 ] 
       		},
			{
        		className: "prayer_who",
        		"targets": [ 3 ] 
        	},
			{
        		className: "type",
        		"targets": [ 4 ] 
        	},
			{
        		className: "prayer_answer",
        		"targets": [ 5 ] 
        	},
			{
        		className: "prayer_title",
        		"targets": [ 6 ] 
        	},
			{
        		className: "detailscolumn",
        		"targets": [ 7 ] 
        	},
			{
        		className: "full_text", "visible": false,
        		"targets": [ 8 ] 
        	}
        ]

    });
});
</script>

