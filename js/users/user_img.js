$(document).ready(function () {

    function importfun(url, div = '', order = '',us_code='',us_name='') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,us_code:us_code,us_name:us_name
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
    // var user_session_code = $("#user_session_code").val();//من صفحة اندكس يوزر سطر20

    // ******************************اجاكس فورم تعديل بيانات البروفايل****************************
    $(function() {
        $("#form_edit_us_img").ajaxForm({
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
                    $("#edit_us_img").attr("src", "img/users/" + data) // إرسال الصورة لمودل تعديل الصورة
                    $("#img_in_navbar").attr("src", "img/users/" + data) // إرسال الصورة لمودل تعديل الصورة
                   
                   importfun("model/users/01users_manegment.php", "#users_table", "show" );


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