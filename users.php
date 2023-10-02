<?php
 include "view/main/inti.php";


 if(!isset($_SESSION['username'])){
    include "view/main/login.php";
 }else{
    
 $page_name = "إدارة المستخدمين - مـطعم الـكوكتيل";
 $nav_title ="إدارة المستخدمين";
 $nav_icon ="fa fa-users";
 $thispage = "users";
 //include "view/main/head.php";?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">

    <link href="css/bootstrap.minrtl.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/bootstrap.minrtl.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.min.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">





    <title><?php echo isset($page_name) ? $page_name:"نظام المخازن" ?></title>
</head>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="css/main/font" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Amiri&family=Reem+Kufi:wght@700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Amiri', serif !important;

    font-family: 'Amiri', serif;
    font-family: 'Reem Kufi', sans-serif;

    background: url(img/main/supermarket.png);
    backdrop-filter: brightness(0.12);
}

.btn,
.text_shdow {
    font-weight: bold;
    filter: drop-shadow(2px 4px 6px black);
}

input {
    color: blue !important;
    font-size: 19px !important;
    font-weight: bold !important;

}

lable.text_shdow {
    font-size: 22px !important;
}

option,
select {
    font-weight: bold;
    cursor: pointer;
    color: blue !important;
    font-size: 19px !important;
}

lable.pull-right.text_shdow {
    position: relative;
    bottom: 5px;
}
</style>

<body dir="rtl">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="  z-index: 2;   ">
                <?php  include "view/main/02navbar.php";?> </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-12 col-12" style="    ">
                <?php  include "view/main/01sidemenubar.php";?> </div>
            <div class="col-lg-9 col-md-8 col-sm-12 col-12" style="  z-index: 1; ">
                <?php 
                    if (isset($_GET['o'])) {
                        if ($_GET['o']=="management") {
                        include "view/users/01users_management.php";
                        }
                        // elseif ($_GET['o']=="units") {
                        //     include "view/stocks/02units.php";
                        //     }elseif ($_GET['o']=="items") {
                        //         include "view/stocks/03items.php";
                        //     }elseif ($_GET['o']=="additun") {
                        //         include "view/stocks/04items_units.php";
                        //         }
                        }
                 ?>
            </div>

        </div>


<!-- ****************************************************************us_img -->
  <!-- Modal exampleModaledusimg -->
  <div class="modal fade" id="exampleModaledusimg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تـعـديل الصـورة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="form_edit_us_img" action="model/users/02user_img.php" method="post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="finaly_us_code_for_img" id="finaly_us_code_for_img">
                            <div class="container">
                                <div class="row">
                                    <div class="col" id="img_in_edit">
                                        <img id="edit_us_img" alt="users avatar"
                                            style="width: 100%;    height: 100%;    filter: drop-shadow(2px 4px 6px black);">
                                    </div>
                                    <div class="col">
                                        <label for="my_img_file_val" style="cursor: pointer">
                                            <span class="badge badge-success" style="padding: 13.5%;    font-size: 15px;
    margin-top: 99.5%;
    filter: drop-shadow(2px 4px 6px black);">
                                                <i class=" fa fa-edit"></i>
                                                إختيار صـورة</span>
                                        </label>
                                    </div>
                                    <div class="col">
                                        <input type="file" name="my_img_file_val" id="my_img_file_val"
                                            style="display: none">
                                    
                                            <button type="submit" class="btn btn-info"  style="padding: 5% 12%;  margin-top: 67.5%;

color: aliceblue !important;
  filter: drop-shadow(2px 4px 6px black);" > <i class='fa fa-save'></i>  حفظ الصورة </button>
                                    </div>
                                </div>
                            </div>
                        </form>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">رجـــوع</button>
                    </div>
                </div>
            </div>
        </div>  <!-- Modal exampleModaleditimg -->
        <div class="modal fade" id="exampleModaleditimg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تـعـديل الصـورة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="form_edit_img" action="model/stocks/05stocks_img.php" method="post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="finaly_us_code_for_img" id="finaly_us_code_for_img">
                            <div class="container">
                                <div class="row">
                                    <div class="col" id="img_in_edit">
                                        <img id="edit_us_img" alt="users avatar"
                                            style="width: 100%;    height: 100%;    filter: drop-shadow(2px 4px 6px black);">
                                    </div>
                                    <div class="col">
                                        <label for="my_img_file_val" style="cursor: pointer">
                                            <span class="badge badge-success" style="padding: 13.5%;    font-size: 15px;
    margin-top: 99.5%;
    filter: drop-shadow(2px 4px 6px black);">
                                                <i class=" fa fa-edit"></i>
                                                إختيار صـورة</span>
                                        </label>
                                    </div>
                                    <div class="col">
                                        <input type="file" name="my_img_file_val" id="my_img_file_val"
                                            style="display: none">
                                    
                                            <button type="submit" class="btn btn-info"  style="padding: 5% 12%;  margin-top: 67.5%;

color: aliceblue !important;
  filter: drop-shadow(2px 4px 6px black);" > <i class='fa fa-save'></i>  حفظ الصورة </button>
                                    </div>
                                </div>
                            </div>
                        </form>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">رجـــوع</button>
                    </div>
                </div>
            </div>
        </div>
<!-- *****************************************************************us_img -->

       <!-- Modal edit data-->
<div class="modal fade" id="exampleModaleditdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel_editdata">تـعديل البيانات</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                            <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
                            <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="hidden" id="finaly_us_code" value="">
                                <lable class="pull-right" for="edit_user_name">الإســـــم</lable>
                                <input autofoucs type="text" id="edit_user_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                                <lable class="pull-right" for="edit_username">إســم المستخدم</lable>
                                <input type="text" id="edit_username" class="form-control" required>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col">
                        <div class="form-group">
                            <lable class="pull-right" for="edit_us_role">الـحالـة</lable>
                            <select id="edit_us_status" class="custom-select">
                            <option value="1">نـــشـط</option>
                            <option value="0">غير نشط</option>
                            </select>
                        </div>
                        </div>
                        <?php
                        if($user_session_info['us_role']=="مــدير"){ ?>
                        <div class="col">
                        <div class="form-group">
                            <lable class="pull-right" for="edit_us_role">الـصـلاحية</lable>
                            <select id="edit_us_role" class="custom-select">
                            <option value="مــدير">مــدير</option>
                            <option value="مــشرف">مــشرف</option>
                            <option value="مــستخدم">مـستخدم</option>
                            </select>
                        </div>
                        </div>
                        <?php
                         }else{?>
                         <input type="hidden" id="edit_us_role" value="">
                         <?php } ?>
                        <div class="w-100"></div>
                        <div class="col">
                        <div class="form-group">
                                <lable class="pull-right" for="edit_user_pass">كلمة المرور</lable>
                                <input type="password" id="edit_user_pass" class="form-control" required>
                            </div>
                        </div>
                        <hr/>
                        <div class="col">
                        <div class="form-group">
                                <lable class="pull-right" for="admin_pass">كلمة المرور الحالية</lable>
                                <input type="password" id="edit_admin_pass" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
      </div>
      <center>
          <div id="edit_data_reusalt"></div>
      </center>
      <div class="modal-footer">
      <button id="btn_send_edit_us_data" type="button" class="btn btn-primary">تـعديل</button>
        <button id="btn_exit_edit_us_data" type="button" class="btn btn-secondary" data-dismiss="modal">رجــوع</button>
      </div>
    </div>
  </div>
</div>

       <!-- Modal admin edit data-->
       <?php  if($user_session_info['us_role']=="مــدير"){ ?>
       <div class="modal fade" id="exampleModaladmineditdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel_dmin_editdata">تـعديل البيانات</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                            <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> finaly_us_code_for_admin -->
                            <div class="row">
                        <div class="col" style="display: none;">
                            <div class="form-group">
                                <input type="hidden" id="finaly_us_code_for_admin" value="">
                                <lable class="pull-right" for="edit_user_name">الإســـــم</lable>
                                <input autofoucs type="text" id="admin_edit_user_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col" style="display: none;">
                        <div class="form-group">
                                <lable class="pull-right" for="edit_username">إســم المستخدم</lable>
                                <input type="text" id="admin_edit_username" class="form-control" required>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col">
                        <div class="form-group">
                            <lable class="pull-right" for="edit_us_role">الـحالـة</lable>
                            <select id="admin_edit_us_status" class="custom-select">
                            <option value="1">نـــشـط</option>
                            <option value="0">غير نشط</option>
                            </select>
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <lable class="pull-right" for="edit_us_role">الـصـلاحية</lable>
                            <select id="admin_edit_us_role" class="custom-select">
                            <option value="مــدير">مــدير</option>
                            <option value="مــشرف">مــشرف</option>
                            <option value="مــستخدم">مـستخدم</option>
                            </select>
                        </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col">
                        <div class="form-group">
                                <lable class="pull-right" for="edit_user_pass">كلمة المرور</lable>
                                <input type="password" id="admin_edit_user_pass" class="form-control" required>
                            </div>
                        </div>
                        <hr/>
                        <div class="col">
                        <div class="form-group">
                                <lable class="pull-right" for="admin_pass">كلمة المرور الحالية</lable>
                                <input type="password" id="admin_edit_admin_pass" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

      </div>
      <center>
          <div id="admin_edit_data_reusalt"></div>
      </center>
      <div class="modal-footer">
      <button id="btn_send_admin_edit_us_data" type="button" class="btn btn-primary">تـعديل</button>
        <button id="btn_exit_edit_us_data" type="button" class="btn btn-secondary" data-dismiss="modal">رجــوع</button>
      </div>
    </div>
  </div>
  
</div>
<?php }?>
                      
    </div>











    <?php // include "view/main/fotter.php"; ?>

    <!-- <script src="js/jquery-3.4.0.min.js"></script> -->
    <!-- <script src="js/popper.min.js"></script> -->

    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>


    <script src="js/main/responsive.js"></script>
    <script src="js/users/users.js"></script>
    <script src="js/malsup.github.js"></script>
    <script src="js/users/user_img.js"></script>

    <!-- <script src="js/ajax.googleapis.js"></script> -->

</body>

</html>
<?php
 } ?>