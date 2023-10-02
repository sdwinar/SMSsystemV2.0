<?php
include  "../main/config.php";
include "../main/function.php";
?>


<?php
if (isset($_GET['order']) && $_GET['order']=="show") {
    $stmt_it = $con->prepare("SELECT * FROM `items` ORDER BY `it_id` DESC");
$stmt_it->execute(array());
$untion = $stmt_it->fetchAll();
$unrowcont = $stmt_it->rowCount();
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
            <th># رقم</th>
            <th>إسم الصـنـف</th>
            <th>صورة الصـنـف</th>
            <th>وحـدات الصـنـف</th>
            <th>إضافة وحدات</th>
            <th><i class="fa fa-list"></i> الـخـيارات </th>
        </tr>
    </thead>
    <tbody>
        <?php

if($unrowcont==0){ ?>
        <tr>
            <td></td>
            <td></td>
            <td>
                <center>
                    <div class="alert alert-info text-center">لا يـوجد صـنـف مسجل</div>
                </center>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <?php }

$num = $unrowcont;
foreach($untion as $it) { ?>

        <tr>
        
            <td>
            <span style="top: 40px;position: relative;"> <?php echo $num; $num--; ?></span>
            </td>

            <td >
            <span style="top: 40px;position: relative;"> <?php echo $it['it_name']?></span>
        </td>
            <td>
                <img src="img/items/<?php echo $it['it_img']==""? "noimg.png":$it['it_img'] ?>"
                    style="    width: 6vw;    height: 12vh;     border-radius: 8%;  filter: drop-shadow(2px 4px 6px black);    margin: 5px;" alt="items">
                &nbsp&nbsp
                <button data-toggle="modal" data-target="#exampleModaleditimg" style="cursor: pointer;" class="badge badge-success edit_it_img"
                data-it_id="<?php echo $it['it_id']?>"
                data-it_img="<?php echo $it['it_img']==""? "noimg.png":$it['it_img']?>"
                ><i
                        class="fa fa-edit"></i></button>
            </td>
            <td>
            <span style="top: 26px;position: relative;"> 
                <?php
                   $sql_it_un = "SELECT * FROM `items_units` WHERE `it_id` = '$it[it_id]' ";
                   $its_uns =  get_all($sql_it_un); 
                   ?>
                <select id="sel_it_un" class="custom-select ">
                    <?php foreach($its_uns as $it_un) { 
                        
//عى ىةث


      //عى ىةث
      $stmt_un_info = $con->prepare("SELECT `un_name` FROM `units` WHERE `un_id` = $it_un[un_id]");
      $stmt_un_info->execute(array());
      $un_name = $stmt_un_info->fetch();
      $un_name = $un_name['un_name'];
                        
                        ?>
                    <option value="<?php echo $it_un['un_id'] ?>">
                        <?php echo   $un_name  ?></option>
                    <?php  }        ?>
                </select>
                </span>
                &nbsp&nbsp

            </td>
            <td class="float-rifht">
            <span style="top: 32.5px;position: relative;"> 
                <a href="?o=additun&it=<?php echo $it['it_id']?>" title="إضافة وحدات للصنف <?php echo $it['it_name']?>">
                    <button style="cursor: pointer;" class="badge badge-success add_it_un"><i
                            class="fa fa-plus"></i></button></a>
                    </span>
            </td>
            <td>
            <span style="top: 32.5px;position: relative;"> 
                <?php 
                      $stmt_sec_info = $con->prepare("SELECT `sec_name` FROM `section` WHERE `sec_id` = $it[it_section]");
                      $stmt_sec_info->execute(array());
                      $sec_name = $stmt_sec_info->fetch();
                      $sec_name = $sec_name['sec_name'];
                      $stmt_un_info = $con->prepare("SELECT `un_name` FROM `units` WHERE `un_id` = $it[it_min_un]");
                      $stmt_un_info->execute(array());
                      $un_name = $stmt_un_info->fetch();
                      $un_name = $un_name['un_name'];
                ?>
                <button class="badge badge-primary edit_it" style="cursor: pointer;" data-toggle="modal"
                    data-target="#exampleModal_edit_it" data-it_id="<?php echo $it['it_id']?>"
                    data-it_barcode="<?php echo $it['it_barcode']?>" data-it_name="<?php echo $it['it_name']?>"
                    data-it_section="<?php echo $it['it_section']?>"
                    data-it_section_name="<?php echo   $sec_name ;?>"
                     data-it_min_un="<?php echo $it['it_min_un']?>"
                     data-it_min_un_name="<?php echo  $un_name;?>"
                    data-it_pr_in="<?php echo $it['it_pr_in']?>" data-it_pr_out="<?php echo $it['it_pr_out']?>"
                    data-it_min_qty="<?php echo $it['it_min_qty']?>"><i class="fa fa-edit"></i></button>&nbsp
                <button class="badge badge-danger delete_it" style="cursor: pointer;"
                    data-id="<?php echo $it['it_id']?>" data-name="<?php echo $it['it_name']?>"> <i
                        class="fa fa-remove"></i></button>
                    </span>
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
     $it_name = $_GET['it_name']; 
     $it_barcode = $_GET['it_barcode']; 
     $it_section = $_GET['it_section']; 
     $it_min_un = $_GET['it_min_un']; 
     $it_pr_in = $_GET['it_pr_in']; 
     $it_pr_out = $_GET['it_pr_out']; 
     $it_min_qty = $_GET['it_min_qty']; 


     

     if($it_name==""){ ?>
<script>
swal.fire({
    position: "top",
    title: "عفواً ... بعض الحقول فارغة",
    icon: "error",
    timer: 2500
})
</script>
<?php

     }
    
     else{
                //تحقق من عدم وجود الصـنـف من قبلs
    $stmt_it = $con->prepare("SELECT `it_name` FROM `items` WHERE `it_name` = ?");
    $stmt_it->execute(array($it_name));
    $cont_name = $stmt_it->rowCount();

    if ($cont_name>0) {?>
<script>
swal.fire({
    position: "top",
    title: "عفواً ... هذا الصـنـف مسجل من قبل",
    icon: "error",
    timer: 2500
})
</script>
<?php
    }else{
        $stmt_add_it = $con->prepare("INSERT INTO `items` (`it_id`, `it_barcode`, `it_name`, `it_section`, `it_min_un`, `it_pr_in`, `it_pr_out`, `it_min_qty`, `it_img`) VALUES
        (NULL, '$it_barcode', '$it_name', '$it_section', '$it_min_un', '$it_pr_in', '$it_pr_out', '$it_min_qty', '');");
        $stmt_add_it->execute(); 
        
        //item_units
        //تحديد اي تي اي دي
      $stmt_it_id_info = $con->prepare("SELECT `it_id` FROM `items` WHERE `it_name` = '$it_name'");
      $stmt_it_id_info->execute(array());
      $id_id = $stmt_it_id_info->fetch();
      $id_id = $id_id['it_id'];
        
        $stmt_add_it_un = $con->prepare("INSERT INTO `items_units` 
        (`it_un_id`, `it_id`, `un_id`, `un_pr_in`, `un_pr_out`, `un_eq`, `is_min_un`)
         VALUES (NULL, '$id_id', '$it_min_un', '$it_pr_in', '$it_pr_out', '1', '1');");
        $stmt_add_it_un->execute(); ?>
<script>
swal.fire({
    position: "top",
    title: "تـمت إضافة الصـنـف بـنـجاح",
    icon: "success",
    timer: 2500
})
</script>
<?php
        
    }
     }
 

}//elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")elseif (isset($_GET['order']) && $_GET['order']=="add")
elseif (isset($_GET['order']) && $_GET['order']=="edit") {
    $edit_it_id = $_GET['it_id']; 
    $edit_it_name = $_GET['it_name']; 
    $edit_it_barcode = $_GET['it_barcode']; 
    $edit_it_section = $_GET['it_section']; 
    $edit_it_min_un = $_GET['it_min_un']; 
    $edit_it_pr_in = $_GET['it_pr_in']; 
    $edit_it_pr_out = $_GET['it_pr_out']; 
    $edit_it_min_qty = $_GET['it_min_qty']; 
    if(empty($edit_it_name)){?>
<script>
swal.fire({
    position: "top",
    title: "عفواً ... بعض الحقول فارغة",
    icon: "error",
    timer: 2500
})
</script>
<?php
}else { 
    $sql_it_name ="SELECT * FROM `items` WHERE `it_name` = '$edit_it_name' && `it_id` != '$edit_it_id' ";
    if(row_count($sql_it_name) == 0){ 
        $stmt_update_it = $con->prepare("UPDATE `items` SET 
        `it_barcode` = '$edit_it_barcode',
       `it_name` = '$edit_it_name',
       `it_section` = '$edit_it_section',
       `it_min_un` = '$edit_it_min_un',
       `it_pr_in` = '$edit_it_pr_in',
       `it_pr_out` = '$edit_it_pr_out',
       `it_min_qty` = '$edit_it_min_qty'
         WHERE `items`.`it_id` = '$edit_it_id';");
        $stmt_update_it->execute();

        //
        //تعديل ايتم يوتن
        $stmt_update_it = $con->prepare("UPDATE `items_units` SET 
        `un_id` = '$edit_it_min_un',
       `un_pr_in` = '$edit_it_pr_in',
       `un_pr_out` = '$edit_it_pr_out',
       `un_eq` = 1
         WHERE `items_units`.`it_id` = '$edit_it_id' && `is_min_un` = 1 ;");
        $stmt_update_it->execute();

        ?>
<script>
swal.fire({
    position: "top",
    title: "تـم ... تـعــديل الصـنـف بنجاح",
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
    title: "عفوا ... هذا الصـنـف مسجل من قبل",
    icon: "error",
    timer: 2500
})
</script>
<?php       }



 }
 
 
}//elseif (isset($_GET['order']) && $_GET['order']=="edit")
?>

<script>
$(document).ready(function() {


    function importun(url, div = '', order = '', it_id = '', it_name = '') { //دالة جلب البيانات  
        $.ajax({
            method: "GET",
            url: url,
            data: {
                order: order,
                it_id: it_id,
                it_name: it_name
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
       /* Centering the modal vertically */
    //    function alignModal() {
    //             var modalDialog = $(this).find(".modal-dialog");
    //             modalDialog.css("margin-top", Math.max(0, 
    //             ($(window).height() - modalDialog.height()) / 2));
    //         }
    //         $(".modal").on("shown.bs.modal", alignModal);
  
    //         /* Resizing the modal according the screen size */
    //         $(window).on("resize", function() {
    //             $(".modal:visible").each(alignModal);
    //         });
                   /* Centering the modal vertically */
    $(".edit_it").on("click", function() {
        // alignModal();
        var it_id = $(this).data("it_id");
        var it_barcode = $(this).data("it_barcode");
        var it_name = $(this).data("it_name");
        var it_section = $(this).data("it_section");
        var it_section_name = $(this).data("it_section_name");
        var it_min_un = $(this).data("it_min_un");
        var it_min_un_name = $(this).data("it_min_un_name");
        var it_pr_in = $(this).data("it_pr_in");
        var it_pr_out = $(this).data("it_pr_out");
        var it_min_qty = $(this).data("it_min_qty");

        $("#finaly_it_id").val(it_id);
        $("#edit_it_barcode").val(it_barcode);
        $("#edit_it_name").val(it_name);
        $("#first_sec").val(it_section);
        $("#first_sec").text(it_section_name);
        $("#first_un").val(it_min_un);
        $("#first_un").text(it_min_un_name);
        $("#edit_it_pr_in").val(it_pr_in);
        $("#edit_it_pr_out").val(it_pr_out);
        $("#edit_it_min_qty").val(it_min_qty);



    });

    $(".delete_it").on("click", function() {
        var id = $(this).data("id");
        var name = $(this).data("name");

        swal.fire({
            position: "top",
            icon: "error",
            title: "حـذف الصـنـف" + "<br/><hr/> " + name,
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

    // ****************************************************it_img**
    $(".edit_it_img").on("click",function(){
        // alignModal();
        var it_id = $(this).data("it_id");
        var it_img =  $(this).data("it_img");
        $("#finaly_it_id_for_img").val(it_id);
        $("#edit_it_img").attr("src", "img/items/" + it_img) // إرسال الصورة لمودل تعديل الصورة


    });

}); //ready
</script>