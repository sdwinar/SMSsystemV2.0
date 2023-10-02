$(document).ready(function(){

    function importun(url, div = '', order = '',un_name='') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,un_name:un_name
            },
            success: function (data) {
                $(div).html(data)
            },
            error: function () {
                // var erorr = $("#conecterorr").text();
                alert('<div class="alert alert-warning" role="alert">عذراً .. حدث خطأ في الاتصال </div>');
            }
        });
    } //دالة جلب ملفات الماين ديف 

    $(".main_stocks").show(function(){
        importun("model/stocks/06stocks.php", "#untbody", "show");
    });
  
});//ready