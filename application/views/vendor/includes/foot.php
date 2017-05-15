<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
 <script src="<?php echo MAINSITE_URL_ASSETS?>vendor/js/bootstrap.min.js"></script>
  <script src="<?php echo MAINSITE_URL_ASSETS?>vendor/js/bootstrap-select.min.js"></script>
 <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
 <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
 <script src="<?php echo MAINSITE_URL_ASSETS?>vendor/js/vcustom.js"></script>
 <script src="<?php echo MAINSITE_URL_ASSETS?>js/custom.js"></script>
  <script src="<?php echo MAINSITE_URL_ASSETS?>js/jquery-date.js"></script>





<script type="text/javascript">
$(function()
{
    $('[data-toggle="tooltip"]').tooltip();
    $(".side-nav .collapse").on("hide.bs.collapse", function() {                   
        $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down");
    });
    $('.side-nav .collapse').on("show.bs.collapse", function() {                        
        $(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right");        
    });
})
</script>