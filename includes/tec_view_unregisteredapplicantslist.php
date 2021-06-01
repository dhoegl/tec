<script type="text/javascript">
var jQ8 = jQuery.noConflict();
jQ8(document).ready(function() {
// Generate unregistered applicants iist - those who have requested to register but have not been approved - for DataTable input
// Last Updated: 2020/12/09
    jQ8('#unregisteredapplicant').DataTable({
//			"processing": true,
//			"serverSide": true,
        "ajax": "../includes/tec_getunregisteredapplicant.php",
//			"bJQueryUI": true,
//			"sScrollY": "300px",
//			"bPaginate": true,
//			"aaSorting": [[ 1, "asc" ]],
//			"ordering": true,
			"order": [[ 11, 'desc' ]],
//			"scrollY":        "200px",
//			"scrollCollapse": true,
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
			// {
            // "targets": -4,
            // "data": null,
            // "defaultContent": "<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#ModalTBD'>Send Email</button>"
			// },
			// {
            // "targets": -5,
            // "data": null,
            // "defaultContent": "<button type='button' class='btn btn-danger applicant_reject btn-sm' data-toggle='modal' data-target='#ModalRegReject'>Reject</button>"
			// },
			// {
            // "targets": -6,
            // "data": null,
            // "defaultContent": "<button type='button' class='btn btn-success applicant_approve btn-sm' data-toggle='modal' data-target='#ModalRegApprove'>Approve</button>"
			// },
			{
			orderable: false,
            targets:  [ 0 ]
 			},
			{
       		className: "churchcode",
       		"targets": [ 1 ] 
           	},
			{
       		className: "firstname",
       		"targets": [ 2 ] 
           	},
			{
			className: "lastname",
			"targets": [ 3 ] 
        	},
			{
			className: "gender",
			"targets": [ 4 ] 
        	},
			{
			className: "username",
			"targets": [ 5 ] 
        	},
			{
			className: "email",
			"targets": [ 6 ] 
        	},
			{
			className: "regdate",
			"targets": [ 7 ] 
        	},
			{
			className: "applicant_approve",
			"targets": [ 8 ] 
        	},
			{
			className: "applicant_reject",
			"targets": [ 9 ] 
            },
            {
			className: "applicant_email",
			"targets": [ 10 ] 
            },
            {
			className: "loginid",
			"targets": [ 11 ] 
        	},
            {
			className: "dirid",
			"targets": [ 12 ] 
        	},
            {
			className: "regcount",
			"targets": [ 13 ] 
        	}
        ]
    });
    // console.log("Made it to View_Unregisteredapplicantslist");
});
</script>