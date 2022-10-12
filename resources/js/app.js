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
                window.location.href = "/quiz" ;
            }
        }
    });
}
