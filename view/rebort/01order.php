<link rel="stylesheet" type="text/css" href="css/dataTables.css">
<!-- <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css"> -->

<script src="js/jquery-3.4.0.min.js"></script>

<script type="text/javascript" charset="utf8" src="js/dataTables.js"></script><!-- <script src="js/tablesorter/jquery.tablesorter.widgets.min.js"></script> -->
<!-- <script type="text/javascript" charset="utf8" src="cdn.datatables.net/plug-ins/1.11.5/api/sum().js"></script><script src="js/tablesorter/jquery.tablesorter.widgets.min.js"></script> -->


<style>
table {
    border: 1.8px solid gray;
    box-shadow: 0px 0px 3px 1px beige;
    font-weight: bold !important;
    font-size: 17px !important;
}

body,
#btn_dd_un {
    font-weight: bold !important;

}

tfoot tr,
thead {
    background: lightblue;
}

.reb_input {
    border-bottom: 2px solid aqua;
    border-radius: 11px;
    padding: 1px 10px;
    width: 100%;
    background: none;
    color: #00e0e9 !important;
    font-size: 26px !important;
}

.inp_date {
    border-bottom: 2px solid aqua;
    border-radius: 11px;
    padding: 1px 10px;
    background: none;
    color: #00e0e9 !important;
}

.nav_me {
    color: aliceblue;
}
</style>
<div id="print_div">
    <!-- ################################################################# -->
<div class="row row_main main_cash" id="main_rebor">

    <div class="col-lg-4 col-md-2 col-sm-4 col-4 hide_on_sm  text-center"></div>
<center>
<div class="col-lg-8 col-md-2 col-sm-4 col-4 hide_on_sm  text-center">
<input class="reb_input" type="text" value="<?php echo  $pptitle_title ?>" style="    margin-top: 16px;">
</div>
</center>
    </div>
    <div class="col-lg-1 col-md-2 col-sm-4 col-4 hide_on_sm  text-center"></div>

<!-- ################################################################# -->
<hr/>
<div class="row row_main main_cash">

    <sapn class="col-lg-2 col-md-2 col-sm-4 col-4 hide_on_sm"></sapn>

    <span class="col-lg-1 col-md-10 col-sm-8 col-8">
        
        <h3 class="nav_me">مــن :</h3>
    </span>
    <span class="col-lg-3 col-md-10 col-sm-8 col-8" id="div_input1">
        
        <input id="before" class="inp_date" type="date" value="<?php echo  date('Y-m-d'); ?>">
    </span>
    <span class="col-lg-1 col-md-10 col-sm-8 col-8">
        
        <h3 class="nav_me" id="lbl_to">الي :</h3>
    </span>
    <span class="col-lg-3 col-md-10 col-sm-8 col-8">
        
        <input id="after" class="inp_date" type="date" value="<?php echo  date('Y-m-d'); ?>">
    </span>


    <span class="col-lg-1 col-md-2 col-sm-4 col-4 hide_on_sm"></span>
</div>
<!-- ################################################################# -->
<div class="row row_main main_cash" id="this_tb">
    <div class="col-lg-2 col-md-2 col-sm-4 col-4 hide_on_sm"></div>
    
    <div class="col-lg-10 col-md-2 col-sm-4 col-4" id="tbrebort">

        


    </div>
</div>

</div><!-- <div id="print_div"> -->
</div><!-- <div id="print_div"> -->
</div><!-- <div id="print_div"> -->
    <div class="row">
    <div class="col-lg-4 col-md-2 col-sm-4 col-4 text-center"></div>
    <div class="col-lg-5 col-md-2 col-sm-4 col-4 text-center">
        <br/>
    <button id="print_this" class="btn btn-success"><i class="fa fa-print"></i>  طباعة</button>
</div>
    </div>



<!-- ################################################################# -->
