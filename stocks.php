<?php
 include "view/main/inti.php";
 
 if(!isset($_SESSION['username'])){
    include "view/main/login.php";
 }else{
     

$sql_sects= "SELECT * FROM `section`";
$sections =  get_all($sql_sects); 
$sql_units = "SELECT * FROM `units`";
$units =  get_all($sql_units); 


 $page_name = "المخزن - مـطعم الـكوكتيل";
 $nav_title ="إدارة الـمــخـــزن";
 $nav_icon ="fas fa-hamburger";
 $thispage = "stocks";
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
                        if ($_GET['o']=="sections") {
                        include "view/stocks/01sections.php";
                        }elseif ($_GET['o']=="units") {
                            include "view/stocks/02units.php";
                            }elseif ($_GET['o']=="items") {
                                include "view/stocks/03items.php";
                            }elseif ($_GET['o']=="additun") {
                                include "view/stocks/04items_units.php";
                                }
                        }
                 ?>
            </div>

        </div>

        <!-- Modal add-->
        <div class="modal fade" id="exampleModal_add_it" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text_shdow" id="exampleModalLabel"><i class="fa fa-plus"></i> إضـافة
                            صـنـف </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="it_section"><i class="fa fa-list"></i>
                                            قسم الصنف</lable>
                                        <br /> <select id="it_section" class="custom-select ">
                                            <?php foreach($sections as $sec) { ?>
                                            <option value="<?php echo $sec['sec_id'] ?>">
                                                <?php echo $sec['sec_name'] ?></option>
                                            <?php  }        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="it_min_un"><i
                                                class="fa fa-balance-scale"></i> الوحدة الاساسية</lable>
                                        <br /> <select id="it_min_un" class="custom-select ">
                                            <?php foreach($units as $unit) { ?>
                                            <option value="<?php echo $unit['un_id'] ?>">
                                                <?php echo $unit['un_name'] ?>
                                            </option>
                                            <?php            }           ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr />

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="it_name"><i class="fa fa-list"></i>
                                            إسم الصنف</lable> <br>
                                        <input autofocus type="text" id="it_name" placeholder="أدخل إسم الصنف"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="it_barcode"><i
                                                class="fa fa-barcode"></i> باركود الصنف</lable> <br />
                                        <input type="number" min="0" step="0.5" id="it_barcode"
                                            placeholder="أدخل باركود الصنف" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <hr />


                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="it_pr_in"><i
                                                class="<?php echo $set_info['set_currency_fa'] ?>"></i>
                                            سـعر الشراء</lable> <br />
                                        <input data-decimals="2" type="number" min="0" step="0.5" id="it_pr_in"
                                            placeholder="أدخل سعر الشراء" class="form-control decimal_number" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="it_pr_out"><i
                                                class="<?php echo $set_info['set_currency_fa'] ?>"></i> سعر البيع
                                        </lable> <br />
                                        <input data-decimals="2" type="number" min="0" step="0.5" id="it_pr_out"
                                            placeholder="أدخل سعر البيع" class="form-control decimal_number" required>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="it_min_qty"><i
                                                class="<?php echo $set_info['set_currency_fa'] ?>"></i>
                                            اقل كمية بالمخزن</lable> <br />
                                        <input type="number" min="0" step="0.5" value="0" id="it_min_qty"
                                            placeholder="أدخل  اقل كمية بالمخزن" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button id="btn_add_it" type="button" class="btn btn-primary"><i class="fa fa-save"></i> حـفظ
                            الصنف</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>
                            إغـلاق</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal edit-->
        <div class="modal fade" id="exampleModal_edit_it" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text_shdow" id="exampleModalLabel"><i class="fa fa-edit"></i> تـعـديــل
                            صـنـف </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <input type="hidden" id="finaly_it_id">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="edit_it_section"><i
                                                class="fa fa-list"></i> قسم الصنف</lable>
                                        <br /> <select id="edit_it_section" class="custom-select ">
                                            <option id="first_sec" value=""></option>
                                            <?php foreach($sections as $sec) { ?>
                                            <option value="<?php echo $sec['sec_id'] ?>">
                                                <?php echo $sec['sec_name'] ?></option>
                                            <?php  }        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="edit_it_min_un"><i
                                                class="fa fa-balance-scale"></i> الوحدة الاساسية</lable>
                                        <br /> <select id="edit_it_min_un" class="custom-select ">
                                            <option id="first_un" value=""></option>
                                            <?php foreach($units as $unit) { ?>
                                            <option value="<?php echo $unit['un_id'] ?>">
                                                <?php echo $unit['un_name'] ?>
                                            </option>
                                            <?php            }           ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr />

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="edit_it_name"><i
                                                class="fa fa-list"></i>
                                            إسم الصنف</lable> <br>
                                        <input autofocus type="text" id="edit_it_name" placeholder="أدخل إسم الصنف"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="edit_it_barcode"><i
                                                class="fa fa-barcode"></i> باركود الصنف</lable> <br />
                                        <input type="number" min="0" step="0.5" id="edit_it_barcode"
                                            placeholder="أدخل باركود الصنف" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <hr />


                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="edit_it_pr_in"><i
                                                class="<?php echo $set_info['set_currency_fa'] ?>"></i>
                                            سـعر الشراء</lable> <br />
                                        <input data-decimals="2" type="number" min="0" step="0.5" id="edit_it_pr_in"
                                            placeholder="أدخل سعر الشراء" class="form-control decimal_number" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="edit_it_pr_out"><i
                                                class="<?php echo $set_info['set_currency_fa'] ?>"></i> سعر البيع
                                        </lable> <br />
                                        <input data-decimals="2" type="number" min="0" step="0.5" id="edit_it_pr_out"
                                            placeholder="أدخل سعر البيع" class="form-control decimal_number" required>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <lable class="pull-right text_shdow" for="edit_it_min_qty"><i
                                                class="<?php echo $set_info['set_currency_fa'] ?>"></i>
                                            اقل كمية بالمخزن</lable> <br />
                                        <input type="number" min="0" step="0.5" value="0" id="edit_it_min_qty"
                                            placeholder="أدخل  اقل كمية بالمخزن" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button id="btn_edit_it" type="button" class="btn btn-primary"><i class="fa fa-save"></i>
                            تـعـديـل الصنف</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>
                            إغـلاق</button>

                    </div>
                </div>
            </div>


        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModaleditaddunit" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="fa fa-edit"></i>
                        <h5 id="modal_edit_title" class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <form action="" method="post" id="mainForm">
                                <div class="form-group">
                                    <lable class="pull-right" for="dept_name"> المعامل:</lable>
                                    <input type="number" id="edit_un_eq" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <lable class="pull-right" for="dept_name"> سعر الشراء:</lable>
                                    <input data-decimals="2" type="number" min="0" step="0.5" id="edit_un_pr_in"
                                        placeholder="أدخل سعر البيع" class="form-control decimal_number" required>
                                </div>
                                <div class="form-group">
                                    <lable class="pull-right" for="dept_name"> سعر البيع:</lable>
                                    <input data-decimals="2" type="number" min="0" step="0.5" id="edit_un_pr_out"
                                        placeholder="أدخل سعر البيع" class="form-control decimal_number" required>
                                </div>
                                <center>
                                    <div id="it_un_edit_reusalt" class="text_center"></div>
                                </center>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="submits_edits_its_uns" value="تعديل وحــدة"
                            class="btn btn-primary pull-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">رجوع</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal del-->

        <div class="modal fade" id="exampleModaldel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حــذف الوحــدة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <h5 id="modal_delete_title"> </h5>
                        <input type="hidden" id="un_finaly_code">
                    </div>
                    <center>
                        <div id="it_un_delete_reusalt">
                        </div>
                    </center>
                    <div class="modal-footer">
                        <button id="delete_it_un" type="button" class="btn btn-danger">حــذف</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">رجــوع</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal exampleModaleditimg -->
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
                            <input type="hidden" name="finaly_it_id_for_img" id="finaly_it_id_for_img">
                            <div class="container">
                                <div class="row">
                                    <div class="col" id="img_in_edit">
                                        <img id="edit_it_img" alt="users avatar"
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


    </div>











    <?php // include "view/main/fotter.php"; ?>

    <!-- <script src="js/jquery-3.4.0.min.js"></script> -->
    <!-- <script src="js/popper.min.js"></script> -->

    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>


    <script src="js/main/responsive.js"></script>
    <script src="js/stocks/sections.js"></script>
    <script src="js/stocks/units.js"></script>
    <script src="js/stocks/items.js"></script>
    <script src="js/bootstrap-input-spinner.js"></script>
    <script src="js/stocks/add_units.js"></script>
    <!-- <script src="js/ajax.googleapis.js"></script> -->
    <script src="js/malsup.github.js"></script>
    <script src="js/stocks/item_img.js"></script>



</body>

</html>
<?php
 } ?>