
$(document).ready(function () {

    function importfun(url, div = '', order = '', op_type = '', op_note = '', cash = '', ksna_bank = '', other = '',op_code='') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order, op_type: op_type, op_note: op_note, cash: cash, ksna_bank: ksna_bank, other: other,op_code:op_code
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
    } //دالة جلب ملفات الماين ديف  other
    $("#irad_sub").show(function () {
        var op_type = $("#op_type").val();
        importfun("model/accounts/03irad.php", "#iradtbody", "show", op_type);
    });

    $("#irad_sub").on("click", function () {//بحث عن تغيير سيلكت  المخزن
        var op_type = $("#op_type").val();
        var op_note = $("#op_note").val();
        var cash = $("#cash").val();
        var ksna_bank = $("#ksna_bank").val();
        var other = $("#other").val();

        // alert(op_type)

        if (cash < 1) {
            swal.fire({
                position: "top",
                title: "خطأ في المبلغ",
                icon: "error",
                timer: 1000
            });

        } else if (ksna_bank === other) {
            swal.fire({
                position: "top",
                title: "لا يمكن السحب لنفس الحساب",
                icon: "error",
                timer: 1500
            });
        } else {
            importfun("model/accounts/03irad.php", "#iradtbody", "insert", op_type, op_note, cash, ksna_bank, other);
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

    });
    $("#print_this").on("click",function(){
        var print = $("#iradtbody").html();
        $("body").html(print);
     window.print();
     window.reload();
    })
// ******************************تعديل المعاملات
$("#edit_irad").on("click",function(){
    var op_code = $("#finaly_po_code").val();
    var op_type = $("#finaly_op_type").val();
    var op_note = $("#edit_op_note").val();
    var cash = $("#edit_cash").val();
    var ksna_bank = $("#edit_ksna_bank").val();
    var other = $("#edit_other").val();

    if (cash < 1) {
        swal.fire({
            position: "top",
            title: "خطأ في المبلغ",
            icon: "error",
            timer: 1000
        });

    } else if (ksna_bank === other) {
        swal.fire({
            position: "top",
            title: "لا يمكن السحب لنفس الحساب",
            icon: "error",
            timer: 1500
        });
    } else {
        importfun("model/accounts/04edit_irad.php", "#iradrusalt", "edit", op_type, op_note, cash, ksna_bank, other,op_code);
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

});
    //    $("#cash").on("keyup",function(){
    //        var val = $(this).val();
    //        var newtotal = new Intl.NumberFormat().format(val);
    //        $("#op_note").val(newtotal);
    //    })

});//ready