<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Dashboard</title>
  <?php include'includes/head.php'; ?>
</head>
<body>
<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">
  <?php include'includes/header.php'; ?>

    <div id="page-wrapper">
      <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row" id="main" >
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="page_inner_heading">
              <h1>Profile</h1>
            </div>
          </div>

          <?php
          if( isset($getVendor) && !empty($getVendor) )
          {
            ?>
            <div class="col-sm-12 col-md-12 well" id="content">
              <div class="profile_block">
                <div class="group_block">
                  <label class="block_label"><span class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span> Vendor Name</label>
                  <p><?php echo ucwords($getVendor[0]['shop_name']); ?></p>
                </div>
                <div class="group_block">
                  <label class="block_label"><span class="icon"><i class="fa fa-user" aria-hidden="true"></i></span> Contact Person</label>
                  <p><?php echo ucwords($getVendor[0]['contact_person_name']); ?></p>
                </div>
                <div class="group_block">
                  <label class="block_label"><span class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></span> Email</label>
                  <p><a href="mailto:<?php echo $getVendor[0]['email']; ?>"><?php echo $getVendor[0]['email']; ?></a></p>
                </div>
                <div class="group_block">
                  <label class="block_label"><span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span> Address</label>
                  <p><?php echo $getVendor[0]['address']; ?></p>
                </div>
                <div class="group_block">
                  <label class="block_label"><span class="icon"><i class="fa fa-phone" aria-hidden="true"></i></span> Contact No</label>                      
                  <p contenteditable="true"><?php echo $getVendor[0]['contact']; ?></p>
                </div>
                <div class="group_block">
                  <label class="block_label"><span class="icon"><i class="fa fa-mobile" aria-hidden="true"></i></span> Alternate Contact No</label>
                  <p contenteditable="true"><?php echo $getVendor[0]['alternate_contact']; ?></p>
                </div>
                <div class="group_block">
                  <!--<label class="block_label"><span class="icon"><i class="fa fa-key" aria-hidden="true"></i></span> Reset Password</label>-->
                  <p contenteditable="true"><a href="javascript:void(0);" id="changepass" class="btn btn-primary">Change Password</a></p>
                </div>

                <div class="pass_col" id="pass_col_div" ><form id="changepassform" autocomplete="off" >
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                      <div class="group_block">
                        <label class="block_label"><span class="icon"><i class="fa fa-key" aria-hidden="true"></i></span> Old Password</label>
                        <p><input class="form-control " id="oldpass" name="oldpass" maxlength="20" placeholder="Old Password*" type="password"></p>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                      <div class="group_block">
                        <label class="block_label"><span class="icon"><i class="fa fa-key" aria-hidden="true"></i></span> New Password</label>
                        <p><input class="form-control " id="newpass" name="newpass" maxlength="20" placeholder="New Password*" type="password"></p>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                      <div class="group_block">
                        <label class="block_label"><span class="icon"><i class="fa fa-key" aria-hidden="true"></i></span> Confirm Password</label>
                        <p><input class="form-control " id="conpass" name="conpass" maxlength="20" placeholder="Confirm Password*" type="password"></p>
                      </div>
                    </div>
                  </div>
                  <div class="group_block">
                    <a class="print_btn btn btn-primary pull-left" id="changepassgo" href="javascript:void(0);"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</a>&nbsp;&nbsp;
                    <a class="print_btn btn btn-primary pull-left" id="changepassno" href="javascript:void(0);"><i class="fa fa-paper-plane" aria-hidden="true"></i> Cancel</a>
                    <br /><span id="changepasserr"></span>
                    <br /><span>Note*:&nbsp;Please mail at info@printitnow.in for any changes/updates in profile.</span>
                  </div>
                </form></div>
                      
              </div>
            </div>
            <?php
          }
          ?>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      <?php include'includes/footer.php'; ?>
    </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->


<script>
$(document).ready(function(){
    $("#changepass").click(function(){
        $(".pass_col").addClass("show")
    });
});
</script>


</body>

 <?php include'includes/foot.php'; ?>

</html>
