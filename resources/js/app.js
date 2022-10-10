import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


$( document ).ready(function() {
    
    $("#verify-button").on("click", function(){
        sendVerification($("#email-input").val());
    })

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
});

function sendVerification(email) {
    $.ajax({
       type:'POST',
       url:$("#verify-button").data("route"),
       data: {"email":email},
       beforeSend:function(){
        $("#verify-button").hide();
        $("#email-input").append("<h2>Please wait..</h2>");
       },
       success:function(data) {
          console.log("show verification input and button");
       }
    });
 }

function getVerification(email) {
    $.ajax({
       type:'POST',
       url:'/getmsg',
       data:'_token = <?php echo csrf_token() ?>',
       beforeSend:function(){
        $("#verify-button").hide();
        $("#email-input").append("<h2>Please wait..</h2>");
       },
       success:function(data) {
          $("#msg").html(data.msg);
       }
    });
 }

