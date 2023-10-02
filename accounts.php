<?php
 include "view/main/inti.php";


 if(!isset($_SESSION['username'])){
    include "view/main/login.php";
 }else{
    
 $page_name = "الـحـسـابــات - مـطعم الـكوكتيل";
 $nav_title ="إدارة الـحـسـابــات";
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
                if ($user_session_info['us_role']=="مــدير") {
                    if (isset($_GET['o'])) {
                        if ($_GET['o']=="tree4") {
                            include "view/accounts/01tree4.php";
                        }
                        // elseif ($_GET['o']=="units") {
                        //     include "view/stocks/02units.php";
                        //     }elseif ($_GET['o']=="items") {
                        //         include "view/stocks/03items.php";
                        //     }elseif ($_GET['o']=="additun") {
                        //         include "view/stocks/04items_units.php";
                        //         }
                    }
                }else{?>
                <div style="margin-top:15%;color: black;    font-weight: bold;    font-size: 19px;" class="alert alert-info text-center">عفوا ... هذه الصفحة خاصة بالادارة فقط</div>
                <?php } ?>
                 ?>
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
    <script src="js/accounts/tree4.js"></script>

    <script src="js/bootstrap-input-spinner.js"></script>
    <!-- <script src="js/ajax.googleapis.js"></script> -->
    <script src="js/malsup.github.js"></script>

</body>

</html>
<?php
 } ?>