<script type="text/javascript">
var jQ40 = jQuery.noConflict();
jQ40(document).ready(function() {
    jQ40('#activeprayertable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "../tec_getactiveprayer.php",
        "orderClasses": false,
         "columnDefs": [ 
			{
            "targets": -2,
            "data": null,
            "defaultContent": "<button class='my_popup_open button_flat_green'>Details</button>"
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
        		className: "prayer_title",
        		"targets": [ 3 ] 
        	},
			{
        		className: "type",
        		"targets": [ 4 ] 
        	},
			{
        		className: "detailscolumn",
        		"targets": [ 5 ] 
        	},
			{
        		className: "full_text", "visible": false,
        		"targets": [ 6 ] 
        	}
        ]

    });
});
</script>

