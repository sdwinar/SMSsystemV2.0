$(document).ready(function () {

    function importfun(url, div = '', order = '', username = '', password = '') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order, username: username, password: password
            },
            // beforeSend: function() {
            //     $(div).html(
            //         "<center><img src='../../assets/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>"
            //     )

            // },
            success: function (data) {
                $(div).html(data)
            },
            error: function () {
                // var erorr = $("#conecterorr").text();
                $(div).html('<div class="alert alert-warning" role="alert">عذراً .. حدث خطأ في الاتصال </div>');
            }
        });
    } //دالة جلب ملفات الماين ديف 

    $("#sendlogin_btn").on("click", function (e) {//عند الضغط على تسجل الدخول 
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        if (username != '' && password != '') {
           importfun("model/main/login.php", "#login_reusalt", "login", username, password);
        }else{
            $("#login_reusalt").html('<div class="alert alert-warning" role="alert">الرجــاء تعبئة جميع الحقول </div>');
        }

    });////$("#login_submit").on("click",function(e)

});