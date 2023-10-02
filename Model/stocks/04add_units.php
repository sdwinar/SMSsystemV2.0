<?php
include  "../main/config.php";
include "../main/function.php";
?>


<?php
if (isset($_GET['order']) && $_GET['order']=="show") {
    $it_id = $_GET["it_id"];
    $sql= "SELECT * FROM `items_units` WHERE `it_id` = '$it_id' ";
    $items_units =  get_all($sql); ?>
<?php foreach ($items_units as $it_un) { ?>
?>
<tr class="text-center">
    <td>
        <?php
              echo  $un_name = get_name_by_id("units","un_id",$it_un['un_id'],"un_name");
                ?>
    </td>
    <td><?php echo $it_un['un_eq'] ?></td>
    <td><?php echo  number_format($it_un['un_pr_in'], 2, '.', ',');  ?></td>
    <td><?php echo  number_format($it_un['un_pr_out'], 2, '.', ',');  ?></td>


    <td class="edit_its_uns" data-toggle="modal" data-target="#exampleModaleditaddunit"
        data-name="تعديل الوحدة =>    <?php echo $un_name ?>" data-it_un_id="<?php echo $it_un['it_un_id']  ?>"
        data-un_eq="<?php echo $it_un['un_eq']  ?>" data-un_pr_in="<?php echo $it_un['un_pr_in']  ?>"
        data-un_pr_out="<?php echo $it_un['un_pr_out']  ?>"><span class="btn btn-primary btn-sm"><i class="fa fa-edit">
            </i></span></td>

    <td class="delete_it_un" data-toggle="modal" data-target="#exampleModaldel"
        data-name="سيتم حذف الوحدة => <?php echo $un_name ?>" data-it_un_id="<?php echo $it_un['it_un_id']  ?>"><span
            class="btn btn-danger btn-sm"><i class="fa fa-remove"> </i></span></td>


</tr>
<?php }
}// order show
elseif (isset($_GET['order']) && $_GET['order']=="add") {

$it_id = mksave($_GET['it_id']);
$un_id  = mksave($_GET['un_id']);
$un_pr_in = mksave($_GET['un_pr_in']);
$un_pr_out = mksave($_GET['un_pr_out']);
$un_eq = mksave($_GET['un_eq']);

 $sql ="SELECT * FROM `items_units` WHERE `it_id` = '$it_id' && `un_id`= '$un_id' ";
 if(row_count($sql)==0){
    $stmt_add_it_un = $con->prepare("INSERT INTO `items_units` 
    (`it_un_id`, `it_id`, `un_id`, `un_pr_in`, `un_pr_out`, `un_eq`, `is_min_un`)
     VALUES (NULL, '$it_id', '$un_id', '$un_pr_in', '$un_pr_out', '$un_eq', '0');");
    $stmt_add_it_un->execute(); ?>
<script>
swal.fire({
    position: "top",
    title: "تمت إضافة الوحدة بنجاح",
    icon: "success",
    timer: 2500
});
</script>

<?php 
 }else{?>
<script>
swal.fire({
    position: "top",
    title: "عفـواً ... هذا الوحدة مسجلة من قبل",
    icon: "error",
    timer: 2500
});
</script>

<?php } 
} //order add 
elseif (isset($_GET['order']) && $_GET['order']=="edit") {
    $it_un_id = mksave($_GET['it_id']);
$un_pr_in = mksave($_GET['un_pr_in']);
$un_pr_out = mksave($_GET['un_pr_out']);

$un_eq = mksave($_GET['un_eq']);

$stmt_edit_it_un = $con->prepare("UPDATE `items_units` 
SET `un_pr_in`='$un_pr_in',
`un_pr_out`='$un_pr_out',
`un_eq`='$un_eq' WHERE `it_un_id`= '$it_un_id'");
$stmt_edit_it_un->execute(); ?>
<div class="alert alert-success">تم تعديل الوحدة بنجاح</div>
<!-- <script>
swal.fire({
    position: "top",
    title: "تمت تعديل الوحدة بنجاح",
    icon: "success",
    timer: 2500
});
</script> -->
<?php 
 
}// order edit
elseif (isset($_GET['order']) && $_GET['order']=="delete") {

    
    $it_un_id = mksave($_GET['it_id']);

    $sql_is_min = "SELECT `is_min_un` FROM `items_units` WHERE `it_un_id` = '$it_un_id' ";
    $is_min_un_info = row_info($sql_is_min);
    if($is_min_un_info['is_min_un']==1){?>
            <div class="alert alert-danger" role="alert">
       عفوا .. لا يمكن حذف الوحدة الاساسية للصنف
</div>
<?php
    }else{
    $stmt_delete_it_un = $con->prepare("DELETE FROM `items_units` WHERE `items_units`.`it_un_id` = '$it_un_id';");
    $stmt_delete_it_un->execute();
    ?>
        <div class="alert alert-success" role="alert">
       تـم ... حـذف الوحدة  بنجاح
</div>
   <?php
}}//elseif (isset($_GET['order']) && $_GET['order']=="delete")


?>

<script>
    var xhr;
function importfun(url, div = '', order = '', it_id = '', un_id = '', un_pr_in = '', un_pr_out = '', un_eq =
'') { //دالة جلب البيانات  

    
    
    
        if(xhr && xhr.readyState != 4){
            xhr.abort();
        }
   xrl =  $.ajax({
        method: "GET",
        url: url,
        data: {
            order: order,
            it_id: it_id,
            un_id: un_id,
            un_pr_in: un_pr_in,
            un_pr_out: un_pr_out,
            un_eq: un_eq
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

$(".edit_its_uns").on("click", function() {

    var it_un_id = $("#finaly_it_un_id").val($(this).data("it_un_id"));
    $("#modal_edit_title").text($(this).data("name"));

    $("#edit_un_pr_in").val($(this).data("un_pr_in"));
    $("#edit_un_pr_out").val($(this).data("un_pr_out"));
    $("#edit_un_eq").val($(this).data("un_eq"));

});

$("#submits_edits_its_uns").on("click", function() {
    // $(this).visible =false;
    $(this).css('visibility', 'hidden'); // Hide element

    var it_id = $("#finaly_it_id").val();
    var it_un_id = $("#finaly_it_un_id").val();
    var un_pr_in = $("#edit_un_pr_in").val();
    var un_pr_out = $("#edit_un_pr_out").val();
    var un_eq = $("#edit_un_eq").val();


    if (un_pr_in == "" || un_pr_in == "" || un_eq == "") {
        swal.fire({
            position: "top",
            title: "عفواً .. بعض الحقول فارغة",
            icon: "error",
            timer: 2500
        });
    } else {
        importfun("model/stocks/04add_units.php", "#it_un_edit_reusalt", "edit", it_id, it_un_id, un_pr_in,
            un_pr_out, un_eq);
        var cont = 0;
        var time = setInterval(function() {
            cont++;
            if (cont == 4) {
                importfun("model/stocks/04add_units.php", "#it_un_table", "show", it_id);
                $("#it_un_edit_reusalt").html("");
                xhr.abort();
                setTimeout(time);
            }
        }, 500);
    }
});

$(".delete_it_un").on("click", function() {
    var it_un_id = $("#finaly_it_un_id").val($(this).data("it_un_id"));
    $("#modal_delete_title").text($(this).data("name"));
});

$("#delete_it_un").on("click",function(){
    var it_id =   $("#finaly_it_id").val();
    var it_un_id = $("#finaly_it_un_id").val();
    importfun("model/stocks/04add_units.php", "#it_un_delete_reusalt", "delete", it_un_id);
        var cont = 0;
        var time = setInterval(function() {
            cont++;
            if (cont == 4) {
                importfun("model/stocks/04add_units.php", "#it_un_table", "show", it_id);
                $("#it_un_delete_reusalt").html("");
                setTimeout(time);
            }
        }, 500);
    });
</script>