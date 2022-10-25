import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    if ($("#quiz-container").length > 0) {
        $("#send-code-button").on("click", function(){
            sendCode($("#email-input").val());
        });
        $("#verify-code-button").on("click", function(){
            verifyCode($("#code-input").val());
        });

        $("#submit-answer-button").on("click", function(){
            checkAnswer($(".single-question").data("id"));
        });
        $("#next-button").on("click", function(){
            window.location.href = $(this).data("route");
        });
    };

    if ($("#demographics-container").length > 0) {

        $('#interest-selection input').on('change', function() {
            if ($('input:checked', '#interest-selection').val() == "Personal") {
                $("#interest-options-personal").show();
                $("#interest-options-work").hide();
            } else {
                $("#interest-options-personal").hide();
                $("#interest-options-work").show();
            }
        });
        $('#activity-selection input').on('change', function() {
            if ($('input:checked', '#activity-selection').val() == "Test") {
                $("#activity-target").show();
            } else {
                $("#activity-target").hide();
                
            }
        });

        $('#activity-target input').on('change', function() {
            $(".target-text").hide();
            $("#"+$('input:checked', '#activity-target').data("input-id")).show();
        });



        let countryDropDowns = $('#work-country, #personal-country');
        countryDropDowns.prepend('<option selected="true" disabled>Choose country</option>');
        countryDropDowns.prop('selectedIndex', 0);
        countryDropDowns.change(function(e) {
            $.ajax({
                type:'POST',
                url:$(this).data("route"),
                data: {
                    "country_id":$(this).find(":selected").data("id")  
                },
                beforeSend:function(){
                },
                error:function(data){
                    
                },
                success:function(data) {
                    populateCities(e.target.id,data);
                }
            });
            //selectCity(e.target.id, $(this).find(":selected").data("id"));
        });

        $("#next-button").on("click", function(){
            $("#interest-section").hide();
            $("#activity-section, #activity-selection").show();
        });


       
    }


function populateCities(field, cityArray){


    let cityDropdown;
    if (field == "work-country") {
        cityDropdown = $("#work-city");
    }else{
        cityDropdown = $("#personal-city");
    }


        cityDropdown.empty();
        cityDropdown.show();

        cityDropdown.append('<option selected="true" disabled>Choose city</option>');
        cityDropdown.prop('selectedIndex', 0);


        $.each(cityArray, function (key, entry) {
            cityDropdown.append($('<option></option>').attr('value', entry.abbreviation).attr('city-id', entry.id).text(entry.name));
        })
     

}
function checkAnswer(questionId) {
    var selectedOptions = [];
    $( "input:checked" ).each(function(){
        selectedOptions.push($(this).data("option-id"));
        
    });
    $("#information-popup").show();
    
    $.ajax({
        type:'POST',
        url:$("#submit-answer-button").data("route"),
        data: {
            "questionId":questionId,
            "selectedOptions": selectedOptions
        },
        beforeSend:function(){
        },
        error:function(data){
            console.log(data);
        },
        success:function(data) {
            if (data == "1") {
                $("#next-button").show();
            } else {
                
            }
        }
    });
}

});
function sendCode(email) {
    $.ajax({
        type:'POST',
        url:$("#send-code-button").data("route"),
        data: {"email":email},
        beforeSend:function(){
            $("#send-code-button").hide();
            $("#email-input").append("<h2>Please wait..</h2>");
        },
        error:function(data){
            console.log(data);
        },
        success:function(data) {
            $("#verify-code-button").show();
            $("#code-input").show();
            $("#email-input").hide();
    
        }
    });
}
function verifyCode(code) {
    $.ajax({
        type:'POST',
        url:$("#verify-code-button").data("route"),
        data: {"code":code},
        beforeSend:function(){

        },
        success:function(data) {
            if (data == "0") {
                console.log("Wrong verification code. Please try again. ")
                $("#verify-code-button").hide();
                $("#code-input").hide();
                $("#email-input").show();
                $("#send-code-button").show();
            }else{
                window.location.href = data ;
            }
        }
    });
}
