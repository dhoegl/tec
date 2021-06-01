<script type="text/javascript">
var jQ8 = jQuery.noConflict();
jQ8(document).ready(function() {
// Generate approved prayer iist - those who have submitted prayer requests but have not been approved - for DataTable input
// Last Updated: 2021/05/28
jQ8('#unapprovedprayertable').DataTable({
//			"processing": true,
//			"serverSide": true,
        	"ajax": {
				url: '../includes/tec_getunapprovedprayer.php',
				type: 'GET',
			},
//			"bJQueryUI": true,
//			"sScrollY": "300px",
//			"bPaginate": true,
//			"aaSorting": [[ 1, "asc" ]],
//			"ordering": true,
			"order": [[ 1, 'asc' ]],
// 			"scrollY":        "200px",
// 			"scrollCollapse": true,
//			"paging":         false,
//			"iDisplayLength": 100,
//       "bLengthChange": false,
//			"bFilter": true,
//			"bSort": true,
//			"bInfo": false,
			"bAutoWidth": true,
//			"sWrapper": "25px",
//			"orderClasses": false,
			"responsive": true,
         "columnDefs": [ 
			// {
            // "targets": -1,
            // "data": null,
            // "defaultContent": "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#ModalPrayerView'>View</button>"
			// },
			// {
            // "targets": -2,
            // "data": null,
            // "defaultContent": "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#ModalPrayerReject'>Reject</button>"
			// },
            // "targets": -3,
            // "data": null,
            // "defaultContent": "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#ModalPrayerApprove'>Approve</button>"
			// },
			{
				orderable: false,
        		"targets": [ 0 ] 
        	},
			{
        		className: "prayer_ID",
        		"targets": [ 1 ] 
        	},
			{
	       		className: "prayer_update",
	       		"targets": [ 2 ] 
	       	},
			   {
        		className: "prayer_who",
        		"targets": [ 3 ] 
        	},
			{
        		className: "prayer_type",
        		"targets": [ 4 ] 
        	},
			{
        		className: "prayer_title",
        		"targets": [ 5 ] 
        	},
			{
				orderable: false,
        		className: "prayer_approve",
        		"targets": [ 6 ] 
        	},
			{
				orderable: false,
	       		className: "prayer_reject",
	       		"targets": [ 7 ] 
	       	},
			{
				orderable: false,
        		className: "prayer_view",
        		"targets": [ 8 ] 
        	},
			{
        		className: "full_text",
				"visible": false,
        		"targets": [ 9 ] 
        	}
        ]

    });
    console.log("Made it to View_UnapprovedPrayerlist");
});
</script>

