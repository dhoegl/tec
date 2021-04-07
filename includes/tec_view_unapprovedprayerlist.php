<script type="text/javascript">
var jQ8 = jQuery.noConflict();
jQ8(document).ready(function() {
    jQ8('#unapprovedprayertable').DataTable({
//			"processing": true,
//			"serverSide": true,
        "ajax": "tec_getunapprovedprayer.php",
//			"bJQueryUI": true,
//			"sScrollY": "300px",
//			"bPaginate": true,
//			"aaSorting": [[ 1, "asc" ]],
//			"ordering": true,
			"order": [[ 0, 'desc' ]],
			"scrollY":        "200px",
			"scrollCollapse": true,
//			"paging":         false,
//			"iDisplayLength": 100,
//       "bLengthChange": false,
//			"bFilter": true,
//			"bSort": true,
//			"bInfo": false,
//			"bAutoWidth": true,
//			"sWrapper": "25px",
//			"orderClasses": false,
         "columnDefs": [ 
//			{
//            "targets": -2,
//            "data": null,
//            "defaultContent": "<button class='my_popup_open button_flat_blue_small'>Details</button>"
//			},
			{
            "targets": -2,
            "data": null,
            "defaultContent": "<button class='my_popup2_open button_flat_blue_small view_button'>View</button>"
			},
			{
            "targets": -7,
            "data": null,
            "defaultContent": "<button class='prayer_reject_button button_flat_blue_small'>Reject</button>"
			},
			{
            "targets": -8,
            "data": null,
            "defaultContent": "<button class='prayer_approve_button button_flat_blue_small'>Approve</button>"
			},
			{
        		className: "indexcol",
        		"targets": [ 0 ] 
        	},
			{
        		className: "prayer_approve",
        		"targets": [ 1 ] 
        	},
			{
       		className: "prayer_reject",
       		"targets": [ 2 ] 
       	},
			{
       		className: "prayer_update",
       		"targets": [ 3 ] 
       	},
			{
        		className: "prayer_type",
        		"targets": [ 4 ] 
        	},
			{
        		className: "prayer_who",
        		"targets": [ 5 ] 
        	},
			{
        		className: "prayer_title",
        		"targets": [ 6 ] 
        	},
			{
        		className: "prayer_view",
        		"targets": [ 7 ] 
        	},
			{
        		className: "full_text", "visible": false,
        		"targets": [ 8 ] 
        	}
        ]

    });
    console.log("Made it to View_UnapprovedPrayerlist");
});
</script>

