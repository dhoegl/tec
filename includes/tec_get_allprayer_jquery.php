<script type="text/javascript">
var $answered = "NA";
var jQ110 = jQuery.noConflict();
 jQ110(document).ready(function () {
//	console.log("$clickbuttonID again = " + $clickbuttonid);
	var allprayerjson = 'tec_get_json_allprayer.php'
	jQ110("#allprayertable tbody").on("click", function () { //Tecfamview 'Update button clicked on #allprayertable
		jQ110("tr.praytable_even").show();
		jQ110("tr.praytable_odd").show();
		jQ110("tr.praytable_text").show();
		jQ110("td.praypraise").empty();
		jQ110("td.prayanswer").empty();
		jQ110("td.praydate").empty();
		jQ110("td.praywho").empty();
		jQ110("td.praytitle").empty();
		jQ110("div.praytext").empty();
		jQ110.getJSON(allprayerjson, function (data) {
			console.log("All Church Update button clicked for Row " + $clickbuttonid);
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
						jQ110("td.praypraise").append(prayPraise);
						jQ110("td.prayanswer").append(prayAnswer);
						jQ110("td.praydate").append(prayerDate);
						jQ110("td.praywho").append(prayerWho);
						jQ110("td.praytitle").append(prayerTitle);
						jQ110("div.praytext").append(prayerText);
						console.log("$answered = " + $answered);
						if ($answered == "NO") {
							jQ110("#updatePrayer").show();
							}
							else {
								jQ110("#updatePrayer").hide();
							}

					};
				});
			};
		});
	});
});	

</script>

