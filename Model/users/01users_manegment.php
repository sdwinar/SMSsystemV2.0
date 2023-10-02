<?php
session_start();
error_reporting(0);
include  "../main/config.php";
include "../main/function.php";

if (isset($_GET['order']) && $_GET['order']=="show") {
    //us_session
    $stmt_us_session = $con->prepare("SELECT * FROM `users` WHERE `us_code` = '$user_session_info[us_code]' ORDER BY `us_code` DESC");
    $stmt_us_session->execute(array());
    $us_session = $stmt_us_session->fetch();


    $stmt_us = $con->prepare("SELECT * FROM `users` WHERE `us_code` != '$user_session_info[us_code]' ORDER BY `us_code` DESC");
    $stmt_us->execute(array());
    $uss = $stmt_us->fetchAll();
    $usrowcont = $stmt_us->rowCount();
?>


<script>
$(function() {
    $(".tablesorter").tablesorter({
        widgets: ["zebra", "filter"]
    });
    var $table = $('table');
    $table[0].config.theme = 'grey';
    $table.trigger('applyWidgets');
});
</script>

<table class="tablesorter text-center" dir="rtl">
    <thead>
        <tr class="text-center">
            <th>إسم المستخدم</th>
            <th>الـصـــــورة</th>
            <th>الإســــــــم</th>
            <th>الـصـلاحيــة</th>
            <th>الـحالــــة</th>

            <th><i class="fa fa-edit"></i> تعديل البيانات </th>
        </tr>
    </thead>
    <tbody>



        <tr class="text-center">
            <td>
                <span style="top: 40px;position: relative;"><?php echo $us_session['username']?></span>
            </td>
            <td> <img src="img/users/<?php echo $us_session['us_img']==""? "avatar.jpg":$us_session['us_img'] ?>"
                    style="    width: 6vw;    height: 12vh;     border-radius: 8%;  filter: drop-shadow(2px 4px 6px black);    margin: 5px;"
                    alt="items">
                &nbsp&nbsp
                <button data-toggle="modal" data-target="#exampleModaledusimg" style="cursor: pointer;"
                    class="badge badge-success edit_us_img" data-us_code="<?php echo $us_session['us_code']?>"
                    data-us_img="<?php echo $us_session['us_img']==""? "avatar.jpg":$us_session['us_img']?>"><i
                        class="fa fa-edit"></i></button>
            </td>
            <td><span style="top: 40px;position: relative;">


                    <?php echo $us_session['us_name']?>

                </span>
            </td>
            <td><span style="top: 40px;position: relative;">

                    <?php echo $us_session['us_role']?>
                </span>
            </td>
            <td><span style="top: 40px;position: relative;">

                    <?php echo $us_session['us_status']==1 ?"نـشــط":"غير نــشط"?>
                </span>
            </td>
            <td>

                <button class="btn btn-info edit_data" data-us_code="<?php echo $us_session['us_code']; ?>"
                    data-us_name="<?php echo $us_session['us_name']; ?>"
                    data-username="<?php echo $us_session['username']; ?>"
                    data-us_role="<?php echo $us_session['us_role']; ?>"
                    data-us_status="<?php echo $us_session['us_status']; ?>"
                    data-img_masar="<?php echo $us_session['us_img']; ?>" data-toggle="modal"
                    data-target="#exampleModaleditdata"><i class="fa fa-edit"></i></button>

            </td>
            <td></td>
        </tr>


        <?php foreach($uss as $un) { ?>
        <tr>
            <td> <span style="top: 40px;position: relative;"><?php echo $un['username']?></span></td>

            <td> <img src="img/users/<?php echo $un['us_img']==""? "avatar.jpg":$un['us_img'] ?>"
                    style="    width: 6vw;    height: 12vh;     border-radius: 8%;  filter: drop-shadow(2px 4px 6px black);    margin: 5px;"
                    alt="items">
            </td>
            <td><span style="top: 40px;position: relative;">

                    <?php echo $un['us_name']?>
                </span>
            </td>
            <td><span style="top: 40px;position: relative;">

                    <?php echo $un['us_role']?>
                </span>
            </td>
            <td><span style="top: 40px;position: relative;">

                    <?php echo $un['us_status']==1 ?"نـشــط":"غير نــشط"?>
                </span>
            </td>
            <td>
                <?php if($user_session_info['us_role']=="مــدير"){ ?>

                <div class="">
                <button class="btn btn-info btn-sm  admin_edit_data" data-us_code="<?php echo $un['us_code']; ?>"
                    data-us_name="<?php echo $un['us_name']; ?>"
                    data-username="<?php echo $un['username']; ?>"
                    data-us_role="<?php echo $un['us_role']; ?>"
                    data-us_status="<?php echo $un['us_status']; ?>"
                    data-img_masar="<?php echo $un['us_img']; ?>" data-toggle="modal"
                    data-target="#exampleModaladmineditdata"><i class="fa fa-edit"></i></button>


                    <button type="button" data-code="<?php echo  $un['us_code'];  ?>"
                        data-name="<?php echo $un['us_name']; ?>" class="btn btn-danger btn-sm delet_us"><i
                            class="fa fa-remove"></i></button>
                </div>
                <?php } ?>
            </td>
        </tr>
        <?php
}
?>

    </tbody>
</table>
<?php
}// isset show elseif (isset($_GET['order']) && $_GET['order']=="show") elseif (isset($_GET['order']) && $_GET['order']=="show")
elseif (isset($_GET['order']) && $_GET['order']=="add") {
  $us_name = $_GET['us_name'];
  $tree3_code = $_GET['tree3_code'];
  if($us_name !=""){
    $stmt_us_code = $con->prepare("SELECT count(us_code),max(us_code) FROM `us` WHERE `tree3_code` = '$tree3_code'  ");
    $stmt_us_code->execute(array());
     $us_code_info = $stmt_us_code->fetch();

     if ($us_code_info['count(us_code)']==0   ) {
        $us_code = (($tree3_code *100000) +1);
     
      } else {
          $us_code = $us_code_info['max(us_code)']+1;
      }

      $sql_find_name = "SELECT * FROM `us` WHERE `us_name` = '$us_name'";
      if (row_count($sql_find_name) == 0) {

        $stmt_insert_us = $con->prepare("INSERT INTO `us` (`tree3_code`,`us_code`, `us_name`) VALUES ('$tree3_code','$us_code', '$us_name');");
        $stmt_insert_us->execute();
        ?>
<script>
swal.fire({
    position: "top",
    title: "تـم ... إضافة  الحساب بنجاح",
    icon: "success",
    timer: 2500
})
</script>
<?php


      }else {
        ?>
<script>
swal.fire({
    position: "top",
    title: "عفوا ... هذا الحـسـاب مسجل من قبل",
    icon: "error",
    timer: 2500
})
</script>
<?php       }

  }else{?>
<script>
swal.fire({
    position: "top",
    title: "عفواً الرجا كتابة إسم الـحـسـاب",
    icon: "error",
    timer: 2500
})
</script>
<?php
      }
  
}//elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")
elseif (isset($_GET['order']) && $_GET['order']=="edit") {
    $us_code = $_GET["us_code"];
    $us_name = $_GET["us_name"];
    
    if(empty($us_name)){?>
<script>
swal.fire({
    position: "top",
    title: "عفواً الرجا كتابة إسم الـحــســاب",
    icon: "error",
    timer: 2500
})
</script>
<?php
}else {
    $sql_us_name ="SELECT * FROM `us` WHERE `us_name` = '$us_name'";
    if(row_count($sql_us_name) == 0){ 
        $stmt_update_us = $con->prepare("UPDATE `us` SET `us_name` = '$us_name' WHERE `us`.`us_code` = '$us_code';");
        $stmt_update_us->execute();
        ?>
<script>
swal.fire({
    position: "top",
    title: "تـم ... تـعــديل إسـم الـحــســاب بنجاح",
    icon: "success",
    timer: 2500
})
</script>

<?php
   }else {
    ?>
<script>
swal.fire({
    position: "top",
    title: "عفوا ... هذا الـحــســاب مسجل من قبل",
    icon: "error",
    timer: 2500
})
</script>
<?php       }



 }
 
 
}//elseif (isset($_GET['order']) && $_GET['order']=="edit")elseif (isset($_GET['order']) && $_GET['order']=="edit")elseif (isset($_GET['order']) && $_GET['order']=="edit")elseif (isset($_GET['order']) && $_GET['order']=="edit")
//elseif (isset($_GET['order']) && $_GET['order']=="delete")elseif (isset($_GET['order']) && $_GET['order']=="delete")elseif (isset($_GET['order']) && $_GET['order']=="delete")
?>
<!-- Modal del DataTable_filter -->

<script src="../../assets/js/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/datatable.js"></script>
<script>

</script>


<script>
$(document).ready(function() {
    // $('#DataTable').DataTable();
    // $("#DataTable_filter").show(function() {
    //  $(this).hide(); 
    // //  $(this).closest("div").siblings().find(".dataTables_length").hide();

    // });
    // $(".dataTables_length").show(function() {
    //  $(this).hide(); 
    // //  $(this).closest("div").siblings().find(".dataTables_length").hide();

    // });


    function importfun(url, div = '', order = '', sql_bills = '', username = '', us_name = '', us_pass = '',
        us_role = '', admin_pass = '', us_code = '', us_status = '') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,
                sql_bills: sql_bills,
                username: username,
                us_name: us_name,
                us_pass: us_pass,
                us_role: us_role,
                admin_pass: admin_pass,
                us_code: us_code,
                us_status: us_status
            },
            // beforeSend: function() {
            //     $(div).html(
            //         "<center><img src='../../assets/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>"
            //     )

            // },
            success: function(data) {

                $(div).html(data)

            },
            error: function() {
                // var erorr = $("#conecterorr").text();,,,$("#add_us_role").val(),$("#admin_pass").val()
                $(div).html(
                    '<div class="alert alert-warning" role="alert">عذراً .. حدث خطأ في الاتصال </div>'
                    );
            }
        });
    } //دالة جلب ملفات الماين ديف 


    // ****************************************************us_img**
    $(".edit_us_img").on("click", function() {
        var us_code = $(this).data("us_code");
        var us_img = $(this).data("us_img");
        $("#finaly_us_code_for_img").val(us_code);
        $("#edit_us_img").attr("src", "img/users/" + us_img) // إرسال الصورة لمودل تعديل الصورة


    });
    //us data
    $(".edit_data").on("click", function() {
        var us_code = $(this).data("us_code");
        $("#finaly_us_code").val(us_code);
        var us_name = $(this).data("us_name");
        var username = $(this).data("username");
        var us_role = $(this).data("us_role");
        var us_status = $(this).data("us_status");
        $("#exampleModalLabel_editdata").html("تعديل بيانات" + " " + us_name);
        $("#edit_user_name").val(us_name);
        $("#edit_username").val(username);
        $("#edit_us_role").val(us_role);
        $("#edit_us_status").val(us_status);
    });

    $("#btn_send_edit_us_data").on("click", function() { //edit_admin_pass
        var us_code = $("#finaly_us_code").val();
        var us_name = $("#edit_user_name").val();
        var username = $("#edit_username").val();
        var us_pass = $("#edit_user_pass").val();
        var admin_pass = $("#edit_admin_pass").val();
        var us_role = $("#edit_us_role").val();
        var us_status = $("#edit_us_status").val();
        //  alert(username)
        importfun("model/users/users_edit_data.php", "#edit_data_reusalt", "edit", "", username,
            us_name, us_pass, us_role, admin_pass, us_code, us_status);
        var cont = 0;
        var settime = setInterval(() => {
            cont++;
            if (cont == 4) {
                importfun("model/users/01users_manegment.php", "#users_table", "show");
                $("#username_in_navbar").html(username);
                $("#edit_data_reusalt").html(" ");
                setTimeout(settime);
            }


        }, 500);

    });

    $("#btn_exit_edit_us_data").on("click", function() {
        $("#edit_user_name").val("");
        $("#edit_username").val("");
        $("#edit_admin_pass").val("");
        $("#edit_user_pass").val("");

    });

    //admin us data
    $(".admin_edit_data").on("click", function() {
        var us_code = $(this).data("us_code");
        $("#finaly_us_code_for_admin").val(us_code);
        var us_name = $(this).data("us_name");
        var username = $(this).data("username");
        var us_role = $(this).data("us_role");
        var us_status = $(this).data("us_status");
        $("#exampleModalLabel_dmin_editdata").html("تعديل بيانات" + " " + us_name);
        $("#admin_edit_user_name").val(us_name);
        $("#admin_edit_username").val(username);
        $("#admin_edit_us_role").val(us_role);
        $("#admin_edit_us_status").val(us_status);
    });
    $("#btn_send_admin_edit_us_data").on("click", function() { //edit_admin_pass
        var us_code = $("#finaly_us_code_for_admin").val();
        var us_name = $("#admin_edit_user_name").val();
        var username = $("#admin_edit_username").val();
        var us_pass = $("#admin_edit_user_pass").val();
        var admin_pass = $("#admin_edit_admin_pass").val();
        var us_role = $("#admin_edit_us_role").val();
        var us_status = $("#admin_edit_us_status").val();
        //  alert(username)
        importfun("model/users/users_edit_data.php", "#admin_edit_data_reusalt", "edit", "", username,
            us_name, us_pass, us_role, admin_pass, us_code, us_status);
        var cont = 0;
        var settime = setInterval(() => {
            cont++;
            if (cont == 4) {
                importfun("model/users/01users_manegment.php", "#users_table", "show");
                $("#admin_edit_data_reusalt").html(" ");
                setTimeout(settime);
            }


        }, 500);

    });



    $(".delet_us").on("click", function() {
        var code = $(this).data("code");
        var name = $(this).data("name");

        swal.fire({
            position: "top",
            icon: "error",
            title: "حـذف المستخدم" + " " + name,
            confirmButtonText: "حـذف",
            cancelButtonText: "رجوع",
            showCancelButton: true,
            preConfirm: () => {
                // alert(code);
                importfun("model/users/04delete_us.php", "#swal_reusalt", "delete",code);
                var cont =0;
             var settime = setInterval(() => {
                 cont++;
                 if(cont==2)
                 importfun("model/users/01users_manegment.php", "#users_table", "show");
                    setTimeout(settime);
                 
             }, 500);
            }
        })

    });


}); //ready
</script>