<?php
//echo "<pre>";
//print_r($prPOST);

$name = $email = $contact = $alternate_contact = $vendor = $paper_size = $print_option = $print_sided = $orientation = $pages = $no_of_copy = $total_no_pages = $binding = $pick_up_date = $optradio = $from = $to = $timeslotval = "";

if( isset($prPOST) && !empty($prPOST) )
{
  $name = $prPOST['name'];
  $email = $prPOST['email'];
  $contact = $prPOST['contact'];
  $alternate_contact = $prPOST['alternate_contact'];
  $vendor = $prPOST['vendor'];
  $paper_size = $prPOST['data']['paper_size'][0];
  $print_option = $prPOST['data']['print_option'][0];
  $print_sided = $prPOST['data']['print_sided'][0];
  $orientation = $prPOST['data']['orientation'][0];
  $pages = $prPOST['data']['pages'][0];
  $no_of_copy = $prPOST['data']['no_of_copy'][0];
  $total_no_pages = $prPOST['data']['total_no_pages'][0];
  $binding = $prPOST['data']['binding'][0];
  $pick_up_date = $prPOST['pick_up_date'];
  $optradio = $prPOST['data']['optradio'][1];
  $from = $prPOST['data']['from'][0];
  $to = $prPOST['data']['to'][0];
  $timeslotval = $prPOST['timeslot'];

  ?><script>
  $("#collapseTwo").slideDown();
  $("#collapseThree").slideDown();
  </script><?php
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PrintItNow</title>
  <?php $this->load->view('includes/head'); ?>
</head>
<body>
<?php $this->load->view('includes/header'); ?>
<section>
  <div class="container">
    <div class="col-md-12">
      <div class="form-wrap">
        <form id="UploadForm" autocomplete="off" name="UploadForm" method="post" action="<?php echo MAINSITE_URL_INDEX.'confirm_order'?>" enctype="multipart/form-data">
          <input type="hidden" value="1" name="printorder" />
        <div class="panel-group" id="accordion">
          
          <?php #Error Message ?>
          <span id="p_err"><?php
            if( isset($prErr) && !empty($prErr) )
            {
              foreach( $prErr as $eachErr ){ echo "<span style=\"color:#ff0000;\">".$eachErr."<br /></span>"; }
            }
          ?></span>
          
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"><a href="javascript:void(0)" id="user_info"> <span class="glyphicon glyphicon-minus"></span> Step#1 - User Information </a> </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
              <div class="panel-body  u-information">
                <fieldset class="user-inforamtion" id="deletetabs1">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <input type="text" placeholder="Name*" maxlength="30" id="p_name" name="name" class="form-control" value="<?php echo $name; ?>" />
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <input type="email*" name="email" maxlength="50" id="p_email" placeholder="jane@firefly.com*" class="form-control" value="<?php echo $email; ?>" />
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <input type="text" name="contact" maxlength="13" id="p_ph" placeholder="Contact Number*" class="form-control" value="<?php echo $contact; ?>" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="alternate_contact" maxlength="13" id="p_alt_ph" placeholder="Alternate Contact Number" class="form-control" value="<?php echo $alternate_contact; ?>" />
                  </div>
                  
                 <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="text-center">
                      <button class="btn btn-primary btn-sx print-now-bttn" type="button" id="upload-file-nxt">Upload File</button>
                  </div>
                 </div>
                 
              </fieldset>
              </div>
            </div>
          </div>
          
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"> <a href="javascript:void(0)" id="vender_info"> <span class="glyphicon glyphicon-plus"></span> Step#2 - Vendor Information</a> </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
              <div class="panel-body">
                <fieldset class="upload-file">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <select class="form-control sect-opt" id="p_vendor" name="vendor">
                        <option value="">Choose Your Vendor</option>
                        <?php
                        if( isset($vendors) && (!empty($vendors)) )
                        {
                          foreach( $vendors as $eachvend )
                          {
                            ?><option value="<?php echo $eachvend['id']; ?>" <?php echo ($vendor==$eachvend['id'])?"selected":""; ?> ><?php echo ucwords($eachvend['shop_name']); ?></option><?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <input type="text" class="form-control datepick" id="datepicker1" value="<?php echo $pick_up_date; ?>" name="pick_up_date" placeholder="Pick Up Date*">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <select class="form-control sect-opt" id="timeslot" name="timeslot">
                        <option value="">Time Slot*</option>
                        <?php
                        # Check available slots
                        $curtime = date("H");
                        if( isset($timeslots) && !empty($timeslots) )
                        {
                          if( $curtime >= 13 && $curtime <= 21 )
                          {
                            ?><option value="<?php echo $timeslots[0]['id']; ?>" <?php echo ($timeslotval==$timeslots[0]['id'])?"selected":""; ?> ><?php echo $timeslots[0]['start_time']." - ".$timeslots[0]['end_time']; ?></option><?php
                          }
                          ?><option value="<?php echo $timeslots[1]['id']; ?>" <?php echo ($timeslotval==$timeslots[1]['id'])?"selected":""; ?> ><?php echo $timeslots[1]['start_time']." - ".$timeslots[1]['end_time']; ?></option><?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-12 text-center"> <a href="javascript:void(0) " class="btn btn-default pull-right submit-bttn" id="next">Next</a> </div>
                  
                </fieldset>
              </div>
            </div>
          </div>
          
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"> <a href="javascript:void(0)" id="user_order"> <span class="glyphicon glyphicon-plus"></span> Step#3 - Order information </a> </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
              <div class="panel-body">
                <div id="AddFileInputBox">
                  
                  <fieldset class="upload-file1 m-b-30">  
                    <legend><a href="javascript:void(0)" style="color:#fff;" class="show_div" showing='1' value='1'>First File Uploading</a></legend>

        					 <div id="TabHideShow_1">
                    <div class="col-md-12 col-sm-12 col-xs-12 m-b-20">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="from-group">
                            <input type="file" name="file[]" class="form-control" placeholder="Upload Your File">
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6 cols-xs-12">
                       		<p style="padding-top:10px;">File types: doc,docx,pdf,ppt,jpg,jpeg,png</p>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <select class="form-control sect-opt" name="data[paper_size][]">
                          <option value="">Paper Size*</option>
                          <option value="A3" <?php echo ($paper_size=="A3")?"selected":""; ?> >A3</option>
                          <option value="A4" <?php echo ($paper_size=="A4")?"selected":""; ?> >A4</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="from-group">
                        <select class="form-control sect-opt" name="data[print_option][]">
                          <option value="">Print Option*</option>
                          <option value="Coloured" <?php echo ($print_option=="Coloured")?"selected":""; ?> >Coloured</option>
                          <option value="Black and White" <?php echo ($print_option=="Black and White")?"selected":""; ?> >Black & White</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <select class="form-control  sect-opt" name="data[print_sided][]">
                          <option value="Print one sided" <?php echo ($print_sided=="Print one sided")?"selected":""; ?> >Print one sided</option>
                          <option value="Print both sided" <?php echo ($print_sided=="Print both sided")?"selected":""; ?> >Print both sided</option>
                         </select>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <select class="form-control  sect-opt" name="data[orientation][]">
                          <option value="">Orientation*</option>
                          <option value="Landscape" <?php echo ($orientation=="Landscape")?"selected":""; ?> >Landscape</option>
                          <option value="Portrait" <?php echo ($orientation=="Portrait")?"selected":""; ?> >Portrait</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <select class="form-control  sect-opt" name="data[pages][]">
                          <option value="">Pages / sheet</option>
                          <option value="1" <?php echo ($pages=="1")?"selected":""; ?> >1</option>
                          <option value="2" <?php echo ($pages=="2")?"selected":""; ?> >2</option>
                          <option value="4" <?php echo ($pages=="4")?"selected":""; ?> >4</option>
                          <option value="6" <?php echo ($pages=="6")?"selected":""; ?> >6</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <input type="number" min="1" name="data[no_of_copy][]" value="<?php echo $no_of_copy; ?>" class="form-control" placeholder="No of Copies*">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <input type="number" min="1" name="data[total_no_pages][]" value="<?php echo $total_no_pages; ?>" class="form-control" placeholder="Total no pages*">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <select class="form-control  sect-opt" name="data[binding][]">
                          <option value="">Binding</option>
                          <option value="Wiro binding" <?php echo ($binding=="Wiro binding")?"selected":""; ?> >Wiro binding</option>
                          <option value="Soft binding" <?php echo ($binding=="Soft binding")?"selected":""; ?> >Soft binding</option>
                        </select>
                      </div>
                    </div>
                    <?php /*
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <input type="text" class="form-control datepick" id="datepicker1" value="<?php echo $pick_up_date; ?>" name="data[pick_up_date][]" placeholder="Pick Up Date*">
                      </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <input type="text" class="form-control" name="data[pick_up_time][]" placeholder="Pick Up Time">
                      </div>
                    </div>
                    */ ?>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <div class="form-group">
                        <div class="row">
                          <div class="pull-left">
                            <label class="">Print* &nbsp; &nbsp;</label>
                            <label class="radio-inline no-pad-right">
                              <input type="radio" value="all" <?php echo ($optradio=="all" )?"checked":""; ?> name="data[optradio][1]">
                              All Pages</label>
                            <label class="radio-inline no-pad-right">
                              <input type="radio" value="cus" name="data[optradio][1]" <?php echo ($optradio=="cus" || $optradio=="" )?"checked":""; ?> >
                              Custom</label>
                          </div>
                          <div id="fromdiv" class="col-md-2 col-sm-2 col-xs-12 pad">
                            <div class="from-group">
                              <input type="number" min="0" name="data[from][]" value="<?php echo $from; ?>" class="form-control" placeholder="From">
                            </div>
                          </div>
                          <div id="todiv" class="col-md-2 col-sm-2 col-xs-12 pad">
                            <div class="from-group">
                              <input type="number" min="0" name="data[to][]" value="<?php echo $to; ?>" class="form-control" placeholder="To">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
				          </div>
                </fieldset>
				      
              </div>
                
              <div class="col-md-12 text-center">
                <a href="#" id="AddMoreFileBox" class="btn btn-default pull-right submit-bttn">Add More</a>
                <input type="button" id="btn_save" name="submit1" value="Submit" class="btn btn-default pull-right submit-bttn m-l-5">
              </div>
            
            </div>
          </div>
        </div>
      </div>
		  <?php /*<div id="progressbox"><div id="progressbar"></div ><div id="statustxt">0%</div ></div>*/ ?>
    </form>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/foot'); ?>
</body>
</html>