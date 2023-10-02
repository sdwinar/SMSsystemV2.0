$(document).ready(function(){

    //decimal_number
    $(".decimal_number").inputSpinner();
    // $(".input-group-prepend").hide();
    // $(".input-group-append").hide();

    $(".decimal_number").on("keyup",function(){
        // inputSpinner();
      
    });

    function importit(url, div = '', order = '', it_barcode='' , it_name='', it_section='', it_min_un='', it_pr_in='', it_pr_out='', it_min_qty='',it_id ='')
    { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order , 
                it_barcode:it_barcode ,
                 it_name:it_name ,
                  it_section:it_section ,
                   it_min_un:it_min_un , 
                   it_pr_in:it_pr_in , 
                   it_pr_out , 
                   it_min_qty:it_min_qty,
                   it_id:it_id
            },
            success: function (data) {
                $(div).html(data)
            },
            error: function () {
                // var erorr = $("#conecterorr").text();
                swal.fire({
                    position: "top",
                    title: "عذراً .. حدث خطأ في الاتصال",
                    icon: "error",
                    timer: 2500
                });
            }
        });
    } //دالة جلب ملفات الماين ديف 

    $(".row_main").show(function(){
        importit("model/stocks/03items.php", "#ittbody", "show");
    });
    $("#btn_add_it").on("click",function(e){ 
        e.preventDefault();
        var it_barcode = $("#it_barcode").val();
        var it_name = $("#it_name").val();
        var it_pr_in = $("#it_pr_in").val();
        var it_pr_out = $("#it_pr_out").val();
        var it_min_qty = $("#it_min_qty").val();

        var it_min_un =$("#it_min_un").val();
        var it_section =$("#it_section").val();


        

        if(it_name==""){
            swal.fire({
                position: "top",
                title: "عفواً .. بعض الحقول فارغة",
                icon: "error",
                timer: 2500
            });
        }else{//,it_barcode , it_name , it_section , it_min_un , it_pr_in , it_pr_out , it_min_qty
           importit("model/stocks/03items.php", "#ittbody","add",it_barcode , it_name , it_section , it_min_un, it_pr_in , it_pr_out , it_min_qty);
            var cont = 0;
            var set_time = setInterval(() => {
                cont++;
                if (cont == 2) {
               importit("model/stocks/03items.php", "#ittbody", "show");
                 $("#it_barcode").val("");
                 $("#it_name").val("");
                $("#it_pr_in").val("");
                $("#it_pr_out").val("");
                $("#it_min_qty").val("");
                    setTimeout(set_time);
                }
            }, 500);
        }

    });
    //edit it
    $("#btn_edit_it").on("click",function(e){
        e.preventDefault();
        var edit_it_id = $("#finaly_it_id").val();
        var edit_it_barcode = $("#edit_it_barcode").val();
        var edit_it_name = $("#edit_it_name").val();
        var edit_it_section =$("#edit_it_section").find(":selected").val();
        var edit_it_min_un =$("#edit_it_min_un").find(":selected").val();
        var edit_it_pr_in = $("#edit_it_pr_in").val();
        var edit_it_pr_out = $("#edit_it_pr_out").val();
        var edit_it_min_qty = $("#edit_it_min_qty").val();

        if(edit_it_name==""){
            swal.fire({
                position: "top",
                title: "عفواً .. بعض الحقول فارغة",
                icon: "error",
                timer: 2500
            });
        }else{//,edit_it_barcode , edit_it_name , edit_it_section , edit_it_min_un , edit_it_pr_in , edit_it_pr_out , edit_it_min_qty
          importit("model/stocks/03items.php", "#ittbody","edit",edit_it_barcode , edit_it_name , edit_it_section , edit_it_min_un, edit_it_pr_in , edit_it_pr_out , edit_it_min_qty,edit_it_id);
            var cont = 0;
            var set_time = setInterval(() => {
                cont++;
                if (cont == 2) {
                  importit("model/stocks/03items.php", "#ittbody", "show");
                //  $("#edit_it_barcode").val("");
                //  $("#edit_it_name").val("");
                // $("#edit_it_pr_in").val("");
                // $("#edit_it_pr_out").val("");
                // $("#edit_it_min_qty").val("");
                    setTimeout(set_time);
                }
            }, 500);
        }

    });

});//ready