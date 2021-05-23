<script type="text/javascript">
// Detect 'Update' button on myprayer list in tec_myprayer.php
// Generate Prayer text that includes subsequent updates from prayer_update table
// Updated 20210523
var $answered = "NA";
var jQ10 = jQuery.noConflict();
 jQ10(document).ready(function () {
//	console.log("$clickbuttonID again = " + $clickbuttonid);
	var myprayerjson = 'tec_get_json_myprayer.php'
	jQ10("#myprayertable tbody").on("click", function () { //Tec_myprayer 'Update' button clicked on #myprayertable
		jQ10("tr.praytable_even").show();
		jQ10("tr.praytable_odd").show();
		jQ10("tr.praytable_text").show();
		jQ10("td.praypraise").empty();
		jQ10("td.prayanswer").empty();
		jQ10("td.praydate").empty();
		jQ10("td.praywho").empty();
		jQ10("td.praytitle").empty();
		jQ10("div.praytext").empty();
		jQ10.getJSON(myprayerjson, function (data) {
			console.log("Update button clicked for Row " + $clickbuttonid);
			if (data.prayerdata && data.prayerdata.length > 0) {
//				console.log("prayerdata exists");
				jQ10.each(data.prayerdata, function (i, rep) {
					if (rep.id === $clickbuttonid) { 
//						console.log("$clickbuttonid = " + $clickbuttonid);
						prayPraise = rep.praypraise;
						prayAnswer = rep.prayanswer;
						$answered = prayAnswer;
						prayerDate = rep.prayerdate;
						prayerWho = rep.fullname;
						prayerTitle = rep.prayertitle;
						prayerText = rep.prayertext;
						jQ10("td.praypraise").append(prayPraise);
						jQ10("td.prayanswer").append(prayAnswer);
						jQ10("td.praydate").append(prayerDate);
						jQ10("td.praywho").append(prayerWho);
						jQ10("td.praytitle").append(prayerTitle);
						jQ10("div.praytext").append(prayerText);
						console.log("$answered = " + $answered);
						if ($answered == "NO") {
							jQ10("#updatePrayer").show();
							}
							else {
								jQ10("#updatePrayer").hide();
							}

					};
				});
			};
		});
	});
});	

</script>

