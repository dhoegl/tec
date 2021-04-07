<script type="text/javascript">
// Populate Popup content with Prayer Details - Unapproved prayer request
 var jQ10 = jQuery.noConflict();
 jQ10(document).ready(function () {
	var unapprovedprayerjson = 'tec_get_json_unapprovedprayer.php'
	jQ10("#unapprovedprayertable tbody").on("click", ".view_button", function () {
		jQ10("td.praypraise").empty();
		jQ10("td.praydate").empty();
		jQ10("td.praywho").empty();
		jQ10("td.praytitle").empty();
		jQ10("div.praytext").empty();
		jQ10.getJSON(unapprovedprayerjson, function (data) {
			console.log("View button clicked for Row " + $clickbuttonid);
			if (data.prayerdata && data.prayerdata.length > 0) {
				jQ10.each(data.prayerdata, function (i, rep) {
					if (rep.id === $clickbuttonid) { 
						prayPraise = rep.praypraise;
						prayerDate = rep.prayerdate;
						prayerWho = rep.fullname;
						prayerTitle = rep.prayertitle;
						prayerText = rep.prayertext;
						jQ10("td.praypraise").append(prayPraise);
						jQ10("td.praydate").append(prayerDate);
						jQ10("td.praywho").append(prayerWho);
						jQ10("td.praytitle").append(prayerTitle);
						jQ10("div.praytext").append(prayerText);
					};
				});
			};
		});
	});
});	

</script>

