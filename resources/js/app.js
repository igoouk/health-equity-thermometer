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

	if ($("#welcome-container").length > 0) {
		setWelcomePage();
		setLoginPage();
	}
	if ($("#quiz-container").length > 0) {
		setQuizPage();
	};
	if ($("#demographics-container").length > 0) {
		setDemogprahicsPage();
	}
	if ($("#result-container").length > 0) {
		setResultPage();
	}

	if ($("#previous-results-container").length > 0) {
		setPreviousResultsPage();
	}


	
	

	
});

function setResultPage(params) {

	$("#save-pdf-button").on("click", function() {
		html2pdf(document.body);
	});
}
function setPreviousResultsPage(params) {

	$(".button").on("click", function() {
		window.location.href = $(this).data("route");
	});
}
function setWelcomePage() {
	$("#get-started-button").on("click", function() {
		$("#welcome-container").hide();
		$("#send-code-container").css("display","flex");
	});
}

function setLoginPage() {
	$("#send-code-button").on("click", function() {

		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email-input").val()))
		{
			sendCode($("#email-input").val());
		}else{
			alert("You have entered an invalid email address!");
		}
		
	});
	$("#verify-code-button").on("click", function() {
		verifyCode($("#code-input").val());
	});
}

function setQuizPage() {
	$("#submit-answer-button").on("click", function() {
		checkAnswer($(".single-question").data("id"));
	});
	$("#next-button,#result-button").on("click", function() {
		window.location.href = $(this).data("route");
	});

	if ($(".second-question").length > 0 ) {
		$("#submit-answer-button").hide();
		$('.second-question input').on('change', function() {
			$("#submit-answer-button").show();
		});
		$('.main-question input').on('change', function() {
			$(".second-question").show();
		});
	}

}

function setDemogprahicsPage() {
	var formValues = [];
	var userInterest = "";
	var userActivity = "";
	$('#interest-selection input').on('change', function() {
		userInterest = $('input:checked', '#interest-selection').val();
		formValues = removeItem("interest", formValues);
		formValues.push({
			"name": "interest",
			"value": userInterest
		});
		if (userInterest == "Personal") {
			$("#interest-options-personal").show();
			$("#interest-options-work").hide();
		} else {
			$("#interest-options-personal").hide();
			$("#interest-options-work").show();
		}
		console.log(formValues)  ;
	});
	$('#activity-selection input').on('change', function() {
		userActivity = $('input:checked', '#activity-selection').val();
		formValues = removeItem("activity", formValues);
		formValues.push({
			"name": "activity",
			"value": userActivity
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
	$("#interest-section #next-button").on("click", function() {
		var country = "";
		var city = "";
		var jobRole = "";
		var organisation = "";
		var reason = "";
		var proceed = true;
		formValues = removeItem("country", formValues);
		formValues = removeItem("city", formValues);
		formValues = removeItem("reason", formValues);
		formValues = removeItem("jobRole", formValues);
		formValues = removeItem("organisation", formValues);
		if (userInterest == "Personal") {
			country = $("#personal-country").find(":selected").val();
			city = $("#personal-city").find(":selected").val();
			reason = $("#personal-reason").val();
			if (reason == "") {
				proceed = false;
			}
			formValues.push(
				{"name": "country", "value":country},
				{"name": "city", "value" : city},
				{"name": "reason", "value" : reason}
			);
		} else {
			country = $("#work-country").find(":selected").val();
			city = $("#work-city").find(":selected").val();
			jobRole = $("#work-role").val();
			organisation = $("#work-organisation").val();
			if (organisation == "" || jobRole == "") {
				proceed = false;
			}
			formValues.push(
				{"name": "country", "value":country},
				{"name": "city", "value": city},
				{"name": "jobRole", "value": jobRole},
				{"name": "organisation", "value": organisation}
				
			);
		}
		if (country == "" || country == "Choose country" || city == "" || city == "Choose city") {
			proceed = false;
		}
		if (proceed) {
			$("#interest-section").addClass("hidden");
			$("#activity-section, #activity-selection").removeClass("hidden");
		}else{
			alert("Please fill all the fields.");
		}
		
	});
	$("#activity-button-container #back-button").on("click", function() {
		$("#interest-section").removeClass("hidden");
		$("#activity-section, #activity-selection").addClass("hidden");
	});
	$("#activity-button-container #next-button").on("click", function() {
		if ($('input:checked', '#activity-target').val() == undefined) {
			alert("Please select one option.");
		}else{
			var inputName = $('input:checked', '#activity-target').val();
			var proceed = true;
			formValues = removeItem(inputName, formValues);
			formValues.push({"name" : inputName, "value": $('.target-text:visible').val()});
	
			if ($('.target-text:visible').val() == "") {
				alert("Please fill all the fields.");
			}else{
				$("#information-section").removeClass("hidden");
				$("#activity-section, #activity-selection").addClass("hidden");
			}
		}
		
		
		
	});
	$("#information-button-container #back-button").on("click", function() {
		$("#information-section").addClass("hidden");
		$("#activity-section, #activity-selection").removeClass("hidden");
	});
	$("#start-new-button").on("click", function() {
		$("#information-section").addClass("hidden");
		$("#interest-section").removeClass("hidden");
	});

	$("#previous-results-button").on("click", function() {
		window.location.href = $(this).data("route");
	});
	$("#start-previous-button").on("click", function() {
		
		$.ajax({
			type: 'POST',
			url: $(this).data("route"),
			beforeSend: function() {},
			error: function(data) {},
			success: function(data) {
				if (data != "0") {
					window.location.href = data;
				}else{
					alert("There has been an errror, please try again later: " + data);
				}
				
			}
		});
	});
	$("#start-button").on("click", function() {
		
		$.ajax({
			type: 'POST',
			url: $(this).data("route"),
			data: {
				"formValues":formValues
			},
			beforeSend: function() {},
			error: function(data) {},
			success: function(data) {
				if (data != "0") {
					window.location.href = data;
				}else{
					alert("Please fill all the fields.")
				}
				
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
function removeItem(itemName, array) {
    const newArr = array.filter(object => {
        return object.name !== itemName;
      });
    return newArr;
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
    var questionIDs = [];
    var selectedOptions = [];

	
	$(".single-question").each(function() {
		questionIDs.push($(this).data("id"))
    });
    $("input:checked,option:selected").each(function() {
        selectedOptions.push({"id":$(this).data("question-id"), "option":$(this).data("option-id")});
    });
    $("#questions-container").hide();
    $("#information-popup").show();
    $.ajax({
        type: 'POST',
        url: $("#submit-answer-button").data("route"),
        data: {
            "questionIds": questionIDs,
            "selectedOptions": selectedOptions
        },
        beforeSend: function() {},
        error: function(data) {
            console.log(data);
        },
        success: function(data) {
            if (data == "1") {
                $("#next-button").css("display","flex");
            } else if(data == "exit"){
				alert("You don't need to complete the test.");
			}
        }
    });
}
function sendCode(email) {
	$.ajax({
		type: 'POST',
		url: $("#send-code-button").data("route"),
		data: {
			"email": email
		},
		beforeSend: function() {
			$("#send-code-button").addClass("disable");
			$("#send-code-button").attr("disabled", true);
			$("#email-input").append("<h2>Please wait..</h2>");
		},
		error: function(data) {
			console.log(data);
		},
		success: function(data) {
			$("#send-code-container").hide();
			$("#verify-code-container").css("display","flex");
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
				alert("Wrong verification code. Please try again. ");
				$("#verify-code-container").css("display","none");
				$("#send-code-container").show();
				$("#send-code-button").removeClass("disable");
				$("#send-code-button").attr("disabled", false);
			} else {
				window.location.href = data;
			}
		}
	});
}