$(document).ready(function () {

    function importfun(url, div = '', order = '', it_id = '', un_id = '', un_pr_in = '', un_pr_out = '', un_eq = '') { //دالة جلب البيانات  
       var xrl = $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order, it_id: it_id, un_id: un_id, un_pr_in: un_pr_in, un_pr_out: un_pr_out, un_eq: un_eq
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

    $(".main_add_it_un").show(function () {
        var it_id = $("#finaly_it_id").val();

        importfun("model/stocks/04add_units.php", "#it_un_table", "show", it_id);

    });

    $("#add_its_uns").on("click", function (e) {
        e.preventDefault();
        var it_id = $("#finaly_it_id").val();
        var un_id = $("#un_id").val();
        var un_pr_in = $("#un_pr_in").val();
        var un_pr_out = $("#un_pr_out").val();
        var un_eq = $("#un_eq").val();
        if(un_pr_in == ""||un_pr_in == ""||un_eq == ""){
            swal.fire({
                position: "top",
                title: "عفواً .. بعض الحقول فارغة",
                icon: "error",
                timer: 2500
            });
        }else{
        importfun("model/stocks/04add_units.php", ".dgdds", "add", it_id, un_id, un_pr_in, un_pr_out, un_eq);
        var cont = 0;
        var time = setInterval(function () {
            cont++;
            if (cont == 2) {
                importfun("model/stocks/04add_units.php", "#it_un_table", "show", it_id);
                //    hide the Modal
                 $("#un_pr_in").val("");
               $("#un_pr_out").val("");
               $("#un_eq").val("");
               xhr.abort();
                setTimeout(time);
            }
        }, 500);
    }

    });




    // $("#submit_add_un").on("click",function(e){
    //     e.preventDefault();
    //     var un_name = $("#un_name").val();
    //     importfun("../../model/inventory/units", "#add_un_reuselt", "add","",un_name );
    //     importfun("../../model/inventory/units", "#un_table", "show" );
    //    var cont = 0;
    //     var time = setInterval(function(){
    //        cont++;
    //        if(cont==2){
    //         //    hide the Modal
    //         $('#add_un_reuselt').text('');
    //         $("#un_name").val("");
    //         setTimeout(time);
    //        }
    //     },1000);

    // });

});//$(document).ready(function()