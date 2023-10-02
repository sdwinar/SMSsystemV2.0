<?php
session_start();
// error_reporting(0); 
include  "../main/config.php";
include "../main/function.php";

if (isset($_GET['order']) && $_GET['order']=="show_calc") {

    $op_code2 = mksave($_GET['op_code2']);

    $stmt_it = $con->prepare("SELECT SUM(`op_it_qty_eq`) FROM `op_det` WHERE `op_code2` = $op_code2;");
    $stmt_it->execute(array());
    $sum_total = $stmt_it->fetch();

    $sumtotal = $sum_total['SUM(`op_it_qty_eq`)'];
?>

<span class="badge badge-primary col-1" id="sum_total_div"
    style="background: #5a0011;    font-weight: bold;    font-size: 16px;    box-shadow: 0px 0px 3px;">الجملة</span>
&nbsp
<span class="badge badge-dark col-3" id="sum_total"
    style="background: #5a0011;    font-weight: bold;    font-size: 16px;    box-shadow: 0px 0px 3px;"><?php echo $sumtotal ; ?></span>

&nbsp
<span class="badge badge-dark col-1"
    style="background: #5a0011;    font-weight: bold;    font-size: 16px;    box-shadow: 0px 0px 3px;">آجـل</span>
&nbsp
<input id="khasm" class="col-2" min="0" type="number" name="" value="0"
    style="background: #5a0011;    font-weight: bold;    font-size: 16px;    box-shadow: 0px 0px 3px;">
&nbsp
<span class="badge badge-dark col-1" id="kia"
    style="background: #5a0011;    font-weight: bold;    font-size: 16px;    box-shadow: 0px 0px 3px;padding: 4.5px 0px 0px 0px;">الصافي</span>
&nbsp
<span class="badge badge-dark col-3"  id="safi"
    style="background: #5a0011;    font-weight: bold;    font-size: 16px;    box-shadow: 0px 0px 3px;"><?php echo $sumtotal ; ?></span>

<input class="form-control form-control-sm table-input" type="hidden" value="full" min="0" id="chek_set_cash" readonly />

<?php    

}//if (isset($_GET['order']) && $_GET['order']=="show_calc")
?>

<script src="js/jquery-3.4.0.min.js"></script>
<script>
$(document).ready(function() {

    $("#sum_total").show(function(){
        var total = $("#sum_total").text(); 
            total =  parseFloat(total);
            $("#finaly_total_sum_from_order_calc").val(total);//يتم ارسال قيمة الجملة لانبت مخفي لحل مشاكل حساب الصافي
            $("#finaly_safi_sum_from_order_calc").val(total);//يتم ارسال قيمة الجملة لانبت مخفي لحل مشاكل حساب الصافي
            var newtotal = new Intl.NumberFormat().format(total);

        $("#safi").text(newtotal);
        $("#sum_total").text(newtotal);

    });
    //حساب الصافي المنتج الكلية 
    $("#khasm").on("change , keyup", function() { //عند تغيير الخصم  
        var khasm = $(this).val();
        var total =  $("#finaly_total_sum_from_order_calc").val();
           
        var safi = total - khasm;

     var newtotal = new Intl.NumberFormat().format(total);
     var newsafi = new Intl.NumberFormat().format(safi);

        $("#safi").text(newsafi);
        $("#sum_total").text(newtotal);
        $("#finaly_safi_sum_from_order_calc").val(safi);//يتم ارسال قيمة الجملة لانبت مخفي لحل مشاكل حساب الصافي




    });
});

</script>