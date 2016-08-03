jQuery(document).ready(function ($) {

    "use strict";
    
    $("#loginLink").on("click", function () {
        $("#form-reg").hide(100);
        $("#form-login").show(300);
        return false;
    });
    $("#regLink").on("click", function () {
        $("#form-login").hide(100);
        $("#form-reg").show(300);
        return false;
    });

    $("#form-reg").submit(function (e) {
        var form = $(this).serializeArray();
        $.post('logic.php', form).done(function(result) {
            if(result == "success_reg"){
                $("#form-reg input").val("");
                $("#form-reg").hide(200);
                $("#form-login").show(200);
                setTimeout(function () {
                    $("#form-login .message").show(200).text("Вы удачно зарегистрировались!");
                },500);
                setTimeout(function () {
                    $("#form-login .message").hide(200).text();
                }, 4000);
            } else if(result == "unsuccessful_reg"){
                $("#form-reg .message").show(200).text("Такой логин или пароль уже существует!");
                setTimeout(function () {
                    $("#form-reg .message").hide(200).text();
                }, 4000);
            } else if(result == "not_valid_login"){
                $("#form-reg .message").show(200).text("Неверный логин!");
                setTimeout(function () {
                    $("#form-reg .message").hide(200).text();
                }, 4000);
            } else if(result == "not_valid_email"){
                $("#form-reg .message").show(200).text("Неверный email!");
                setTimeout(function () {
                    $("#form-reg .message").hide(200).text();
                }, 4000);
            }
        });
        e.preventDefault();
    });

   $("#form-login").submit(function (e) {
       var form = $(this).serializeArray();
       $.post('logic.php', form).done(function(result){
           if(result == "unsuccessful_log"){
               $("#form-login .message").show(200).text("Неверные данные для авторизации!");
               setTimeout(function () {
                   $("#form-login .message").hide(200).text();
               }, 4000);
           } else if(result == "not_valid_login"){
               $("#form-login .message").show(200).text("Неверный логин!");
               setTimeout(function () {
                   $("#form-login .message").hide(200).text();
               }, 4000);
           } else if(result == "success_log"){
               // $(location).attr('href', "profile.php");
               window.location = "profile.php";
           }
       });
       e.preventDefault();
   });

    $("#form-add-prod").submit(function (e) {
        var form = $(this).serializeArray();
        $.post('../logic.php', form).done(function(result) {
            if(result == "success_add"){
                window.location = "index.php?page=products";
            }
        });
        e.preventDefault();
    });

    $("#form-delete-prod").submit(function (e) {
        var form = $(this).serializeArray();
        $.post('../logic.php', form).done(function(result){
            if(result == "success_delete"){
                window.location = "index.php?page=delete_product";
            }
        });
        e.preventDefault();
    });

    


});
