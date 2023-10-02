<?php
include  "../main/config.php";
include "../main/function.php";
session_start();
error_reporting(0); 

if (isset($_GET['order']) && $_GET['order']=="insert") {
    $op_type = mksave($_GET['op_type']);
    $op_note = mksave($_GET['op_note']);
    $cash = mksave($_GET['cash']);
    $ksna_bank = mksave($_GET['ksna_bank']);
    $other = mksave($_GET['other']);
    $us_code = $_SESSION['us_code'];

    //insert op *************************************************************************************************

    //   max(op_code)
    if ($op_type != 13 && $op_type != 14) {//إثتثنا الديون من الادخال في جدول او بي لان له تحقق من وجود الدين اولا وسيتم الادخال فيه بالاسفل
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
        VALUES ('$op_type', '$op_code', '$op_date', '$op_time', '$us_code', '$op_code_year', '210200001', '','$op_note');");
        $stmtfirst->execute();
    }

          //cash op *************************************************************************************************
        if($op_type == 6){//////iradat
            //اولا سحب من حساب الاخرين
            $stmt_set_cash_out = $con->prepare("INSERT INTO `cash` (`cash_serial`, `op_code`, `op_tree_code_in`, `op_tree_code_out`, `cash_in`, `cash_out` , `op_total`, `op_added`, `op_discont`, `op_safi`, `pay_select`,`op_discont_out` )
            VALUES (NULL, '$op_code','$ksna_bank', '$other', '$cash', '0' , '$cash', '', '', '$cash', '','0');");
            $stmt_set_cash_out->execute();
            ?>
<script>
swal.fire({
    position: "top",
    title: "  تـمت الاضافة بنجاح  ",
    icon: "success",
    timer: 2000
})
</script>
<?php

            // //ثانيا ايداع في الخزينة او البنك
            // $stmt_set_cash_in = $con->prepare("INSERT INTO `cash` (`cash_serial`, `op_code`, `op_tree_code`, `cash_in`, `cash_out` , `op_total`, `op_added`, `op_discont`, `op_safi`, `pay_select` )
            // VALUES (NULL, '$op_code', '$ksna_bank', '$cash', '0' , '$cash', '', '', '$cash', '');");
            // $stmt_set_cash_in->execute();
            //cash op *************************************************************************************************
       
                  //cash op *************************************************************************************************
        }elseif($op_type == 7|| $op_type == 8){//////منصرف قيد
                    //اولا سحب من حساب الاخرين
                    $stmt_set_cash_out = $con->prepare("INSERT INTO `cash` (`cash_serial`, `op_code`, `op_tree_code_in`, `op_tree_code_out`, `cash_in`, `cash_out` , `op_total`, `op_added`, `op_discont`, `op_safi`, `pay_select`,`op_discont_out` )
                    VALUES (NULL, '$op_code', '$other','$ksna_bank', '0', '$cash' , '$cash', '', '', '$cash', '','0');");
                    $stmt_set_cash_out->execute();

                    ?>
<script>
swal.fire({
    position: "top",
    title: "  تـمت الاضافة بنجاح  ",
    icon: "success",
    timer: 2000
})
</script>
<?php
        
                    // //ثانيا ايداع في الخزينة او البنك
                    // $stmt_set_cash_in = $con->prepare("INSERT INTO `cash` (`cash_serial`, `op_code`, `op_tree_code`, `cash_in`, `cash_out` , `op_total`, `op_added`, `op_discont`, `op_safi`, `pay_select` )
                    // VALUES (NULL, '$op_code', '$ksna_bank', '0', '$cash' , '$cash', '', '', '$cash', '');");
                    // $stmt_set_cash_in->execute();
                    //cash op *************************************************************************************************
                }elseif($op_type == 13){
                    //اولا ننظر هل يوجد دين على المذكور
                    $sql_ch_din ="SELECT cash_serial, sum(op_discont_out),sum(op_discont) FROM `cash` WHERE 
                    (`op_tree_code_in` = '$other' AND `op_tree_code_out` = '$ksna_bank' )";
                    $din_info_fun = row_info($sql_ch_din);
                    $din_info =  $din_info_fun['sum(op_discont_out)'];
                    $new_dain = $din_info - $cash; 
                  //اذا كانت قيمة السداد اكبر من الدين
                  if($new_dain<0){?>
<script>
swal.fire({
    position: "center",
    title: "  عفواً ... قيمة السداد اكبر من الدين  ",
    icon: "erorr",
    timer: 2000
})
</script>
<?php
                  }else{
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
                    VALUES ('$op_type', '$op_code', '$op_date', '$op_time', '$us_code', '$op_code_year', '210200001', '','$op_note');");
                    $stmtfirst->execute();
                    $stmt_set_cash_out = $con->prepare("INSERT INTO `cash` (`cash_serial`, `op_code`, `op_tree_code_in`, `op_tree_code_out`, `cash_in`, `cash_out` , `op_total`, `op_added`, `op_discont`, `op_safi`, `pay_select`,`op_discont_out` )
                    VALUES (NULL, '$op_code', '$other','$ksna_bank', '0', '$cash' , '$cash', '', '', '$cash', '','0');");
                    $stmt_set_cash_out->execute();

                    // اولا تصفير الدين

                    $stmt_set_cash_out130 = $con->prepare("UPDATE `cash` SET
                    `op_discont_out` = 0
                    WHERE `op_tree_code_in` = '$other' AND `op_tree_code_out` = '$ksna_bank'  ;");
                   $stmt_set_cash_out130->execute();
                    // ثانيا اضافة متبقي الدين
                    //اولا جلب اخر عملية في الكاش لجلب رقمها
                    $sql_ch_din ="SELECT `cash_serial` FROM `cash` ORDER by `cash_serial` DESC LIMIT 1 ";
                    $din_info_fun = row_info($sql_ch_din);
                    $cash_serial13 =  $din_info_fun['cash_serial']; 

                    $stmt_set_cash_out13 = $con->prepare("UPDATE `cash` SET
                     `op_discont_out` = '$new_dain'
                     WHERE `cash_serial` = '$cash_serial13' ;");
                    $stmt_set_cash_out13->execute();
                   
                    ?>
<script>
swal.fire({
    position: "top",
    title: "  تـمت الاضافة بنجاح  ",
    icon: "success",
    timer: 2000
})
</script>
<?php

                  }

                    

                
                    //cash op *************************************************************************************************
                
                                 //cash op **********************************دين من حساب***************************************************************
                                }elseif($op_type == 14){
                                    //اولا ننظر هل يوجد دين على المذكور
                                    $sql_ch_din ="SELECT cash_serial, sum(op_discont_out),sum(op_discont) FROM `cash` WHERE 
                                    (`op_tree_code_in` = '$ksna_bank' AND `op_tree_code_out` = '$other'  )";
                                    $din_info_fun = row_info($sql_ch_din);
                                   echo $din_info =  $din_info_fun['sum(op_discont)'];
                                    $new_dain = $din_info - $cash; 
                                  //اذا كانت قيمة السداد اكبر من الدين
                                  if($new_dain<0){?>
                <script>
                swal.fire({
                    position: "center",
                    title: "  عفواً ... قيمة السداد اكبر من الدين  ",
                    icon: "erorr",
                    timer: 2000
                })
                </script>
                <?php
                                                  }else{
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
                                    VALUES ('$op_type', '$op_code', '$op_date', '$op_time', '$us_code', '$op_code_year', '210200001', '','$op_note');");
                                    $stmtfirst->execute();
                                    $stmt_set_cash_out = $con->prepare("INSERT INTO `cash` (`cash_serial`, `op_code`, `op_tree_code_in`, `op_tree_code_out`, `cash_in`, `cash_out` , `op_total`, `op_added`, `op_discont`, `op_safi`, `pay_select`,`op_discont_out` )
                                    VALUES (NULL, '$op_code', '$ksna_bank','$other', '$cash', '0' , '$cash', '', '', '$cash', '','0');");
                                    $stmt_set_cash_out->execute();
                
                                    // اولا تصفير الدين
                
                                    $stmt_set_cash_out130 = $con->prepare("UPDATE `cash` SET
                                    `op_discont` = 0
                                    WHERE `op_tree_code_in` = '$ksna_bank' AND `op_tree_code_out` = '$other' ;");
                                   $stmt_set_cash_out130->execute();
                                    // ثانيا اضافة متبقي الدين
                                    //اولا جلب اخر عملية في الكاش لجلب رقمها
                                    $sql_ch_din ="SELECT `cash_serial` FROM `cash` ORDER by `cash_serial` DESC LIMIT 1 ";
                                    $din_info_fun = row_info($sql_ch_din);
                                    $cash_serial13 =  $din_info_fun['cash_serial']; 
                
                                    $stmt_set_cash_out13 = $con->prepare("UPDATE `cash` SET
                                     `op_discont` = '$new_dain'
                                     WHERE `cash_serial` = '$cash_serial13' ;");
                                    $stmt_set_cash_out13->execute();
                
                                    ?>
                <script>
                swal.fire({
                    position: "top",
                    title: "  تـمت الاضافة بنجاح  ",
                    icon: "success",
                    timer: 2000
                })
                </script>
                <?php
                
                                  }
                
                                    
                
                                
                                    //cash op *************************************************************************************************
                                }



       

}//insert
elseif (isset($_GET['order']) && $_GET['order']=="show") {
    $op_type = mksave($_GET['op_type']);
 $sql_op = "SELECT * FROM `op` WHERE `op_type` =  '$op_type' ORDER BY `op_date`";
 $irads = get_all($sql_op);
 ?>
<script>
$(document).ready(function() {
    // DataTable initialisation
    $('#order_data').DataTable({
        //     dom: 'Bfrtip',
        // buttons: [
        //     'print'
        // ],
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'الكل']
        ],
        "order": [
            [0, "desc"]
        ],
        "paging": true,
        "autoWidth": true,
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            nb_cols = api.columns().nodes().length;
            var j = 2;
            while (j < nb_cols) {
                var pageTotal = api
                    .column(j, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return Number(a) + Number(b);
                    }, 0);
                // Update footer
                var newtotal = new Intl.NumberFormat().format(pageTotal);
                $(api.column(j).footer()).html(newtotal + " ج");
                j++;
            }
        }
    });
});
</script>

<table id="order_data" class="display text-center" style="width:100%">
    <thead>
        <tr>
            <th> التاريخ </th>
            <th>المبلغ </th>
            <th style="width: 90px"> جهة السحب</th>
            <th style="width: 90px"> جهة الايداع </th>
            <th> البيان </th>
            <th> خيارات </th>
            <th style="display: none;"> # </th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td> جملة المبلغ</td>
            <td style="display: none;"></td>
            <td style="display: none;"></td>
            <td style="display: none;"></td>
            <td style="display: none;"></td>
            <td style="display: none;" id="totle_mony"></td>
            <td style="width:120px"></td>
        </tr>
    </tfoot>
    <tbody>
        <?php
foreach( $irads as  $irad){
    $sql_irad = "SELECT * FROM `cash` WHERE `op_code` =  $irad[op_code]  ORDER BY `op_code` DESC";
    $irade = row_info($sql_irad);

    ?>

        <tr style="    border-bottom: 2px solid black !important;">
            <td style="width: 95px"><?php echo $irad['op_date']." "."@"." ".$irad['op_time'] ?></td>
            <td style="    padding: 0px;    width: 100px;" data-order="<?php echo $irade['cash_out'] ; ?>">
                <?php
                if($op_type==6){
                echo number_format($irade['cash_in'])." "."ج";
                // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
            }elseif($op_type==7){
                echo number_format($irade['cash_out'])." "."ج";
                // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
            }elseif($op_type==8){
                echo number_format($irade['cash_out'])." "."ج";
            }  elseif($op_type==13){
                echo number_format($irade['cash_out'])." "."ج";
            }   elseif($op_type==14){
                echo number_format($irade['cash_in'])." "."ج";
            }  
           
           ?>
            </td>

            <td> <?php
                            if($op_type==6){
                                echo get_name_by_id("tree4","tree4_code",$irade['op_tree_code_out'],"tree4_name"); 
                                // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                            }elseif($op_type==7){
                                echo get_name_by_id("tree4","tree4_code",$irade['op_tree_code_out'],"tree4_name"); 
                                // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                            }elseif($op_type==8){
                                echo get_name_by_id("tree4","tree4_code",$irade['op_tree_code_out'],"tree4_name"); 
                            }  elseif($op_type==13){
                                echo get_name_by_id("tree4","tree4_code",$irade['op_tree_code_out'],"tree4_name"); 
                                // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                            } elseif($op_type==14){
                                echo get_name_by_id("tree4","tree4_code",$irade['op_tree_code_in'],"tree4_name"); 
                                // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                            }
            
            
              ?> </td>
            <td> <?php
                    if($op_type==6){
                        echo get_name_by_id("tree4","tree4_code",$irade['op_tree_code_in'],"tree4_name"); 
                        // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                    }elseif($op_type==7){
                        echo get_name_by_id("tree4","tree4_code",$irade['op_tree_code_in'],"tree4_name"); 
                        // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                    }elseif($op_type==8){
                        echo get_name_by_id("tree4","tree4_code",$irade['op_tree_code_in'],"tree4_name"); 
                    }  elseif($op_type==13){
                        echo get_name_by_id("tree4","tree4_code",$irade['op_tree_code_in'],"tree4_name"); 
                        // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                    } elseif($op_type==14){
                        echo get_name_by_id("tree4","tree4_code",$irade['op_tree_code_out'],"tree4_name"); 
                        // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                    }
              ?>
            </td>

            <td><?php echo $irad['op_note'] ?></td>
            <td style="width: 70px">
<?php
            if($op_type==6 || $op_type==7 || $op_type==8){//تاجيل عملية تعديل الحسابات في ما بعد
                  
                    ?>
                <button class="btn btn-success btn-sm edit_cashsss" data-toggle="modal" data-target="#edidqid"
                    data-op_code="<?php  echo $irad['op_code'] ; ?>" data-op_type="<?php  echo $irad['op_type'] ; ?>"
                    data-edit_op_note="<?php echo $irad['op_note'] ; ?>"
                    data-first_other_val="<?php echo $irade['op_tree_code_out']; ?>"
                    data-first_ksna_bank_val="<?php echo $irade['op_tree_code_in']; ?>"
                    data-first_other_text="<?php echo get_name_by_id("tree4","tree4_code",$irade['op_tree_code_out'],"tree4_name"); ?>"
                    data-first_ksna_bank_text="<?php echo get_name_by_id("tree4","tree4_code",$irade['op_tree_code_in'],"tree4_name"); ?>"
                    data-edit_cash="<?php echo $irade['cash_in'] ; ?>" data-title="<?php 
                           if($op_type==6){
                               echo "تعديل الايرادات" ;
                                echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                           }elseif($op_type==7){
                               echo "تعديل المنصرفات" ;
                                echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                           }elseif($op_type==8){
                               echo "تعديل قيد يومي" ;
                           }               
                 ?>"><i class="fa fa-edit"></i></button>
                 <?php   } ?>
                <button class="btn btn-danger btn-sm delet_irad" data-op_code="<?php echo $irad['op_code'] ; ?>"
                data-cash="<?php
                
                if($op_type==6 || $op_type==14){
                    echo $irade['cash_in'] ;
                    // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                }elseif($op_type==7 || $op_type==13){
                    echo $irade['cash_out'] ;
                    // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                }elseif($op_type==8){
                    echo $irade['cash_out'] ;
                    // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                }
                
                ?>"
                                data-first_other_val="<?php

if($op_type==14){
    echo $irade['op_tree_code_out'];
    // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
}elseif($op_type==13){
    echo $irade['op_tree_code_in'];
    // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
}
                                
                                
                                
                                ?>"
                    data-first_ksna_bank_val_del="<?php
                    
                    if( $op_type==14){
                        echo $irade['op_tree_code_in']; 
                        // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                    }elseif( $op_type==13){
                        echo $irade['op_tree_code_out']; 
                        // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                    } ?>"
                    data-op_type="<?php echo $irad['op_type'] ; ?>" data-title="<?php 
                            if($op_type==6){
                                echo "الإيراد" ;
                                // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                            }elseif($op_type==7){
                                echo "المنصرف" ;
                                // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
                            }elseif($op_type==8){
                                echo " القيد اليومي" ;
                            }elseif($op_type==13){
                                echo " سداد دين الي حساب" ;
                            } elseif($op_type==14){
                                echo " سداد دين من حساب" ;
                            }                    
                 ?>"><i class="fa fa-remove"></i></button>
            </td>
            <td style="display: none;" data-order="<?php echo $irade['cash_in'] ; ?>">
                <?php
            if($op_type==6 || $op_type==14){
                echo $irade['cash_in'] ;
                // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
            }elseif($op_type==7 || $op_type==13){
                echo $irade['cash_out'] ;
                // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
            }elseif($op_type==8){
                echo $irade['cash_out'] ;
                // echo number_format($irade['cash_in'] , 2, '.', ',')." "."ج";;
            }
            ?>
            </td>
        </tr>


        <?php
}
?>


    </tbody>

</table>
<?php

}
?>
<script>
/* Centering the modal vertically */
function alignModal() {
    var modalDialog = $(this).find(".modal-dialog");
    modalDialog.css("margin-top", Math.max(0,
        ($(window).height() - modalDialog.height()) / 2) + 50);
}
$(".modal").on("shown.bs.modal", alignModal);

/* Resizing the modal according the screen size */
$(window).on("resize", function() {
    $(".modal:visible").each(alignModal);
});
/* Centering the modal vertically */


$(".edit_cashsss").on("click", function() {
     alignModal(); //دالة تعديل مكان المودل
    $("#finaly_po_code").val($(this).data("op_code"));
    $("#finaly_op_type").val($(this).data("op_type"));
    $("#exampleModalLabel").text($(this).data("title"));
    $("#edit_cash").val($(this).data("edit_cash"));
    $("#edit_op_note").val($(this).data("edit_op_note"));
    $("#first_other").text($(this).data("first_other_text"));
    $("#first_ksna_bank").text($(this).data("first_ksna_bank_text"));
    $("#first_other").val($(this).data("first_other_val"));
    $("#first_ksna_bank").val($(this).data("first_ksna_bank_val"));
    alert($("#finaly_po_code").val());
});









function importfun(url, div = '', order = '', op_type = '', op_code = '',other='',ksna_bank='',cash='') { //دالة جلب البيانات  
    $.ajax({
        method: "GET",
        url: url,
        data: {
            order: order,
            op_type: op_type,
            op_code: op_code,
            other: other,
            ksna_bank: ksna_bank,
            cash: cash
        },
        // beforeSend: function() {
        //     $(div).html(
        //         "<center><img src='../../assets/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>"
        //     )

        // },
        success: function(data) {
            $(div).html(data)
        },
        error: function() {
            // var erorr = $("#conecterorr").text();
            $(div).html('<div class="alert alert-warning" role="alert">عذراً .. حدث خطأ في الاتصال </div>');
        }
    });
} //دالة جلب ملفات الماين ديف  other


$(".delet_irad").on("click", function() {
    var op_code = $(this).data("op_code");
    var op_type = $(this).data("op_type");

    var other = $(this).data("first_other_val");
    var ksna_bank = $(this).data("first_ksna_bank_val_del");
    var cash = $(this).data("cash");

    var name = $(this).data("title");
    swal.fire({
        position: "center",
        icon: "error",
        title: "حـذف عملية" + " " + name,
        confirmButtonText: "حـذف",
        cancelButtonText: "رجوع",
        showCancelButton: true,
        preConfirm: () => {
            importfun("model/accounts/04edit_irad.php", "#iradtbody", "delete", op_type, op_code,other,ksna_bank,cash);
            var cont = 0;
            var set_time = setInterval(() => {
                cont++;
                if (cont == 2) {
                   importfun("model/accounts/03irad.php", "#iradtbody", "show", op_type);
                    $("#cash").val(0);
                    $("#op_note").val("");
                    setTimeout(set_time);
                }
            }, 500);
        }
    })

});
</script>