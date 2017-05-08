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
                <div class="col-sm-12 col-md-12 well" id="content">
                  <div class="profile_block">
                    <div class="group_block">
                      <label class="block_label"><span class="icon"><i class="fa fa-user" aria-hidden="true"></i></span> Name</label>
                      <p>Aleem Javed</p>
                    </div>
                    <div class="group_block">
                      <label class="block_label"><span class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></span> Email</label>
                      <p><a href="mailto:aleem.javed@vibescom.in">aleem.javed@vibescom.in</a></p>
                    </div>
                    <div class="group_block">
                      <label class="block_label"><span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span> Address</label>
                      <p>E-22, Sector-8, Vibes Communication</p>
                    </div>
                    <div class="group_block">
                      <label class="block_label"><span class="icon"><i class="fa fa-phone" aria-hidden="true"></i></span> Contact No</label>
                      
                      <p contenteditable="true">+91 9015080818</p>
                    </div>
                    <div class="group_block">
                      <label class="block_label"><span class="icon"><i class="fa fa-mobile" aria-hidden="true"></i></span> Altenate Contact No</label>
                      <p contenteditable="true">+91 9080818150</p>
                    </div>
                    <div class="group_block">
                      <label class="block_label"><span class="icon"><i class="fa fa-key" aria-hidden="true"></i></span> Reset Password</label>
                      <p contenteditable="true"><a href="javascript:void(0);" id="changepass" class="btn btn-primary">Change Password</a></p>
                    </div>
                    <div class="pass_col" >
                      <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                          <div class="group_block">
                            <label class="block_label"><span class="icon"><i class="fa fa-key" aria-hidden="true"></i></span> Old Password</label>
                            <p><input class="form-control " id="" name="" placeholder="Old Password" type="password"></p>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                          <div class="group_block">
                            <label class="block_label"><span class="icon"><i class="fa fa-key" aria-hidden="true"></i></span> New Password</label>
                            <p><input class="form-control " id="" name="" placeholder="New Password" type="password"></p>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                          <div class="group_block">
                            <label class="block_label"><span class="icon"><i class="fa fa-key" aria-hidden="true"></i></span> Confirm Password</label>
                            <p><input class="form-control " id="" name="" placeholder="Confirm Password" type="password"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="group_block">
                      <a class="print_btn btn btn-primary pull-left" href="javascript:void(0);"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</a>
                    </div>
                  </div>
                </div>
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
