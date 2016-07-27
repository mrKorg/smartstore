jQuery(document).ready(function ($) {

    "use strict";
    
    $("#loginLink").on("click", function () {
        $("#form-reg").hide(100);
        $("#form-login").show(300);
    });
    $("#regLink").on("click", function () {
        $("#form-login").hide(100);
        $("#form-reg").show(300);
    });

    $("#form-reg").submit(function (e) {
        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serializeArray(),
            success: function (data){
                $("#content").html(data);
                Push.create('Поздавляем, вы зарегистрировались!', {
                    body: "Вы можете авторизоваться",
                    timeout: 5000
                });
            }
        });
        e.preventDefault();
    });

   $("#form-login").submit(function (e) {
       var form = $(this);
       $.ajax({
           type: form.attr('method'),
           url: form.attr('action'),
           data: form.serializeArray(),
           success: function (data){
               $("#content").html(data);
           }
       });
       e.preventDefault();
   });

   $("#logout").submit(function (e) {
       var form = $(this);
       $.ajax({
           type: form.attr('method'),
           url: form.attr('action'),
           data: form.serializeArray(),
           success: function (data){
               $("#content").html(data);
           }
       });
       e.preventDefault();
   });


});
