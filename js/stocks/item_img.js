$(document).ready(function () {

    function importit(url, div = '', order = '', it_barcode='' , it_name='', it_section='', it_min_un='', it_pr_in='', it_pr_out='', it_min_qty='',it_id ='')
    { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order , 
                it_barcode:it_barcode ,
                 it_name:it_name ,
                  it_section:it_section ,
                   it_min_un:it_min_un , 
                   it_pr_in:it_pr_in , 
                   it_pr_out , 
                   it_min_qty:it_min_qty,
                   it_id:it_id
            },
            success: function (data) {
                $(div).html(data)
            },
            error: function () {
                // var erorr = $("#conecterorr").text();
                swal.fire({
                    position: "top",
                    title: "عذراً .. حدث خطأ في الاتصال",
                    icon: "error",
                    timer: 2500
                });
            }
        });
    } //دالة جلب ملفات الماين ديف 
    // var user_session_code = $("#user_session_code").val();//من صفحة اندكس يوزر سطر20

    // ******************************اجاكس فورم تعديل بيانات البروفايل****************************
    $(function() {
        $("#form_edit_img").ajaxForm({
            success: function (data) {
                // alert($("#finaly_it_id_for_img").val())
                // alert(data);
            if (data == 1) {
                   
                    swal.fire({
                        position: "top",
                        title: "لم تقم بإختيار صورة",
                        icon: "error",
                        timer: 2000
                    })
                }else if (data == 2) {
                   
                    swal.fire({
                        position: "top",
                        title: "لم تقم بإختيار صورة",
                        icon: "error",
                        timer: 2000
                    })
                }else if (data == 3) {
                   
                    swal.fire({
                        position: "top",
                        title: "الرجا .. إختيار صورة بإمتداد صحيح",
                        icon: "error",
                        timer: 2000
                    })
                }else if (data == 4) {
                   
                    swal.fire({
                        position: "top",
                        title: "عفوا حجم الصورة يذيد عن 2 ميغابايت",
                        icon: "error",
                        timer: 2000
                    })
                } else if (data == 5) {
                   
                    swal.fire({
                        position: "top",
                        title: "عفوا .. حدث خطا عند حذف الصورة القديمة",
                        icon: "error",
                        timer: 2000
                    })
                } 
                else {
                    $("#edit_it_img").attr("src", "img/items/" + data) // إرسال الصورة لمودل تعديل الصورة
                   
                     importit("model/stocks/03items.php", "#ittbody", "show");


                }
              
            },
            error: function (er) {
                $("#img_in_edit").html(er);

            }
        });
    });
    $("#my_img_file_val").on("change", function () {
        
    });

    // $("#send_my_img").on("click", function(e) {
    //     e.preventDefault();
    //     // var us_code = $("#finaly_us_code").val();
    //     // var my_img_file_val = $("#my_img_file_val").val();
    //  });
});//ready