//Validation of print form
$( document).ready(function()
{
	// First Form --------------------------- 
	$("#upload-file-nxt").click(function()
	{
		$("#p_err").html("");
		
		var p_name = $("#p_name").val();
		var p_email = $("#p_email").val();
		var p_ph = $("#p_ph").val();
		var p_alt_ph = $("#p_alt_ph").val();
		
		if( p_name=="" )
		{
			$("#p_err").html("Please enter name").css("color", "red");
			$("#p_name").focus();
			return false;
		}
		if( p_name.length < 3 )
		{
			$("#p_err").html("Please enter atleast 3 characters").css("color", "red");
			$("#p_name").focus();
			return false;
		}
		if( p_email=="" )
		{
			$("#p_err").html("Please enter email").css("color", "red");
			$("#p_email").focus();
			return false;
		}
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if( !regex.test(p_email) )
		{
			$("#p_err").html("Please enter valid email").css("color", "red");
			$("#p_email").focus();
			return false;
		}
		if( p_ph=="" )
		{
			$("#p_err").html("Please enter contact number").css("color", "red");
			$("#p_ph").focus();
			return false;
		}
		if( p_ph.length < 10  )
		{
			$("#p_err").html("Please enter 10 digits").css("color", "red");
			$("#p_ph").focus();
			return false;
		}
		var filter = /^[0-9-+]{10,13}$/;
		if( !filter.test(p_ph) )
		{
			$("#p_err").html("Please enter valid contact number").css("color", "red");
			$("#p_ph").focus();
			return false;
		}
		if( p_alt_ph!="" )
		{
			if( p_alt_ph.length < 10  )
			{
				$("#p_err").html("Please enter 10 digits").css("color", "red");
				$("#p_alt_ph").focus();
				return false;
			}
			var filter = /^[0-9-+]+$/;
			if( !filter.test(p_alt_ph) )
			{
				$("#p_err").html("Please enter valid alternate contact number").css("color", "red");
				$("#p_alt_ph").focus();
				return false;
			}
		}
		$("#collapseOne").slideUp();
		$("#collapseTwo").slideDown();
	});
	
	$("#user_info").click(function()
	{
		$("#collapseOne").slideToggle();
    });
	
	$("#vender_info").click(function()
	{
		$("#p_err").html("");
		var p_email = $("#p_email").val();
		var p_ph = $("#p_ph").val();
		var p_alt_ph = $("#p_alt_ph").val();
		
		if( p_name=="" || p_email=="" || p_ph=="" )
		{
			$("#p_err").html("Please fill required fields").css("color", "red");
			return false;	
		}
		$("#collapseTwo").slideToggle();
    });
	
	// Second Form --------------------------- 
	$("#next").click(function()
	{
		$("#p_err").html("");
		if( $("#p_vendor").val()=="" )
		{
			$("#p_err").html("Please select vendor").css("color", "red");
			$("#p_vendor").focus();
			return false;
		}		
		if( $("#datepicker1").val() == "" )
		{
			$("#p_err").html("Please select pickup date").css("color", "red");
			$("#datepicker1").focus();
			return false;
		}
		if( $("#timeslot").val() == "" )
		{
			$("#p_err").html("Please select pickup timeslot").css("color", "red");
			$("#timeslot").focus();
			return false;
		}
		
	    $("#collapseTwo").slideUp();
		$("#collapseThree").slideDown();
    });
	
	$("#user_order").click(function()
	{
		$("#p_err").html("");
		if( $("#p_vendor").val()=="" )
		{
			$("#p_err").html("Please select vendor").css("color", "red");
			return false;
		}
		if( $("#datepicker1").val() == "" )
		{
			$("#p_err").html("Please select pickup date").css("color", "red");
			$("#datepicker1").focus();
			return false;
		}
		if( $("#timeslot").val() == "" )
		{
			$("#p_err").html("Please select pickup timeslot").css("color", "red");
			$("#timeslot").focus();
			return false;
		}
		$("#collapseThree").slideToggle();
    });
});


$(document).ready(function()
{
	var FileInputsHolder 	= $('#AddFileInputBox');
	var submitbutton 	 	= $('#btn_save');
	var myform 			 	= $("#UploadForm");
	var completed  		 	= '0%';
	var statustxt 			= $('#statustxt');
	var progressbox 	 	= $('#progressbox');
	var progressbar 		= $('#progressbar'); 
	var status=1;
	var MaxFileInputs		= 5; //Maximum number of file input boxs
	
	// adding and removing file input box
	$(document).on('click', '.show_div', function ()
	{
		var divValue=$(this).attr('showing');
		$("#TabHideShow_"+divValue).slideToggle();	
	});
	
	//var arrayOfStrings={};
	var i = $("#AddFileInputBox").find('.upload-file1').size();
   
	//var arrayOfNumbers = arrayOfStrings.map(i);
	//alert('hhhhh');
	//return false;
    $("#AddMoreFileBox").click(function()
	{
		event.returnValue = false;
		//console.log(i);
		if(i < MaxFileInputs)
		{
			//arrayOfStrings[]=i;
			$("#AddFileInputBox").find('#TabHideShow_'+i).slideToggle();
			i++;	
			var string=ConvertnoToSting(i);
			var AppendDiv='<fieldset class="upload-file1 m-b-30" id=deletetabs'+i+'><legend><a href="javascript:void(0)" style="color:#fff;" class="show_div" showing='+i+' value='+i+'>'+string+' File Uploading</a><a href="#" class="removeclass pull-right" deletetab='+i+'><img src="assets/images/delete.png" border="0" /></a></legend><div id=TabHideShow_'+i+'><div class="col-md-12 col-sm-12 col-xs-12 m-b-20"><div class="row"><div class="col-md-6"><div class="from-group"><input type="file" name="file[]" class="form-control" placeholder="Upload Your File"></div></div><div class="col-md-6 col-sm-6 cols-xs-12"><p style="padding-top:10px;">Your file type is doc,docx,pdf,jpg</p></div></div></div> <div class="col-md-4 col-sm-4 col-xs-12"><div class="form-group"><select class="form-control sect-opt" name="data[paper_size][]" id=paprSiz'+i+'> <option value="">Paper Size*</option><option value="A3">A3</option><option value="A4">A4</option> </select></div></div><div class="col-md-4 col-sm-4 col-xs-12"> <div class="from-group"> <select class="form-control sect-opt" name="data[print_option][]"><option value="">Print Option*</option><option value="Coloured">Coloured</option><option value="Black and White">Black & White</option></select></div></div><div class="col-md-4 col-sm-4 col-xs-12"><div class="form-group"><select class="form-control  sect-opt" name="data[print_sided][]"><option value="Print one sided">Print one sided</option><option value="Print both sided">Print both sided</option> </select></div></div><div class="col-md-4 col-sm-4 col-xs-12"><div class="form-group"><select class="form-control  sect-opt" name="data[orientation][]"><option  value="">Orientation*</option><option value="Landscape">Landscape</option><option value="Portrait">Portrait</option></select> </div> </div> <div class="col-md-4 col-sm-4 col-xs-12"><div class="form-group"><select class="form-control  sect-opt" name="data[pages][]"><option value="">Pages / sheet</option><option value="1">1</option><option value="2">2</option><option value="4">4</option><option value="6">6</option> </select></div></div><div class="col-md-4 col-sm-4 col-xs-12"><div class="form-group"><input type="number" class="form-control" name="data[no_of_copy][]" placeholder="No of Copies*"></div></div><div class="col-md-4 col-sm-4 col-xs-12"> <div class="form-group"><input type="number" name="data[total_no_pages][]" class="form-control" placeholder="Total no pages*"></div></div><div class="col-md-4 col-sm-4 col-xs-12"><div class="form-group"><select class="form-control sect-opt" placeholder="" name="data[binding][]"><option value="">Binding</option><option value="Wiro binding">Wiro binding</option> <option>Soft binding</option> </select> </div></div><div class="col-md-8 col-sm-8 col-xs-12"><div class="form-group"><div class="row"><div class="pull-left"><label class="">Print* &nbsp; &nbsp;</label><label class="radio-inline no-pad-right"><input type="radio" checked value="all" name="data[optradio]['+i+']">All Pages</label><label class="radio-inline no-pad-right"><input type="radio" value="cus" name="data[optradio]['+i+']">Custom</label></div><div class="col-md-3 col-sm-3 col-xs-12 pad"><div class="from-group"><input type="number" class="form-control" name="data[from][]" placeholder="From"></div></div><div class="col-md-3 col-sm-3 col-xs-12 pad"><div class="from-group"><input type="number" name="data[to][]" class="form-control" placeholder="To"></div></div></div></div></div></div></fieldset>';
			$(AppendDiv).appendTo(FileInputsHolder);
			
			/* <div class="col-md-4 col-sm-4 col-xs-12"> <div class="form-group"><input type="text" name="data[pick_up_date][]" class="form-control datepick" id="datepicker'+i+'" placeholder="Pick Up Date*"></div></div>*/
		}
		return false;
    });
					  
	$(document).on("click",".removeclass", function(e)
	{
		event.returnValue = false;
		var deleteDiv = $(this).attr('deletetab');
		if( deleteDiv > 1 )
		{
			$("#deletetabs"+deleteDiv).remove();
			i--;
		}	
	});
	
	//Final form validation ---------------------
	$("#btn_save").click(function()
	{
		$("#p_err").html("");
		var p_name = $("#p_name").val();
		var p_email = $("#p_email").val();
		var p_ph = $("#p_ph").val();
		var p_vendor = $("#p_vendor").val();
		var p_flag = 1;
			
		if( p_name=="" || p_email=="" || p_ph=="" )
		{
			$("#p_err").html("Please fill user information").css("color", "red");
			p_flag = 0;
			return false;
		}
		if( p_vendor=="" )
		{
			$("#p_err").html("Please select vendor").css("color", "red");
			p_flag = 0;
			return false;
		}
		$("select[name^='data[paper_size]']").each(function(){
			if( $(this).val()=="" )
			{
				$("#p_err").html("Please select paper size").css("color", "red");
				p_flag = 0;
				return p_flag;
			}
		});
		if( p_flag == 1 )
		{
			$("select[name^='data[print_option]']").each(function(){
				if( $(this).val() == "" )
				{
					$("#p_err").html("Please select print option").css("color", "red");
					p_flag = 0;
					return p_flag;
				}
			});
		}
		if( p_flag == 1 )
		{
			$("select[name^='data[print_sided]']").each(function(){
				if( $(this).val() == "" )
				{
					$("#p_err").html("Please select print side").css("color", "red");
					p_flag = 0;
					return p_flag;
				}
			});
		}
		if( p_flag == 1 )
		{
			$("select[name^='data[orientation]']").each(function(){
				if( $(this).val() == "" )
				{
					$("#p_err").html("Please select orientation").css("color", "red");
					p_flag = 0;
					return p_flag;
				}
			});
		}
		if( p_flag == 1 )
		{
			$("select[name^='data[pages]']").each(function(){
				if( $(this).val() == "" )
				{
					$("#p_err").html("Please select pages/sheet").css("color", "red");
					p_flag = 0;
					return p_flag;
				}
			});
		}
		if( p_flag == 1 )
		{
			$("input[name^='data[no_of_copy]']").each(function(){
				if( $(this).val() == "" )
				{
					$("#p_err").html("Please specify no of copies").css("color", "red");
					p_flag = 0;
					return p_flag;
				}
				if( $(this).val() < 1 )
				{
					$("#p_err").html("Please specify valid no of copies").css("color", "red");
					p_flag = 0;
					return p_flag;
				}
			});
		}
		if( p_flag == 1 )
		{
			$("input[name^='data[total_no_pages]']").each(function(){
				if( $(this).val() == "" )
				{
					$("#p_err").html("Please specify total pages").css("color", "red");
					p_flag = 0;
					return p_flag;
				}
				if( $(this).val() < 1 )
				{
					$("#p_err").html("Please specify valid total pages").css("color", "red");
					p_flag = 0;
					return p_flag;
				}
			});
		}
		/*
		if( p_flag == 1 )
		{
			$("select[name^='data[binding]']").each(function(){
				if( $(this).val() == "" )
				{
					$("#p_err").html("Please select binding").css("color", "red");
					p_flag = 0;
					return p_flag;
				}
			});
		}
		if( p_flag == 1 )
		{
			$("input[name^='data[pick_up_date]']").each(function(){
				if( $(this).val() == "" )
				{
					$("#p_err").html("Please select pickup date").css("color", "red");
					p_flag = 0;
					return p_flag;
				}
			});
		}*/
		if( p_flag == 1 )
		{
			$("input[name^='data[optradio]']:checked").each(function(){
				if( $(this).val() == "cus" )
				{
					var frm = $(this).closest("div").siblings("div").find("input[name^='data[from]']").val();
					var to = $(this).closest("div").siblings("div").find("input[name^='data[to]']").val();
					if( frm=="" || frm<1 || to=="" || to<1 )
					{
						$("#p_err").html("Please specify valid from and to page number").css("color", "red");
						p_flag = 0;
						return p_flag;
					}
					if( frm > to )
					{
						$("#p_err").html("Please specify valid from and to page number").css("color", "red");
						p_flag = 0;
						return p_flag;
					}
				}
			});
		}
		
		if( p_flag==1 )
		{
			$("form[id='UploadForm']").submit();
		}		
	
	});
		
	
	 /*Submitbutton.click(function(){ 
		var selected = $('select[name="paper_size[]"]').map(function(){
			   return $(this).val();
		}).get();
		   console.log(selected);
	$.each(selected, function(key, value) {
		console.log(key);
		  // if(value==""){
			  // $("#paprSiz2").addClass("border");
			  // return false;
		  // }
	});
});
*/

	/*$(myform).ajaxForm({
		beforeSend: function() { //brfore sending form
			submitbutton.attr('disabled', ''); // disable upload button
			statustxt.empty();
			progressbox.show(); //show progressbar
			progressbar.width(completed); //initial value 0% of progressbar
			statustxt.html(completed); //set status text
			statustxt.css('color','#000'); //initial color of status text
			
		},
		uploadProgress: function(event, position, total, percentComplete) { //on progress
			progressbar.width(percentComplete + '%') //update progressbar percent complete
			statustxt.html(percentComplete + '%'); //update status text
			if(percentComplete>50)
				{
					statustxt.css('color','#fff'); //change status text to white after 50%
				}else{
					statustxt.css('color','#000');
				}
				
			},
		success: function(data, statusText, xhr)  { // on complete
			//output.html(response.responseText); //update element with received data
			percentComplete = '100%';
			console.log('Success');
			myform.resetForm();  // reset form
			submitbutton.removeAttr('disabled'); //enable submit button
			progressbox.hide(); // hide progressbar
			//$("#uploaderform").slideUp(); // hide form after upload
		}
	}); 
	*/
					
});

// Print Now - Datepicker
$('body').on('focus',".datepick", function()
{
	var dt = new Date();
	var time = dt.getHours() + ":" + dt.getMinutes();
	var setDate = ( time > "13:00" )?"1":"0";
  
	$(this).datepicker(
	{
		dateFormat: "yy-mm-dd",
		minDate: "+"+setDate+"d"
	});
});
//Disable page from/to for all pages
$("input[name^='data[optradio]']").change(function()
{
	var pageopt = $(this).val();
	if( pageopt=="all" )
	{
		$("div[id^='fromdiv']").hide("slow");
		$("div[id^='todiv']").hide("slow");
	}
	else{
		$("div[id^='fromdiv']").show("slow");
		$("div[id^='todiv']").show("slow");
	}
});


function ConvertnoToSting(number)
{
	if(number=='1'){
		return "First";
	}
	if(number=='2'){
		return "Second";
	}
	if(number=='3'){
		return "Third";
	}
	if(number=='4'){
		return "Fourth";
	}
	if(number=='5'){
		return "Fifth";
	}
	if(number=='6'){
		return "Six";
	}
	if(number=='7'){
		return "Seven";
	}
	if(number=='8'){
		return "Eight";
	}
	if(number=='9'){
		return "Nine";
	}if(number=='10'){
		return "Ten";
	}
}


// Vendor Login/ Forget Password
$("document").ready(function()
{
	$('.toggle').click(function(){
	   $('#login-step2').show(); 
	   $('#login-step1').slideUp(); 
	   $('#login-step2').slideDown();
	});
	/*
	$('#login-step2 .sub1').click(function(){
	   $('#login-step3').show(); 
	   $('#login-step2').slideUp(); 
	   $('#login-step3').slideDown();
	});
	*/
	
	
	// Vendor login validations --------------------------------------------
	$("#vlogin").click(function()
	{
		$("#vlog-err").html("");
		var vemail = $("#log_usr").val();
		var vpass = $("#log_pass").val();
		
		if( vemail=="" )
		{
			$("#vlog-err").html("Please enter username").css("color", "red");
			$("#log_usr").focus();
			return false;
		}
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if( !regex.test(vemail) )
		{
			$("#vlog-err").html("Please enter valid username").css("color", "red");
			$("#log_usr").focus();
			return false;
		}
		if( vpass=="" )
		{
			$("#vlog-err").html("Please enter password").css("color", "red");
			$("#log_pass").focus();
			return false;
		}
		
		$("#log-form").submit();
	});
	
	
	// Vendor forget password validations --------------------------------------------
	$("#vfpass").click(function()
	{
		$("#vlog-err").html("");
		var vemail = $("#f_user").val();
		
		if( vemail=="" )
		{
			$("#vlog-err").html("Please enter username").css("color", "red");
			$("#f_user").focus();
			return false;
		}
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if( !regex.test(vemail) )
		{
			$("#vlog-err").html("Please enter valid username").css("color", "red");
			$("#f_user").focus();
			return false;
		}
		
		$.ajax({
			type: 'POST',
			url: 'forget-password',
			data: {vemail: vemail},
			success: function(result)
			{
				if( result==1 )
				{
					$("#vlog-err").html("Email has been sent to reset password").css("color", "green");
				}
				else
				{
					$("#vlog-err").html(result);
				}
			}
		});
		
	});
	
	
	// Vendor forget password validations --------------------------------------------
	$("#vrespass").click(function()
	{
		$("#vlog-err").html("");
		var vpass = $("#res_pass").val();
		var vcpass = $("#resc_pass").val();
		
		if( vpass=="" )
		{
			$("#vlog-err").html("Please enter New Password").css("color", "red");
			$("#res_pass").focus();
			return false;
		}
		if( vcpass=="" )
		{
			$("#vlog-err").html("Please enter Confirm Password").css("color", "red");
			$("#resc_pass").focus();
			return false;
		}
		if( vcpass!=vpass )
		{
			$("#vlog-err").html("Confirm Password does not match New Password").css("color", "red");
			$("#resc_pass").focus();
			return false;
		}

		$("#rpass-form").submit();
		
	});
	
});


// Vendor Dashboard
$("document").ready(function()
{
	//Get view details ------------------------------------------------
	$("i[id^='vieworder_']").click(function()
	{
		var getOrderId = $(this).attr("id").split("_");
		if( getOrderId[1]!="" || getOrderId[1]!=0 )
		{
			$.ajax({
				type: "Post",
				url: "get-order-details",
				data: {ordId: getOrderId[1], pgnam: getOrderId[2]},
				success: function(result)
				{
					//alert(result);
					if( result!=0 )
					{
						$("#modal-content-div").html(result);
						$('#myModal').modal('show');
					}
				}
			});
		}
	});
	
});

//Update order status ----------------------------------------------
function updatestatus(stat, oid)
{
	//alert(stat+"<br />"+oid);
	$.ajax({
		type: "POST",
		url: "update-order-status",
		data: {statval: stat, oid: oid},
		success: function (result)
		{
			if( result==1 )
			{
				$("p[id='statup_"+oid+"']").html("Status updated successfully").delay(2000).fadeOut("slow");
			}
		}
	});
	
}

//Track file download ---------------------------------------------
function filetrack(filename='', opid='', url='')
{
	$.ajax({
		type: "POST",
		url: "track-files",
		data: {filename: filename, opid: opid},
		success: function(result)
		{
			if(result==1)
			{
				//$("#fileid"+opid).find("i").insertAfter("<span class=\"check\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i></span>");
				window.open(url+filename);
			}
		}
	});
}

//Print receipt ---------------------------------------------
function printFunc( divId='' )
{
	//alert($("iframe[name='print_frame']").html());
	//window.print();
	window.frames["print_frame"].document.body.innerHTML = $("iframe[name='print_frame']").text();
	window.frames["print_frame"].window.focus();
	window.frames["print_frame"].window.print();
}

//Custom Order Filter --------------------------------------------------
function showFilterIp( filteropt='' )
{
	if( filteropt!="" )
	{
		if( filteropt!="rn" )
		{
			$("#filterval").datepicker({ dateFormat: "yy-mm-dd" });
		}
		else
		{
			$("#filterval").datepicker("destroy");
		}
		$("#filterval").parents("ul").css("display", "block");
	}
}
$("input[id='filtergo']").click(function()
{
	var filteropt = $("#filteropt").val();
	var filterval = $("#filterval").val();
	
	if( filteropt!="all" )
	{
		if( filteropt=="" )
		{
			$("#filteropt").css("border-color", "red");
			return false;
		}
		if( filterval=="" )
		{
			$("#filterval").css("border-color", "red");
			return false;
		}
	}
	
	$("#cosearch").submit();
	
});

// Change Password ------------------------------------------------
$("#changepassgo").click(function()
{
	var oldpass = $("#oldpass").val();
	var newpass = $("#newpass").val();
	var conpass = $("#conpass").val();
	$("#changepasserr").html("");
	
	if( oldpass == "" )
	{
		$("#changepasserr").html("Please enter old password").css("color", "red");
		$("#oldpass").focus();
		return false;
	}
	if( newpass == "" )
	{
		$("#changepasserr").html("Please enter new password").css("color", "red");
		$("#newpass").focus();
		return false;
	}
	if( conpass == "" )
	{
		$("#changepasserr").html("Please enter confirm password").css("color", "red");
		$("#conpass").focus();
		return false;
	}
	if( conpass != newpass )
	{
		$("#changepasserr").html("Confirm password does not match").css("color", "red");
		$("#conpass").focus();
		return false;
	}
	
	$.ajax({
		type: "POST",
		url: "update-password",
		data: {oldpass: oldpass, newpass: newpass, conpass: conpass},
		success: function(result)
		{
			if( result==1 )
			{
				$("#changepasserr").html("Password changed successfully").css("color", "green");
				$("#changepassform")[0].reset();
			}
			else
			{
				$("#changepasserr").html(result).css("color", "red");
			}
		}
	});
});
// Cancel Change Password ------------------------------------------------
$(document).ready(function(){
    $("#changepass").click(function(){
        $(".pass_col").addClass("show")
        $(".pass_col").removeClass("inactive")
    });
});
$("a[id^='changepassno']").click(function(){
	//alert("hallo");
	//$("div[id='pass_col_div']").css("display", "none");
	$("div[id='pass_col_div']").addClass("inactive");
});


// Admin Dashboard
// Add vendor ------------------------------------------------------------------
$(document).ready(function()
{
	$("#av_submit").click(function()
	{
		var av_shop = $("#av_shop").val();
		var av_name = $("#av_name").val();
		var av_email = $("#av_email").val();
		var av_ph = $("#av_ph").val();
		var av_altph = $("#av_altph").val();
		var av_addr = $("#av_addr").val();
		var avold_email = $("#avold_email").val();
		var avold_ph = $("#avold_ph").val();
		var vendorcase = $("#vendorcase").val();
		var vendorid = $("#vendorid").val();
		$("#av_err").html("").css("color", "red");
		
		if( av_shop=="" )
		{
			$("#av_err").html("Please enter Shop Name");
			$("#av_shop").focus();
			return false;
		}
		if( av_name=="" )
		{
			$("#av_err").html("Please enter Name");
			$("#av_name").focus();
			return false;
		}
		if( av_name.length < 3 )
		{
			$("#av_err").html("Please enter atleast 3 characters");
			$("#av_name").focus();
			return false;
		}
		if( av_email=="" )
		{
			$("#av_err").html("Please enter Email Id");
			$("#av_email").focus();
			return false;
		}
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if( !regex.test(av_email) )
		{
			$("#av_err").html("Please enter valid Email Id");
			$("#av_email").focus();
			return false;
		}
		if( av_ph=="" )
		{
			$("#av_err").html("Please enter Contact Number");
			$("#av_ph").focus();
			return false;
		}
		var regex = /^[0-9-+]+$/;
		if( !regex.test(av_ph) )
		{
			$("#av_err").html("Please enter valid Contact Number");
			$("#av_ph").focus();
			return false;
		}
		if( av_altph!="" )
		{
			var regex = /^[0-9-+]+$/;
			if( !regex.test(av_altph) )
			{
				$("#av_err").html("Please enter valid Contact Number");
				$("#av_altph").focus();
				return false;
			}
		}
		if( av_addr=="" )
		{
			$("#av_err").html("Please enter Contact Address");
			$("#av_addr").focus();
			return false;
		}
		
		// Edit
		if( vendorcase=="edit" )
		{
			$.ajax({
				type: "post",
				url: vendorid,
				data: {av_name: av_name, av_email: av_email, av_ph: av_ph, av_altph: av_altph, av_addr: av_addr, av_shop: av_shop, avold_email: avold_email, avold_ph: avold_ph},
				success: function(result){
					if( result==1 )
					{
						$("#av_err").html("Vendor added successfully").css("color", "green");
					}
					else
					{
						$("#av_err").html(result);
						return false;
					}
				}
			});
		}
		else
		{
			$.ajax({
				type: "post",
				url: "add-vendor",
				data: {av_name: av_name, av_email: av_email, av_ph: av_ph, av_altph: av_altph, av_addr: av_addr, av_shop: av_shop},
				success: function(result){
					if( result==1 )
					{
						$("#av_err").html("Vendor added successfully").css("color", "green");
						$("#addvendor")[0].reset();
					}
					else
					{
						$("#av_err").html(result);
						return false;
					}
				}
			});
		}
		
	});
	
	//Phone number on key up validation
	$('[id^="av_ph"]').keypress(function(event)
	{
		if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
			event.preventDefault(); //stop character from entering input
		}
		if (event.keyCode == 32) {
			event.preventDefault(); //stop space from entering input
		}
	});
	$('[id^="av_altph"]').keypress(function(event)
	{
		if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
			event.preventDefault(); //stop character from entering input
		}
		if (event.keyCode == 32) {
			event.preventDefault(); //stop space from entering input
		}
	});
	
});

//Vendor Status Update
function vendorstatusupdate(vid=0, stat=0)
{
	if(vid!=0)
	{
		$.ajax({
			type: "POST",
			url: "vendor-status-update",
			data: {vid: vid, stat: stat},
			success: function(result)
			{
				if( result==1 )
				{
					$("#v_st_err_"+vid).html("Status Updated successfully");
				}
			}
		});
	}
}

//Search Vendor
function searchvendor(keyword='')
{
	if(keyword!="")
	{
		$.ajax({
			type: "POST",
			url: "vendor-search",
			data: {keyword: keyword},
			success: function(result)
			{
				$("#vendorcontent").html(result);
			}
		});
	}
}