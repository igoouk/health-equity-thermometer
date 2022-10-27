import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	if ($("#login-container").length > 0) {
		setLoginPage();
	}
	if ($("#quiz-container").length > 0) {
		setQuizPage();
	};
	if ($("#demographics-container").length > 0) {
		setDemogprahicsPage();
	}

	function setLoginPage() {
		$("#send-code-button").on("click", function() {
			sendCode($("#email-input").val());
		});
		$("#verify-code-button").on("click", function() {
			verifyCode($("#code-input").val());
		});
	}

	function setQuizPage() {
		$("#submit-answer-button").on("click", function() {
			checkAnswer($(".single-question").data("id"));
		});
		$("#next-button").on("click", function() {
			window.location.href = $(this).data("route");
		});
	}

	function setDemogprahicsPage() {
		var formValues = [];
		var userInterest = "";
		var userActivity = "";
		$('#interest-selection input').on('change', function() {
			userInterest = $('input:checked', '#interest-selection').val();
			formValues.push({
				"intereset": userInterest
			});
			if (userInterest == "Personal") {
				$("#interest-options-personal").show();
				$("#interest-options-work").hide();
			} else {
				$("#interest-options-personal").hide();
				$("#interest-options-work").show();
			}
		});
		$('#activity-selection input').on('change', function() {
			userActivity = $('input:checked', '#activity-selection').val();
			formValues.push({
				"activity": userActivity
			});
			if (userActivity == "Test") {
				$("#activity-target").show();
			} else {
				$("#activity-target").hide();
			}
		});
		$('#activity-target input').on('change', function() {
			$(".target-text").hide();
			$("#" + $('input:checked', '#activity-target').data("input-id")).show();
		});
		$("#next-button").on("click", function() {
			var country = "";
			var city = "";
			var jobRole = "";
			var organisation = "";
			var reason = "";
			if (userInterest == "Personal") {
				country = $("#personal-country").find(":selected").val();
				city = $("#personal-city").find(":selected").val();
				reason = $("#personal-reason").val();
                formValues.push(
                    {"country":country},
                    {"city" : city},
                    {"reason" : reason}
                );
			} else {
                country = $("#work-country").find(":selected").val();
				city = $("#work-city").find(":selected").val();
				jobRole = $("#work-role").val();
				organisation = $("#work-organisation").val();
                formValues.push(
                    {"country":country},
                    {"city" : city},
                    {"jobRole" : jobRole},
                    {"organisation" : organisation}
                    
                );
            }
			console.log(formValues);
			$("#interest-section").hide();
			$("#activity-section, #activity-selection").show();
		});
		$("#back-button").on("click", function() {
			$("#interest-section").show();
			$("#activity-section, #activity-selection").hide();
		});
		$("#start-button").on("click", function() {
			//window.location.href = $(this).data("route");
			$.ajax({
				type: 'POST',
				url: $(this).data("route"),
				data: {
					"country_id": $(this).find(":selected").data("id")
				},
				beforeSend: function() {},
				error: function(data) {},
				success: function(data) {
					populateCities(e.target.id, data);
				}
			});
		});
		let countryDropDowns = $('#work-country, #personal-country');
		countryDropDowns.prepend('<option selected="true" disabled>Choose country</option>');
		countryDropDowns.prop('selectedIndex', 0);
		countryDropDowns.change(function(e) {
			$.ajax({
				type: 'POST',
				url: $(this).data("route"),
				data: {
					"country_id": $(this).find(":selected").data("id")
				},
				beforeSend: function() {},
				error: function(data) {},
				success: function(data) {
					populateCities(e.target.id, data);
				}
			});
		});
	}

	function populateCities(field, cityArray) {
		let cityDropdown;
		if (field == "work-country") {
			cityDropdown = $("#work-city");
		} else {
			cityDropdown = $("#personal-city");
		}
		cityDropdown.empty();
		cityDropdown.show();
		cityDropdown.append('<option selected="true" disabled>Choose city</option>');
		cityDropdown.prop('selectedIndex', 0);
		$.each(cityArray, function(key, entry) {
			cityDropdown.append($('<option></option>').attr('value', entry.abbreviation).attr('city-id', entry.id).text(entry.name));
		})
	}

	function checkAnswer(questionId) {
		var selectedOptions = [];
		$("input:checked").each(function() {
			selectedOptions.push($(this).data("option-id"));
		});
		$("#information-popup").show();
		$.ajax({
			type: 'POST',
			url: $("#submit-answer-button").data("route"),
			data: {
				"questionId": questionId,
				"selectedOptions": selectedOptions
			},
			beforeSend: function() {},
			error: function(data) {
				console.log(data);
			},
			success: function(data) {
				if (data == "1") {
					$("#next-button").show();
				} else {}
			}
		});
	}
});

function sendCode(email) {
	$.ajax({
		type: 'POST',
		url: $("#send-code-button").data("route"),
		data: {
			"email": email
		},
		beforeSend: function() {
			$("#send-code-button").hide();
			$("#email-input").append("<h2>Please wait..</h2>");
		},
		error: function(data) {
			console.log(data);
		},
		success: function(data) {
			$("#verify-code-button").show();
			$("#code-input").show();
			$("#email-input").hide();
		}
	});
}

function verifyCode(code) {
	$.ajax({
		type: 'POST',
		url: $("#verify-code-button").data("route"),
		data: {
			"code": code
		},
		beforeSend: function() {},
		success: function(data) {
			if (data == "0") {
				console.log("Wrong verification code. Please try again. ")
				$("#verify-code-button").hide();
				$("#code-input").hide();
				$("#email-input").show();
				$("#send-code-button").show();
			} else {
				window.location.href = data;
			}
		}
	});
}