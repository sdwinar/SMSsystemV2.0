<style>
    .navbar{
        background: #01011d  !important;
        border-bottom: 1px solid #c74141;
    border-radius: 2%;
    filter: drop-shadow(2px 4px 6px black);
    }
    .navbar-brand{
        color: aliceblue !important;
        filter: drop-shadow(2px 4px 6px );
    }
 .nav-link{
        color: #00f8ffe6  !important;
        font-weight :bold !important;
    }
    .dropdown-item{
      font-weight :bold !important;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-dark navbar-inverse navbar-fixed-top">
  <a style="color: lime!important;    filter: none;    box-shadow: 1px 1px 6px grey;    padding: 7px;    border: 1px solid yellow;    border-radius: 8%;"
     class="navbar-brand"><i class="<?php echo isset($nav_icon)?$nav_icon:"cutlery" ?> "></i>&nbsp<?php echo isset($nav_title)?$nav_title:"مـطعم الـكوكتيل" ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">


    <?php if(isset($thispage)&& $thispage!="home"){?>
      <li class="nav-item active">
        <a class="nav-link" href="home.php"><i class="fa fa-home"></i> الرئيسية  <span class="sr-only">(current)</span></a>
      </li>
      <?php }?>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-edit"></i> طـلبـات سريعة
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

          <a class="dropdown-item" href="order.php?op_type=2">الـمبيـعـات</a>
          <a class="dropdown-item" href="order.php?op_type=1">المشتريات</a>
          <a class="dropdown-item" href="order.php?op_type=4">مرتجع مبيعات</a>
          <a class="dropdown-item" href="order.php?op_type=3">مرتجع مشتريات</a>
          <div class="dropdown-divider"></div> 
          <a class="dropdown-item" href="order.php?order_review">مراجعة الفواتير</a>
        </div>
      </li>
      <?php // if(isset($thispage)&& $thispage!="stocks"){?>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="stockss" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-hamburger"></i> الـمــطــبــخ 
         </a>
         <div class="dropdown-menu" aria-labelledby="stockss">
         
          <a class="dropdown-item" href="stocks.php?o=items">  &nbsp الاصــنـاف &nbsp </a>
          <a class="dropdown-item" href="stocks.php?o=sections">  &nbsp الـأقسـام &nbsp </a>
          <a class="dropdown-item" href="stocks.php?o=units">  &nbsp الـوحـدات &nbsp </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="stocks.php?o=stocks">الـمطبــخ</a>
      
        </div>
      </li>
      <?php // }?>
      <?php // if(isset($thispage)&& $thispage!="stocks"){?> 
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="accountss" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-dollar"></i> الـحـسـابـات 
         </a>
         <div class="dropdown-menu" aria-labelledby="accountss">
         <!-- <a class="dropdown-item" href="accounts.php?o=all">  &nbsp قيود اليومية &nbsp </a> -->
         <a class="dropdown-item" href="accounts.php?o=irad">  &nbsp الإيــرادات &nbsp </a>
         <a class="dropdown-item" href="accounts.php?o=monsarf">  &nbsp الـمنـصرفات &nbsp </a>
         <a class="dropdown-item" href="accounts.php?o=dain">  &nbsp سداد دين لحساب &nbsp </a>
         <a class="dropdown-item" href="accounts.php?o=dain_from">  &nbsp سداد دين من حساب &nbsp </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="accounts.php?o=tree4">  &nbsp الـحـسـابـات &nbsp </a>

        </div>
      </li>
      <?php // }?>
      <?php // if(isset($thispage)&& $thispage!="stocks"){?>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userss" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-users"></i> المستخدمين 
         </a>
         <div class="dropdown-menu" aria-labelledby="userss">
         <a class="dropdown-item" href="users.php?o=management">  &nbsp إدارة المستخدمين &nbsp </a>
          <div class="dropdown-divider"></div>
       
        </div>
      </li>
      <?php // }?> 
      <?php // }?>
      <?php // if(isset($thispage)&& $thispage!="stocks"){?>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="rebortee" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bar-chart"></i> التـقارير 
         </a> 
         <div class="dropdown-menu" aria-labelledby="rebortee"> 
         <a class="dropdown-item" href="rebort.php?o=order">  &nbsp تقرير المنتجات &nbsp </a>
         <a class="dropdown-item" href="rebort.php?o=arba7">  &nbsp تقرير الارباح &nbsp </a>
         <a class="dropdown-item" href="rebort.php?o=makzan">  &nbsp تقرير المخزن &nbsp </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="rebort.php?o=grd7sab">  &nbsp جـرد حـسـاب &nbsp </a>
          <a class="dropdown-item" href="rebort.php?o=khazna">  &nbsp تقرير الخزنة &nbsp </a>
          <a class="dropdown-item" href="rebort.php?o=all">  &nbsp كل الحسابات &nbsp </a>

       
        </div>
      </li>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="accountss" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-gear"></i> الإعدادات 
         </a>
         <div class="dropdown-menu" aria-labelledby="accountss">
         <a class="dropdown-item" href="model/main/logout.php">  &nbsp تسجيل الخروج &nbsp </a>
          <div class="dropdown-divider"></div>
       
        </div>
      </li>

      <?php // }?>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <!-- <input style="    width: 150px;" class="form-control mr-sm-2 text-center" type="search" placeholder="بـحــــث" aria-label="Search"> -->
      <span  style="    color: aqua;    padding: 6px 10px;    border: 1.5px solid burlywood;    margin: 0px 11px 1px 0px;    border-radius: 10%;  box-shadow: 1px 1px;    font-weight: bold;        -webkit-text-stroke-width: thin;

       text-transform: uppercase;"> <span id="username_in_navbar" ><?php echo $user_session_info['username'] ?> </span> 
      <img id="img_in_navbar" src="img/users/<?php echo $user_session_info['us_img']==""? "avatar.jpg":$user_session_info['us_img']?>"
      style="width: 40px;    height: 35px;    border-radius: 10%;    filter: drop-shadow(3px 4px 8px gray);"
      alt="image"> 
      </span>
    </form>
  </div>

</nav>