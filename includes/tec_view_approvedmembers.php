<script type="text/javascript">
var jQ9 = jQuery.noConflict();
jQ9(document).ready(function() {
// Generate iist of approved members- those who have been approved as associated with this church/institution
// Used to populate Registration Admin popup when approving new applicants
// Updated to try and build select/deselect function when user chooses approved member when associating 
// Last Updated: 2020/12/10
    jQ9('#approvedmemberslist').DataTable({
        //			"processing": true,
        //			"serverSide": true,
        "ajax": "../includes/tec_getapprovedmembers.php",
        //			"bJQueryUI": true,
        //			"sScrollY": "300px",
        //			"bPaginate": true,
        //			"aaSorting": [[ 1, "asc" ]],
        //			"ordering": true,
        "order": [[1, 'asc']],
        //			"scrollY":        "200px",
        //			"scrollCollapse": true,
        //			"paging":         false,
        "iDisplayLength": 10,
        //       "bLengthChange": false,
        //			"bFilter": true,
        //			"bSort": true,
        //			"bInfo": false,
        //			"bAutoWidth": true,
        //			"sWrapper": "25px",
        //			"orderClasses": false,
        "pageLength": 1,
        "responsive": true,
        "columnDefs": [
            {
                "targets": -6,
                "data": null,
                "defaultContent": "<button type='button' name='selectfam' class='btn btn-success btn-sm' data-toggle='modal' data-target='#ModalTBD'>Select</button>"
            },
            {
                className: "Select",
                "targets": [0]
            },
            {
                className: "idDirectory", "visible": true,
                "targets": [1]
            },
            {
                className: "church_ID", "visible": false,
                "responsivePriority": [2],
                "targets": [2]
            },
            {
                // className: "lastname",
                className: "Surname",
                "responsivePriority": [2],
                "targets": [3]
            },
            {
                // className: "his_name",
                className: "Name_1",
                "targets": [4]
            },
            {
                // className: "her_name",
                className: "Name_2",
                "targets": [5]
            }
        ]
    });
});
</script>