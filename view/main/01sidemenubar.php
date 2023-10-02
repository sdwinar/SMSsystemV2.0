<style>
    @charset "ISO-8859-1";

.Button {
	height: 50px;
	position: relative;
	background: #ccc;
	padding-top: 10px;
	padding-bottom: 10px;
	padding-left: 0px;
	left: 0px;
	right: 0px;
	width: 100%;
	overflow: hidden;
}

.nav-side-menu {
  overflow: auto;
  font-family: verdana;
  font-size: 12px;
  font-weight: 200;
  background-color: #2e353d;
  position: fixed;
  top: 61px;
  padding-left: 0px;
  height: 100%;
  /* width: 17%; */
  color: #e1ffff;
  border-top: 2px solid #c74141;
    border-radius: 2%;
    filter: drop-shadow(2px 2px 7px black);
}

.nav-side-menu .brand {
  background-color: #23282e;
  line-height: 50px;
  display: block;
  text-align: center;
  font-size: 14px;
}
.nav-side-menu .toggle-btn {
  display: none;
}
.nav-side-menu ul,
.nav-side-menu li {
  list-style: none;
  padding: 0px;
  margin: 0px;
  line-height: 35px;
  cursor: pointer;
}
.nav-side-menu ul :not(collapsed) .arrow:before,
.nav-side-menu li :not(collapsed) .arrow:before {
  font-family: 'Font Awesome 5 Free';
  content: "\f13a";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
  float: right;
  font-weight: 900;
}
.nav-side-menu ul .,
.nav-side-menu li . {
  border-left: 3px solid #d19b3d;
  background-color: #4f5b69;
}
.nav-side-menu ul .sub-menu li.,
.nav-side-menu li .sub-menu li. {
  color: #ede6e6;
    font-size: 14px;}
.nav-side-menu ul .sub-menu li. a,
.nav-side-menu li .sub-menu li. a {
  color: #ede6e6;
    font-size: 14px;
}
.nav-side-menu ul .sub-menu li,
.nav-side-menu li .sub-menu li {
  background-color: #181c20;
  border: none;
  line-height: 28px;
  border-bottom: 1px solid #23282e;
  margin-left: 0px;
}
.nav-side-menu ul .sub-menu li:hover,
.nav-side-menu li .sub-menu li:hover {
  background-color: #020203;
}

.nav-side-menu li {
  padding-left: 0px;
  border-left: 3px solid #84a3c6;
  border-bottom: 1px solid #23282e;
}
.nav-side-menu li a {
  text-decoration: none;
  color: #e1ffff;
}
.nav-side-menu li a i {
  padding-left: 10px;
  width: 20px;
  padding-right: 20px;
}
.nav-side-menu li:hover {
  border-left: 3px solid #d19b3d;
  background-color: #4f5b69;
  -webkit-transition: all 1s ease;
  -moz-transition: all 1s ease;
  -o-transition: all 1s ease;
  -ms-transition: all 1s ease;
  transition: all 1s ease;
}
@media (max-width: 767px) {
  .nav-side-menu {
    position: relative;
    width: 100%;
    margin-bottom: 10px;
  }
  .nav-side-menu .toggle-btn {
    display: block;
    cursor: pointer;
    position: absolute;
    right: 10px;
    top: 10px;
    z-index: 10 !important;
    padding: 3px;
    background-color: #ffffff;
    color: #000;
    width: 40px;
    text-align: center;
  }
  .brand {
    text-align: left !important;
    font-size: 22px;
    padding-left: 20px;
    line-height: 50px !important;
  }
}
@media (min-width: 767px) {
  .nav-side-menu .menu-list .menu-content {
    display: block;
  }
}
body {
  margin: 0px;
  padding: 0px;
}
.my_icon_in_meneu_side_bar{
    margin: 7px 9px;
}
    img.brand_logo {
      width: 14vw;
    height: 35vh;
    margin: -13px 0px -38px 0px;
       filter: invert(1);
}
}
a {
    font-weight: bold !important;
}
</style>
<div class="nav-side-menu">
    <div class="brand"><img id="brand_img_logo" src="img/main/transparent.png" class="brand_logo" alt="Logo"></div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">

            
            <li  data-toggle="collapse" data-target="" class="collapsed " style="    opacity: 0;">
                &nbsp    <a href="#" class="memu_text"> &nbsp <i class="fas fa-stroopwafel fa-spin"></i> &nbsp الـمــطــبــخ <i class="fa fa-arrow-down float-right my_icon_in_meneu_side_bar"></i> </a>
                </li>
                <ul class="sub-menu collapse" id="">
                <a href="#"> <li class=""> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـمنـتـجـات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                <a href="#"> <li class=""> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـاصـنـاف &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                <a href="#"> <li class=""> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـوحــدات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                <a href="stocks.php?o='sctions'"> <li class=""> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـاقـسام &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                <a href="#"> <li class=""> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـاسـعـار &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                </ul>
                
                <li  data-toggle="collapse" data-target="#invoice" class="collapsed "> 
                &nbsp  <a href="#" class="memu_text"> &nbsp  <i class="fas fa-stroopwafel fa-spin"></i>&nbsp الـطـلـبـيات <i class="fa fa-arrow-down float-right my_icon_in_meneu_side_bar"></i> </a>
                </li>
                <ul class="sub-menu collapse" id="invoice">
                    <li class=""><a href="order.php?op_type=2"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـمـبـيـعـات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="order.php?op_type=1"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـمشـتـريـات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="order.php?op_type=4"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp مرتجع مبيعات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="order.php?op_type=3"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp مرتجع مشتريات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="order.php?order_review"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp مراجعة الفواتير &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                </ul>

                <li  data-toggle="collapse" data-target="#stocks" class="collapsed "> 
                &nbsp  <a href="#" class="memu_text"> &nbsp  <i class="fas fa-stroopwafel fa-spin"></i>&nbsp الـمــطــبــخ <i class="fa fa-arrow-down float-right my_icon_in_meneu_side_bar"></i> </a>
                </li>
                <ul class="sub-menu collapse" id="stocks">
                <a href="stocks.php?o=items"> <li class=""> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـاصـنـاف &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                <a href="stocks.php?o=units"> <li class=""> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـوحــدات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                <a href="stocks.php?o=sections"> <li class=""> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـاقـسام &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                <a href="stocks.php?o=stocks"> <li class=""> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـاقـسام &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                </ul>


                <li  data-toggle="collapse" data-target="#acount" class="collapsed ">
                &nbsp  <a href="#" class="memu_text"> &nbsp  <i class="fas fa-stroopwafel fa-spin"></i>&nbsp الـحـسـابـات <i class="fa fa-arrow-down float-right my_icon_in_meneu_side_bar"></i> </a>
                </li>
                <ul class="sub-menu collapse" id="acount">
                    <!-- <li class=""><a href="accounts.php?o=all"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp قيود يومية &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li> -->
                    <li class=""><a href="accounts.php?o=irad"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـإيرادات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="accounts.php?o=monsarf"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـمنـصرفات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="accounts.php?o=dain"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp سداد دين لحساب &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="accounts.php?o=dain_from"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp سداد دين من حساب &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="accounts.php?o=tree4"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـحسـابـات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                </ul>

                <li  data-toggle="collapse" data-target="#rebort" class="collapsed ">
                &nbsp  <a href="#" class="memu_text"> &nbsp  <i class="fas fa-stroopwafel fa-spin"></i>&nbsp التـقـاريـر <i class="fa fa-arrow-down float-right my_icon_in_meneu_side_bar"></i> </a>
                </li>
                <ul class="sub-menu collapse" id="rebort">
                    <li class=""><a href="rebort.php?o=order"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp  تقرير الطلبيات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="rebort.php?o=arba7"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp  تقرير الارباح &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="rebort.php?o=makzan"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp  تقرير المخزن &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="rebort.php?o=grd7sab"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp  جـرد حـسـاب &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="rebort.php?o=khazna"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp  تقرير الخزنة &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="rebort.php?o=all"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp  كل الحسابات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                </ul>

                <li  data-toggle="collapse" data-target="#users" class="collapsed ">
                &nbsp  <a href="#" class="memu_text"> &nbsp  <i class="fas fa-stroopwafel fa-spin"></i>&nbsp الـمـسـتـخدمين <i class="fa fa-arrow-down float-right my_icon_in_meneu_side_bar"></i> </a>
                </li>
                <ul class="sub-menu collapse" id="users">
                    <li class=""><a href="users.php?o=management"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp إدارة المستخدمين &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="#"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـيومـيـات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="#"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp المـرتــبـات &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                    <li class=""><a href="#"> &nbsp <i class="fas fa-file-invoice fa-lg"></i> &nbsp الـحـوافز &nbsp  &nbsp  <i class="fa-solid fa-arrow-left float-right my_icon_in_meneu_side_bar" style="font-size:14px"></i> &nbsp </a></li>
                </ul>



                <li>
                &nbsp <a href="#"  class="memu_text ">  &nbsp  <i class="fas fa-stroopwafel fa-spin"></i>&nbsp الإعدادات                  </a>
                </li>
            </ul>
     </div>
</div>