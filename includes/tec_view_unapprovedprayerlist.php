<script type="text/javascript">
var jQ8 = jQuery.noConflict();
jQ8(document).ready(function() {
// Generate approved prayer iist - those who have submitted prayer requests but have not been approved - for DataTable input
// Last Updated: 2021/05/28
jQ8('#unapprovedprayertable').DataTable({
//			"processing": true,
//			"serverSide": true,
        "ajax": "../includes/tec_getunapprovedprayer.php",
//			"bJQueryUI": true,
//			"sScrollY": "300px",
//			"bPaginate": true,
//			"aaSorting": [[ 1, "asc" ]],
//			"ordering": true,
			"order": [[ 0, 'desc' ]],
// 			"scrollY":        "200px",
// 			"scrollCollapse": true,
//			"paging":         false,
//			"iDisplayLength": 100,
//       "bLengthChange": false,
//			"bFilter": true,
//			"bSort": true,
//			"bInfo": false,
//			"bAutoWidth": true,
//			"sWrapper": "25px",
//			"orderClasses": false,
			"responsive": true,
         "columnDefs": [ 
			{
            "targets": -2,
            "data": null,
            "defaultContent": "<button class='my_popup2_open button_flat_blue_small view_button'>View</button>"
			},
            "targets": -6,
            "data": null,
            "defaultContent": "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#ModalPrayerEmail'>Send Email</button>"
			},
			{
            "targets": -7,
            "data": null,
            "defaultContent": "<button type='button' class='btn btn-danger PRAYER_reject' data-toggle='modal' data-target='#ModalPrayerReject'>Reject</button>"
			},
			{
            "targets": -8,
            "data": null,
            "defaultContent": "<button type='button' class='btn btn-success prayer_approve' data-toggle='modal' data-target='#ModalPrayerApprove'>Approve</button>"
			},
			{
				orderable: false,
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

