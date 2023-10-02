
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
<div class="row row_main main_it" style="   width: 100%;    right: 10%; position: relative;">

    <div class="col-lg-4 col-md-10 col-sm-8 col-8">
        <h3 class="nav-link"> <i class="fa fa-list"></i> إدارة الـأصــنـاف</h3>
    </div>
    <div class="col-lg-5 col-md-1 col-sm-1 col-1 hide_on_sm">
    </div>

    <div class="col-lg-3 col-md-2 col-sm-3 col-3 pull-ledft">
        <button class="btn btn-primary" id="btn_dd_it" data-toggle="modal" data-target="#exampleModal_add_it"
        > <i class="fa fa-plus"></i> إضافة صنف</button>
    </div>
</div>

<div class="row row_main" style=" width:100%;    right: 10%; position: relative;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 " id="ittbody">

    </div>
</div>
<div class="sw_rusalt"></div>



 