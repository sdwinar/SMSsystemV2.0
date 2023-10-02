<?php
session_start();
// error_reporting(0);
include  "../main/config.php";
include "../main/function.php";

if (isset($_GET['order']) && $_GET['order']=="add") {
    $username  = mksave($_GET['username']);
    $us_pass  = mksave($_GET['us_pass']);
    $us_name  = mksave($_GET['us_name']);
    $us_role  = mksave($_GET['us_role']);
    $us_status  = mksave($_GET['us_status']);
    $admin_pass  = mksave($_GET['admin_pass']);

    if (!empty($username) && !empty($us_pass) && !empty($us_name)) {
        $sql_admin_pass = "SELECT `us_pass` FROM `users` WHERE `us_code` = $user_session_info[us_code]";
        $us_amin_pass = row_info($sql_admin_pass);
        $us_amin_pass = $us_amin_pass['us_pass'] ;



      

        if ($us_amin_pass== $admin_pass) {
            $sql_username = "SELECT `username` FROM `users` WHERE `username` = '$username' ";

            if (row_count($sql_username)==0) {

             
                

                $stmt_edit_user = $con->prepare("INSERT INTO `users` (`us_code`, `username`, `us_pass`, `us_name`, `us_img`, `us_status`, `us_role`, `us_lang`, `us_theme`)
                 VALUES (NULL, '$username', '$us_pass', '$us_name', '', '$us_status', '$us_role', 'ar', 'dark');");
               $stmt_edit_user->execute(array()); 
            //    ,$new_pass,$us_name,$us_status,$us_role
               ?>
               <div class="alert alert-success" role="alert">
               تمت إضافة المستخدم بنجاح</div>
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
    
    <?php }

}