<?php
error_reporting(0);
include  "../main/config.php";
include "../main/function.php";
?>


<?php
// //    $my_img_file_val = mksave($_GET['my_img_file_val']);



   if (isset($_FILES['my_img_file_val'])) {
       $it_id= mksave($_POST['finaly_it_id_for_img']);



       $imgname = $_FILES['my_img_file_val']['name'];
       $imgtype = $_FILES['my_img_file_val']['type'];
       $imgtemp = $_FILES['my_img_file_val']['tmp_name'];
       $imgsize = $_FILES['my_img_file_val']['size'];
       $imgerorr = $_FILES['my_img_file_val']['error'];
       // $new_name = uniqid('articals',false) .  '.' . $imgname;
       $img_array = array('jpg', 'gif', 'jpeg', 'png');
       $img_extenstion = strtolower(end(explode('.', $imgname)));
       if ($imgerorr == 4) {
           echo 2;
           exit();
       } elseif (!in_array($img_extenstion, $img_array)) { 
        echo 3;
        exit();
           } elseif ($imgsize > 2500000) {
            echo 4;
            exit();
        } else {
            $target_path = "../../img/items/";
            $datenow = date("dmy");
            $horsnow = date("his");
            $target_path = $target_path . basename($user_session_info['username'] . $datenow . $horsnow . $imgname);
            move_uploaded_file($imgtemp, $target_path);

            $stmt_us_img_chik = $con->prepare("SELECT * FROM `items` WHERE	`it_id` = '$it_id' ");
            $stmt_us_img_chik->execute();
            $conts_ing_find = $stmt_us_img_chik->rowCount();
            $userinfoprofileinfo = $stmt_us_img_chik->fetch();

            $picuser = $user_session_info['username'] .  $datenow . $horsnow . $imgname;

            if ($userinfoprofileinfo['it_img'] != '') {
                $file = stripslashes($userinfoprofileinfo['it_img']);
                $folder_path = "../../img/items/$file";
                unlink($folder_path) or die("5");

                $stmteditimgpro = $con->prepare("UPDATE `items`  SET `it_img` = '$picuser' WHERE `it_id` = '$it_id' ");
                $stmteditimgpro->execute();
                echo $picuser;
            } else {

                $stmteditimgpro = $con->prepare("UPDATE `items`  SET `it_img` = '$picuser'  WHERE `it_id` = '$it_id' ");
                $stmteditimgpro->execute();
                echo $picuser;
            }
        }
            ?>
<?php
   }//if (isset($_GET['order']) && $_GET['order']=="edit")if (isset($_GET['order']) && $_GET['order']=="edit")
else {
    echo 1;
}
?>