<?php
include  "../main/config.php";
include "../main/function.php";

if (isset($_GET['order']) && $_GET['order']=="show") {
    $stmt_un = $con->prepare("SELECT * FROM `units` ORDER BY `un_id` DESC");
$stmt_un->execute(array());
$untion = $stmt_un->fetchAll();
$unrowcont = $stmt_un->rowCount();
?>


<script>
$(function() {
    $(".tablesorter").tablesorter({
        widgets: ["zebra", "filter"]
    });
});
</script>

<table class="tablesorter text-center" dir="rtl">
    <thead>
        <tr>
            <th>معرف الوحـدة</th>
            <th>إسم الوحـدة</th>
            <th><i class="fa fa-list"></i> الـخـيارات </th>
        </tr>
    </thead>
    <tbody>
        <?php

if($unrowcont==0){ ?>
        <tr>
            <td></td>
            <td>
                <center>
                    <div class="alert alert-info text-center">لا يـوجد وحـدة مسجل</div>
                </center>
            </td>
            <td></td>
        </tr>

        <?php }


foreach($untion as $un) { ?>
        <tr>
            <td><?php echo $un['un_id']?></td>
            <td><?php echo $un['un_name']?></td>
            <td>
                <button class="badge badge-primary edit_un" style="cursor: pointer;"
                    data-id="<?php echo $un['un_id']?>" data-name="<?php echo $un['un_name']?>"><i
                        class="fa fa-edit"></i></button>&nbsp
                <button class="badge badge-danger delete_un" style="cursor: pointer;"
                    data-id="<?php echo $un['un_id']?>" data-name="<?php echo $un['un_name']?>"> <i
                        class="fa fa-remove"></i></button>
            </td>
        </tr>
        <?php
}
?>

    </tbody>
</table>
<?php
}// isset show
elseif (isset($_GET['order']) && $_GET['order']=="add") {
     $un_name = $_GET['un_name']; 

     if($un_name==""){ ?>
<script>
swal.fire({
    position: "top",
    title: "عفواً ... ادخل إسم الوحـدة",
    icon: "error",
    timer: 2500
})
</script>
<?php
     }else{
                //تحقق من عدم وجود الوحـدة من قبلs
    $stmt_un = $con->prepare("SELECT `un_name` FROM `units` WHERE `un_name` = ?");
    $stmt_un->execute(array($un_name));
    $cont_name = $stmt_un->rowCount();

    if ($cont_name>0) {?>
<script>
swal.fire({
    position: "top",
    title: "عفواً ... هذا الوحـدة مسجل من قبل",
    icon: "error",
    timer: 2500
})
</script>
<?php
    }else{
        $stmt_add_un = $con->prepare("INSERT INTO `units` (`un_id`, `un_name`) VALUES (null, '$un_name');");
        $stmt_add_un->execute(); ?>
<script>
swal.fire({
    position: "top",
    title: "تـمت إضافة الوحـدة بـنـجاح",
    icon: "success",
    timer: 2500
})
</script>
<?php
        
    }
     }
 

}//elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")
elseif (isset($_GET['order']) && $_GET['order']=="edit") {
    $un_id = $_GET["un_id"];
    $un_name = $_GET["un_name"];
    if(empty($un_name)){?>
<script>
swal.fire({
    position: "top",
    title: "عفواً الرجا كتابة إسم الوحـدة",
    icon: "error",
    timer: 2500
})
</script>
<?php
}else {
    $sql_un_name ="SELECT * FROM `units` WHERE `un_name` = '$un_name'";
    if(row_count($sql_un_name) == 0){ 
        $stmt_update_un = $con->prepare("UPDATE `units` SET `un_name` = '$un_name' WHERE `units`.`un_id` = '$un_id';");
        $stmt_update_un->execute();
        ?>
<script>
swal.fire({
    position: "top",
    title: "تـم ... تـعــديل الوحـدة بنجاح",
    icon: "success",
    timer: 2500
})
</script>
<?php
   }else {
    ?>
<script>
swal.fire({
    position: "top",
    title: "عفوا ... هذا الوحـدة مسجل من قبل",
    icon: "error",
    timer: 2500
})
</script>
<?php       }



 }
 
 
}//elseif (isset($_GET['order']) && $_GET['order']=="edit")
elseif (isset($_GET['order']) && $_GET['order']=="delete") {
    $un_id = $_GET["un_id"];

    //is in items 
    $aql_is_in_it = "SELECT `un_id` FROM `items_units` WHERE `un_id` = '$un_id'";
    if(row_count($aql_is_in_it)>0){?>
    <script>
swal.fire({
    position: "top",
    title: "عفوا ... لا يمكن حذف الوحدة لانها تحتوى على اصناف",
    icon: "error",
    timer: 2500
})
</script>

<?php
    }else{
        $stmt_delete_sec = $con->prepare("DELETE FROM `units` WHERE `units`.`un_id` = ' $un_id';");
        $stmt_delete_sec->execute();
        ?>
    <script>
swal.fire({
    position: "top",
    title: "تم حذف الوحدة بنجاح",
    icon: "success",
    timer: 2500
})
</script>

<?php
    }
}
?>
?>

<script>
$(document).ready(function() {


    function importun(url, div = '', order = '', un_id = '', un_name = '') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,
                un_id: un_id,
                un_name: un_name
            },
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
    $(".edit_un").on("click", function() {

        var id = $(this).data("id");
        var name = $(this).data("name");

        swal.fire({
            position: "top",
            title: "تعديل الوحـدة" + "<br/><hr/> " + name,
            input: "text",
            inputAttributes: {
                placeholder: "ادخل إسم الوحـدة"
            },
            confirmButtonText: "تعـديل",
            cancelButtonText: "رجوع",
            showCancelButton: true,
            preConfirm: (un_name) => {
                if (`${un_name}` != "") {
                    importun("model/stocks/02units.php", ".sw_rusalt", "edit", id,
                        `${un_name}`);
                    var cont = 0;
                    var set_time = setInterval(() => {
                        cont++;
                        if (cont == 2) {
                            importun("model/stocks/02units.php", "#untbody", "show");

                            setTimeout(set_time);
                        }
                    }, 500);
                }
            }
        })

    });

    $(".delete_un").on("click", function() {
        var id = $(this).data("id");
        var name = $(this).data("name");

        swal.fire({
            position: "top",
            icon: "error",
            title: "حـذف الوحـدة" + "<br/><hr/> " + name,
            confirmButtonText: "حـذف",
            cancelButtonText: "رجوع",
            showCancelButton: true,
            preConfirm: () => {
                importun("model/stocks/02units.php", ".sw_rusalt", "delete", id);
                var cont = 0;
                var set_time = setInterval(() => {
                    cont++;
                    if (cont == 2) {
                        importun("model/stocks/02units.php", "#untbody", "show");

                        setTimeout(set_time);

                    }

                }, 500);
            }
        })

    });

}); //ready
</script>