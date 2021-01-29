<script type="text/javascript">
var jQ8 = jQuery.noConflict();
jQ8(document).ready(function() {
    jQ8('#familytable').DataTable({
//			"processing": true,
//			"serverSide": true,
        "ajax": "tec_getfamily.php",
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
            "defaultContent": "<button class='my_popup_open button_flat_green_small'>Details</button>"
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
        		className: "prayer_who",
        		"targets": [ 2 ] 
        	},
			{
        		className: "type",
        		"targets": [ 3 ] 
        	},
			{
        		className: "prayer_answer",
        		"targets": [ 4 ] 
        	},
			{
        		className: "prayer_title",
        		"targets": [ 5 ] 
        	},
			{
        		className: "detailscolumn",
        		"targets": [ 6 ] 
        	},
			{
        		className: "full_text", "visible": false,
        		"targets": [ 7 ] 
        	}
        ]

    });
});
</script>

