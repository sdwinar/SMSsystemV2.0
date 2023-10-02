$(document).ready(function(){
    
    function importfun(url, div = '', order = '',us_code='',us_name='',username='',us_role='',us_status='',us_pass='',admin_pass='') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,us_code:us_code,us_name:us_name,username:username,us_role:us_role,us_status:us_status,us_pass:us_pass,admin_pass:admin_pass
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

    $(".main_users").show(function(){
        importfun("model/users/01users_manegment.php", "#users_table", "show" );
        
    });

    // $(".tree3_code_select").on("change",function(){ 
    //     alert($(this).val());
    //  })

$("#sub_add_us00112").on("click",function(){
    us_name = $("#admin_add_user_name").val();
    username = $("#admin_add_username").val();
    us_role = $("#admin_add_us_role").val();
    us_status = $("#admin_add_us_status").val();
    us_pass = $("#admin_add_user_pass").val();
    admin_pass = $("#admin_add_admin_pass").val();
    if(username==''){
        swal.fire({
            position: "top",
            title: "بعض الحقول فارغة",
            icon: "error",
            timer: 2500
        })
    }else{
        importfun("model/users/03add_us.php", "#us_add_rus", "add","",us_name,username,us_role,us_status,us_pass,admin_pass );
        var cont = 0;
        var readdorder = setInterval(function() { //إعادة استدعاء الدالة لان المتصفح متخلف
            cont++;
            if (cont == 1) {
                importfun("model/users/01users_manegment.php", "#users_table", "show" );

                setTimeout(readdorder);
            }

        }, 500);
    }
});
      
  


    // Delete 




});//$(document).ready(function()