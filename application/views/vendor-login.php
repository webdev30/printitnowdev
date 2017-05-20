<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PrintItNow </title>
<?php include'includes/head.php'; ?>
</head>
<body>


<section class="m-b-30">
   <div class="container">
    	<div class="row">
          <div class="login-page-logo">
              <img src="<?php echo MAINSITE_URL_ASSETS; ?>images/print-logo.png"/ width=" " height=" " alt="logo">
              <br /><span id="vlog-err" style="color:#ff0000;"><?php echo (isset($logErr) && $logErr!="" )?$logErr:""; ?></span>
          </div>
          <div class="module form-module">

              <?php 
              if( !isset($case) )
              {
                # Login Module ?>
                <div class="form" id="login-step1">
                  <h2>Login to your account</h2>
                  <form method="post" action="" autocomplete="off" id="log-form">
                      <input type="text" placeholder="Username*" value="" name="log_usr" id="log_usr" maxlength="50" />
                      <input type="password" placeholder="Password*" value="" name="log_pass" id="log_pass" maxlength="20" />
                      <a class="sub-btn" id="vlogin">Login</a>
                  </form>
                  <?php
                  if( !isset($admincase) )
                  {
                    ?>
                    <div class="toggle">
                      <i class="fa fa-times fa-pencil"></i> Forgot your password?
                    </div>
                    <?php
                  }
                  ?>
                </div>
                
                <?php # Forget Password ?>
                <div class="form" id="login-step2">
                  <h2>Forget Password</h2>
                  <form method="post" autocomplete="off" id="pass-form" action="" >
                    <input type="text" placeholder="Username*" value="" name="f_user" id="f_user" maxlength="50" />
                    <a class="sub1 sub-btn" id="vfpass">Submit</a>
                  </form>
                </div>
                <?php
              }
              else
              {
                # Reset Password
                ?>
                <div class="form" id="login-step3" style="display:block;">  
                  <h2>Reset Password</h2>
                  <form method="post" autocomplete="off" id="rpass-form" action="" >
                      <input type="text" placeholder="New Password*" value="" name="res_pass" id="res_pass" maxlength="20" />
                      <input type="text" placeholder="Confirm Password*" value="" name="resc_pass" id="resc_pass" maxlength="20" />
                      <a class="sub-btn" id="vrespass" >Submit</a>
                  </form>
                </div>
                <?php
              }
              ?>              
              
            </div>   
         </div>
    </div>
</section>

<?php include'includes/foot.php'; ?>

</body>
</html>