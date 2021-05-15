<script type="text/javascript">
// ****************************** Show Active Prayer Data **************************************
// Called by tec_prayer.php
var jQ8 = jQuery.noConflict();
jQ8(document).ready(function() {
    jQ8('#activeprayertable').DataTable({
//			"processing": true,
//			"serverSide": true,
        "ajax": {
            url: 'tec_getactiveprayer2.php',
            type: 'GET',
            },
//			"bJQueryUI": true,
//			"sScrollY": "600px",
//			"bPaginate": true,
//			"aaSorting": [[ 1, "asc" ]],
//			"ordering": true,
			"order": [[ 1, 'desc' ]],
//			"iDisplayLength": 100,
//			"bLengthChange": false,
//			"bFilter": true,
//			"bSort": true,
//			"bInfo": false,
            "bAutoWidth": true,
            // "responsive": true,
            "responsive": true,
            // "responsive": {
            // details: {
            //     type: 'column',
            //     target: 'tr'
            //     }
            // },
            // responsive: {
            //     details: {
            //         type: 'column'
            //     }
            // },
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
                targets:   [ 1 ]
            },
            {
        		className: "prayer_update",
                targets:   [ 2 ]
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
                "visible": false,
        		"targets": [ 5 ] 
        	},
			{
        		className: "prayer_title",
        		"targets": [ 6 ] 
        	},
			{
        		className: "glance",
        		"targets": [ 7 ] 
        	},
			{
        		className: "detailscolumn",
                orderable: false,
        		"targets": [ 8 ] 
        	},
			{
        		className: "full_text",
                "visible": false,
        		targets: [ 9 ] 
        	}
        ]

    });
});
</script>

