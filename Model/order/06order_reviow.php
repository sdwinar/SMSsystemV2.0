<?php
session_start();
// error_reporting(0);
include  "../main/config.php";
include "../main/function.php";

if (isset($_GET['order']) && $_GET['order']=="show") {

    // $stmt_delete_sec02 = $con->prepare("DELETE FROM `op` WHERE `op_tree_code` NOT IN (SELECT `tree4_code` FROM `tree4`) ;");  //حذف الفاتورة العشوائية التي تنزل لوحدها مع اول اتزيل
    //  $stmt_delete_sec02->execute();

    $stmt_bills = $con->prepare("SELECT * FROM `op`  ORDER BY `op_code` DESC LIMIT 20");
    $stmt_bills->execute(array());
    $bills = $stmt_bills->fetchAll();
    $unrowcont = $stmt_bills->rowCount();
?>


<script>
$(function() {
    $(".tablesorter").tablesorter({
        widgets: ["zebra", "filter"]
    });
});
</script>
<!-- <span class="bagde badge-dark cl-12"> ( <?php // echo  $unrowcont ?> ) </span> -->
<table class="tablesorter text-center" dir="rtl">
    <thead>
        <tr>
            <th>معرف الفاتورة</th>
            <th>نوع الفاتورة</th>
            <th>الزبون / المورد</th>
            <th>تاريخ الفاتورة</th>
            <th><i class="fa fa-list"></i> الـخـيارات </th>
        </tr>
    </thead>
    <tbody>
        <?php

if($unrowcont==0){ ?>
        <tr>
            <td></td>
            <td>
                <center>
                    <div class="alert alert-info text-center">لا يـوجد فاتورة مسجل</div>
                </center>
            </td>
            <td></td>
        </tr>

        <?php }


foreach($bills as $bill) {
    $nowwww = $bill['op_tree_name'];
    if($nowwww==0){//لا تعرض فاتورة تحت الطلب لم تكتمل

    }else{
        ?>
        <tr>
        <td><?php echo $bill['op_code_year'] ?></td>
        <td><?php
    $stmt_bills_op_type = $con->prepare("SELECT `type_name` FROM `op_type` WHERE `type_code` = $bill[op_type]");
        $stmt_bills_op_type->execute(array());
        $type_name = $stmt_bills_op_type->fetch();
        echo $type_name['type_name'] ?></td>

<td><?php
    $stmt_bills_tree4_name = $con->prepare("SELECT `tree4_name` FROM `tree4` WHERE `tree4_code` = $bill[op_tree_code]");
        $stmt_bills_tree4_name->execute(array());
        $tree4_name = $stmt_bills_tree4_name->fetch();
        echo $tree4_name['tree4_name'] ?></td>

    <td><?php echo $bill['op_date']." "."@"." ".$bill['op_time'] ?></td>
    <td>
        <a target="_blank" href="order.php?op_code=<?php echo $bill['op_code'] ?>"><button class="btn btn-info"><i class="fa fa-eye"></i></button></a>
        <!-- <a target="_blank" href="order.php?op_type=<?php //echo $bill['op_type']?>&op_code=<?php //echo $bill['op_code']?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a> -->
    <button class="btn btn-danger delete_order"
     data-op_code="<?php echo $bill['op_code'] ?>"
     data-name="<?php echo $type_name['type_name'] ?>"
     >
        
    <i class="fa fa-remove"></i></button>
    </td>
        </tr>
        <?php
    }
}//foresh
?>

    </tbody>
</table>
<?php
}// isset show
elseif (isset($_GET['order']) && $_GET['order']=="add") {
     $un_name = $_GET['un_name']; 

     if($un_name==""){ ?>
<script>
swal.fire({
    position: "top",
    title: "عفواً ... ادخل إسم الفاتورة",
    icon: "error",
    timer: 2500
})
</script>
<?php
     }else{
                //تحقق من عدم وجود الفاتورة من قبلs
    $stmt_un = $con->prepare("SELECT `un_name` FROM `units` WHERE `un_name` = ?");
    $stmt_un->execute(array($un_name));
    $cont_name = $stmt_un->rowCount();

    if ($cont_name>0) {?>
<script>
swal.fire({
    position: "top",
    title: "عفواً ... هذا الفاتورة مسجل من قبل",
    icon: "error",
    timer: 2500
})
</script>
<?php
    }else{
        $stmt_add_un = $con->prepare("INSERT INTO `units` (`un_id`, `un_name`) VALUES (null, '$un_name');");
        $stmt_add_un->execute(); ?>
<script>
swal.fire({
    position: "top",
    title: "تـمت إضافة الفاتورة بـنـجاح",
    icon: "success",
    timer: 2500
})
</script>
<?php
        
    }
     }
 

}//elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")
elseif (isset($_GET['order']) && $_GET['order']=="delete") {
    $op_code = $_GET["un_id"];

    //اولا ننظر هل يوجد دين على المذكور
    $sql_ch_din ="SELECT op_discont, op_discont_out FROM `cash`  WHERE `op_code` = ' $op_code' ";
    $din_info_fun = row_info($sql_ch_din);

    //التاكد من عدم وجدو ديون
    $sum_op_discont =  $din_info_fun['op_discont'];
    $sum_op_discont_out =  $din_info_fun['op_discont_out'];
    if($sum_op_discont>0 || $sum_op_discont_out>0 ){
        ?>
        <script>
    swal.fire({
        position: "top",
        title: "لا يمكن الحذف لوجود ديون مرتبطة بالطلب",
        icon: "error",
        timer: 2500
    })
    </script>
    
    <?php

    }else{
         
        $stmt_delete_sec01 = $con->prepare("DELETE FROM `cash` WHERE `cash`.`op_code` = ' $op_code';");   $stmt_delete_sec01->execute();
        $stmt_delete_sec03 = $con->prepare("DELETE FROM `op_det` WHERE `op_det`.`op_code2` = ' $op_code';");   $stmt_delete_sec03->execute();
        $stmt_delete_sec04 = $con->prepare("DELETE FROM `stock` WHERE `stock`.`op_code` = ' $op_code';");   $stmt_delete_sec04->execute();
        $stmt_delete_sec02 = $con->prepare("DELETE FROM `op` WHERE `op`.`op_code` = ' $op_code';");   $stmt_delete_sec02->execute();

        ?>
    <script>
swal.fire({
    position: "top",
    title: "تم حذف الطلب بنجاح",
    icon: "success",
    timer: 2500
})
</script>

<?php

    }

   
    

 
    }

?>
?>

<script>
$(document).ready(function() {

    function importun(url, div = '', order = '',un_name='') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,un_name:un_name
            },
            success: function (data) {
                $(div).html(data)
            },
            error: function () {
                // var erorr = $("#conecterorr").text();
                alert('<div class="alert alert-warning" role="alert">عذراً .. حدث خطأ في الاتصال </div>');
            }
        });
    } //دالة جلب ملفات الماين ديف 


    function importun(url, div = '', order = '', un_id = '', un_name = '') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,
                un_id: un_id,
                un_name: un_name
            },
            success: function(data) {
                $(div).html(data)
            },
            error: function() {
                // var erorr = $("#conecterorr").text();
                $(div).html(
                    '<div class="alert alert-warning" role="alert">عذراً .. حدث خطأ في الاتصال </div>'
                );
            }
        });
    } //دالة جلب ملفات الماين ديف  
 

    $(".delete_order").on("click", function() {
        var op_code = $(this).data("op_code");
        var name = $(this).data("name");

        swal.fire({
            position: "top",
            icon: "error",
            title: "سيتم حـذف فاتورة" + "<br/><hr/> " + name,
            confirmButtonText: "حـذف",
            cancelButtonText: "رجوع",
            showCancelButton: true,
            preConfirm: () => {
                importun("model/order/06order_reviow.php", ".sw_rusalt", "delete", op_code);
                var cont = 0;
                var set_time = setInterval(() => {
                    cont++;
                    if (cont == 2) {
                        importun("model/order/06order_reviow.php", "#ordertbody", "show");

                        setTimeout(set_time);

                    }

                }, 500);
            }
        })

    });

}); //ready
</script>