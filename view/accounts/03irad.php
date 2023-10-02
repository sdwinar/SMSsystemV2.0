<?php
//سليكت المخازن
if ($_GET['o']=="monsarf" || $_GET['o']=="dain" || $_GET['o']=="irad" || $_GET['o']=="dain_from") {
    $stmt_ksna_bank = $con->prepare("SELECT * FROM `tree4` WHERE `tree3_code` in(1201,1202)");
    $stmt_ksna_bank->execute(array());
    $ksna_bank = $stmt_ksna_bank->fetchAll();
}elseif($_GET['o']=="all" ){
    $stmt_ksna_bank = $con->prepare("SELECT * FROM `tree4` WHERE `tree3_code` in(SELECT `tree3_code` FROM `tree3`)");
    $stmt_ksna_bank->execute(array());
    $ksna_bank = $stmt_ksna_bank->fetchAll();
}
//سيلكت المنصرفات
if($_GET['o']=="monsarf" || $_GET['o']=="dain"){
$stmt_other = $con->prepare("SELECT * FROM `tree4` WHERE `tree3_code` in(5201,5202,5101,1205,1204,1203,2101,3101,1202,3201.3301)");
$stmt_other->execute(array());
$other = $stmt_other->fetchAll(); 
}
//سيلكت الايرادات
elseif($_GET['o']=="irad" || $_GET['o']=="dain_from"){
$stmt_other = $con->prepare("SELECT * FROM `tree4` WHERE `tree3_code` in(4201,4101,1203,2101,3101,1202,3201,3301)");
$stmt_other->execute(array());
$other = $stmt_other->fetchAll(); 
}
elseif($_GET['o']=="all" ){
    $stmt_other = $con->prepare("SELECT * FROM `tree4` WHERE `tree3_code` in(SELECT `tree3_code` FROM `tree3`)");
    $stmt_other->execute(array());
    $other = $stmt_other->fetchAll(); 
    }
?>
<link rel="stylesheet" type="text/css" href="css/dataTables.css">
<!-- <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css"> -->

<script src="js/jquery-3.4.0.min.js"></script>

<script type="text/javascript" charset="utf8" src="js/dataTables.js"></script><!-- <script src="js/tablesorter/jquery.tablesorter.widgets.min.js"></script> -->
<!-- <script type="text/javascript" charset="utf8" src="cdn.datatables.net/plug-ins/1.11.5/api/sum().js"></script><script src="js/tablesorter/jquery.tablesorter.widgets.min.js"></script> -->
<style>
table {
    border: 1.8px solid gray;
    box-shadow: 0px 0px 3px 1px beige;
    font-weight: bold !important;
    font-size: 17px !important;
}

body,
#btn_dd_un {
    font-weight: bold !important;

}
tfoot tr ,thead {
	background: lightblue;
}


.btn {
    cursor: pointer;
}

.nav_me {
    color: aliceblue;
}
div#order_data_wrapper{
    background: white;
    filter: drop-shadow(2px 2px 9px gray);
    /* box-shadow: 3px 2px 3px grey; */
    padding: 8px;
    border-radius: 10px;
}
</style>

<hr />
<input type="hidden" id="finaly_po_code">
<input type="hidden" id="finaly_op_type">
<div class="row row_main main_cash" style="   width: 100%;  position: relative;">

    <div class="col-lg-4 col-md-10 col-sm-8 col-8">
        <h3 class="nav-link"> <i class="fa fa-list"></i> <?php echo  $pptitle_title ?> </h3>
        <hr/><br/>

    </div>
    <div class="col-lg-8 col-md-2 col-sm-4 col-4 hide_on_sm">
        
    </div>

    <!-- ################################################################# -->
    <div class="row">

            <h3 class="col-lg-2 col-md-3 col-sm-3 col-3 nav_me">الـمبلغ :</h3>
            <input type="number" style="border: 1px solid;    border-radius: 6.3px;    color: blue !important;"
             class="col-lg-2 col-md-3 col-sm-3 col-3" min="1" id="cash" value="0">

            <h3 class="col-lg-1 col-md-3 col-sm-1 col-3 nav_me">من:</h3>
            <?php if($_GET['o']=="irad" || $_GET['o']=="dain_from") { // إظهار سحب الاخرين للايراد?>
            <select name="other" id="other" class="custom-select col-lg-3 col-md-3 col-sm-3 col-3">
                        <!-- <option value="0">كـل الـمخازن</option> -->
                            <?php 
                        foreach ($other as $stock){
                            ?>
                            <option value="<?php echo $stock['tree4_code']?>"><?php echo $stock['tree4_name']?></option>
                            <?php } ?>
                        </select>  
                        <?php }elseif($_GET['o']=="monsarf" || $_GET['o']=="dain"){ // إظهار سحب الخزنة للايراد?>
            <select name="ksna_bank" id="ksna_bank" class="custom-select col-lg-3 col-md-3 col-sm-3 col-3">
                        <!-- <option value="0">كـل الـمخازن</option> -->
                            <?php 
                        foreach ($ksna_bank as $stock){
                            ?>
                            <option value="<?php echo $stock['tree4_code']?>"><?php echo $stock['tree4_name']?></option>
                            <?php } ?>
                        </select>  
                        <hr/><br/>

                        <?php }elseif($_GET['o']=="all" ){ // إظهار سحب الخزنة للايراد?>
            <select name="ksna_bank" id="ksna_bank" class="custom-select col-lg-3 col-md-3 col-sm-3 col-3">
                        <!-- <option value="0">كـل الـمخازن</option> -->
                            <?php
                        foreach ($ksna_bank as $stock) {
                            ?>
                            <option value="<?php echo $stock['tree4_code']?>"><?php echo $stock['tree4_name']?></option>
                            <?php
                        } ?>
                        </select>  
                        <hr/><br/>

                        <?php } ?>  
                        <h3 class="col-lg-1 col-md-3 col-sm-3 col-3 nav_me">الي:</h3>
            <?php if($_GET['o']=="irad" || $_GET['o']=="dain_from") {?>
            <select name="ksna_bank" id="ksna_bank" class="custom-select col-lg-3 col-md-3 col-sm-3 col-3">
                        <!-- <option value="0">كـل الـمخازن</option> -->
                            <?php 
                        foreach ($ksna_bank as $stock){
                            ?>
                            <option value="<?php echo $stock['tree4_code']?>"><?php echo $stock['tree4_name']?></option>
                            <?php }?>
                        </select>  
                        <hr/><br/>

                        <?php }elseif($_GET['o']=="monsarf" || $_GET['o']=="dain") { // إظهار سحب الاخرين للايراد?>
            <select name="other" id="other" class="custom-select col-lg-3 col-md-3 col-sm-3 col-3">
                        <!-- <option value="0">كـل الـمخازن</option> -->
                            <?php 
                        foreach ($other as $stock){
                            ?>
                            <option value="<?php echo $stock['tree4_code']?>"><?php echo $stock['tree4_name']?></option>
                            <?php } ?>
                        </select>  
                        <?php }elseif($_GET['o']=="all" ) { // إظهار سحب الاخرين للايراد?>
            <select name="other" id="other" class="custom-select col-lg-3 col-md-3 col-sm-3 col-3">
                        <!-- <option value="0">كـل الـمخازن</option> -->
                            <?php 
                        foreach ($other as $stock){
                            ?>
                            <option value="<?php echo $stock['tree4_code']?>"><?php echo $stock['tree4_name']?></option>
                            <?php } ?>
                        </select>  
                        <?php } ?> 
                        <h3 class="col-lg-2 col-md-3 col-sm-3 col-3 nav_me" style="margin-top: 30px;">البـيــــان :</h3>
                        <hr/><br/>
                        <textarea class="col-lg-10 col-md-3 col-sm-3 col-3 nav_me" style="margin-top: 30px;
                        border: 1px solid;    border-radius: 6.3px;    color: blue !important;font-size: 19px;
                            font-weight: bold;    padding: 10px 15px;" id="op_note" cols="70" rows="3"
                            placeholder="البيان ..."></textarea>
                            <span class="col-lg-5 col-md-3 col-sm-3 col-3"></span>
                            <button id="irad_sub" class="col-lg-3 col-md-3 col-sm-3 col-3 btn btn-primary"style="margin-top: 10px;"><i class="fa fa-save"></i>  تأكيد العملية</button>
    </div>

    <!-- ################################################################# -->
    <div class="col-lg-4 col-md-10 col-sm-8 col-8">
    <hr/><br/>

        <h3 class="nav-link"> <i class="fa fa-list"></i> العمليات الاخيرة </h3>
    </div>
    <div class="col-lg-4 col-md-2 col-sm-4 col-4 hide_on_sm">
        
    </div>
    <div class="col-lg-4 col-md-2 col-sm-4 col-4 hide_on_sm">
        <!-- <button id="print_this" class="btn btn-success">طباعة <i class="fa fa-print"></i> </button> -->
        </div>



</div>

<div class="row row_main">
    <div class="col-lg-1 col-md-2 col-sm-1 col-1">
                        </div>
    <div class="col-lg-11 col-md-10 col-sm-11 col-11 " id="iradtbody">

    </div>
</div>
<div class="sw_rusalt"></div>