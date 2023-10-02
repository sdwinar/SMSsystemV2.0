<?php
session_start();
include  "../main/config.php";
include "../main/function.php";

if (isset($_GET['order']) && $_GET['order']=="login") {
    $username = mksave($_GET['username']);
    $password = mksave($_GET['password']);

    if(empty($username) || empty($password)){?>
<div class="alert alert-warning" role="alert">الرجــاء تعبئة جميع الحقول </div>
<?php
exit();
?>
<?php
    }else{
        $sql="SELECT * FROM `users` WHERE	`username` = '$username' && `us_pass`= '$password'";

        $count = row_count($sql);
        if ($count==0) {?>
<div class="alert alert-warning" role="alert">عفواً ... بيـانـات دخول غير صحيحة </div>
<?php
            exit();
        } else {
            $sql_us_info="SELECT * FROM `users` WHERE	`username` = '$username' && `us_pass`= '$password'";

            $sql_user_info = row_info($sql_us_info);
            $old_us_status = $sql_user_info['us_status'] ;

            if($old_us_status == 0){?>
                <div class="alert alert-warning" role="alert">عفـوأ حسابك غير نشط حالياً </div>
                <?php

            }else{    
                        $_SESSION['username'] = $sql_user_info['username'];
                    $_SESSION['us_code'] = $sql_user_info['us_code'];
                 
                ?>
    <div class="alert alert-success" role="alert">
        جــــاري ... تسجيل الدخول
    </div>
    <script>
    var t = 0;
    log = setInterval(function() {
        t++
        if (t == 1) {
            window.location = "home.php"
        }
    }, 500)
    </script>
    <?php

            }
            

            // $users[] = row_info($sql);
            // foreach ($users as $user) {
    
        }
    }//if(empty($username) || empty($password))

}//if (isset($_GET['order']) && $_GET['order']=="insert") 