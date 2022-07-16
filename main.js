$(window).on('beforeunload', function() {
	$('body').hide();
	$(window).scrollTop(0);
});


if (window.location.href.match("Bmi.php") != null) {
	//Onload Event
	$(window).on("load", function() {
		$("html").css({
			"overflow": "hidden"
		});
		document.body.style.overflow = "hidden";
		//setTimeout Start
		setTimeout(function() {
			$("html").css({
				"overflow-y": "scroll",
				"scroll-behavior": "smooth"
			});
			document.body.style.overflow = "scroll";


			$(".counter").each(function() {
				var size = $(this).text().split(".")[1] ?
					$(this).text().split(".")[1].length :
					0;
				$(this)
					.prop("Counter", 0)
					.animate({
						Counter: $(this).text(),
					}, {
						duration: 5000,
						step: function(now) {
							$(this).text(parseFloat(now).toFixed(1));
						},
					});
			});


			//Bmr and Ideal weight counter
			$(".counter1").each(function() {
				var size = $(this).text().split(".")[1] ?
					$(this).text().split(".")[1].length :
					0;
				$(this)
					.prop("Counter", 0)
					.animate({
						Counter: $(this).text(),
					}, {
						duration: 5000,
						step: function(now) {
							$(this).text(parseFloat(now).toFixed(0));
						},
					});
			});
		}, 5500);
	});
}

//Hidden Card
function yesnoCheck() {
	if (document.getElementById("yesCheck").checked) {
		$("#yesCheck").change(function() {
			$("#r6").show(),
				window.scrollTo({
					top: 3000,
				});
		});

		document.getElementById("ifyes").style.display = "block";
		sbmtBtn.disabled = false;
	} else {
		if ((document.getElementById("ifyes").style.display = "block")) {
			$("#noCheck").change(function() {
				$("#r6").slideUp().fadeOut();
			});
		} else {
			document.getElementById("ifyes").style.display = "none";
			sbmtBtn.disabled = true;
		}
	}
}

if (window.location.href.match("Plan.php") != null) {
	$(document).ready(function() {
		var vdailyCalChange = $('#cal_change').text();
		if (vdailyCalChange > 1000) {
			document.getElementById("Details_plan").style.display = "none";
			document.getElementById("error").style.display = "block";
		}
	})

}