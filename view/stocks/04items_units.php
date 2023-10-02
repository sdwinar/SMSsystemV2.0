<link rel="stylesheet" href="css/tablesorter/theme.default.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.dark.min.css"
    integrity="sha512-nc1pKg6wCivxMCLNT7Intf8DfGGN34QbjjU/5hLixwYHzAofenG0KxhbCAZS/oYibU37I/OR/FUgyY+Kd7zE1g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="js/jquery-3.4.0.min.js"></script>

<script src="js/tablesorter/jquery.tablesorter.min.js"></script>
<script src="js/tablesorter/jquery.tablesorter.widgets.min.js"></script>

<style>
table {
    border: 1.8px solid gray;
    filter: drop-shadow(0px 0px 7px gray);
    box-shadow: 0px 0px 3px 1px beige;
    font-weight: bold !important;
    font-size: 17px !important;
}

body,
#btn_dd_it {
    font-weight: bold !important;

}

.btn {
    cursor: pointer;
}
</style>
<?php
if (isset($_GET['it'])) {
    $it =$_GET['it'];

    //select un
    $stmt_items = $con->prepare("SELECT * FROM `items` WHERE `it_id` = ?");
    $stmt_items->execute(array($it));
    $it_info = $stmt_items->fetch();
}
?>
<input type="hidden" value="<?php echo $it ?>" id="finaly_it_id" class="form-control">
<input type="hidden" value="" id="finaly_it_un_id" class="form-control">

<hr />
<div class="row row_main main_add_it_un" style="   width: 100%;    right: 10%; position: relative;">

    <div class="col-lg-8 col-md-10 col-sm-8 col-8">
        <h4 class="nav-link"><i class="fa fa fa-tags "></i> إضافة وحدات للصنف =>
            <?php echo " ".$it_info['it_name'] ?> </h4>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1 col-1 hide_on_sm">
    </div>

    <div class="col-lg-3 col-md-2 col-sm-3 col-3 pull-ledft">
        <a href="stocks.php?o=items" class="btn btn-primary mb-3 btn_add">عودة للاصناف</a>

    </div>
</div>
<script>
$(function() {
    $(".tablesorter").tablesorter({
        // widgets: ["zebra", "filter"]
    });
});
</script>
<div class="row row_main main_add_it_un" style="   width: 100%;    right: 10%; position: relative;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
<table class="tablesorter text-center" dir="rtl">
    <!-- <thead style="    position: absolute;    z-index: -100;    opacity: 0;">
        <tr class="text-center">
            <th>الوحدة</th>
            <th> المعامل</th>
            <th> شراء بالجنيه</th>
            <th> بيع بالجنيه</th>
            <th></th>
            <th> </th>
        </tr>
    </thead> -->
    <tbody>
        </hr> </br>
        <tr class="text-center">
            <td class="col-3">
                <select id="un_id" class="custom-select">
                    <?php
                $stmt_un_in_items_units = $con->prepare("SELECT * FROM units WHERE un_id NOT IN  (SELECT un_id FROM items_units WHERE it_id = $it ) ");
                $stmt_un_in_items_units->execute(array());
                $unitsall = $stmt_un_in_items_units->fetchAll();
                 ?>

                    <?php foreach ($unitsall as $unit) { ?>
                    <option value="<?php echo $unit['un_id'] ?>"><?php echo $unit['un_name'] ?>
                    </option>
                    <?php } ?>
                </select>
            </td>
            <td class="text-center"><input min="1" value=""  type="number" id="un_eq"  placeholder="أدخل رقم معامل الوحدة" class="form-control text-center"></td>
            <td><input data-decimals="2" type="number" min="0" step="0.5" id="un_pr_in" placeholder="أدخل سعر الشراء"
                                            class="form-control decimal_number" required></td>
            <td><input data-decimals="2" type="number" min="0" step="0.5" id="un_pr_out" placeholder="أدخل سعر البيع"
                                            class="form-control decimal_number" required></td>
            <td id="add_its_uns" titele="إضافة"><span class="btn btn-success"><i class="fa fa-plus"> </i></span></td>
        </tr>
    <tbody>
</table>
<div class="dgdds"></div>
</div>
</div>
<hr/><hr/>
<div class="row row_main main_add_it_un" style="   width: 100%;    right: 10%; position: relative;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    <h4 class="page-header pull-right text-secondary nav-link"><i class="fa fa fa-tags "></i> وحـدات   <?php echo " ".$it_info['it_name'] ?>  </h4>
    </div>
</div>


<div class="row row_main main_add_it_un" style="   width: 100%;    right: 10%; position: relative;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">

    
<table class="tablesorter text-center" dir="rtl">
    <thead>
        <tr class="text-center">
            <th>الوحدة</th>
            <th> المعامل</th>
            <th> شراء بالجنيه</th>
            <th> بيع بالجنيه</th>
            <th></th>
            <th> </th>
        </tr>
    </thead>
    <tbody id="it_un_table">
       
    <tbody>
</table>


</div>
</div>