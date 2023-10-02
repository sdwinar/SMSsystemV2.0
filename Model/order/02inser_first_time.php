<?php
session_start();
error_reporting(0);
include  "../main/config.php";
include "../main/function.php";

if (isset($_GET['order']) && $_GET['order']=="insert") {
    $op_type = mksave($_GET['op_type']);
    $us_code = $_SESSION['us_code'];

    //حذف البيانات اولا من op_det في حال تحديث فاتورة فارغة
    $stmtfirst = $con->prepare("DELETE FROM `op_det` WHERE `op_code2`  NOT IN (SELECT `op_code` FROM `cash` )");
    $stmtfirst->execute(array());
    //حذف البيانات في حال تحديث فاتورة فارغة
    $stmtfirst = $con->prepare("DELETE FROM `op` WHERE `op_code`  NOT IN (SELECT `op_code` FROM `cash` )");
    $stmtfirst->execute(array());

    //max(op_code)
    $stmtopmax = $con->prepare("SELECT max(`op_code`) FROM `op` ");
    $stmtopmax->execute(array());
    $opmaxinfo = $stmtopmax->fetch();
    $op_code = $opmaxinfo['max(`op_code`)']+1;
    //op_date time
    $op_date = date("Y/m/d");
    $op_time= date("H:i");
    //op_code_year
    $today = date("d");
    //تحديد تغيير op_code_year ليبدا كل هناك سنة وهنا يوم من جديد
    $stmtop_code_year = $con->prepare("SELECT max(`op_code_year`) FROM `op` WHERE RIGHT(`op_date`, 2)  = '$today' && `op_type` = '$op_type' ;");
    $stmtop_code_year->execute(array());
    $op_code_yearinfo = $stmtop_code_year->fetch();
    $op_code_year = $op_code_yearinfo['max(`op_code_year`)']+1;

    $stmtfirst = $con->prepare("INSERT INTO `op` (`op_type`, `op_code`, `op_date`, `op_time`, `op_us_code`, `op_code_year`, `op_tree_code`, `op_tree_name`, `op_note`)
      VALUES ('$op_type', '$op_code', '$op_date', '$op_time', '$us_code', '$op_code_year', '210200001', '','');");
    $stmtfirst->execute();
        
    //جلب بيانات العملية
    $stmtop = $con->prepare("SELECT * FROM `op` WHERE `op_code`  = '$op_code' ");
    $stmtop->execute(array());
    $opinfo = $stmtop->fetch();
    echo "رقم الطلبية  ".":"." ". $opinfo['op_code_year']; //
       ?>
           <input type="hidden" id="op_code" value="<?php echo $opinfo['op_code']; ?>">

       <?php
}// inser
