<?php
include  "../main/config.php";
include "../main/function.php";
session_start();
error_reporting(0);

if (isset($_GET['order']) && $_GET['order']=="show") {
    $before = mksave($_GET['before']);
    $after = mksave($_GET['after']);
    if ($before=="") {
        $before = date("Y/m/d");
    }
    if ($after=="") {
        $after = date("Y/m/d");
    } ?>


<?php

    $sql_op = "SELECT *,SUM(`cash`.`op_total`),SUM(`cash`.`cash_in`),SUM(`cash`.`cash_out`),SUM(`cash`.`op_discont`),SUM(`cash`.`op_discont_out`) FROM `op` INNER JOIN `cash` WHERE `op`.`op_code` = `cash`.`op_code` AND `op`.`op_date` BETWEEN '$before' AND '$after' GROUP BY `cash`.`op_tree_code_in`,`cash`.`op_tree_code_out`";
    $ops = get_all($sql_op); ?>
<script>
$(document).ready(function() {
    $('#example').DataTable({
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
        "order": [
            [0, "desc"]
        ],
        "paging": false,
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
                $(api.column(j).footer()).html(newtotal);
                j++;
            }
        }
    });
});
</script>
<style>
div#example_wrapper {
    background: white;
    padding: 13px 10px;
    border-radius: 10px;
}
</style>
<br /><br />

<table id="example" class="display text-center" style="width:100%">
    <thead>
        <tr>
            <th>الخزينة</th>
            <th>النوع</th>
            <th>الحساب</th>
            <!-- <th>المبلغ</th> -->
            <th>منه</th>
            <th>له</th>
            <th> آجل له</th>
            <th> آجل عليه</th>
            <!-- <th>المتبقي</th> -->

        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($ops as $op) {
            ?>

        <tr>

   
            <td> <?php
                if ($op['op_type']==1 || $op['op_type']==7  || $op['op_type']==13 || $op['op_type']==8 ||$op['op_type']==3) {
                    echo get_name_by_id("tree4", "tree4_code", $op['op_tree_code_out'], "tree4_name");
                } elseif ($op['op_type']==2 ||$op['op_type']==4 || $op['op_type']==14 ||$op['op_type']== 6) {
                    echo get_name_by_id("tree4", "tree4_code", $op['op_tree_code_in'], "tree4_name");
                }
                 ?> </td>
            <td> <?php
                         //تحديد الجهة هل هي عميل مورد ام ماذا

                        if ($op['op_type']==1 || $op['op_type']==7  || $op['op_type']==13 || $op['op_type']==8 ||$op['op_type']==3) {

                            $tr3code_sql = "SELECT `tree3_code` FROM `tree4` WHERE `tree4_code` = $op[op_tree_code_in] ";
                            $tr3_info = row_info($tr3code_sql);
                            $t3_code = $tr3_info['tree3_code'];
                            echo get_name_by_id("tree3", "tree3_code",$t3_code, "tree3_name");

                        } elseif ($op['op_type']==2 ||$op['op_type']==4 || $op['op_type']==14 ||$op['op_type']== 6) {
                            $tr3code_sql = "SELECT `tree3_code` FROM `tree4` WHERE `tree4_code` = $op[op_tree_code_out] ";
                            $tr3_info = row_info($tr3code_sql);
                            $t3_code = $tr3_info['tree3_code'];
                            echo get_name_by_id("tree3", "tree3_code",$t3_code, "tree3_name");
                        }
                         
                         
                         
            //echo get_name_by_id("tree3","tree4_code",$op['op_tree_code_in'],"tree3_name");?> </td>
            <td> <?php
                        if ($op['op_type']==1 || $op['op_type']==7  || $op['op_type']==13 || $op['op_type']==8 ||$op['op_type']==3) {
                            echo get_name_by_id("tree4", "tree4_code", $op['op_tree_code_in'], "tree4_name");
                        } elseif ($op['op_type']==2 ||$op['op_type']==4 || $op['op_type']==14 ||$op['op_type']== 6) {
                            echo get_name_by_id("tree4", "tree4_code", $op['op_tree_code_out'], "tree4_name");
                        } ?> </td>

            <!-- <td> <?php
                        // if($op['op_type']==13){
                        //     echo 0;//المبلغ 0 حتى لا يدخل الدين القيدم في الحسابات
                        // }else{
                        //     echo $op['SUM(`cash`.`op_total`)'];
                        // }

           //echo get_name_by_id("items","it_id",$op['it_code'],"it_name");?>
            </td> -->
            <td> <?php
        // عندما تكون العملية مشرتيات ندغع له
        if ($op['op_type']==1 || $op['op_type']==7  || $op['op_type']==13 || $op['op_type']==8 ||$op['op_type']==3) {
            echo $op['SUM(`cash`.`cash_in`)'];
        } elseif ($op['op_type']==2 ||$op['op_type']==4 || $op['op_type']==14 ||$op['op_type']== 6) {
            echo $op['SUM(`cash`.`cash_in`)'];
        }
            //echo get_name_by_id("items","it_id",$op['it_code'],"it_name");?> </td>

            <td> <?php
        // عندما تكون العملية بيع ندغع منه
        if ($op['op_type']==1 || $op['op_type']==7  || $op['op_type']==13 || $op['op_type']==8 ||$op['op_type']==3) {
            echo $op['SUM(`cash`.`cash_out`)'];
        } elseif ($op['op_type']==2 ||$op['op_type']==4 || $op['op_type']==14 ||$op['op_type']== 6) {
            echo $op['SUM(`cash`.`cash_out`)'];
        }
            //echo get_name_by_id("items","it_id",$op['it_code'],"it_name");?> </td>
            
            <td> <?php                 echo $op['SUM(`cash`.`op_discont_out`)'];           //echo get_name_by_id("items","it_id",$op['it_code'],"it_name");?>
            <td> <?php                 echo $op['SUM(`cash`.`op_discont`)'];           //echo get_name_by_id("items","it_id",$op['it_code'],"it_name");?>
            </td>
            <!-- <td><?php
                        if ($op['op_type']==1 || $op['op_type']==7  || $op['op_type']==13 || $op['op_type']==8 ||$op['op_type']==3) {
                            // echo $op['it_qty_in'];
                        } elseif ($op['op_type']==2 ||$op['op_type']==4 || $op['op_type']==14 ||$op['op_type']== 6) {
                            // echo $op['it_qty_out'];
                        } ?></td> -->
            <!-- <td> <?php
                if ($op['op_type']==1 || $op['op_type']==7  || $op['op_type']==13 || $op['op_type']==8 ||$op['op_type']==3) {
                    //  echo  $op['op_total']- $op['op_discont'];
                } elseif ($op['op_type']==2 ||$op['op_type']==4 || $op['op_type']==14 ||$op['op_type']== 6) {
                    //  echo $op['SUM(`cash`.`cash_out`)']- $op['op_discont'];
                }
            //echo get_name_by_id("units","un_id",$op['un_code'],"un_name");?> </td> -->


        </tr>
        <?php
        } // forech op?>

    </tbody>
    <tfoot>
        <tr>
            <th>الجملة</th>
            <th style="opacity: 0;">Start date</th>
            <th style="opacity: 0;">Start date</th>
            <th>Salary</th>
            <th>Salary</th>
            <th>Salary</th>
            <th>Salary</th>
            <!-- <th>Salary</th> -->


        </tr>
    </tfoot>
</table>
<?php
}