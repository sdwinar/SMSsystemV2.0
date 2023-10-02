<?php
include  "../main/config.php";
include "../main/function.php";
session_start();
// error_reporting(0); 

if (isset($_GET['order']) && $_GET['order']=="show") {

    $before = mksave($_GET['before']);
    $after = mksave($_GET['after']);
    if($before==""){
        $before = date("Y/m/d");
    }
    if($after==""){
        $after = date("Y/m/d");
    }
    ?>


<?php

    $sql_op = "SELECT * FROM `op` WHERE `op_date` BETWEEN '$before' AND '$after' ";
    $ops = get_all($sql_op);

    ?>
<script>
$(document).ready(function() {
    $('#example').DataTable(
        {
            ".diss": {
            "decimal": ",",
            "thousands": "."
        },
        //     dom: 'Bfrtip',
        // buttons: [
        //     'print'
        // ],
    //     pageLength : 5,
    // lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'الكل']],
            "order": [[ 0, "desc" ]],
			"paging": false,
			"autoWidth": true,
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api();
				nb_cols = api.columns().nodes().length;
				var j = 2;
				while(j < nb_cols){
					var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          var newtotal = new Intl.NumberFormat().format(pageTotal);
          $( api.column( j ).footer() ).html(newtotal);
					j++;
				} 
			}
		}
    );
});
</script>
<style>
    div#example_wrapper {
    background: white;
    padding: 13px 10px;
    border-radius: 10px;
}
</style>
<br/><br/>

<table id="example" class="display text-center" style="width:100%">
    <thead>
        <tr>
            <th>التاريخ</th>
            <th>المستخدم</th>
            <th>العملية</th>
            <th>المنتج</th>
            <th>الوحدة</th>
            <th>العدد</th>
            <th>سعر التكلفة</th>
            <th>سعر البيع</th>
            <th> الخصم</th>
            <th>الربح</th>
        </tr>
    </thead>
    <tbody> 
        <?php 
        foreach ($ops as $op) {
            $op1 = $op['op_code'];
            $sql_order = "SELECT * FROM `op_det` WHERE `op_code2` =  '$op1' ";
            $orders = get_all($sql_order);
            foreach ($orders as $order) {
                ?>

        <tr>
        <td style="width: 95px"><?php echo $op['op_date']." "."@"." ".$op['op_time'] ?></td>
        <td> <?php echo get_name_by_id("users","us_code",$op['op_us_code'],"us_name");   ?> </td>
        <td> <?php echo get_name_by_id("op_type","type_code",$op['op_type'],"type_name");   ?> </td>
        <td> <?php echo get_name_by_id("items","it_id",$order['op_it_code'],"it_name");   ?> </td>
        <td> <?php echo get_name_by_id("units","un_id",$order['op_it_un_code'],"un_name");   ?> </td>
            <td><?php echo $order['op_it_qty'] ; ?></td>
            <td class="diss">           <?php echo $order['op_it_pr_in']* $order['op_it_qty']; ?></td>
            <td>           <?php echo $order['op_it_price']* $order['op_it_qty']; ?></td>
            <td>           <?php echo $order['op_it_pr_khasm'] ?></td>
            <td><?php
            if($op['op_type']==1){
                echo ($order['op_it_price']* $order['op_it_qty'] - $order['op_it_pr_in']* $order['op_it_qty']) + $order['op_it_pr_khasm'];

            }else{
                echo ($order['op_it_price']* $order['op_it_qty'] - $order['op_it_pr_in']* $order['op_it_qty']) - $order['op_it_pr_khasm'];

            }
              ?></td>
        </tr>
        <?php
            } //foresc order
        } // forech op?>

    </tbody>
    <tfoot>
        <tr>
            <th >الجملة</th>
            <th style="opacity: 0;">Position</th>
            <th  style="opacity: 0;">Office</th>
            <th  style="opacity: 0;">Age</th>
            <th  style="opacity: 0;">Start date</th>
            <th>Salary</th>
            <th>Salary</th>
            <th>Salary</th>
            <th>Salary</th>
            <th>Salary</th>
        </tr>
    </tfoot>
</table>
<?php
}