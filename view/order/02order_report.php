<script src="js/jquery-3.4.0.min.js"></script>
<?php
if(isset($_GET['op_code']) && (int)$_GET['op_code'] ){
    $op_code = mksave($_GET['op_code']);
    //سيلكت او بي
     $sql_op = "SELECT * FROM `op` WHERE `op_code` = '$op_code' ";
      $po_info = row_info ($sql_op);
      //سيلكت التفاصيل
     $sql_op_det = "SELECT * FROM `op_det` WHERE `op_code2` = '$op_code' ";
     $po_det_info = row_info ($sql_op_det);
       //سيلكت الكاش
       $sql_cash = "SELECT * FROM `cash` WHERE `op_code` = '$op_code' ";
       $cash_info = row_info ($sql_cash);
          //سيلكت نوع الفاتورة
          $sql_op_type = "SELECT `type_name` FROM `op_type` WHERE `type_code` = '$po_info[op_type]' ";
          $op_type_info = row_info ($sql_op_type);
    
    //تفاصيل الفاتورة
    $orders = get_all ($sql_op_det);
?>
<link rel="stylesheet" href="css/order/order.css">

<div class="row big_report_row">
    <div class="col-12">

        <div class="row b1_report_row" style="">
            <div class="col-4">
                <span class="inv-label">
                    رقم الفاتـــورة:
                </span>
                <span id="inv-no"></span><?php echo $po_info['op_code_year']; ?>
            </div>
            <div class="col-4">
                <span class="inv-label">
                    نوع الفاتورة:
                </span>
                <span id="inv-pay-method"><?php  echo $op_type_info['type_name']; ?></span>
            </div>
            <div class="col-4">
                <span class="inv-label">
                    التكلفة الأولية:
                </span>
                <span id="inv-sub-total"><?php  echo  number_format($cash_info['op_total'], 2, '.', ','); ?></span>
            </div>
            <div class="col-4">
                <span class="inv-label">
                    التـــاريــــــــخ:
                </span>
                <span id="inv-date"><?php echo $po_info['op_date']; ?></span>
            </div>
            <div class="col-4">
                <span class="inv-label">
                    طريقة الدفع:
                </span>
                <span id="inv-pay-method"><?php  echo $cash_info['pay_select']; ?></span>
            </div>
            <div class="col-4">
                <span class="inv-label">
                    الخصــــــــــــم:
                </span>
                <span id="inv-discount"><?php  echo $cash_info['op_discont']; ?></span>
            </div>

            <div class="col-4">
                <span class="inv-label">
                    إسم المستخدم:
                </span>
                <span id="inv-us-name"><?php 
                     $sql_us = "SELECT `us_name` FROM `users` WHERE `us_code` = '$po_info[op_us_code]' ";
                     $us_info = row_info ($sql_us);
                    echo $us_info['us_name']; ?></span>
            </div>
            <div class="col-4">
                الخزنة/البنك:
                </span>
                <span id="inv-safe"><?php 
                     $sql_safe = "SELECT `tree4_name` FROM `tree4` WHERE `tree4_code` = '$cash_info[op_tree_code]' ";
                     $safe_info = row_info ($sql_safe);
                    echo $safe_info['tree4_name']; ?></span>
            </div>
            <div class="col-4">

            </div>
            <div class="col-4">
                <span class="inv-label">
                    إسم العميـــــل:
                </span>
                <span id="inv-customer"><?php 
                     $sql_custmer = "SELECT `tree4_name` FROM `tree4` WHERE `tree4_code` = '$po_info[op_tree_code]' ";
                     $custmer_info = row_info ($sql_custmer);
                    echo $custmer_info['tree4_name']; ?></span>
            </div>
            <div class="col-4">

            </div>
            <div class="col-4">
                <span class="inv-label">
                    التكلفـة الكليـة:
                </span>
                <span id="inv-total"><?php echo number_format($cash_info['op_safi'], 2, '.', ',');  ?></span>
            </div>





        </div><!-- b1_report_row -->

        <!-- *********************************************************************************** -->
        <div class="row b1_report_row" style="    padding: 25px 200px">
        <div class="col-12">                <h5>تفاصيل الفاتورة:</h5></div>
        <div class="col-12">            
        <table class="table table-bordered table-sm" style="    color: aliceblue;    font-weight: bold;">
                <thead>
                <tr>
                    <th scope="col">الـطـلب</th>
                    <th scope="col">الوحدة</th>
                    <th scope="col">السعر</th>
                    <th scope="col">الـعدد</th>
                    <th scope="col">التكلفة</th>
                </tr>
                </thead>
                <tbody id="order-details">
                    <?php 
                    foreach($orders as $order){?>
                    <tr>
                        <td><?php
                        $it_info = "SELECT `it_name` FROM `items` WHERE `it_id` = '$order[op_it_code]' ";
                        $it_info = row_info ($it_info);
                       echo $it_info['it_name']; ?>
                       </td>
                       <td><?php
                        $un_info = "SELECT `un_name` FROM `units` WHERE `un_id` = '$order[op_it_un_code]' ";
                        $un_info = row_info ($un_info);
                       echo $un_info['un_name']; ?>
                       </td>
                       <td><?php echo  number_format($order['op_it_price'], 2, '.', ','); ?>
                       </td>
                       <td><?php echo $order['op_it_qty']; ?>
                       </td>
                       </td>
                       <td><?php 
                      $total =  ($order['op_it_price'] * $order['op_it_qty']);
                       echo  number_format($total, 2, '.', ',') ; ?>
                       </td>
                    </tr>
                   <?php
                   }
                    ?>
                </tbody>
            </table>

        </div>
        <div class="col-12 text-center">
                التكلفة الكلية:
                <span id="total-order-price"><?php echo number_format($cash_info['op_safi'], 2, '.', ',');  ?></span>
            </div>
            <hr/><br/>
            <div class="col-12 text-center">
        <button id="print_this" class="btn btn-success">طباعة الفاتورة</button>
        <button onClick="window.close();" id="btn-back" class="btn btn-secondary">رجوع</button>
    </div>
        </div><!-- b1_report_row -->






    </div>
</div><!-- big_report_row -->
<script>
        $("#print_this").on("click",function(){
        $(this).hide();
     window.print();
    // alert(55);
    });
</script>
<?php

}else//!isset($_GET['op_code']
{
    ?>
<div style="margin-top:15%;color: black;    font-weight: bold;    font-size: 19px;"
    class="alert alert-info text-center">
    عفواً ... طريقة غير صحيحة للعرض</div>
<?php
}
?>
