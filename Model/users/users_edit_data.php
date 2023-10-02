<?php
session_start();
error_reporting(0);
include  "../main/config.php";
include "../main/function.php";

if (isset($_GET['order']) && $_GET['order']=="edit") {
    $us_code  = mksave($_GET['us_code']);
    $username  = mksave($_GET['username']);
    $us_pass  = mksave($_GET['us_pass']);
    $us_name  = mksave($_GET['us_name']);
    $us_role  = mksave($_GET['us_role']);
    $us_status  = mksave($_GET['us_status']);
    $admin_pass  = mksave($_GET['admin_pass']);

    if (!empty($username) || !empty($us_pass) || !empty($us_name)) {
        $sql_admin_pass = "SELECT `us_pass` FROM `users` WHERE `us_code` = $user_session_info[us_code]";
        $us_amin_pass = row_info($sql_admin_pass);
        $us_amin_pass = $us_amin_pass['us_pass'] ;



        //عند عدم تغيير البيانات وعدم تغيير إسم المستخدم اسم المتخدم او كانت الباسورد فارغة وتغيير البيانات الاخرى
        $sql_user_info = "SELECT `us_pass`,`username` FROM `users` WHERE `us_code` = '$us_code'";
        $sql_user_info = row_info($sql_user_info);
        $old_user_pass = $sql_user_info['us_pass'] ;

        if ($us_amin_pass== $admin_pass) {
            $sql_username = "SELECT `username` FROM `users` WHERE `username` = '$username' && `us_code` != '$us_code' ";

            if (row_count($sql_username)==0) {

                empty($us_pass)?$new_pass= $old_user_pass: $new_pass=$us_pass;
             
                

                $stmt_edit_user = $con->prepare("UPDATE `users` SET 
                `username` = ?,`us_pass` = ?, `us_name` = ? , `us_status` = ? ,`us_role` = ?
                WHERE `us_code` = '$us_code' ");
               $stmt_edit_user->execute(array($username,$new_pass,$us_name,$us_status,$us_role)); 
            //    ,$new_pass,$us_name,$us_status,$us_role
               ?>
               <div class="alert alert-success" role="alert">
               تمت تعديل البيانات بنجاح</div>
                   <?php
               
            } else {?>
                <script>
                swal.fire({
                    position: "top",
                    title: "عفواً... إسم المستخدم مسجل من قبل",
                    icon: "error",
                    timer: 2000
                })
                </script>
            
            <?php
            }
        } else {?>
            <script>
            swal.fire({
                position: "top",
                title: "عفواً... كلمة المرور الخاصة بك غير صحيحة",
                icon: "error",
                timer: 2000
            })
            </script>
        
        <?php
        }
    } else { ?>
        <script>
        swal.fire({
            position: "top",
            title: "الرجاء تعيئة جميع الحقول",
            icon: "error",
            timer: 2000
        })
        </script>
    
    <?php } ?>
<?php
}//(isset($_GET['order']) && $_GET['order']=="show")(isset($_GET['order']) && $_GET['order']=="show")
?>

<script src="../../assets/js/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/datatable.js"></script>
<!-- <script src="../../assets/js/sweetalert2.all.min.js"></script> -->

<script src="../../assets/js/main.js"></script>

<script>
$(document).ready(function() {
    // alert("username");

}); //ready
</script>