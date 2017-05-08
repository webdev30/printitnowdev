$('.collapse').on('shown.bs.collapse', function(){
$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
});




$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
//    $("#upload-file-nxt").click(function() {
//       $(".u-information").hide();
//       $(".vendor-select").show();
//         
//     });
});

$('a[href="#navbar-more-show"], .navbar-more-overlay').on('click', function(event) {
		event.preventDefault();
		$('body').toggleClass('navbar-more-show');
		if ($('body').hasClass('navbar-more-show'))	{
			$('a[href="#navbar-more-show"]').closest('li').addClass('active');
		}else{
			$('a[href="#navbar-more-show"]').closest('li').removeClass('active');
		}
		return false;
});

// Toggle Function
$('.toggle').click(function(){
   $('#login-step2').show(); 
   $('#login-step1').slideUp(); 
   $('#login-step2').slideDown();

});
 
$('#login-step2 .sub1').click(function(){
   $('#login-step3').show(); 
   $('#login-step2').slideUp(); 
   $('#login-step3').slideDown();

});
 
   
 //menu active code
$(document).ready(function() {
  var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
        pgurl =pgurl;  
    if(pgurl=='' || pgurl== "NULL")
    {
    pgurl='index.php';
    }
    $(".navbar-nav li:nth-child(1)").addClass('active');
    $(".navbar-nav li").removeClass('active');
    $(".navbar-nav li a").each(function(){
         var link = $("a",this).attr('href');           
         if(pgurl==$(this).attr('href'))
         {
            $(this).closest('li').addClass('active');
            return false;
         }
     });
    $(".navbar-nav li li a").each(function(){
         var link = $("a",this).attr('href');           
         if(pgurl==$(this).attr('href'))
         {
            $(".navbar-nav li li").parents("li").addClass('active');
            return false;
         }
     });

});



	

	
	
	
	
	
	
	
	
	
	
	
	
	
	



    




