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
                    <h1>Current Orders</h1>
                    <form method="post" id="cosearch" action="" style="display: inline-block; float: right;">
                    <ul class="inputs">
                      <li><input id="filtergo" value="Go" name="filtergo" type="button" ></li>
                      <li><input class="form-control" id="filterval" name="filterval" maxlength="30" type="text"></li>
                    </ul>
                    <div class="top_filter">
                      <select class="selectpicker" id="filteropt" name="filteropt" onchange="showFilterIp(this.value);">
                        <?php/*<option value="">Search By</option>*/?>
                        <option value="all">All</option>
                        <option value="pd">Pickup Date</option>
                        <option value="rn">Ref. no.</option>
                        <option value="od">Order Date</option>
                      </select>
                    </div>
                    </form>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12 well" id="content">
                    <div class="table-responsiv">
                        <table class="table table-hover">
                             <thead>
                                <tr>
                                    <th>Ref. no.</th>
                                    <th>Order Date</th>
                                    <th>Customer Info</th>
                                    <th>Pickup Date</th>
                                    <th class="text-center">Total files</th>
                                    <th class="text-center">View</th>
                                    <th class="text-center">Status</th>
                                </tr>
                             </thead>
                             <tbody>
                                <?php 
                                if( isset($curOrdResults) && !empty($curOrdResults) )
                                {
                                  foreach( $curOrdResults as $eachResult )
                                  {
                                    ?>
                                    <tr>
                                      <td><?php echo $eachResult['order_reference_no']; ?></td>
                                      <td><?php echo date("M d' Y", strtotime($eachResult['created_on'])); ?>
                                        <br />at&nbsp;<?php echo date("g:i A", strtotime($eachResult['created_on'])); ?></td>
                                      <td><?php echo ucwords($eachResult['name']); ?><br /><?php echo $eachResult['contact']; ?></td>
                                      <td><?php echo date("M d' Y", strtotime($eachResult['pickup_date'])); ?><br />
                                        Time:&nbsp;<?php
                                        if( isset($timeslots) )
                                        {
                                          foreach ($timeslots as $value)
                                          {
                                            if( $value['id']==$eachResult['pickup_slot'] )
                                            {
                                              echo date("g:i a", strtotime($value['start_time']))." - ".date("g:i a", strtotime($value['end_time']));
                                            }
                                          }
                                        }
                                        ?></td>
                                      <td class="text-center"><?php echo $eachResult['filecount']; ?></td>
                                      <td class="text-center"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#myModal1" id="vieworder_<?php echo $eachResult['order_reference_id']; ?>_co"></i></td>
                                      <td class="text-center">
                                        <?php
                                        if( isset($admincase) && $admincase==1 )
                                        {
                                          switch($eachResult['order_status'])
                                          {
                                            case 1: echo "Recieved"; break;
                                            case 2: echo "Work In Progress"; break;
                                            case 3: echo "Complete"; break;
                                            case 4: echo "Delivered"; break;
                                            default: echo "Open"; break;
                                          }
                                        }
                                        else
                                        {
                                          ?>
                                          <select class="selectpicker" onchange="updatestatus(this.value, <?php echo $eachResult['order_reference_id']; ?>);" >
                                            <option value="" >Status</option>
                                            <option value="1" <?php echo ($eachResult['order_status']==1)?"selected":""; ?> >Recieved</option>
                                            <option value="2" <?php echo ($eachResult['order_status']==2)?"selected":""; ?> >Work In Progress</option>
                                            <option value="3" <?php echo ($eachResult['order_status']==3)?"selected":""; ?> >Complete</option>
                                            <option value="4" <?php echo ($eachResult['order_status']==4)?"selected":""; ?> >Delivered</option>
                                          </select>
                                          <p style="font:10px; color:#009900; text-align:center;" id="statup_<?php echo $eachResult['order_reference_id']; ?>" ></p>
                                          <?php
                                        }
                                        ?>
                                        <!--
                                        <div class="dropdown">
                                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
                                          <span class="caret"></span></button>
                                          <ul class="dropdown-menu">
                                            <li><a >Recieved</a></li>
                                            <li><a >Work In Progress</a></li>
                                            <li><a >Complete</a></li>
                                            <li><a >Delivered</a></li>
                                          </ul>
                                        </div> --> 
                                      </td>
                                    </tr>
                                    <?php
                                  }
                                }
                                else
                                {
                                  echo "<tr><td colspan=\"6\">No current orders are available</td></tr>";
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
