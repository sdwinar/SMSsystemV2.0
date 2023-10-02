<?php
//جلب حسابات شجرة1
$sql_select_tree3 = "SELECT * FROM `tree3`";
$trees3 =  get_all($sql_select_tree3); 
?>
<link rel="stylesheet" href="css/tablesorter/theme.default.min.css"/> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.dark.min.css" integrity="sha512-nc1pKg6wCivxMCLNT7Intf8DfGGN34QbjjU/5hLixwYHzAofenG0KxhbCAZS/oYibU37I/OR/FUgyY+Kd7zE1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="js/jquery-3.4.0.min.js"></script>

<script src="js/tablesorter/jquery.tablesorter.min.js"></script>
<script src="js/tablesorter/jquery.tablesorter.widgets.min.js"></script>
<style>
    table{
        border: 1.8px solid gray ;
    filter: drop-shadow(0px 0px 7px gray);
    box-shadow: 0px 0px 3px 1px beige;
    font-weight: bold !important;
    font-size: 17px !important;
    }
    body,#btn_dd_it{
        font-weight: bold !important;

    }
    .btn{
        cursor: pointer;
    }

</style>

<hr />
<div id="swal_reusalt"></div>
<div class="row row_main main_tree4" style="   width: 100%; position: relative;">
    <div class="col-lg-5 col-md-10 col-sm-8 col-8">
        <h3 class="nav-link"> <i class="fa fa-list"></i> إدارة الـحـســابــات</h3>
    </div>
    <div class="col-lg-4 col-md-1 col-sm-1 col-1 hide_on_sm">
    </div>

    <div class="col-lg-3 col-md-2 col-sm-3 col-3">
    <button id="swal_add_tree4" type="button" class="btn btn-primary mb-3 btn_add">
            <i class="fa fa-plus-square"></i> إضافة حـساب
        </button>
    </div>
</div>
<div id="tree4_table"></div>

<script src="js/accounts/tree4.js"></script>
<script>
        function importfun(url, div = '', order = '',tree4_code='',tree4_name='',tree3_code) { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,tree4_code:tree4_code,tree4_name:tree4_name,tree3_code:tree3_code
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

        $("#swal_add_tree4").on("click",function(e){
        e.preventDefault();
        // var tree3_select = $("#tree3_select").html();
        // var tree4_code = $(".tree4_code_select").val();


 
        
        swal.fire({
            position:"top",
            title:"إضافة حـساب جديد",
            html:
            '<div id="tree3_select" style="display:block">'+
            '<label class="pull-right" for="tree3list"> تحديد الـقـسم:</label>'+
            '<select id="tree3_code_select" class="custom-select tree4_code_select">'+
            
            <?php
                 foreach ($trees3  as $tree3) { ?>
                '<option value="<?php echo $tree3['tree3_code']; ?>"><?php  echo $tree3['tree3_name']; ?></option>'+
                <?php } ?>
            '</select>'+

            '</div>',
            input:"text",
            inputAttributes:{
                placeholder:"ادخل إسم الحساب",
                id:"tree4_name"
            },
            confirmButtonText:"حــفظ",
            cancelButtonText:"رجوع",
            showCancelButton:true,
            preConfirm: (tree3_code,tree4_name) =>{

             var tree3_code = $("#tree3_code_select").val();
             var tree4_name = $("#tree4_name").val();
             importfun("model/accounts/tree4.php", "#swal_reusalt", "add","",`${tree4_name}`, `${tree3_code}` );
             var cont =0;
             var settime = setInterval(() => {
                 cont++;
                 if(cont==2)
                 importfun("model/accounts/tree4.php", "#tree4_table", "show" );
                    setTimeout(settime);
                 
             }, 500);

            }
            
        })
    });
</script>
