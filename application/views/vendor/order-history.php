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
                    <h1>Order History</h1>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12 well" id="content">
                    <div class="table-responsive">
                        <table class="table table-hover">
                             <thead>
                                <tr>
                                    <th>Ref. no.</th>
                                    <th>Order Date</th>
                                    <th>Customer Info</th>
                                    <th>Delivery Date</th>
                                    <th class="text-center">View</th>
                                </tr>
                             </thead>
                             <tbody>
                                <?php
                                if( isset($ordHisResults) && !empty($ordHisResults) )
                                {
                                  foreach ($ordHisResults as $history)
                                  {
                                    ?>
                                    <tr>
                                      <td><?php echo $history['order_reference_no']; ?></td>
                                      <td><?php echo date("M d' Y g:i A", strtotime($history['created_on'])); ?></td>
                                      <td><?php echo ucwords($history['name']); ?><br /><?php echo $history['contact']; ?></td>
                                      <td><?php echo date("M d' Y", strtotime($history['deliver_date'])); ?><br />
                                        Status:&nbsp;<?php echo "Delivered"; ?></td>
                                      <td class="text-center"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#myModal1" id="vieworder_<?php echo $history['order_reference_id']; ?>_his" ></i></td>
                                    </tr>
                                    <?php
                                  }
                                }
                                else
                                {
                                  echo "<tr><td colspan=\"5\">No current orders are available</td></tr>";
                                } ?>
                             </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <?php include'includes/footer.php'; ?>
    </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->

<?php #Orders Popup -------------------------------------- ?>
<div id="myModal" class="modal user_detail_modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" id="modal-content-div" >
    
    </div>
  </div>
</div>

</body>
<?php include'includes/foot.php'; ?>
</html>