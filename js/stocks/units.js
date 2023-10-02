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

    $(".main_un").show(function(){
        importun("model/stocks/02units.php", "#untbody", "show");
    });
    $("#btn_dd_un").on("click",function(e){
        e.preventDefault();
        swal.fire({
            position:"top",
            title:"إضافة وحـدة  جديد",
            input:"text",
            inputAttributes:{
                placeholder:"ادخل إسم الوحـدة",
                id:"ادخل إسم الوحـدة"
            },
            confirmButtonText:"حــفظ",
            cancelButtonText:"رجوع",
            showCancelButton:true,
            preConfirm: (un_name) =>{
                if(`${un_name}`!=""){
                    importun("model/stocks/02units.php", ".sw_rusalt", "add",`${un_name}` );
                    var cont = 0;
                    var set_time = setInterval(() => {
                        cont++;
                        if (cont == 2) {
                            importun("model/stocks/02units.php", "#untbody", "show");
                            setTimeout(set_time);
                        }
                    }, 500);
                }


            }
            
        })
    });

});//ready