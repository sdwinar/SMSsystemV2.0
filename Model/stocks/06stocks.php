<?php
include  "../main/config.php";
include "../main/function.php";

if (isset($_GET['order']) && $_GET['order']=="show") {
    $sql_stock = "SELECT *, SUM(it_qty_in), SUM(it_qty_out) FROM `stock` GROUP BY `it_code`,`un_code` LIMIT 20 ";
    $stok_det = get_all ($sql_stock);
    // $unrowcont = $stok_det->rowCount();
?>


<script>
$(function() {
    $(".tablesorter").tablesorter({
        widgets: ["zebra", "filter"]
    });
});
</script>

<table class="tablesorter text-center" dir="rtl">
    <thead>
        <tr>
        <th>
            <!-- <i class="fa fa-id-card"></i> -->
            الـصــف</th>
                <th>الـوحـدة  </th>
                <th> المتوفر </th>
        </tr>
    </thead>
    <tbody>
        <?php

// if($unrowcont==0){ ?>
        <!-- <tr>
            <td></td>
            <td>
                <center>
                    <div class="alert alert-info text-center">لا يـوجد وحـدة مسجل</div>
                </center>
            </td>
            <td></td>
        </tr> -->

        <?php
        // }


foreach($stok_det as $stok){
            //سيلكت او بي
 $sql_op = "SELECT * FROM `op` WHERE `op_code` = '$stok[op_code]' ";
 $po_info = row_info ($sql_op);
        //جلب نوع الفاتورة
              //سيلكت نوع الفاتورة
      $sql_op_type = "SELECT `type_name` FROM `op_type` WHERE `type_code` = '$po_info[op_type]' ";
      $op_type_info = row_info ($sql_op_type);
    //سيلكت  الاصناف
    $sql_op_it = "SELECT * FROM `items` WHERE `it_id` = '$stok[it_code]'  ";
    $it_type_info = row_info ($sql_op_it);
    //سيلكت  الوحدات ['max(tree3_code)']
    $sql_op_un = "SELECT * FROM `units` WHERE `un_id` = '$stok[un_code]' ";
    $un_type_info = row_info ($sql_op_un);
    ?>
    <tr class="text-center">
        <!-- <td><?php // echo $op_type_info['type_name'] ?></td> -->
        <td><?php echo $it_type_info['it_name'] ?></td>
        <td><?php echo $un_type_info['un_name'] ?></td>
        <td><?php echo $stok['SUM(it_qty_in)']- $stok['SUM(it_qty_out)']; ?></td>

    </tr>
        <?php
}
?>

    </tbody>
</table>
<?php
}// isset show

?>
