<?php
//سليكت المخازن
$stmtstock = $con->prepare("SELECT * FROM `tree4` WHERE `tree3_code` = 1206 ");
$stmtstock->execute(array());
$stocks = $stmtstock->fetchAll();
//سليكت الخزنة
$stmt_safes = $con->prepare("SELECT * FROM `tree4`  WHERE `tree3_code` = 1201");
$stmt_safes->execute(array());
$safes = $stmt_safes->fetchAll();
//سليكت البنوك
$stmt_bank = $con->prepare("SELECT * FROM `tree4`  WHERE `tree3_code` = 1202");
$stmt_bank->execute(array());
$banks = $stmt_bank->fetchAll();

$sql_sects= "SELECT * FROM `section` ORDER by `sec_name`";
$sections =  get_all($sql_sects); 

$sql_sects= "SELECT * FROM `items` ORDER by `it_pr_out` ";
$items =  get_all($sql_sects); 


//جلب حسابات شجرة1
$sql_select_tree3 = "SELECT * FROM `tree3` WHERE `tree3_code` in ( 1203,2101)";
$trees3 =  get_all($sql_select_tree3); 


?>
<link rel="stylesheet" href="css/order/order.css">
<div id="swal_reusalt">

</div>
<input type="hidden" id="finaly_op_tree_code" value="">
<input type="hidden" id="finaly_total_sum_from_order_calc" value="">
<input type="hidden" id="finaly_safi_sum_from_order_calc" value="">
<!-- ######################################################### -->
<div class="row order_row_one" style="top: 5px;    position: relative;">
    <!-- ***********************************************************************************sec_start***** -->
    <div class="col-lg-1 col-md-4 col-sm-4 col-4 " style="  z-index: 1;   
     /* width: 100% !important;    max-width: 100% !important;  */
     width: 171px !important;    max-width: 203px !important;    margin-left: -36px;
     ">
        <div class="card text-center sec_cadrd">
            <div class="card-title sec_title"><i class="fa fa-list"></i> الاقسام</div>
            <br />
            <div class="card-body sec_card_body">
                <div class="row">
                    <?php
                    foreach($sections as $sec){?>
                    <span class="col-12 badge badge-info sec-badge"
                        data-sec_id="<?php echo $sec['sec_id']  ?>"><?php echo $sec['sec_name']  ?></span>
                    <?php  }                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- ***********************************************************************************sec_end**** -->

    <!-- ***********************************************************************************it_start***** -->
    <div class="col-lg-4 col-md-5 col-sm-8 col-8 order_main_it_div" style="  z-index: 1;
    margin-left: 0px;    margin-right: 5px;     padding: 0px 19px;
    ">
        <div class="card text-center sec_cadrd" style="    overflow-x: hidden;">
            <div class="card-title sec_title">
                <input autofocus type="text" name="" id="prder_serch_it" placeholder="بـحــــث عـن مـنـتـج">
            </div>
            <div class="card-body sec_card_body" style="    padding-top: 21px!important;">
                <div class="row" id="order_it_row" style="    padding-left: 15px;">

                </div>
            </div>
        </div>
    </div>
    <!-- ***********************************************************************************it_end**** -->

    <!-- ***********************************************************************************order_start***** -->
    <div class="col-lg-7 col-md-5 col-sm-12 col-12 " style="  z-index: 1;
     /* width: 56% !important;    max-width: 53% !important; */
     margin-left: 0px;    margin-right: -32px;
      ">
        <div class="card text-center sec_cadrd">
            <div class="card-title sec_title order_nimber">

            </div>
            <div class="card-body sec_card_body">

                <div class="row">
                    <span class="col-3 badge badge-info sec-badge_order">الطلب</span>
                    <span class="col-2 badge badge-info sec-badge_order">الوحدة</span>
                    <span class="col-2 badge badge-info sec-badge_order">السعر</span>
                    <span class="col-1 badge badge-info sec-badge_order">العدد</span>
                    <span class="col-1 badge badge-info sec-badge_order">الخصم</span>
                    <span class="col-2 badge badge-info sec-badge_order">التكلفة</span>
                    <span class="col-1 badge badge-info sec-badge_order">خيارات</span>
                </div>
                <br />
                <div class="order_this">

                </div>

            </div>
        </div>
    </div>
    <!-- ***********************************************************************************order_end**** -->

</div>
<!-- ######################################################### -->
<div class="row secnd_order_row" style="padding: 0px 14px;">
    <div class="col-12" style="border: 2px solid wheat;    margin-top: 18px;    height: 97px;border-radius: 1.2%;
    box-shadow: 2px 3px 5px blue;">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 calc_row row">
                <div class="form-group col-3" id="custmer_show">
                </div>
                <div class="form-group col-1">
                    <button title="إضافة عميل جديد" type="button" id="add-customer"
                        class="btn btn-success pull-right mt-2"><i class="fa fa-user-plus"></i></button>
                </div>
                <select name="stock" id="stock" class="custom-select stock_select_in_fatora" style="display:none;">
                            <?php 
                        foreach ($stocks as $stock){
                            ?>
                            <option value="<?php echo $stock['tree4_code']?>"><?php echo $stock['tree4_name']?></option>
                            <?php } ?>
                        </select>
                <div class="col-3">
                    <select name="stock" id="pay_select" class="custom-select">
                        <option value="safe_div"> دفع نقداً</option>
                        <option value="bank_div"> دفع بـنكي</option>
                    </select>
                </div>
                <div class="col-5 safe_div" id="safe_div" style="display:block">
                    <select name="stock" id="safe" class="custom-select">
                        <?php 
                        foreach ($safes as $safe){
                            ?>
                        <option value="<?php echo $safe['tree4_code']?>"><?php echo $safe['tree4_name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-5 bank_div" id="bank_div" style="display:none">
                    <select name="stock" id="bank" class="custom-select">
                        <?php 
                        foreach ($banks as $bank){
                            ?>
                        <option value="<?php echo $bank['tree4_code']?>"><?php echo $bank['tree4_name']?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-12 calc_row row" id="order_calc_div"
            style="padding-bottom:8px;    padding-top: 8px;">
                <span class="badge badge-primary col-1"
                style="background: #5a0011;    font-weight: bold;    font-size: 16px;    box-shadow: 0px 0px 3px;"
                >الجملة</span>
                &nbsp
                <span class="badge badge-dark col-3"
                style="background: #5a0011;    font-weight: bold;    font-size: 16px;    box-shadow: 0px 0px 3px;"
                >0</span>
                &nbsp                
                <span class="badge badge-dark col-1" 
                style="background: #5a0011;    font-weight: bold;    font-size: 16px;    box-shadow: 0px 0px 3px;"
                >آجـل</span>
                &nbsp
                <input class="col-2" min="0" type="number" name="" value="0"
                style="background: #5a0011;    font-weight: bold;    font-size: 16px;    box-shadow: 0px 0px 3px;"
                >
                &nbsp               
                <span class="badge badge-dark col-1"
                style="background: #5a0011;    font-weight: bold;    font-size: 16px;    box-shadow: 0px 0px 3px; padding: 4.5px 0px 0px 0px;"
                >الصافي</span>
                &nbsp
                <span class="badge badge-dark col-3"
                style="background: #5a0011;    font-weight: bold;    font-size: 16px;    box-shadow: 0px 0px 3px;"
                >0</span>
                <input class="form-control form-control-sm table-input" type="hidden" value="null" min="0" id="chek_set_cash" readonly />

            </div>
            <div class="col-3"></div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 calc_row ">
                <button class="btn btn-success col-12 set_cash" id="order_submit"
                style="padding: 1px 0px; margin-top: -5px;     background: black;" >
                            <i class="fa fa-save"></i> تـأكيد الطـلــب
                </button>

            </div>
 

        </div>
    </div>
</div>
<!-- ######################################################### -->
<script src="js/jquery-3.4.0.min.js"></script>


<script>
//طريقة الدفع نقدا بنكي
$("#pay_select").on("change", function() {
    var val = $(this).val();

    if (val == "bank_div") {

        $("#finaly_op_tree_code").val($("#bank").val()); //إرسال قيمة تري4 للانبت النهائي
        $("#safe_div").fadeOut(function() {
            $("#bank_div").fadeIn();
        });
    } else if (val == "safe_div") {
        $("#finaly_op_tree_code").val($("#safe").val()); //إرسال قيمة تري4 للانبت النهائي
        $("#bank_div").fadeOut(function() {
            $("#safe_div").fadeIn();
        });
    } else {
        $("#bank_div").fadeOut(function() {
            $("#safe_div").fadeOut();
        });
    }
});
//تجديد قيمة op_tree_vode
$("#safe").show(function() { //عند تغيير الخزنة
    var val = $(this).val();
    $("#finaly_op_tree_code").val(val);

});
$("#safe").on("change", function() { //عند تغيير الخزنة
    var val = $(this).val();
    $("#finaly_op_tree_code").val(val);

});
$("#bank").on("change", function() { //عند تغيير البنك
    var val = $(this).val();
    $("#finaly_op_tree_code").val(val);

});

function importfun(url, div = '', order = '', custmer_add_type = '', custmer_add_name =
    '') { //دالة جلب البيانات  
    $.ajax({
        method: "GET",
        url: url,
        data: {
            order: order,
            custmer_add_type: custmer_add_type,
            custmer_add_name: custmer_add_name
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
            $(div).html(
                '<div class="alert alert-warning" role="alert">عذراً .. حدث خطأ في الاتصال </div>'
            );
        }
    });
} //دالة جلب ملفات الماين ديف 

//first_time_***********************************************************************************************
$("#custmer_show").show(function() {
    // alert("lll");
    importfun("model/order/01order_show.php", "#custmer_show", "show_custmer");
});

function importfun2(url, div = '', order = '', tree4_code = '', tree4_name = '', tree3_code) { //دالة جلب البيانات  
    $.ajax({
        method: "GET",
        url: url,
        data: {
            order: order,
            tree4_code: tree4_code,
            tree4_name: tree4_name,
            tree3_code: tree3_code
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
} //دالة جلب ملفات الماين ديف 

$("#add-customer").on("click", function(e) {
    e.preventDefault();
    // var tree3_select = $("#tree3_select").html();
    // var tree4_code = $(".tree4_code_select").val();




    swal.fire({
        position: "top",
        title: "إضافة حـساب جديد",
        html: '<div id="tree3_select" style="display:block">' +
            '<label class="pull-right" for="tree3list"> تحديد الـقـسم:</label>' +
            '<select id="tree3_code_select" class="custom-select tree4_code_select">' +

            <?php
                 foreach ($trees3  as $tree3) { ?> '<option value="<?php echo $tree3['tree3_code']; ?>"><?php  echo $tree3['tree3_name']; ?></option>' +
            <?php } ?> '</select>' +

            '</div>',
        input: "text",
        inputAttributes: {
            placeholder: "ادخل إسم الحساب",
            id: "tree4_name"
        },
        confirmButtonText: "حــفظ",
        cancelButtonText: "رجوع",
        showCancelButton: true,
        preConfirm: (tree3_code, tree4_name) => {

            var tree3_code = $("#tree3_code_select").val();
            var tree4_name = $("#tree4_name").val();
            importfun2("model/accounts/tree4.php", "#swal_reusalt", "add", "", `${tree4_name}`,
                `${tree3_code}`);
            var cont = 0;
            var settime = setInterval(() => {
                cont++;
                if (cont == 2)
                    importfun("model/order/01order_show.php", "#custmer_show",
                        "show_custmer");
                setTimeout(settime);

            }, 500);

        }

    })
});
</script>
<?php
if(isset($_GET['op_code'])){
    $this_op_code = $_GET['op_code'];
?>
<input type="hidden" id="this_op_code" value="<?php echo  $this_op_code ?>">
<script>
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

    $("#this_op_code").show( function () {
        // var op_it_code = $(this).data("op_it_code");
        var op_code = $("#this_op_code").val();
       isertorder("edit_old_order","model/order/03inser_order.php", ".order_this", "insert_order","",op_code);

       var cont = 0;
        var readdorder = setInterval(function() {//إعادة استدعاء الدالة لان المتصفح متخلف
            cont++;
            if (cont == 1) {
                ordercalc("model/order/04order_calc.php", "#order_calc_div", "show_calc",op_code);// 
                   setTimeout(readdorder);
            } 

        }, 500);

    });
</script>
<?php
}
?>