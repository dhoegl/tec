<script type="text/javascript" charset="utf-8">
//****************************** Extract Students in School Data **************************************
    var studentjQ = jQuery.noConflict();
    studentjQ(document).ready(function () {
        studentjQ.ajax({
            url: '../_tenant/Config.xml',
            type: 'Get',
            success: xmlschool
        });
    });
    function xmlschool(xml) {
            //Get name from config.xml
    var schoolnametext;
        schoolnametext = (studentjQ(xml).find('name').text());
        console.log('schoolnametext = ' + schoolnametext)
    //Add name to Pages
    //if (document.getElementById("custname")) {
    //    var name_element = document.getElementById("custname");
    //    name_element.innerHTML = schoolnametext;
    //    }

    var jQ15 = jQuery.noConflict();
        jQ15(document).ready(function() {
            var studentlist = jQ15('#studentdata').DataTable({
                //"processing": true,
                //"serverSide": true,
                paging: false,
                searching: false,
                "order": [[1, 'asc']],
                "columnDefs": [
                    {
                        "visible": false, "targets": 1
                    }
                  ],
                "ajax": {
                    url: 'services/tec_getstudentlist.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { profile_id: $profile_id, schoolname: schoolnametext }
                },
            });
        });
    }
</script>
