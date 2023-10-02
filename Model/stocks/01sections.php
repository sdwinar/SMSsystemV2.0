<?php
include  "../main/config.php";
include "../main/function.php";
?>


<?php
if (isset($_GET['order']) && $_GET['order']=="show") {
    $stmt_sec = $con->prepare("SELECT * FROM `section` ORDER BY `sec_id` DESC");
$stmt_sec->execute(array());
$section = $stmt_sec->fetchAll();
$secrowcont = $stmt_sec->rowCount();
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
            <th>معرف القسم</th>
            <th>إسم القسم</th>
            <th><i class="fa fa-list"></i> الـخـيارات </th>
        </tr>
    </thead>
    <tbody>
        <?php

if($secrowcont==0){ ?>
        <tr>
            <td></td>
            <td>
                <center>
                    <div class="alert alert-info text-center">لا يـوجد قسم مسجل</div>
                </center>
            </td>
            <td></td>
        </tr>

        <?php }


foreach($section as $sec) { ?>
        <tr>
            <td><?php echo $sec['sec_id']?></td>
            <td><?php echo $sec['sec_name']?></td>
            <td>
                <button class="badge badge-primary edit_sec" style="cursor: pointer;"
                    data-id="<?php echo $sec['sec_id']?>" data-name="<?php echo $sec['sec_name']?>"><i
                        class="fa fa-edit"></i></button>&nbsp
                <button class="badge badge-danger delete_sec" style="cursor: pointer;"
                    data-id="<?php echo $sec['sec_id']?>" data-name="<?php echo $sec['sec_name']?>"> <i
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
     $sec_name = $_GET['sec_name']; 

     if($sec_name==""){ ?>
<script>
swal.fire({
    position: "top",
    title: "عفواً ... ادخل إسم القسم",
    icon: "error",
    timer: 2500
})
</script>
<?php
     }else{
                //تحقق من عدم وجود الوحـدة من قبلs
    $stmt_sec = $con->prepare("SELECT `sec_name` FROM `section` WHERE `sec_name` = ?");
    $stmt_sec->execute(array($sec_name));
    $cont_name = $stmt_sec->rowCount();

    if ($cont_name>0) {?>
<script>
swal.fire({
    position: "top",
    title: "عفواً ... هذا القسم مسجل من قبل",
    icon: "error",
    timer: 2500
})
</script>
<?php
    }else{
        $stmt_add_sec = $con->prepare("INSERT INTO `section` (`sec_id`, `sec_name`) VALUES (null, '$sec_name');");
        $stmt_add_sec->execute(); ?>
<script>
swal.fire({
    position: "top",
    title: "تـمت إضافة القسم بـنـجاح",
    icon: "success",
    timer: 2500
})
</script>
<?php
        
    }
     }
 

}//elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")
elseif (isset($_GET['order']) && $_GET['order']=="edit") {
    $sec_id = $_GET["sec_id"];
    $sec_name = $_GET["sec_name"];
    if(empty($sec_name)){?>
<script>
swal.fire({
    position: "top",
    title: "عفواً الرجا كتابة إسم القسم",
    icon: "error",
    timer: 2500
})
</script>
<?php
}else {
    $sql_sec_name ="SELECT * FROM `section` WHERE `sec_name` = '$sec_name'";
    if(row_count($sql_sec_name) == 0){ 
        $stmt_update_sec = $con->prepare("UPDATE `section` SET `sec_name` = '$sec_name' WHERE `section`.`sec_id` = '$sec_id';");
        $stmt_update_sec->execute();
        ?>
<script>
swal.fire({
    position: "top",
    title: "تـم ... تـعــديل القسم بنجاح",
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
    title: "عفوا ... هذا القسم مسجل من قبل",
    icon: "error",
    timer: 2500
})
</script>
<?php       }



 }
 
 
}//elseif (isset($_GET['order']) && $_GET['order']=="edit")
elseif (isset($_GET['order']) && $_GET['order']=="delete") {
    $sec_id = $_GET["sec_id"];

    //is in items 
    $aql_is_in_it = "SELECT `it_section` FROM `items` WHERE `it_section` = '$sec_id'";
    if(row_count($aql_is_in_it)>0){?>
    <script>
swal.fire({
    position: "top",
    title: "عفوا ... لا يمكن حذف القسم لانه يحتوى على اصناف",
    icon: "error",
    timer: 2500
})
</script>

<?php
    }else{
        $stmt_delete_sec = $con->prepare("DELETE FROM `section` WHERE `section`.`sec_id` = ' $sec_id';");
        $stmt_delete_sec->execute();
        ?>
    <script>
swal.fire({
    position: "top",
    title: "تم حذف القسم بنجاح",
    icon: "success",
    timer: 2500
})
</script>

<?php
    }
}
?>

<script>
$(document).ready(function() {


    function importsec(url, div = '', order = '', sec_id = '', sec_name = '') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,
                sec_id: sec_id,
                sec_name: sec_name
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
    $(".edit_sec").on("click", function() {

        var id = $(this).data("id");
        var name = $(this).data("name");

        swal.fire({
            position: "top",
            title: "تعديل القسم" + "<br/><hr/> " + name,
            input: "text",
            inputAttributes: {
                placeholder: "ادخل إسم القسم"
            },
            confirmButtonText: "تعـديل",
            cancelButtonText: "رجوع",
            showCancelButton: true,
            preConfirm: (sec_name) => {
                if (`${sec_name}` != "") {
                    importsec("model/stocks/01sections.php", ".sw_rusalt", "edit", id,
                        `${sec_name}`);
                    var cont = 0;
                    var set_time = setInterval(() => {
                        cont++;
                        if (cont == 2) {
                            importsec("model/stocks/01sections.php", ".sectbody",
                                "show");
                            setTimeout(set_time);
                        }
                    }, 500);
                }
            }
        })

    });

    $(".delete_sec").on("click", function() {
        var id = $(this).data("id");
        var name = $(this).data("name");

        swal.fire({
            position: "top",
            icon: "error",
            title: "حـذف القسم" + "<br/><hr/> " + name,
            confirmButtonText: "حـذف",
            cancelButtonText: "رجوع",
            showCancelButton: true,
            preConfirm: () => {
                importsec("model/stocks/01sections.php", ".sw_rusalt", "delete", id);
                var cont = 0;
                var set_time = setInterval(() => {
                    cont++;
                    if (cont == 2) {
                        importsec("model/stocks/01sections.php", ".sectbody",
                            "show");
                        setTimeout(set_time);

                    }

                }, 500);
            }
        })

    });

}); //ready
</script>