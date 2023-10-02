$(document).ready(function(){
    
    function importfun(url, div = '', order = '',tree4_code='',tree4_name='',tree3_code) { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,tree4_code:tree4_code,tree4_name:tree4_name,tree3_code:tree3_code
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

    $(".main_tree4").show(function(){
        importfun("model/accounts/tree4.php", "#tree4_table", "show" );
        
    });

    // $(".tree3_code_select").on("change",function(){
    //     alert($(this).val());
    //  })


      
  


    // Delete 




});//$(document).ready(function()