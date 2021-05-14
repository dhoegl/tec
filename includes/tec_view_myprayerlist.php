<script type="text/javascript">
var jQ8 = jQuery.noConflict();
jQ8(document).ready(function() {
    jQ8('#myexistprayertable').DataTable({
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
			"responsive": true,
			// responsive: {
            // 	details: {
            //     	type: 'column',
            //     	target: 'tr'
            //     }
            // },
//			"bSort": true,
//			"bInfo": false,
//			"bAutoWidth": true,
//			"sWrapper": "25px",
//			"orderClasses": false,
         "columnDefs": [ 
            {
                className: 'dtr-control',
				responsivePriority: 1,
                orderable: false,
                targets:   [ 0 ]
            },
			{
    	   		className: "myprayer_update",
				responsivePriority: 1,
				"targets": [ 1 ] 
	       	},
			{
        		className: "myprayer_title",
				responsivePriority: 1,
        		"targets": [ 2 ] 
        	},
			{
        		className: "updatecolumn",
				orderable: false,
				responsivePriority: 1,
        		"targets": [ 3 ] 
        	},
			{
        		className: "myprayer_answer",
                "visible": false,
				orderable: false,
				responsivePriority: 1,
        		"targets": [ 4 ] 
        	},
			{
        		className: "myprayer_who",
                "visible": false,
				orderable: false,
				responsivePriority: 1,
        		"targets": [ 5 ] 
        	},
			{
        		className: "mypraypraise",
                "visible": false,
				orderable: false,
				responsivePriority: 1,
        		"targets": [ 6 ] 
        	},
			{
        		className: "myprayer_text",
                "visible": false,
				orderable: false,
        		"targets": [ 7 ] 
        	},
			{
        		className: "indexcol",
				responsivePriority: 100,
        		"targets": [ 8 ] 
        	}

        ]

    });
});
</script>

