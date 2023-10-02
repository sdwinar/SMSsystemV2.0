
$(document).ready(function () {

    function importfun(url, div = '', order = '', sql_cash = '') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order, sql_cash: sql_cash
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
    $(".main_cash").show(function () {
        var cash =  $("#cash").val();
        var cash = "WHERE `op_tree_code_in` =" + cash + " GROUP BY `op_tree_code_in`";
        importfun("model/accounts/02cash.php", "#untbody", "show",cash);
    });

    $("#cash").on("change", function () {//بحث عن تغيير سيلكت  المخزن
        var cash =  $("#cash").val();
        var cash = "WHERE `op_tree_code_in` =" + cash + " GROUP BY `op_tree_code_in`";
        importfun("model/accounts/02cash.php", "#untbody", "show",cash);
   });

});//ready