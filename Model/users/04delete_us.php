<?php
session_start();
// error_reporting(0);
include  "../main/config.php";
include "../main/function.php";

if (isset($_GET['order']) && $_GET['order']=="delete") {
    $us_code = mksave($_GET['sql_bills']);
    //التاكد ان ليس للمستخدم عمليات في جدول op
    $sql_cek = "SELECT `op_us_code` FROM `op` WHERE `op_us_code` = '$us_code'";

    if(row_count( $sql_cek)>0){
        ?>
        <script>
        swal.fire({
            position: "top",
            title: "عفوا ... لا يمكن حذف المستخدم لوجود عمليات مرتبطة به",
            icon: "error",
            timer: 2500
        })
        </script>
        <?php
    }else{
        $stmt_delete_us= $con->prepare("DELETE FROM `users` WHERE `users`.`us_code` = '$us_code';");
        $stmt_delete_us->execute();
        ?>
<script>
swal.fire({
position: "top",
title: "تـم ... حــذف الـحــســاب بنجــاح",
icon: "success",
timer: 2500
})
</script>
<?php
    }
}