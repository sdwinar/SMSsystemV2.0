<?php
 $page_name = "الرئيسية - مـطعم الـكوكتيل";
 $nav_title ="مـطــعــم الـكـوكـتـيــل";
 $nav_icon ="fas fa-pizza-slice";
 $thispage = "home";
 include "view/main/inti.php";
 include "view/main/head.php";

 if(!isset($_SESSION['username'])){
    include "view/main/login.php";
 }else{
     ?>

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
}
</style>

<body dir="rtl" style="    background: #021e1d;">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12" style="  z-index: 2;  background:  #021e1d;"> <?php  include "view/main/02navbar.php"; ?> </div>
            <div class="col-3" style=" z-index: 1;   background:  #021e1d;"> 123<?php include "view/main/01sidemenubar.php"; ?>
            </div>
            <div class="col-9" style="  z-index: 1;  background:  #021e1d;">
                <div class="row">
                    <div class="col-8" style="    background:  #021e1d;"> <?php include "view/home/01circlemenu.php"; ?>
                    </div>
                    <div class="col-2">.</div>

                </div>
            </div>
        </div>
    </div>

<?php
 } ?>



    <?php include "view/main/fotter.php"; ?>