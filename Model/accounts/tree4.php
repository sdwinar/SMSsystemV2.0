<?php
include  "../main/config.php";
include "../main/function.php";

if (isset($_GET['order']) && $_GET['order']=="show") {
    $stmt_tree4 = $con->prepare("SELECT * FROM `tree4` ORDER BY `tree4_code` DESC");

$stmt_tree4->execute(array());
$tree4s = $stmt_tree4->fetchAll();
$tree4rowcont = $stmt_tree4->rowCount();
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
            <th>معرف الـحــســاب</th>
            <th>إسم الـحــســاب</th>
            <th>إسم الفرع</th>
            <th><i class="fa fa-list"></i> الـخـيارات </th>
        </tr>
    </thead>
    <tbody>
        <?php

if($tree4rowcont==0){ ?>
        <tr>
            <td></td>
            <td>
                <center>
                    <div class="alert alert-info text-center">لا يـوجد حـسـاب مسجل</div>
                </center>
            </td>
            <td></td>
        </tr>

        <?php }


foreach($tree4s as $un) { ?>
        <tr>
            <td><?php echo $un['tree4_code']?></td>
            <td><?php echo $un['tree4_name']?></td>
            <td><?php echo get_name_by_id("tree3","tree3_code",$un['tree3_code'],"tree3_name");?></td>
            <td>
                <div class="">
                    <button type="button" data-code="<?php echo $un['tree4_code']; ?>"
                        data-name="<?php echo $un['tree4_name']; ?>" class="btn btn-info btn-sm edit_tree4"><i
                            class="fa fa-edit"></i></button>
                    <button type="button" data-code="<?php echo  $un['tree4_code'];  ?>"
                        data-name="<?php echo $un['tree4_name']; ?>" class="btn btn-danger btn-sm delet_tree4"><i
                            class="fa fa-remove"></i></button>
                </div>
            </td>
        </tr>
        <?php
}
?>

    </tbody>
</table>
<?php
}// isset show elseif (isset($_GET['order']) && $_GET['order']=="show") elseif (isset($_GET['order']) && $_GET['order']=="show")
elseif (isset($_GET['order']) && $_GET['order']=="add") {
  $tree4_name = $_GET['tree4_name'];
  $tree3_code = $_GET['tree3_code'];
  if($tree4_name !=""){
    $stmt_tree4_code = $con->prepare("SELECT count(tree4_code),max(tree4_code) FROM `tree4` WHERE `tree3_code` = '$tree3_code'  ");
    $stmt_tree4_code->execute(array());
     $tree4_code_info = $stmt_tree4_code->fetch();

     if ($tree4_code_info['count(tree4_code)']==0   ) {
        $tree4_code = (($tree3_code *100000) +1);
     
      } else {
          $tree4_code = $tree4_code_info['max(tree4_code)']+1;
      }

      $sql_find_name = "SELECT * FROM `tree4` WHERE `tree4_name` = '$tree4_name'";
      if (row_count($sql_find_name) == 0) {

        $stmt_insert_tree4 = $con->prepare("INSERT INTO `tree4` (`tree3_code`,`tree4_code`, `tree4_name`) VALUES ('$tree3_code','$tree4_code', '$tree4_name');");
        $stmt_insert_tree4->execute();
        ?>
<script>
swal.fire({
    position: "top",
    title: "تـم ... إضافة  الحساب بنجاح",
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
    title: "عفوا ... هذا الحـسـاب مسجل من قبل",
    icon: "error",
    timer: 2500
})
</script>
<?php       }

  }else{?>
<script>
swal.fire({
    position: "top",
    title: "عفواً الرجا كتابة إسم الـحـسـاب",
    icon: "error",
    timer: 2500
})
</script>
<?php
      }
  
}//elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")
elseif (isset($_GET['order']) && $_GET['order']=="edit") {
    $tree4_code = $_GET["tree4_code"];
    $tree4_name = $_GET["tree4_name"];
    
    if(empty($tree4_name)){?>
<script>
swal.fire({
    position: "top",
    title: "عفواً الرجا كتابة إسم الـحــســاب",
    icon: "error",
    timer: 2500
})
</script>
<?php
}else {
    $sql_tree4_name ="SELECT * FROM `tree4` WHERE `tree4_name` = '$tree4_name'";
    if(row_count($sql_tree4_name) == 0){ 
        $stmt_update_tree4 = $con->prepare("UPDATE `tree4` SET `tree4_name` = '$tree4_name' WHERE `tree4`.`tree4_code` = '$tree4_code';");
        $stmt_update_tree4->execute();
        ?>
<script>
swal.fire({
    position: "top",
    title: "تـم ... تـعــديل إسـم الـحــســاب بنجاح",
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
    title: "عفوا ... هذا الـحــســاب مسجل من قبل",
    icon: "error",
    timer: 2500
})
</script>
<?php       }



 }
 
 
}//elseif (isset($_GET['order']) && $_GET['order']=="edit")elseif (isset($_GET['order']) && $_GET['order']=="edit")elseif (isset($_GET['order']) && $_GET['order']=="edit")elseif (isset($_GET['order']) && $_GET['order']=="edit")
    elseif (isset($_GET['order']) && $_GET['order']=="delete") {
        $tree4_code = $_GET["tree4_code"];

      
            $stmt_delete_tree4= $con->prepare("DELETE FROM `tree4` WHERE `tree4`.`tree4_code` = '$tree4_code';");
             $stmt_delete_tree4->execute();
             ?>
<script>
swal.fire({
    position: "top",
    title: "تـم ... حــذف الـحــســاب بنجــاح",
    icon: "success",
    timer: 2500
})
</script>
<?php
            
         ?>
<?php
         
    




    }//elseif (isset($_GET['order']) && $_GET['order']=="delete")elseif (isset($_GET['order']) && $_GET['order']=="delete")elseif (isset($_GET['order']) && $_GET['order']=="delete")
?>
<!-- Modal del DataTable_filter -->

<script src="../../assets/js/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/datatable.js"></script>
<script>

</script>


<script>
$(document).ready(function() {
    // $('#DataTable').DataTable();
    // $("#DataTable_filter").show(function() {
    //  $(this).hide(); 
    // //  $(this).closest("div").siblings().find(".dataTables_length").hide();

    // });
    // $(".dataTables_length").show(function() {
    //  $(this).hide(); 
    // //  $(this).closest("div").siblings().find(".dataTables_length").hide();

    // });


    function importfun(url, div = '', order = '', tree4_code = '', tree4_name = '') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,
                tree4_code: tree4_code,
                tree4_name: tree4_name
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
    $(".edit_tree4").on("click", function() {

        var code = $(this).data("code");
        var name = $(this).data("name");

        swal.fire({
            position: "top",
            title: "تعديل الـحــســاب" + " " + name,
            input: "text",
            inputAttributes: {
                placeholder: "ادخل إسم الـحــســاب",
                id: "ادخل إسم الـحــســاب"
            },
            confirmButtonText: "تعـديل",
            cancelButtonText: "رجوع",
            showCancelButton: true,
            preConfirm: (tree4_name) => {
                importfun("model/accounts/tree4.php", "#swal_reusalt", "edit", code,
                    `${tree4_name}`);
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

    $(".delet_tree4").on("click", function() {
        var code = $(this).data("code");
        var name = $(this).data("name");

        swal.fire({
            position: "top",
            icon: "error",
            title: "حـذف الـحــســاب" + " " + name,
            confirmButtonText: "حـذف",
            cancelButtonText: "رجوع",
            showCancelButton: true,
            preConfirm: () => {
                // alert(code);
                importfun("model/accounts/tree4.php", "#swal_reusalt", "delete", code);
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


}); //ready
</script>