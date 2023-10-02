$(document).ready(function() {

    function laptop() {
       // var sitelang = $(".sitelang").text();    0px -34px  0px  15px !important 
        var sitelang = "ar";//مؤقتا الي حين تضمين اللغة : ;
        if (sitelang == "ar") {
            // صفحة فاتورة المشتريات               0             px -34px  0px  15px !important
            $(".form-group").css({ 'margin-bottom': ' 0 !important' });
            $(".ameal_name").css({'position':'relative',    'width': '123px', 'margin': '10px -6px -10px 0px' });
            $(".add_new_ameal").css({'position':'relative',  'margin': '-8px -85px 0px 15px' });
            $(".bank_div,.safe_div").css({'position':'relative',  'margin': '0px 34px' });
            $(".stock_div").css({'position':'relative',  'margin': '0px -128px 0px  0px' });
            $("#costumer_name").css({'position':'relative',  'right': '-57px' });
            $(".stock_name").css({'position':'relative','width': '77px','margin': '8px -79px -10px 54px' });

            // $(".talabia_div,.order-calc").css({ 'right': '-8%','position': 'relative','width': '110%' });




            //$(".pagenamelable").css({ 'margin-right': '3%' });
        } else {
            $(".pagenamelable").css({ 'margin-left': '3%' });
            $(".pagenamelable").css({ 'margin-right': '1%' });
        }

    }

    function laptopS() {
        // var sitelang = $(".sitelang").text();    0px -34px  0px  15px !important
         var sitelang = "ar";//مؤقتا الي حين تضمين اللغة
         if (sitelang == "ar") {
             // صفحة فاتورة المشتريات               0             px -34px  0px  15px !important
             $(".invoice-no").css({'position':'relative','font-size':'12px','margin': '0px 19px 0px 14px' });
             $(".form-group").css({ 'margin-bottom': ' 0 !important' });
             $(".ameal_name").css({'position':'relative','right': '-50px','top': '10px','width': '77px' });
             $(".stock_name").css({'position':'relative','width': '77px','margin': '8px -79px -10px 54px' });
             $(".bank_div,.safe_div").css({'position':'relative',  'margin': '0px 47px' });
            $("#costumer_name").css({'position':'relative',  'right': '-85px' });
            $(".add_new_ameal").css({'position':'relative',  'right': '-103px','top': '-8px' });
            $(".stock_div").css({'position':'relative',  'margin': '0px -112px 0px -4px' });

             //$(".pagenamelable").css({ 'margin-right': '3%' });
         } else {
             $(".pagenamelable").css({ 'margin-left': '3%' });
             $(".pagenamelable").css({ 'margin-right': '1%' });
         }
 
     }
     function tablet() {
      // var sitelang = $(".sitelang").text();    0px -34px  0px  15px !important
      var sitelang = "ar";//مؤقتا الي حين تضمين اللغة
      if (sitelang == "ar") {
          // صفحة فاتورة المشتريات               0             px -34px  0px  15px !important
          $(".invoice-no").css({'position':'relative','font-size':'12px','margin': '0px 19px 0px 14px' });
          $(".form-group").css({ 'margin-bottom': ' 0 !important' });
          $(".ameal_name").css({'position':'relative','right': '-50px','top': '10px','width': '77px' });
          $(".stock_name").css({'position':'relative','width': '77px','margin': '8px 8px -10px 54px' });
          $(".bank_div,.safe_div").css({'position':'relative',  'margin': '0px -23px 0px 0px' });
         $("#costumer_name").css({'position':'relative',  'right': '-192px' });
         $(".costumer_name_select_bill").css({'position':'relative',  'right': '-192px' });
         $(".add_new_ameal").css({'position':'relative',  'right': '-231px','top': '-8px' });
         $(".stock_div").css({'position':'relative',  'margin': '0px -112px 0px -4px' });
         $(".order-calc").css({'position':'relative',  'height': '97px' });


          //$(".pagenamelable").css({ 'margin-right': '3%' });
      } else {
          $(".pagenamelable").css({ 'margin-left': '3%' });
          $(".pagenamelable").css({ 'margin-right': '1%' });
      }
 
     }
     function mobileL() {     
        var sitelang = "ar";//مؤقتا الي حين تضمين اللغة  : ; : -68px;
     
        if (sitelang == "ar") {
            // صفحة القائمة الرئيسية               0             px -34px  0px  15px !important
            $("#brand_img_logo").css({'position':'relative','width':'16vw','height':'9vh','margin': '0px 0px 0px 0px' });
            $(".nav-side-menu").css({'position':'relative','height':'auto','margin-top':'-68px'});
            // الرو داخل الاقسام
            $(".row_main").css({'position':'relative','width':'100%','right':'4%'});
            $(".hide_on_sm").css({'display':'none'});

            
       //     $(".invoice-no").css({'position':'relative','font-size':'12px','margin': '0px 19px 0px 14px' });
        //     $(".form-group").css({ 'margin-bottom': ' 0 !important' });
        //     $(".ameal_name").css({'position':'relative','right': '-50px','top': '10px','width': '77px' });
        //     $(".stock_name").css({'position':'relative','width': '77px','margin': '8px 8px -10px 54px' });
        //     $(".bank_div,.safe_div").css({'position':'relative',  'margin': '0px -23px 0px 0px' });
        //    $(".stock_div").css({'position':'relative',  'margin': '0px -112px 0px -4px' });
  
            //$(".pagenamelable").css({ 'margin-right': '3%' });
        } else {
            $(".pagenamelable").css({ 'margin-left': '3%' });
            $(".pagenamelable").css({ 'margin-right': '1%' });
        }
   
       }
    var widthz = innerWidth;
   // alert(widthz)
    if (widthz <= 1440  && widthz > 1024 ) {
       laptop();
    } else if (widthz <= 1024  && widthz > 768) {
       laptopS();
    }else if (widthz <= 768  && widthz > 425) {
       tablet();
    }else if (widthz <= 425  && widthz > 375) {
        mobileL();
     }else if (widthz <= 375  && widthz > 100) {
        mobileL();
     }

})


