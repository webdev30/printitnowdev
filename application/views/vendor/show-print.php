<div class="modal-body">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <div class="user_info">
          <?php
          if( isset($printCust) && !empty($printCust) )
          {
            ?>
            <div class="header clearfix">
              <span class="ref_no"><?php echo $printCust[0]['order_reference_no']; ?></span>
              <?php
              if( isset($_SESSION['adminid']) )
              {
                echo "Total:&nbsp;Rs 800";
              }
              else
              {
                ?><a class="print_btn btn btn-primary" onclick="printFunc();" href="javascript:void(0);"><i class="fa fa-print" aria-hidden="true"></i> Print Reciept</a><?php
              }
              ?>
           </div>
            <ul>
              <li><p><span class="title"><i class="fa fa-user" aria-hidden="true"></i></span> <?php echo $printCust[0]['name']; ?></p></li>
              <li><p><span class="title"><i class="fa fa-phone" aria-hidden="true"></i></span> <?php echo $printCust[0]['contact'];  echo ($printCust[0]['alternate_contact']!="")?",&nbsp;".$printCust[0]['alternate_contact']:""; ?></p></li>
              <?php
              if( isset($_SESSION['adminid']) )
              {
                ?><li><p><span class="title"><i class="fa fa-envelope" aria-hidden="true"></i></span> <?php echo $printCust[0]['email']; ?></p></li><?php
              }
              ?>
            </ul>
            <?php
          }
          ?>
          <!-- <li><p><span class="title"><i class="fa fa-envelope" aria-hidden="true"></i></span> example@gmail.com</p></li> -->
       </div>
       <div class="block">
          <?php 
          if( isset($printData) && !empty($printData) )
          {
            $i = 0;
            foreach( $printData as $eachPrint )
            {
              ?>
              <div class="file_info">
                <div class="header">
                  <p>
                    <span class="slno"><?php echo ++$i; ?></span>
                    <span class="title">
                    <?php 
                    switch( $eachPrint['file_type'] )
                    {
                      case 'jpg':
                      case 'jpeg':
                      case 'png':
                        echo "<i class=\"fa fa-file-image-o\" aria-hidden=\"true\"></i>";
                        break;
                      case 'doc':
                      case 'docx':
                        echo "<i class=\"fa fa-file-text-o\" aria-hidden=\"true\"></i>";
                        break;
                      case 'pdf':
                        echo "<i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\"></i>";
                        break;
                      case 'ppt':
                        echo "<i class=\"fa fa-file-powerpoint-o\" aria-hidden=\"true\"></i>";
                        break;
                    } 
                    ?>
                    </span> <?php echo $eachPrint['file_name']; ?>
                  </p>

                  <?php
                  # File Download
                  if( isset($urlbase) && $urlbase!="his" && !isset($_SESSION['adminid']) )
                  {
                    ?>
                    <span id="fileid<?php echo $eachPrint['id']; ?>" onclick="filetrack('<?php echo $eachPrint['file_name']; ?>', <?php echo $eachPrint['id']; ?>, '<?php echo MAINSITE_URL_ASSETS."uploads/"; ?>');" class="download"><i class="fa fa-download" aria-hidden="true"></i>
                    <?php 
                    if( isset($printTrackIds) && !empty($printTrackIds) && in_array($eachPrint['id'], $printTrackIds) )
                    {
                      ?><span class="check"><i class="fa fa-check" aria-hidden="true"></i></span><?php
                    } 
                    ?>
                    </span><?php
                  }
                  ?>
                </div>
                <ul class="clearfix">
                  <li><p><span class="title">Paper Size:-</span> <?php echo $eachPrint['paper_size']; ?></p></li>
                  <li><p><span class="title">Print Option:-</span> <?php echo $eachPrint['print_option']; ?></p></li>
                  <li><p><span class="title">Print Side:-</span> <?php echo $eachPrint['sides']; ?></p></li>
                  <li><p><span class="title">Orientation:-</span> <?php echo $eachPrint['orientation']; ?></p></li>
                  <li><p><span class="title">Pages/Sheet:-</span> <?php echo $eachPrint['slides_per_page']; ?> Page<?php echo ($eachPrint['slides_per_page']>1)?"s":""; ?></p></li>
                  <li><p><span class="title">No of Copies:-</span> <?php echo $eachPrint['copy_count']; ?> <?php echo ($eachPrint['copy_count']>1)?"Copies":"Copy"; ?></p></li>
                  <li><p><span class="title">Total Pages:-</span> <?php echo $eachPrint['page_count']; ?> Page<?php echo ($eachPrint['page_count']>1)?"s":""; ?></p></li>
                  <li><p><span class="title">Binding:-</span> <?php echo $eachPrint['binding']; ?></p></li>
                  <li><p><span class="title">Print:-</span> <?php echo $eachPrint['print_page']; ?> Pages
                  <?php
                  if( $eachPrint['print_page']=="Custom" )
                  {
                    /*?><span title="from" class="from"><?php echo $eachPrint['page_from']; ?></span>&nbsp;-&nbsp;<span class="to" title="to"><?php echo $eachPrint['page_to']; ?></span><?php*/
                    echo "(".$eachPrint['page_from']."&nbsp;-&nbsp;".$eachPrint['page_to'].")";
                  }
                  ?>
                  </p></li>
                </ul>
              </div>
              <?php
            }
          }
          ?>
       
       </div>
      </div>

      <div class="modal-footer">
        <?php /*<a class="print_btn btn btn-primary pull-left" href="javascript:void(0);"><i class="fa fa-print" aria-hidden="true"></i> Print Reciept</a>*/ ?>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>


<?php # Receipt Layout ?>
<iframe name="print_frame" style="display:none;" width="0" height="0" frameborder="0"  src="about:blank">
    <div class="user_info">
    <?php
    if( isset($printCust) && !empty($printCust) )
    {
      ?>
      <html>
        <head>
          <title></title>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        </head>
        <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
          <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr>
              <td colspan="2" style="padding:10px; background:#f5f5f5; border-top:1px solid #dddddd; border-bottom:1px solid #dddddd; width:60%;"><span style="font-size: 25px; font-weight: bold; display: inline-block; text-align:left;"><?php echo $printCust[0]['order_reference_no']; ?></span></td>
               <td style="border-top:1px solid #dddddd; border-bottom:1px solid #dddddd; padding:10px; width:30%; text-align:right;">
                <?php 
                if( isset($vendorData) && !empty($vendorData) )
                {
                  ?><p style="font-size:14px;"><?php echo ucwords($vendorData[0]['shop_name']); ?><br> 
                  <?php echo $vendorData[0]['address']; ?></p><?php
                }
                ?>
              </td>
            </tr>
            <tr>
              <td style="border-bottom:1px solid #dddddd; padding:10px; width:30%;">
                <p style="font-size:14px; font-weight:bold;">Name</p>
              </td>
              <td colspan="2" style="border-bottom:1px solid #dddddd; padding:10px; width:70%;">
                <p style="font-size:14px; font-weight:normal;"><?php echo $printCust[0]['name']; ?></p>
              </td>
            </tr>
            <tr>
              <td style="border-bottom:1px solid #dddddd; padding:10px; width:30%;">
                <p style="font-size:14px; font-weight:bold;">Contact No.</p>
              </td>
              <td colspan="2" style="border-bottom:1px solid #dddddd; padding:10px; width:70%;">
                <p style="font-size:14px; font-weight:normal;"><?php echo $printCust[0]['contact'];  echo ($printCust[0]['alternate_contact']!="")?",&nbsp;".$printCust[0]['alternate_contact']:""; ?></p>
              </td>
            </tr>
            <tr>
              <td style="border-bottom:1px solid #dddddd; padding:10px; width:30%;">
                <p style="font-size:14px; font-weight:bold;">Total Files</p>
              </td>
              <td colspan="2" style="border-bottom:1px solid #dddddd; padding:10px; width:70%;">
                <p style="font-size:14px; font-weight:normal;"><?php echo count($printData); ?></p>
              </td>
            </tr>
          </table>
        </body>
      </html>
      <?php
    }
    ?>
   </div>
</iframe>