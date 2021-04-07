<script type="text/javascript">
 var jQ10 = jQuery.noConflict();
 jQ10(document).ready(function () {
	var activeprayerjson = 'tec_get_json_activeprayer.php'
	jQ10("#activeprayertable tbody").on("click", function () {
		jQ10("td.praypraise").empty();
		jQ10("td.praydate").empty();
		jQ10("td.praywho").empty();
		jQ10("td.prayanswer").empty();
		jQ10("td.praytitle").empty();
		jQ10("div.praytext").empty();
		jQ10.getJSON(activeprayerjson, function (data) {
			console.log("Details button clicked for Row " + $clickbuttonid);
//			console.log(data);
			if (data.prayerdata && data.prayerdata.length > 0) {
				console.log("prayerdata exists at tec_get_activeprayer_jquery");
				jQ10.each(data.prayerdata, function (i, rep) {
					if (rep.id === $clickbuttonid) { 
//						console.log("$clickbuttonid = " + $clickbuttonid);
						prayPraise = rep.praypraise;
						prayAnswer = rep.prayanswer;
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
					};
				});
			};
		});
	});
});	

</script>

