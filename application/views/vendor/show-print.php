<div class="modal-body">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <div class="user_info">
          <?php
          if( isset($printCust) && !empty($printCust) )
          {
            ?>
            <span class="ref_no"><?php echo $printCust[0]['order_reference_no']; ?></span>
            <ul>
              <li><p><span class="title"><i class="fa fa-user" aria-hidden="true"></i></span> <?php echo $printCust[0]['name']; ?></p></li>
              <li><p><span class="title"><i class="fa fa-phone" aria-hidden="true"></i></span> <?php echo $printCust[0]['contact'];  echo ($printCust[0]['alternate_contact']!="")?",&nbsp;".$printCust[0]['alternate_contact']:""; ?></p></li>
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
            foreach( $printData as $eachPrint )
            {
              ?>
              <div class="file_info">
                <div class="header">
                   <p><span class="title">
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
                    </span> <?php echo $eachPrint['file_name']; ?></p>
                   <span onclick="window.open('<?php echo MAINSITE_URL_ASSETS."uploads/".$eachPrint['file_name']; ?>');" class="download"><i class="fa fa-download" aria-hidden="true"></i></span>
                </div>
                <ul class="clearfix">
                   <li><p><span class="title">Paper Size:-</span> <?php echo $eachPrint['paper_size']; ?></p></li>
                   <li><p><span class="title">Print Option:-</span> <?php echo $eachPrint['print_option']; ?></p></li>
                   <li><p><span class="title">Print Side:-</span> <?php echo $eachPrint['sides']; ?></p></li>
                   <li><p><span class="title">Orientation:-</span> <?php echo $eachPrint['orientation']; ?></p></li>
                   <li><p><span class="title">Pages/Sheet:-</span> <?php echo $eachPrint['slides_per_page']; ?> Pages</p></li>
                   <li><p><span class="title">No of Copies:-</span> <?php echo $eachPrint['copy_count']; ?> Copies</p></li>
                   <li><p><span class="title">Total Pages:-</span> <?php echo $eachPrint['page_count']; ?> Pages</p></li>
                   <li><p><span class="title">Binding:-</span> <?php echo $eachPrint['binding']; ?></p></li>
                   <li><p><span class="title">Pick-up Date:-</span> <?php echo date("M d' Y", strtotime($eachPrint['pickup_date'])); ?></p></li>
                   <li><p><span class="title">Print:-</span> <?php echo $eachPrint['print_page']; ?> Pages</p></li>
                </ul>
              </div>
              <?php
            }
          }
          ?>
       
       </div>
      </div>

      <div class="modal-footer">
        <a class="print_btn btn btn-primary pull-left" href="javascript:void(0);"><i class="fa fa-print" aria-hidden="true"></i> Print Reciept</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>