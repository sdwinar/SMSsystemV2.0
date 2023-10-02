<?php
session_start();
// error_reporting(0);
include  "../main/config.php";
include "../main/function.php";

if (isset($_GET['order']) && $_GET['order']=="insert_order") {

       //التفريغ بين الحذف والاضافة
    $opration= mksave($_GET['opration']);
    
    if ($opration=="insert") {
        $op_code2 = mksave($_GET['op_code']);
        $op_it_code = mksave($_GET['op_it_code']);

        //سيلكت او بي
        $it_op_inf = "SELECT `op_type` FROM `op` WHERE `op_code` = '$op_code2' ";
        $op_type_info = row_info($it_op_inf);

        //سيلكت او بي
        $it_op = "SELECT * FROM `items` WHERE `it_id` = '$op_it_code' ";
        $it_info = row_info($it_op);



        //تحذير الكمية تقل
        $it_min_qty =  $it_info['it_min_qty'];
        $sql_stock = "SELECT SUM(it_qty_in), SUM(it_qty_out) FROM `stock`  WHERE `it_code` = '$op_it_code' ";
        $stok_det = row_info($sql_stock);
        $amunt =  $stok_det['SUM(it_qty_in)'] - $stok_det['SUM(it_qty_out)'];

        if ($amunt<$it_min_qty && ($op_type_info['op_type']==2 || $op_type_info['op_type']==3)) {?>
<script>
swal.fire({
    position: "top",
    title: "تحذير الكمية في المخزن",
    icon: "warning",
    timer: 1100
})
</script>
<?php

    }

        

        $op_it_un_code =  $it_info['it_min_un'];
        $op_it_un_eq = 1;
        $op_it_qty = 1;
        //ادخال الكمية الكلية عبارة عن سعرالتكلفة في الشراء وسعر البيع في البيع
        if ($op_type_info['op_type']==1 || $op_type_info['op_type']==3) {
            $op_it_qty_eq = $it_info['it_pr_in'];
        } else {
            $op_it_qty_eq = $it_info['it_pr_out'];
        }
        $op_it_price = $it_info['it_pr_out'];
        //لحساب تكلفة المنتج يجب ادخال قيمة التكلفة لنقصها من قيمة البيع
        // ولانه لا توجد في نظام شكلت حقل للتكلفة المنتج قررنا وضعها في القيمة المجانية
        // التي لم نستخدمها في النظام
        $op_it_pr_in = $it_info['it_pr_in'];
        $op_st_code = 1;
        $op_it_exp ='';


        if ($op_it_un_code!='') {

        //حتى لا تتم الاضافة مرتين وزيادة الكمية فقط op_it_qty_eq
            $stmt_op_det = $con->prepare("SELECT * FROM `op_det` WHERE
 `op_code2` = $op_code2
 && `op_it_code` = $op_it_code
 && `op_it_un_code` = $op_it_un_code");
            $stmt_op_det->execute(array());
            $op_det_cont = $stmt_op_det->rowCount();
            $op_det_info = $stmt_op_det->fetch();

            if ($op_det_cont==0) {
                $stmt_insert_order = $con->prepare("INSERT INTO `op_det` (`op_serial`, `op_code2`, `op_it_code`, `op_it_un_code`, `op_it_un_eq`, `op_it_qty`, `op_it_qty_eq`, `op_it_price`, `op_it_pr_in`, `op_it_exp`, `op_st_code`, `op_it_note`) 
                                                       VALUES (NULL, '$op_code2', '$op_it_code', '$op_it_un_code', '$op_it_un_eq', '$op_it_qty', '$op_it_qty_eq', '$op_it_price', '$op_it_pr_in', '', '$op_st_code', '');");
                $stmt_insert_order->execute();
            } else {//في حالة الضغط مرتين تتم إضافة الكمية
                //نجلب رقم العملية لنبحث به في جدول العمليات لجلب نوع العملية واضافة سعر الشراء او سرع البيع للكمية حسب نوع العملية
                $stmt_op_tp = $con->prepare("SELECT `op_type` FROM `op` WHERE `op_code` =  '$op_code2' LIMIT 1 ");
                $stmt_op_tp->execute(array());
                $op_op_tp = $stmt_op_tp->fetch();

                $op_det_old_pice = $op_det_info['op_it_price'];
                $op_det_old_pr_in = $op_det_info['op_it_pr_in'];
                $op_det_old_khasm = $op_det_info['op_it_pr_khasm'];
                $op_det_new_qty = $op_det_info['op_it_qty']+1;

                $op_det_new_pice = $op_det_old_pice * $op_det_new_qty;
                $op_det_new_pr_in = $op_det_old_pr_in * $op_det_new_qty;


                if($op_op_tp['op_type']==1 ||$op_op_tp['op_type'] == 2){


                    $op_det_new_qty_eq= ($op_det_new_pr_in-$op_det_old_khasm);


                }else{
                    $op_det_new_qty_eq= ($op_det_new_pice-$op_det_old_khasm);

                }

           
                //تحذير الكمية في المخزن
                // echo $op_det_new_qty ;
                $new_amont = $amunt - $op_det_new_qty;
                //    echo $it_min_qty;
                if (($new_amont<$it_min_qty) && ($op_type_info['op_type']==2 || $op_type_info['op_type']==3)) {?>
<script>
swal.fire({
    position: "top",
    title: "تحذير الكمية في المخزن",
    icon: "warning",
    timer: 1100
})
</script>
<?php
        
            }

//                 $stmt_edit_order = $con->prepare("UPDATE  `op_det` SET 
//             `op_it_qty` =    '$op_det_new_qty',
//             `op_it_price` =    '$op_det_old_pice',
//             `op_it_qty_eq` = '$op_det_new_qty_eq'                
//             WHERE     `op_code2` = '$op_code2'
//  && `op_it_code` = '$op_it_code'
//  && `op_it_un_code` = '$op_it_un_code' ");
//                 $stmt_edit_order->execute(array());
            }
        } else {?>
<script>
swal.fire({
    position: "top",
    title: "الرجاء اختيار المنتج اولاً",
    icon: "error",
    timer: 2000
})
</script>
<?php
              }
    } elseif ($opration=="delete") {
        $op_serial = $_GET['op_serial'];
        $op_code2 = mksave($_GET['op_code']);

         
        $stmt_del_order = $con->prepare("DELETE FROM `op_det` WHERE `op_serial` = '$op_serial' ");
        $stmt_del_order->execute(array());
    } elseif ($opration=="edit") {
        $op_serial = $_GET['op_serial'];
        $op_code2 = mksave($_GET['op_code']);

        $op_it_un_code = mksave($_GET['op_it_un_code']);
       
        $op_it_un_eq = mksave($_GET['op_it_un_eq']);
        $op_it_qty = $_GET['op_it_qty'];
      
        $op_it_qty_eq = $_GET['op_it_qty_eq'];
        $op_it_pr_khasm  = $_GET['op_it_pr_khasm'];

        //جلب كود المنتج للبحث به في جدو وحدات الصنف من اجل تحديد سعر الوحدة
        $ssql = "SELECT `op_it_code` FROM `op_det` WHERE `op_serial` = '$op_serial'";
        $oop_it_code = row_info($ssql);
        $ooop_code_it = $oop_it_code['op_it_code'];
   
        //جلب سعر الوحده من وحدات الصنف
        $ssqll = "SELECT * FROM `items_units` WHERE `it_id` = '$ooop_code_it' && `un_id` = '$op_it_un_code' ";
        $oop_it_pric = row_info($ssqll);

        $op_it_price = $oop_it_pric['un_pr_out'];
        $op_it_pr_in = $oop_it_pric['un_pr_in'];



        $stmt_edit_order = $con->prepare("UPDATE  `op_det` SET 
        `op_it_un_code` = '$op_it_un_code' ,               
        `op_it_un_eq` = '$op_it_un_eq' ,               
        `op_it_qty` =' $op_it_qty' ,               
        `op_it_qty_eq` = '$op_it_qty_eq' ,               
        `op_it_pr_khasm` = '$op_it_pr_khasm'               
         WHERE `op_serial` = '$op_serial' ");
        $stmt_edit_order->execute(array()); ?>
<script>
swal.fire({
    position: "top",
    title: "تـم تعديل الطلبية",
    icon: "success",
    timer: 1000
})
</script>
<?php
    } elseif ($opration=="edit_old_order") {// لتعديل الفاتورة القادم من صفحة تعديل الفواتير jsفي صفحة 01order
        $op_code2 = mksave($_GET['op_code']);
    }


    //تحديد نوع العملية لإخفا السعر في بضاعة اول المدة
    $stmt_op_type = $con->prepare("SELECT `op_type` FROM `op` WHERE `op_code`  = '$op_code2'");
    $stmt_op_type->execute(array());
    $op_type = $stmt_op_type->fetch();
    $op_type = $op_type['op_type'];
    //عرض الطلبية بعد الادخال
    $stmt_order_show = $con->prepare("SELECT * FROM `op_det` WHERE `op_code2`  = '$op_code2' ORDER BY `op_serial` DESC ");
    $stmt_order_show->execute(array());
    $orders = $stmt_order_show->fetchAll();
    $rowconut =  $stmt_order_show->rowCount();

    foreach ($orders as $order) {
        //معلومات المنتج
        $stmt_it = $con->prepare("SELECT * FROM `items` WHERE `it_id` = $order[op_it_code] ");
        $stmt_it->execute(array());
        $items = $stmt_it->fetch();
        //معلومات الوحدة
        $stmt_un = $con->prepare("SELECT * FROM `units` WHERE `un_id` = $order[op_it_un_code] ");
        $stmt_un->execute(array());
        $units = $stmt_un->fetch();
        //معلومات وحدات الصتنف
        $stmt_un = $con->prepare("SELECT * FROM `items_units` WHERE `it_id` = $order[op_it_code] && `is_min_un` = 0 ");
        $stmt_un->execute(array());
        $its_uns = $stmt_un->fetchAll();
        //معلومات وحداة الاساسية للصنف
        $stmt_un_min = $con->prepare("SELECT * FROM `items_units` WHERE `it_id` = $order[op_it_code] && `is_min_un` = 1 LIMIT 1 ");
        $stmt_un_min->execute(array());
        $its_uns_min = $stmt_un_min->fetch(); ?>
<!-- إعطا خلفية للرو المحدد -->
<!-- #############################################################بداية عرض الطلبية############################################# -->
<div class="row" style="    margin-bottom: 4px;">


    <input min="0" class="form-control order_input col-3" value="<?php echo $items['it_name'] ?>" type="text"
        id="order_barcode" readonly />
    </span>

    <select class="custom-select oprder_units order_input  col-2">
        <option data-price="<?php echo $its_uns_min['un_pr_out'] ?>" data-un_eq="<?php echo $its_uns_min['un_eq'] ?>"
            value="<?php echo $units['un_id'] ?>"><?php echo $units['un_name']?></option>
        <?php
            foreach ($its_uns as $it_un) {
                $un_name =  get_name_by_id("units", "un_id", $it_un['un_id'], "un_name"); ?>

        <option data-price="<?php echo $it_un['un_pr_out'] ?>" data-un_eq="<?php echo $it_un['un_eq'] ?>"
            value="<?php echo $it_un['un_id'] ?>"><?php echo  $un_name  ?></option>

        <?php
            } ?>

    </select>
    </span>


    <input data-decimals="2" step="0.5" min="0" class="form-control edit_op_it_price order_input col-2 "
        value="<?php
                if ($op_type==1 || $op_type==3) {
                    echo $order['op_it_pr_in'] ;
                } else {
                    echo $order['op_it_price'] ;
                } ?>" type="number" />
    </span>
    <input min="1" class="form-control edit_op_it_qty order_input col-1" value="<?php echo $order['op_it_qty'] ?>"
        type="number" />
    </span>
    <input min="1" class="form-control khasm order_input col-1" value="<?php echo $order['op_it_pr_khasm'] ?>"
        type="number" />
    </span>

    <span class="form-control edit_op_it_qty_eq order_input taklefa col-2"
        style="        margin-left: -20px;"><?php
        
        if ($op_type==1 || $op_type==3) {
            $tklffa = ($order['op_it_pr_in'] * $order['op_it_qty'])-  $order['op_it_pr_khasm'] ;
        } else {
            $tklffa = ($order['op_it_price'] * $order['op_it_qty'])-  $order['op_it_pr_khasm'] ;
        }
        echo number_format($tklffa, 2); ?></span>
    </span>

    <button class="btn btn-success edit_order_btn btn-sm col-1"
        style="max-width: 29px !important;    margin-right: 14px;" data-op_serial="<?php echo $order['op_serial'] ; ?>"
        data-op_code2="<?php echo $order['op_code2'] ; ?>"><i class="fa fa-edit"></i></button>
    </span>


    <button style="max-width: 25px !important;    margin-right: 4px;" class="btn btn-danger delete_order btn-sm col-1"
        data-op_serial="<?php echo $order['op_serial'] ; ?>" data-op_code2="<?php echo $order['op_code2'] ; ?>"><i
            class="fa fa-remove"></i></button>
    </span>

</div>

<?php
    }
}//isert
?>

<script src="../js/bootstrap-input-spinner.js"></script>

<script>
$(document).ready(function() {


    function importorder(opration = '', url, div = '', order = '', op_code2 = '', op_it_code = '',
        op_it_un_code = '', op_it_un_eq = '', op_it_qty = '', op_it_qty_eq = '', op_it_price = '', op_serial =
        '', op_it_pr_khasm = '') { //دالة جلب ملفات الماين ديف 
        $.ajax({
            method: "GET",
            url: url,
            data: {
                opration: opration,
                order: order,
                op_code: op_code2,
                it_code: op_it_code,
                op_it_un_code: op_it_un_code,
                op_it_un_eq: op_it_un_eq,
                op_it_qty: op_it_qty,
                op_it_qty_eq: op_it_qty_eq,
                op_it_price: op_it_price,
                op_serial: op_serial,
                op_it_pr_khasm: op_it_pr_khasm
                //        },
                // // beforeSend: function() {
                // //     $(div).html(
                // //         "<center><img src='../../img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>"
                // //     )

            },
            success: function(data) {
                $(div).html(data);

            },
            error: function(e) {
                // var erorr = $("#conecterorr").text(); op_code2  
                alert(e)
            }
        });
    } //دالة جلب ملفات الماين ديف 7
    function ordercalc(url, div = '', order = '', op_code2 = '') { //دالة جلب ordercalc ordercalc ordercalc 
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,
                op_code2: op_code2
                //        },
                // // beforeSend: function() {
                // //     $(div).html(
                // //         "<center><img src='../../img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>"
                // //     )

            },
            success: function(data) {
                $(div).html(data);

            },
            error: function(e) {
                // var erorr = $("#conecterorr").text(); submit_new_un 
                alert(e)
            }
        });
    } //دالة جلب ordercalc ordercalc ordercalc  

    $(".delete_order").on("click", function() { //إضافة اوردر طلبية  
        var op_serial = $(this).data("op_serial");
        var op_code2 = $(this).data("op_code2");
        // alert(op_serial);
        importorder("delete", "model/order/03inser_order.php", ".order_this", "insert_order", op_code2,
            "", "", "", "", "", "", op_serial); // عرض المنمتجات مباشرة
        var cont = 0;
        var readdorder = setInterval(function() { //إعادة استدعاء الدالة لان المتصفح متخلف
            cont++;
            if (cont == 1) {
                ordercalc("model/order/04order_calc.php", "#order_calc_div", "show_calc",
                    op_code2); // 
                setTimeout(readdorder);
            }

        }, 500);

    });

    $(".edit_order_btn").on("click", function() { //عند الضغط على زر التعديل 

        var op_serial = $(this).data("op_serial");
        var op_code2 = $(this).data("op_code2");

        var op_it_qty = $(this).siblings(".edit_op_it_qty").val();
        var op_it_qty_eq = $(this).siblings(".edit_op_it_qty_eq").text();
        var op_it_price = $(this).siblings(".edit_op_it_price").val();
        // var op_qty_free = $(this).siblings(".edit_op_qty_free").val();
        var op_it_un_code = $(this).siblings(".oprder_units").val();
        var op_it_pr_khasm = $(this).siblings(".khasm").val();

        // var op_it_un_code =$("#oprder_units").val(); .find(':selected').data('un_eq');
        var op_it_un_eq = $(this).siblings(".oprder_units").find(':selected').data('un_eq');
        //    alert(op_it_qty_eq);
        var cont = 0;
        var readdorder = setInterval(function() { //إعادة استدعاء الدالة لان المتصفح متخلف
            cont++;
            if (cont == 1) {
                importorder("edit", "model/order/03inser_order.php", ".order_this",
                    "insert_order", op_code2, "", op_it_un_code, op_it_un_eq, op_it_qty,
                    op_it_qty_eq, op_it_price, op_serial, op_it_pr_khasm
                    ); // عرض المنمتجات مباشرة


            } else if (cont == 2) {
                ordercalc("model/order/04order_calc.php", "#order_calc_div", "show_calc",
                    op_code2); // 
                setTimeout(readdorder);
            }

        }, 500);

    });


    // **********************************************************التعديل*****************************************************
    $(".edit_op_it_price").on("change , keyup , show", function() { //عند تغيير الثمن
        var price = $(this).val();
        var qty = $(this).siblings(".edit_op_it_qty").val();
        var khasm = $(this).siblings(".khasm").val();
        var total = (price * qty) - khasm;
        $(this).siblings(".edit_op_it_qty_eq").text(total);

    });

    // .................................................................................
    $(".edit_op_it_qty").on("change , keyup , show", function() { //عند تغيير الكمية
        var qty = $(this).val();
        var price = $(this).siblings(".edit_op_it_price").val();
        var khasm = $(this).siblings(".khasm").val();
        

        var total = (price * qty) - khasm;
        $(this).siblings(".edit_op_it_qty_eq").text(total);
    });
    // .................................................................................
    $(".khasm").on("change , keyup , show", function() { //عند تغيير الخصم
        var khasm = $(this).val();
        var price = $(this).siblings(".edit_op_it_price").val();
        var qty = $(this).siblings(".edit_op_it_qty").val();
        var total = (price * qty) - khasm;
        $(this).siblings(".edit_op_it_qty_eq").text(total);
    });
    // .................................................................................
    $(".oprder_units").change(function() { //حساب التكلفة الكلية عند تغيير الوحدة
        var price = $(this).find(':selected').data('price');
        var un_eq = $(this).find(':selected').data('un_eq');
        var op_it_un_code = $(this).val();
        $("#it_un_eq").val(un_eq); //إعطاء قيمة معامل الوحدة لانبت معامل الوحدة
        $("#oprder_units").val(op_it_un_code);




        $(this).siblings(".edit_op_it_price").val(price);
        var qty = $(this).siblings(".edit_op_it_qty").val();
        var khasm = $(this).siblings(".khasm").val();
        var total = (price * qty) - khasm;
        $(this).siblings(".edit_op_it_qty_eq").text(total);
    })
    // .................................................................................



}); //ready