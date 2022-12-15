import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.mobileCheck = function() {
	let check = false;
	(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
	return check;
  };
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

	if ($("#welcome-back-container").length > 0) {
		setWelcomeBackPage();
	}



	
});






var formValues = {};
var userInterest = "";
var userActivity = "";

function setWelcomeBackPage(params) {
	$(".button").on("click", function(){
		window.location.href = $(this).data("route");
	})
}

function setResultPage(params) {

	$("#save-pdf-button").on("click", function() {
		$("#result-container .container-header").css({"font-size": "21px", "line-height":"22px"});
		$("#button-container").hide();
		$("#loading-overlay").css({"display": "flex"});
		
		var optDesktop = {
			margin:       	[50,1,0,1],
			filename:     	'myfile.pdf',
			image:        	{ type: 'png'},
			html2canvas:  	{ scale: 1 },
			jsPDF:        	{ unit: 'px', format: [window.screen.width,window.screen.height], orientation: 'portrait' },
			pagebreak: 		{ after: ['#result-content'] }
			};
		var optMobile = {
			margin:       	[130,40,0,40],
			filename:     	'myfile.pdf',
			image:        	{ type: 'png'},
			html2canvas:  	{ scale: 3, ignoreElements: ["#loading-overlay"]},
			jsPDF:        	{ unit: 'px', format: [700,1400], orientation: 'portrait',precision:100 },
			pagebreak: 		{ after: ['#result-content'] }
			};
		var opt = window.mobileCheck ? optMobile : optDesktop;
			// New Promise-based usage:
			html2pdf().set(opt).from(document.body).save().then(
				function (pdf) {
					$("#result-container .container-header").css({"font-size": "42px", "line-height":"44px"});
					$("#loading-overlay").css({"display": "none"});
					$("#button-container").show();
					console.log("done");
					}, 
					function(){
					
						//Error Here
						
					});;
			
					
		
		

	});

	$("#read-more-button").on("click", function (params) {
		window.open("/pdf/Further-Resources.pdf", '_blank');
	});
	$("#download-thermometer-button").on("click", function (params) {
		window.open("/pdf/blank-thermometer.pdf", '_blank');
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
		$( "body" ).scrollTop( 300 );
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
	//disable back buttons on browser
	history.pushState(null, document.title, location.href);
	window.addEventListener('popstate', function (event)
	{
	history.pushState(null, document.title, location.href);
	});


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

	$("input").on("change", function() {
		if ($(this).is(':checked')  && $("#"+$(this).attr("id")+"-text").length > 0) {
			$("#"+$(this).attr("id")+"-text").show();
		}else{
			$(".input-holder-text input").hide();
		}
	});

}
function showFieldsForVisibleInputs() {
	//Show fields for checked options
	$("input:checked").delay(1500).each(function(){
			$(this).change();
	})
}
function setDemogprahicsPage() {
	
	
	

	
	showFieldsForVisibleInputs();
	$('#interest-selection input').on('change', function() {
		userInterest = $('input:checked', '#interest-selection').val();
		//formValues = removeItem("interest", formValues);
		formValues.interest = userInterest;
		
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
		//formValues = removeItem("activity", formValues);
		formValues.activity = userActivity;
		
		if (userActivity == "Test") {
			$("#activity-target").show();
		} else {
			$("#activity-target").hide();
		}
	});
	$('#activity-target input').on('change', function() {
		$(".target-text").hide();
		if ($("#" + $('input:checked', '#activity-target').data("input-id")).length > 0 ) {
			$("#" + $('input:checked', '#activity-target').data("input-id")).show();
		}
		
	});
	$("#interest-section #next-button").on("click", function() {
		var country = "";
		var city = "";
		var jobRole = "";
		var organisation = "";
		var reason = "";
		var proceed = true;
		/*
		formValues = removeItem("country", formValues);
		formValues = removeItem("city", formValues);
		formValues = removeItem("reason", formValues);
		formValues = removeItem("jobRole", formValues);
		formValues = removeItem("organisation", formValues);*/
		delete formValues.country;
		delete formValues.city;
		delete formValues.jobRole;
		delete formValues.organisation;
		delete formValues.reason;
		if (userInterest == "Personal") {
			country = $("#personal-country").find(":selected").val();
			city = $("#personal-city").find(":selected").val();
			reason = $("#personal-reason").val();
			if (reason == "") {
				proceed = false;
			}
			formValues.country = country;
			formValues.city = city;
			formValues.reason = reason;
			
		} else {
			country = $("#work-country").find(":selected").val();
			city = $("#work-city").find(":selected").val();
			jobRole = $("#work-role").val();
			organisation = $("#work-organisation").val();
			if (organisation == "" || jobRole == "") {
				proceed = false;
			}
			formValues.country = country;
			formValues.city = city;
			formValues.jobRole = jobRole;
			formValues.organisation = organisation;
		
		}
		if (country == "" || country == "Choose country" || city == "" || city == "Choose County/Area") {
			proceed = false;
		}
		if (proceed) {
			$("#interest-section").addClass("hidden");
			$("#activity-section, #activity-selection").removeClass("hidden");
			showFieldsForVisibleInputs();
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
			//formValues = removeItem("target", formValues);
			
			formValues.targetName = $('.target-text:visible').length != 0 ? $('.target-text:visible').val() : "Self";
	
			if (formValues.targetName == "") {
				alert("Please fill all the fields.");
			}else{
				formValues.target = $("#activity-target input:checked").val();
				$("#information-section").removeClass("hidden");
				showFieldsForVisibleInputs();
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
		showFieldsForVisibleInputs();
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
		sendFormValues($(this).data("route"));
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
function sendFormValues(route) {

	$.ajax({
		type: 'POST',
		url: route,
		data: {
			"formValues": formValues
		},
		beforeSend: function beforeSend() {},
		error: function error(data) {},
		success: function success(data) {
			if (data != "0") {

			window.location.href = data;

			} else {
			alert("Please fill all the fields.");
			}
		}
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
    
	if (cityArray.length == 0) {
		cityDropdown.append('<option selected="true" disabled value="N/A" data-city-id="999">No country/area option available</option>');
	}else{
		cityDropdown.append('<option selected="true" disabled>Choose County/Area</option>');
		$.each(cityArray, function(key, entry) {
			cityDropdown.append($('<option></option>').attr('value', entry.abbreviation).attr('city-id', entry.id).text(entry.name));
		})
	}
	cityDropdown.prop('selectedIndex', 0);
    
}

function checkAnswer(questionId) {
    var questionIDs = [];
    var selectedOptions = [];

	
	$(".single-question").each(function() {
		questionIDs.push($(this).data("id"))
    });
    $("input:checked,option:selected").each(function() {
		var optionValue = "";
		if ($(this).data("additional-field") == "") {
			optionValue = $(this).val();	
		}else{
			optionValue = $("#"+$(this).attr("id")+"-text").val();		
		}
		selectedOptions.push({"id":$(this).data("question-id"), "option":$(this).data("option-id"), "value":optionValue});
        
    });
    $("#questions-container").hide();

    
    $.ajax({
        type: 'POST',
        url: $("#submit-answer-button").data("route"),
        data: {
            "questionIds": questionIDs,
            "selectedOptions": selectedOptions
        },
        beforeSend: function() {
			
		},
        error: function(data) {
            console.log(data);
        },
        success: function(data) {
            if (data == "1") {
				$("#information-popup").show();
                $("#next-button").css("display","flex");
            } else if(data == "exit"){
				$("#next-button").attr("data-route", "/");
				$("#next-button").text("Start again");
				$("#information-text").hide();
				$("#exit-text").show();
				$("#next-button").css("display","flex");
				$("#information-popup").show();
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
			window.scrollTo(0, 0);
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
			 switch (data) {
				case "0":
					alert("Wrong verification code. Please try again.");
					$("#verify-code-container").css("display", "none");
					$("#send-code-container").show();
					$("#send-code-button").removeClass("disable");
					$("#send-code-button").attr("disabled", false);
				break;
				case "/demographics":
					window.location.href = data;
				break;
				case "/welcome-back":
					window.location.href = data;
				break;
				case "1":
					alert("Already used code. Please try again.");
					$("#verify-code-container").css("display", "none");
					$("#send-code-container").show();
					$("#send-code-button").removeClass("disable");
					$("#send-code-button").attr("disabled", false);
				break;
				default:
				
			}
		}
	});
}