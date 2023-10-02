<?php
include  "../main/config.php";
include "../main/function.php";
session_start();
// error_reporting(0); 

if (isset($_GET['order']) && $_GET['order']=="edit") {
     $op_code = mksave($_GET['op_code']); 
     $op_type = mksave($_GET['op_type']);
    $op_note = mksave($_GET['op_note']);
    $cash = mksave($_GET['cash']); 
    $ksna_bank = mksave($_GET['ksna_bank']);
    $other = mksave($_GET['other']);
    $us_code = $_SESSION['us_code'];

    $stmtupop = $con->prepare("UPDATE `op` SET `op_note` = '$op_note' WHERE `op_code` =  '$op_code' ;");
    $stmtupop->execute();

              //cash op *************************************************************************************************
              if($op_type == 6){//////iradat
                //اولا سحب من حساب الاخرين
                $stmt_set_cash_out = $con->prepare("UPDATE `cash` SET 
                 `op_tree_code_out` = '$other',
                 `op_tree_code_in` = '$ksna_bank',
                  `cash_in` = '$cash' 
                 WHERE `op_code` =  '$op_code';");
                $stmt_set_cash_out->execute();
    
       
                //cash op *************************************************************************************************
           
                      //cash op *************************************************************************************************
            }elseif($op_type == 7|| $op_type == 8){//////iradat
                        //اولا سحب من حساب الاخرين
                        $stmt_set_cash_out = $con->prepare("UPDATE `cash` SET 
                        `op_tree_code_in` = '$other',
                        `op_tree_code_out` = '$ksna_bank',
                         `cash_out` = '$cash' 
                        WHERE `op_code` =  '$op_code'  ;");
                       $stmt_set_cash_out->execute();
                                      
                                                //cash op *************************************************************************************************
                    }
                    ?>
<script>
swal.fire({
    position: "center",
    title: "  تـم التعديل بنجاح  ",
    icon: "success",
    timer: 2000
})
</script>
<?php

}elseif (isset($_GET['order']) && $_GET['order']=="delete") {

    $op_code = mksave($_GET['op_code']);
    $op_type = mksave($_GET['op_type']);
    $ksna_bank = mksave($_GET['ksna_bank']);
     $other = mksave($_GET['other']);
     $cash = mksave($_GET['cash']);
 
    if(  $op_type==13){
        

        //اولا ننظر هل يوجد دين على المذكور
        $sql_ch_din ="SELECT cash_serial, sum(op_discont_out) FROM `cash`
        WHERE `op_tree_code_out` = '$ksna_bank' AND `op_tree_code_in` = ' $other' ";
        $din_info_fun = row_info($sql_ch_din);
           $din_info =  $din_info_fun['sum(op_discont_out)'];
        $new_dain = $din_info + $cash; 

        
        $stmt_set_cash_out130 = $con->prepare("UPDATE `cash` SET
        `op_discont_out` = 0
        WHERE `op_tree_code_out` = '$ksna_bank' AND `op_tree_code_in` = ' $other' ;");
       $stmt_set_cash_out130->execute();

                // ثانيا اضافة متبقي الدين
        //اولا جلب اخر عملية في الكاش لجلب رقمها
        $sql_ch_din ="SELECT MIN(`cash_serial`) FROM `cash` WHERE `op_tree_code_out` = '$ksna_bank' AND `op_tree_code_in` = '$other'";
        $din_info_fun = row_info($sql_ch_din);
       echo $cash_serial13 =  $din_info_fun['MIN(`cash_serial`)']; 

        $stmt_set_cash_out13 = $con->prepare("UPDATE `cash` SET
            `op_discont_out` = '$new_dain'
            WHERE `cash_serial` = '$cash_serial13' ;");
        $stmt_set_cash_out13->execute();

        $stmtupop = $con->prepare("DELETE FROM `cash` WHERE `op_code` =  '$op_code' ;");
        $stmtupop->execute();
    
        $stmtupop = $con->prepare("DELETE FROM `op` WHERE `op_code` =  '$op_code' ;");
        $stmtupop->execute();
    ?>
        <script>
    swal.fire({
        position: "center",
        title: "  تـم الحذف بنجاح  ",
        icon: "success",
        timer: 2000
    })
    </script>
    <?php

// 333333333333333############################################################################################
    }elseif(  $op_type==14){
        


        //اولا ننظر هل يوجد دين على المذكور
        $sql_ch_din ="SELECT cash_serial,sum(op_discont) FROM `cash`
        WHERE `op_tree_code_in` = '$ksna_bank' AND `op_tree_code_out` = ' $other' ";
        $din_info_fun = row_info($sql_ch_din);
        $din_info =  $din_info_fun['sum(op_discont)'];
         $new_dain = $din_info + $cash; 
       

        $stmt_set_cash_out130 = $con->prepare("UPDATE `cash` SET
        `op_discont` = 0
        WHERE `op_tree_code_in` = '$ksna_bank' AND `op_tree_code_out` = ' $other' ;");
       $stmt_set_cash_out130->execute();

                // ثانيا اضافة متبقي الدين
        //اولا جلب اخر عملية في الكاش لجلب رقمها
        $sql_ch_din ="SELECT MIN(`cash_serial`) FROM `cash` WHERE `op_tree_code_in` = '$ksna_bank' AND `op_tree_code_out` = '$other'";
        $din_info_fun = row_info($sql_ch_din);
       echo $cash_serial13 =  $din_info_fun['MIN(`cash_serial`)']; 

        $stmt_set_cash_out13 = $con->prepare("UPDATE `cash` SET
            `op_discont` = '$new_dain'
            WHERE `cash_serial` = '$cash_serial13' ;");
        $stmt_set_cash_out13->execute();

        $stmtupop = $con->prepare("DELETE FROM `cash` WHERE `op_code` =  '$op_code' ;");
        $stmtupop->execute();
    
        $stmtupop = $con->prepare("DELETE FROM `op` WHERE `op_code` =  '$op_code' ;");
        $stmtupop->execute();
    ?>
        <script>
    swal.fire({
        position: "center",
        title: "  تـم الحذف بنجاح  ",
        icon: "success",
        timer: 2000
    })
    </script>
    <?php


    }else{

        $stmtupop = $con->prepare("DELETE FROM `op` WHERE `op_code` =  '$op_code' ;");
        $stmtupop->execute();

    $stmtupop = $con->prepare("DELETE FROM `cash` WHERE `op_code` =  '$op_code' ;");
    $stmtupop->execute();

  
?>
    <script>
swal.fire({
    position: "center",
    title: "  تـم الحذف بنجاح  ",
    icon: "success",
    timer: 2000
})
</script>
<?php

}
}

?>
