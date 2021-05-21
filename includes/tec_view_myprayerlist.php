<script type="text/javascript">
var jQ8 = jQuery.noConflict();
jQ8(document).ready(function() {
    jQ8('#myexistprayertable').DataTable({
//			"processing": true,
//			"serverSide": true,
			"ajax": {
				url: 'tec_getmyprayer.php',
				type: 'GET',
			},
//			"bJQueryUI": true,
//			"sScrollY": "200px",
//			"bPaginate": true,
			"order": [[ 1, 'desc' ]],
// 			"scrollY":        "200px",
// 			"scrollCollapse": true,
//			"paging":         false,
//			"aaSorting": [[ 1, "asc" ]],
//			"iDisplayLength": 100,
//			"bLengthChange": false,
//			"bFilter": true,
			"responsive": true,
			// responsive: {
            // 	details: {
            //     	type: 'column',
            //     	target: 'tr'
            //     }
            // },
//			"bSort": true,
//			"bInfo": false,
			"bAutoWidth": true,
//			"sWrapper": "25px",
//			"orderClasses": false,
         "columnDefs": [ 
            {
                // className: 'dtr-control',
                orderable: false,
                targets:   [ 0 ]
            },
			{
        		className: "indexcol",
				// responsivePriority: 4,
        		"targets": [ 1 ] 
        	},
			{
    	   		className: "myprayer_update",
				// responsivePriority: 3,
				"targets": [ 2 ] 
	       	},
			{
        		className: "myprayer_title",
				// responsivePriority: 2,
        		"targets": [ 3 ] 
        	},
			{
        		className: "updatecolumn",
				// responsivePriority: 1,
				orderable: false,
        		"targets": [ 4 ] 
        	},
			{
        		className: "myprayer_answer",
				// responsivePriority: 1,
                "visible": false,
				orderable: false,
        		"targets": [ 5 ] 
        	},
			{
        		className: "myprayer_who",
				// responsivePriority: 1,
                "visible": false,
				orderable: false,
        		"targets": [ 6 ] 
        	},
			{
        		className: "mypraypraise",
				// responsivePriority: 1,
                "visible": false,
				orderable: false,
        		"targets": [ 7 ] 
        	},
			{
        		className: "myprayer_text",
				// responsivePriority: 1,
                "visible": false,
				orderable: false,
        		"targets": [ 8 ] 
        	}
        ]

    });
});
</script>

