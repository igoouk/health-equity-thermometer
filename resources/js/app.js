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
      
    $("#send-code-button").on("click", function(){
        sendCode($("#email-input").val());
    });
    $("#verify-code-button").on("click", function(){
        verifyCode($("#code-input").val());
    });

    $("#submit-answer-button").on("click", function(){
        checkAnswer($(".single-question").data("id"));
    });



    /**
     * On each question page there will be a submit button and when it is submitted a popup will come up with relevant information.
 
The red question has 3 images and draggable words, all words needs to be associated with the right image to be correct.
 
For all the following questions, except the last purple one, the answer is multi-select.
 
On the orange question, if you answer no on the first and none of above on the second you will be taken directly to results page with the correct information 
(in powerpoint). Otherwise you will go through all questions, even if you answer them wrong, with no possibility of going back and changing your answer.
 */

function checkAnswer(questionId) {
    var selectedOptions = [];
    $( "input:checked" ).each(function(){
        selectedOptions.push($(this).data("option-id"));
        
    });
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
