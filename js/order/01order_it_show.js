$(document).ready(function () {


    



    function importfun(url, div = '', order = '', sql_it = '', sec_id = '', op_type = '') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order, sql_it: sql_it, sec_id: sec_id, op_type: op_type
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
        //السماح باسكرول ديف المنتجات
        $(".order_row_one").show(function () {
            var op_type = $("#op_type").val();
            importfun("model/order/01order_show.php", "#order_it_row", "show_sec_it", "", "",op_type);
            $(".order_main_it_div").css({ 'z-index': '2' });
        });
        $(".order_row_one").on("click", function () {
            $(".order_main_it_div").css({ 'z-index': '2' });
        });
        //ارجعاك ظهور عناصر النافبار
        $(".nav-link").on("click", function () {
            $(".order_main_it_div").css({ 'z-index': '1' });
        });

    $(".sec-badge").on("click", function () {
        var op_type = $("#op_type").val();
        $("#prder_serch_it").val("");
        $(this).addClass("sec_active").siblings().removeClass("sec_active");
        var sec_id = $(this).data("sec_id");
        var sql_it = "WHERE `it_section` =" + sec_id;

        importfun("model/order/01order_show.php", "#order_it_row", "show_sec_it", sql_it, sec_id,op_type);

    });
    $("#prder_serch_it").on("keyup", function () {
        var op_type = $("#op_type").val();
        $(".sec-badge").removeClass("sec_active");
        var it = $(this).val();
        var sql_it = "WHERE  (`it_name`  LIKE '%" + it + "%' || `it_barcode`  LIKE '%" + it + "%')   ";
        importfun("model/order/01order_show.php", "#order_it_row", "show_sec_it", sql_it,"",op_type);
    });

    //inser first time
    $(".order_row_one").show(function () {
        var op_type = $("#op_type").val();
        importfun("model/order/02inser_first_time.php", ".order_nimber", "insert", "", "", op_type);
    });

           // ************************************************************تأكيد الطلبية********************************
           function setcach(url, div = '', order = '',op_code='',op_tree_code='',cash_out='',op_tree_code_user ='',op_tree_name='',op_st_code='',op_total='',op_added='',op_discont='',op_safi='',pay_select='',op_type=''){ //دالة جلب ملفات الماين ديف 
            $.ajax({
                method: "GET",
                url: url,
                data: {
                    order: order,op_code:op_code,op_tree_code:op_tree_code,cash_out:cash_out,op_tree_code_user:op_tree_code_user,op_tree_name:op_tree_name,op_st_code:op_st_code,op_total:op_total,op_added:op_added,op_discont:op_discont,op_safi:op_safi,pay_select:pay_select,op_type:op_type
                    //        },
                    // // beforeSend: function() {
                    // //     $(div).html(
                    // //         "<center><img src='../../img/main/lod.gif' width='140px' class='cpwaiteimg' /></center>"
                    // //     )
    
                },
                success: function (data) {
                    $(div).html(data);
    
                },
                error: function (e) {
                    // var erorr = $("#conecterorr").text(); submit_new_un  id="" 
                    alert("خطاء في الاتصال")
                }
            });
        } //دالة جلب ملفات الماين ديف 

    $("#order_submit").on("click",function(){
        

        var op_code =$("#op_code").val();
        var op_tree_code =$("#finaly_op_tree_code").val();//cash
        var cash_out = $("#finaly_safi_sum_from_order_calc").val();//safi

        var pay_select =$("#pay_select").find(":selected").text();
        var op_total = $("#finaly_total_sum_from_order_calc").val();
        var op_added =0;
        var op_discont =$("#khasm").val();
        var op_safi =$("#finaly_safi_sum_from_order_calc").val();//safi

        var chek_set_cash =$("#chek_set_cash").val();
              //تعديل اسم العميل والمخزن
       var custmer_code = $("#costumer_name").val();
       var custmer_name = $("#costumer_name").find(":selected").text();
       var stok = $("#stock").val();
       var op_type = $("#op_type").val();
    //    alert(op_total)

        if(chek_set_cash =='full'){
            if(op_total==="" || op_total=== null || op_total === undefined || op_total === NaN || op_total=="" || op_total== null || op_total == undefined || op_total == NaN){

                swal.fire({
                    position: "top",
                    title: "عفوا جملة الطلبية غير صحيحة",
                    icon: "error",
                    timer: 1000
                })
           
            }else{
              $(this).hide();//حتى لا يتم الادخال اكثر من مرة
 setcach("model/order/05order_set_cash.php", "#swal_reusalt", "edit_op",op_code,"","",custmer_code,custmer_code,stok);//تعديل المخزن واسم ورقم العميل 
setcach("model/order/05order_set_cash.php", "#swal_reusalt", "set_cash",op_code,op_tree_code,cash_out,custmer_code,"",stok,op_total,op_added,op_discont,op_safi,pay_select,op_type);// 
            }

        }
    
    });


});//reday
