<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PrintItNow </title>
  <?php $this->load->view('includes/head'); ?>
</head>
<body>
<?php $this->load->view('includes/header'); ?>
<section class="m-b-30">
	<div class="container">
    <div class="row">
      <div class="user-review-page">
        <h2>Review Your order</h2>
        <p>Name: <?php echo (isset($_SESSION['user_info']['name']))?trim($_SESSION['user_info']['name']):""; ?></p>
        <p>Contact No : <?php echo (isset($_SESSION['user_info']['contact']))?trim($_SESSION['user_info']['contact']):""; ?> </p>
        <p>Email id : <?php echo $_SESSION['user_info']['email']?></p>
        <p>Alternate Contact No : <?php echo $_SESSION['user_info']['alternate_contact']?></p>
        
        <table class="table table-bordered table-sm m-0">
          <thead class="">
            <tr>
              <th>Product</th>
              <th>Pick Up Date</th>
              <th>Total Price</th>
            </tr>
            <?php
  					foreach( $_SESSION['data'] as $data )
            {
  						?>
              <tr>
                <td>
                  Paper Size : <?php echo $data['paper_size'] ?> <br>
                  Print Option : <?php echo $data['print_option'] ?><br>
                  Side : <?php echo $data['print_sided'] ?> <br>
                  Orientation : <?php echo $data['orientation'] ?> <br>
                  Sheet / pages :  <?php echo $data['pages'] ?> <br>
                  No of Copies : <?php echo $data['no_of_copy'] ?> <br>
                  Total no. pages : <?php echo $data['total_no_pages'] ?> <br>
                  binding :  <?php echo $data['binding']?><br>
                  Print Pages :  <?php echo ( isset($data['optradio']) && trim($data['optradio'])=="cus" )?"Custom":"All"; ?><br>
                  <?php if( isset($data['optradio']) && $data['optradio']=="cus" )
                  {
                    ?>From: <?php echo $data['from']?><br>
                    To: <?php echo $data['to']?><?php
                  } 
                  ?>
                </td>
                <td><?php echo date('M d\' Y', strtotime($data['pick_up_date'])); ?></td>
              </tr>
              <?php
  					}
  					?>
            <tr>
              <td colspan="5" class="text-right">Total : Rs 800</td>
            </tr>            
            <tr>
              <td  colspan="5"><div class="col-md-12 text-center"> <a href="<?php echo MAINSITE_URL_INDEX; ?>thank-you" class="btn btn-default pull-right submit-bttn">Pay Now</a> </div></td>
            </tr>
          </thead>
        </table>
                
      </div>
    </div>
  </div>
</section>
<?php 
$this->load->view('includes/footer');
$this->load->view('includes/foot');
?>
</body>
</html>