<script type="text/javascript">
var jQ8 = jQuery.noConflict();
jQ8(document).ready(function() {
    jQ8('#myprayertable').DataTable({
//			"processing": true,
//			"serverSide": true,
			"ajax": "tec_getmyprayer.php",
//			"bJQueryUI": true,
//			"sScrollY": "200px",
//			"bPaginate": true,
			"order": [[ 0, 'desc' ]],
			"scrollY":        "200px",
			"scrollCollapse": true,
			"paging":         false,
//			"aaSorting": [[ 1, "asc" ]],
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
            "defaultContent": "<button class='my_popup2_open button_flat_green_small'>Update</button>"
			},
			{
        		className: "indexcol",
        		"targets": [ 0 ] 
        	},
			{
       		className: "myprayer_update",
       		"targets": [ 1 ] 
       	},
//			{
//        		className: "prayer_who",
//        		"targets": [ 2 ] 
//        	},
			{
        		className: "myprayer_title",
        		"targets": [ 2 ] 
        	},
//			{
//        		className: "type",
//        		"targets": [ 4 ] 
//        	},
			{
        		className: "detailscolumn",
        		"targets": [ 3 ] 
        	},
			{
        		className: "prayer_answer", "visible": false,
        		"targets": [ 4 ] 
        	}
        ]

    });
});
</script>

