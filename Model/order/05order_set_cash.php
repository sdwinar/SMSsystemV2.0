<?php
session_start();
// error_reporting(0); 
include  "../main/config.php";
include "../main/function.php";
?>


<?php
if (isset($_GET['order']) && $_GET['order']=="set_cash") {
    $op_code = mksave($_GET['op_code']);
    $op_tree_code = mksave($_GET['op_tree_code']);
    $custmer_code = mksave($_GET['op_tree_code_user']); 
    $cash = mksave($_GET['cash_out']);
    $op_total = mksave($_GET['op_total']);
    $op_added = mksave($_GET['op_added']);
    $op_discont = mksave($_GET['op_discont']);
    $op_safi = mksave($_GET['op_safi']);
    $pay_select = mksave($_GET['pay_select']);
    $stok = mksave($_GET['op_st_code']);
    $op_type = mksave($_GET['op_type']);

    //*********************************************************************************المشتريات1**مرتجع مبيعات4**اول مدة9******** */
    if ($op_type==9 || $op_type==1 || $op_type== 4) {
        $sql_op_det_for_st= "SELECT * FROM `op_det` WHERE `op_code2` = '$op_code'";
        $op_set_dets = get_all($sql_op_det_for_st);
        foreach ($op_set_dets as  $op_det) {
            $op_it_id = $op_det['op_it_code'];
               $op_it_un_code= $op_det['op_it_un_code'];
            $op_it_qty = $op_det['op_it_qty'];
        

            //لتحديد الكمية بضرب الوحدات في المعامل
            //اولا تحديد إذا كانت الوحدة المختارة هي الصغرى 
            $sql_cont_it= "SELECT * FROM `items` WHERE `it_id` = '$op_it_id' && `it_min_un` = '$op_it_un_code' ";
            if(row_count ($sql_cont_it)==0){
                $sql_un_it_qty ="SELECT `un_eq` FROM `items_units` WHERE `it_id` = '$op_it_id'  && `un_id` = '$op_it_un_code' ";
                $it_un_info = row_info ($sql_un_it_qty);
                // $op_it_qty = $it_un_info['un_eq']*$op_it_qty;
            }

            //إذا كان الصنف موجود تتم إضافة الكمية
            // $sql_chick_it_in_st = "SELECT * FROM `stock` WHERE `op_st_code` = '$stok' && `it_id` = '$op_it_id' ";
            // if (row_count($sql_chick_it_in_st)==0) {
            // }


    
            $stmt_set_stock = $con->prepare("INSERT INTO `stock` (`ser_no`, `op_code`, `op_st_code`, `op_type`, `it_code`, `un_code` , `it_qty_in`, `it_qty_out`)
            VALUES (NULL, '$op_code', '$stok','$op_type','$op_it_id','$op_it_un_code','$op_it_qty', '0');");
            $stmt_set_stock->execute();
        }
            //cash insert
    
            $stmt_set_cash = $con->prepare("INSERT INTO `cash` (`cash_serial`, `op_code`, `op_tree_code_in`,`op_tree_code_out`, `cash_in`, `cash_out` , `op_total`, `op_added`, `op_discont`, `op_safi`, `pay_select`, `op_discont_out` )
                                                                VALUES (NULL, '$op_code', '$custmer_code','$op_tree_code', '0', '$cash' , '$op_total', '$op_added', '0', '$op_safi', '$pay_select','$op_discont');");
            $stmt_set_cash->execute();

    //**************************************************************************مرتجع مشتريات3*******المبيعات2************************* */
    }elseif ($op_type==2 || $op_type==3) {
        $sql_op_det_for_st= "SELECT * FROM `op_det` WHERE `op_code2` = '$op_code'";
        $op_set_dets = get_all($sql_op_det_for_st);
        foreach ($op_set_dets as  $op_det) {
            $op_it_id = $op_det['op_it_code'];
               $op_it_un_code= $op_det['op_it_un_code'];
            $op_it_qty = $op_det['op_it_qty'];
        

            //لتحديد الكمية بضرب الوحدات في المعامل
            //اولا تحديد إذا كانت الوحدة المختارة هي الصغرى 
            $sql_cont_it= "SELECT * FROM `items` WHERE `it_id` = '$op_it_id' && `it_min_un` = '$op_it_un_code' ";
            if(row_count ($sql_cont_it)==0){
                $sql_un_it_qty ="SELECT `un_eq` FROM `items_units` WHERE `it_id` = '$op_it_id'  && `un_id` = '$op_it_un_code' ";
                $it_un_info = row_info ($sql_un_it_qty);
                // $op_it_qty = $it_un_info['un_eq']*$op_it_qty;
            }

            //إذا كان الصنف موجود تتم إضافة الكمية
            // $sql_chick_it_in_st = "SELECT * FROM `stock` WHERE `op_st_code` = '$stok' && `it_id` = '$op_it_id' ";
            // if (row_count($sql_chick_it_in_st)==0) {
            // }


    
            $stmt_set_stock = $con->prepare("INSERT INTO `stock` (`ser_no`, `op_code`, `op_st_code`, `op_type`, `it_code`, `un_code` , `it_qty_in`, `it_qty_out`)
            VALUES (NULL, '$op_code', '$stok','$op_type','$op_it_id','$op_it_un_code','0', '$op_it_qty');");
            $stmt_set_stock->execute();
        }
            //cash insert
    
            $stmt_set_cash = $con->prepare("INSERT INTO `cash` (`cash_serial`, `op_code`, `op_tree_code_in`, `op_tree_code_out`, `cash_in`, `cash_out` , `op_total`, `op_added`, `op_discont`, `op_safi`, `pay_select`,`op_discont_out` )
                                                   VALUES (NULL, '$op_code', '$op_tree_code', '$custmer_code','$cash', '0' , '$op_total', '$op_added', '$op_discont', '$op_safi', '$pay_select','0');");
            $stmt_set_cash->execute();
    }
        //*********************************************************************فاتورة مبدئية5************************* */
    elseif ($op_type==5) {
        $sql_op_det_for_st= "SELECT * FROM `op_det` WHERE `op_code2` = '$op_code'";
        $op_set_dets = get_all($sql_op_det_for_st);
        foreach ($op_set_dets as  $op_det) {
            $op_it_id = $op_det['op_it_code'];
               $op_it_un_code= $op_det['op_it_un_code'];
            $op_it_qty = $op_det['op_it_qty'];
        

            //لتحديد الكمية بضرب الوحدات في المعامل
            //اولا تحديد إذا كانت الوحدة المختارة هي الصغرى 
            $sql_cont_it= "SELECT * FROM `items` WHERE `it_id` = '$op_it_id' && `it_min_un` = '$op_it_un_code' ";
            if(row_count ($sql_cont_it)==0){
                $sql_un_it_qty ="SELECT `un_eq` FROM `items_units` WHERE `it_id` = '$op_it_id'  && `un_id` = '$op_it_un_code' ";
                $it_un_info = row_info ($sql_un_it_qty);
                // $op_it_qty = $it_un_info['un_eq']*$op_it_qty;
                // $op_it_qty = $it_un_info['un_eq']*$op_it_qty;
            }

            //إذا كان الصنف موجود تتم إضافة الكمية
            // $sql_chick_it_in_st = "SELECT * FROM `stock` WHERE `op_st_code` = '$stok' && `it_id` = '$op_it_id' ";
            // if (row_count($sql_chick_it_in_st)==0) {
            // }


    
            $stmt_set_stock = $con->prepare("INSERT INTO `stock` (`ser_no`, `op_code`, `op_st_code`, `op_type`, `it_code`, `un_code` , `it_qty_in`, `it_qty_out`)
            VALUES (NULL, '$op_code', '$stok','$op_type','$op_it_id','$op_it_un_code','0', '0');");
            $stmt_set_stock->execute();
        }
            //cash insert
    
            $stmt_set_cash = $con->prepare("INSERT INTO `cash` (`cash_serial`, `op_code`, `op_tree_code_in`, `cash_in`, `cash_out` , `op_total`, `op_added`, `op_discont`, `op_safi`, `pay_select` )
            VALUES (NULL, '$op_code', '$op_tree_code', '0', '0' , '$op_total', '$op_added', '$op_discont', '$op_safi', '$pay_select');");
            $stmt_set_cash->execute();
    }

    ?>
<script>
        //  $("#pur_rebort").modal("show");

swal.fire({
    position: "top",
    title: " تـم تأكيد العملية  ",
    icon: "success",
    timer: 1000
})
var cont = 0;
var time = setInterval(function() {
    cont++;
    if (cont == 1) {
        setTimeout(time);
      window.open("order.php?op_code=<?php echo $op_code ?>");
      location.reload();

    }

}, 500)
</script>
<?php
}//if (isset($_GET['order']) && $_GET['order']=="set_cash")
elseif (isset($_GET['order']) && $_GET['order']=="edit_op") {
    $op_code = $_GET['op_code'];
    $op_tree_code_user  = $_GET['op_tree_code_user'];
    $op_tree_name = $_GET['op_tree_name'];
    $op_st_code = $_GET['op_st_code'];

    // $stmt_edit_op = $con->prepare("UPDATE  `op` SET
    // `op_tree_code_in` = $op_tree_code_user ,
    // `op_tree_name` = $op_tree_name
    //  WHERE `op_code` = 88 ");
    // $stmt_edit_op->execute(array());
//لقد جعلنا الجهة التي تعاملت مع الفاتورة كودها المن تري 4 في خانة op_tree_name
    $stmt_edit_op = $con->prepare("UPDATE  `op` SET 
    `op_tree_code` = $op_tree_code_user,            
    `op_tree_name` = $op_tree_name            
     WHERE `op_code` = '$op_code' ");
    $stmt_edit_op->execute(array());

    $stmt_edit_op_det = $con->prepare("UPDATE  `op_det` SET 
    `op_st_code` = $op_st_code                
     WHERE `op_code2` = '$op_code' ");
    $stmt_edit_op_det->execute(array());
}
