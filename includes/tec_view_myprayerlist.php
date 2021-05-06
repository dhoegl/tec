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
			responsive: {
            	details: {
                	type: 'column',
                	target: 'tr'
                }
            },
//			"bSort": true,
//			"bInfo": false,
//			"bAutoWidth": true,
//			"sWrapper": "25px",
//			"orderClasses": false,
         "columnDefs": [ 
            {
                className: 'dtr-control',
                orderable: false,
                targets:   [ 0 ]
            },
			{
        		className: "indexcol",
        		"targets": [ 1 ] 
        	},
			{
    	   		className: "myprayer_update",
       			"targets": [ 2 ] 
	       	},
			{
        		className: "myprayer_title",
        		"targets": [ 3 ] 
        	},
			{
        		className: "updatecolumn",
				orderable: false,
        		"targets": [ 4 ] 
        	},
			{
        		className: "myprayer_answer",
                "visible": false,
				orderable: false,
        		"targets": [ 5 ] 
        	},
			{
        		className: "myprayer_text",
                "visible": false,
				orderable: false,
        		"targets": [ 6 ] 
        	}
        ]

    });
});
</script>

