<?php
session_start();
// error_reporting(0); 
include  "../main/config.php";
include "../main/function.php";
?>


<?php
if (isset($_GET['op_type']) && $_GET['order']=="show_sec_it") {
     $sql_it = $_GET['sql_it'];
    $sec_id = $_GET['sec_id'];
    $op_type = $_GET['op_type'];



    $sql_sects= "SELECT * FROM `items` $sql_it ORDER by `it_pr_out` LIMIT 20";
    $items =  get_all($sql_sects);

    if(row_count($sql_sects)==0){
        $sec_name =  get_name_by_id("section","sec_id",$sec_id,"sec_name");
        ?>
        <div style="color: black;    font-weight: bold;    font-size: 19px;"
         class="alert alert-info text-center col-lg-12 col-md-12 col-sm-12 col-12 ">
               لا يـوجد صنف في قسم <?php echo    $sec_name ?></div>

<?php
    }else{
        foreach ($items as $it) {?>

   
    <div class="col-lg-4 col-md-6 col-sm-6 col-6 ">
    <img class="sec_it_img" src="img/items/<?php echo $it['it_img']==""? "noimg.png":$it['it_img'] ?>" alt="it_img"
    data-op_it_code="<?php echo $it['it_id'] ?>"
    >
    <h5 class="order_it_name"><?php echo $it['it_name'] ?></h5>
    <h5 class="order_it_pr_out">
        <!-- //اظهار سعر الشراء لفاتورة المشتريات والبيع للمبيعات -->
        <?php

        if($_GET['op_type']==1 || $_GET['op_type']== 3){
           echo  number_format($it['it_pr_in'], 2, '.', ',')." "."ج"; 
        }else{
            echo  number_format($it['it_pr_out'], 2, '.', ',')." "."ج"; 
        }
        ?>
    </h5>
    </div>
  <?php
     }
    }
     
}elseif (isset($_GET['order']) && $_GET['order']=="show_custmer") {

    //سليكت العملاء
$stmtcustomer = $con->prepare("SELECT * FROM `tree4` WHERE `tree3_code` in ( 1203,2101) ORDER BY `tree3_code` DESC");
$stmtcustomer->execute(array());
$customers = $stmtcustomer->fetchAll();
?>
<select data-live-search="true" name="customer" id="costumer_name" 
class="custom-select selectpicker costumer_name_select_bill">
    <?php
     foreach ($customers as $customer) {  ?>
    <option value="<?php echo $customer['tree4_code']?>"><?php echo $customer['tree4_name']?>
    </option>
    <?php   } ?>
</select>
<?php
}//(isset($_GET['order']) && $_GET['order']=="show")(isset($_GET['order']) && $_GET['order']=="show")
?>
<script>
$(document).ready(function () {
            // *******************************************************************inser order************************************
    function isertorder(opration='',url, div = '', order = '', op_it_code='',op_code='') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,op_it_code:op_it_code,op_code:op_code,opration:opration
            },
            // beforeSend: function() {
            //     $(div).html(
            //         "<center><img src='../../assets/img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>"
            //     )

            // },
            success: function (data) {
                $(div).html(data)
            },
            error: function () {
                // var erorr = $("#conecterorr").text();
                $(div).html('<div class="alert alert-warning" role="alert">عذراً .. حدث خطأ في الاتصال </div>');
            }
        });
    } //دالة جلب ملفات الماين ديف 

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

    $(".sec_it_img").on("click", function () {
        var op_it_code = $(this).data("op_it_code");
        var op_code = $("#op_code").val();
       isertorder("insert","model/order/03inser_order.php", ".order_this", "insert_order",op_it_code,op_code);

       var cont = 0;
        var readdorder = setInterval(function() {//إعادة استدعاء الدالة لان المتصفح متخلف
            cont++;
            if (cont == 1) {
                ordercalc("model/order/04order_calc.php", "#order_calc_div", "show_calc",op_code);// 
                   setTimeout(readdorder);
            } 

        }, 500);

    });

    });//ready
</script>