$(document).ready(function(){

    function importsec(url, div = '', order = '',sec_name='') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,sec_name:sec_name
            },
            success: function (data) {
                $(div).html(data)
            },
            error: function () {
                // var erorr = $("#conecterorr").text();
                $(div).html('<div class="alert alert-warning" role="alert">عذراً .. حدث خطأ في الاتصال </div>');
            }
        });
    } //دالة جلب ملفات الماين ديف 

    $(".row_main").show(function(){
        importsec("model/stocks/01sections.php", ".sectbody", "show");
    });
    $("#btn_dd_sec").on("click",function(e){
        e.preventDefault();
        swal.fire({
            position:"top",
            title:"إضافة قسم  جديد",
            input:"text",
            inputAttributes:{
                placeholder:"ادخل إسم القسم",
                id:"ادخل إسم القسم"
            },
            confirmButtonText:"حــفظ",
            cancelButtonText:"رجوع",
            showCancelButton:true,
            preConfirm: (sec_name) =>{
                if(`${sec_name}`!=""){
                    importsec("model/stocks/01sections.php", ".sw_rusalt", "add",`${sec_name}` );
                    var cont = 0;
                    var set_time = setInterval(() => {
                        cont++;
                        if (cont == 2) {
                            importsec("model/stocks/01sections.php", ".sectbody", "show");
                            setTimeout(set_time);
                        }
                    }, 500);
                }


            }
            
        })
    });

});//ready