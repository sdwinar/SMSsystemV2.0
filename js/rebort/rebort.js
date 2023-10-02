
$(document).ready(function () {

    function importfun(url, div = '', order = '', before = '', after = '') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order, before: before, after: after
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
    $("#main_rebor").show(function () {
        var before = $("#before").val();
        var after = $("#after").val();


        importfun("model/rebort/01oredr.php", "#tbrebort", "show", before, after);
    });
    $("#before").change(function () {
        var before = $("#before").val();
        var after = $("#after").val();


        importfun("model/rebort/01oredr.php", "#tbrebort", "show", before, after);
    });
    $("#after").change(function () {
        var before = $("#before").val();
        var after = $("#after").val();


        importfun("model/rebort/01oredr.php", "#tbrebort", "show", before, after);
    });

    // **************************************************************************************الارباح


    $("#main_rebor_arba7").show(function () {
        var before = $("#before").val();
        var after = $("#after").val();


        importfun("model/rebort/02arba7.php", "#tbrebort", "show", before, after);
    });
    $("#before_arba7").change(function () {
        var before = $("#before_arba7").val();
        var after = $("#after_arba7").val();
        
        importfun("model/rebort/02arba7.php", "#tbrebort", "show", before, after);
        });
        $("#after_arba7").change(function () {
        var before = $("#before_arba7").val();
        var after = $("#after_arba7").val();
        
        importfun("model/rebort/02arba7.php", "#tbrebort", "show", before, after);
        });
    // **************************************************************************************المخزن
    $("#main_rebor_makzan").show(function () {
        var before = $("#before_makzan").val();
        var after = $("#after_makzan").val();


        importfun("model/rebort/03makzan.php", "#tbrebort", "show", before, after);
    });
    $("#before_makzan").change(function () {
        var before = $("#before_makzan").val();
        var after = $("#after_makzan").val();
        
        importfun("model/rebort/03makzan.php", "#tbrebort", "show", before, after);
        });
        $("#after_makzan").change(function () {
        var before = $("#before_makzan").val();
        var after = $("#after_makzan").val();
        
        importfun("model/rebort/03makzan.php", "#tbrebort", "show", before, after);
        });
        // **************************************************************************************grd7sab
    $("#main_rebor_grd7sab").show(function () {
        var before = $("#before_grd7sab").val();
        var after = $("#after_grd7sab").val();


        importfun("model/rebort/04grd7sab.php", "#tbrebort", "show", before, after);
    });
    $("#before_grd7sab").change(function () {
        var before = $("#before_grd7sab").val();
        var after = $("#after_grd7sab").val();
        
        importfun("model/rebort/04grd7sab.php", "#tbrebort", "show", before, after);
        });
        $("#after_grd7sab").change(function () {
        var before = $("#before_grd7sab").val();
        var after = $("#after_grd7sab").val();
        
        importfun("model/rebort/04grd7sab.php", "#tbrebort", "show", before, after);
        });
        // **************************************************************************************all
    $("#main_rebor_all").show(function () {
        var before = $("#before_all").val();
        var after = $("#after_all").val();


        importfun("model/rebort/all.php", "#tbrebort", "show", before, after);
    });
    $("#before_all").change(function () {
        var before = $("#before_all").val();
        var after = $("#after_all").val();
        
        importfun("model/rebort/all.php", "#tbrebort", "show", before, after);
        });
        $("#after_all").change(function () {
        var before = $("#before_all").val();
        var after = $("#after_all").val();
        
        importfun("model/rebort/all.php", "#tbrebort", "show", before, after);
        });

        // **************************************************************************************khazna
    $("#main_rebor_khazna").show(function () {
        var before = $("#before_khazna").val();
        var after = $("#after_khazna").val();


        importfun("model/rebort/05khazna.php", "#tbrebort", "show", before, after);
    });
    $("#before_khazna").change(function () {
        var before = $("#before_khazna").val();
        var after = $("#after_khazna").val();
        
        importfun("model/rebort/05khazna.php", "#tbrebort", "show", before, after);
        });
        $("#after_khazna").change(function () {
        var before = $("#before_khazna").val();
        var after = $("#after_khazna").val();
        
        importfun("model/rebort/05khazna.php", "#tbrebort", "show", before, after);
        });

    $("#print_this").on("click", function () {

        $("body").css({ 'padding': '30px 50px' });
        $("label").css({ 'display': 'none' });
        $("#div_input1").css({ 'position': 'relative', 'right': '48px', 'top': '-40px' });
        $("#lbl_to").css({ 'position': 'relative', 'right': '209px', 'top': '-81px' });
        $("#after").css({ 'position': 'relative', 'right': '244px', 'top': '-124px' });
        $("#this_tb").css({ 'position': 'relative', 'top': '-154px' });
        $("td").css({ 'border-left': '1px solid', 'text-align': 'center' });
        var print = $("#print_div").html();
        $("body").html(print);

        window.print();
        location.reload();


    });


});//ready