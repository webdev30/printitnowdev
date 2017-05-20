<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
     <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top_strip"></div> -->
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header category_top">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:void;">
                <img src="<?php echo MAINSITE_URL_ASSETS?>vendor/images/logo.png" alt="LOGO">
            </a>
        </div>

        <div class="navbar-header top_nav">
            <!-- <a class="navbar-brand" href="javascript:void;">
                <img src="images/logo.png" alt="LOGO">
            </a> -->
             <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li>
                    <a><i class="fa fa-user" aria-hidden="true"></i> <?php 
                    if( isset($_SESSION['vendorname']) ){ echo $_SESSION['vendorname']; }
                    if( isset($_SESSION['adminname']) ){ echo $_SESSION['adminname']; }
                    ?></a>
                </li>            
                <li class="dropdown">
                    <?php 
                    if( isset($_SESSION['vendorid']) )
                    {
                        ?><a href="logout" onclick="window.location.href='<?php echo MAINSITE_URL; ?>logout'" class="dropdown-toggle" data-toggle="dropdown"><?php
                    }
                    else
                    {
                        ?><a href="adminpanel/logout" onclick="window.location.href='<?php echo MAINSITE_URL; ?>adminpanel/logout'" class="dropdown-toggle" data-toggle="dropdown"><?php   
                    }
                    ?>
                    <i class="fa fa-fw fa-power-off"></i> Logout</a>
                </li>
            </ul>
        </div>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    
                </li>
                <li>
                    <?php 
                    if( isset($_SESSION['vendorid']) )
                    {
                        ?><a href="<?php echo MAINSITE_URL; ?>vendor"><?php
                    }
                    else
                    {
                        ?><a href="<?php echo MAINSITE_URL; ?>admin-board"><?php   
                    }
                    ?>
                    <i class="fa fa-fw fa-paper-plane-o"></i> Current Orders</a>
                </li>
                <li>
                    <?php 
                    if( isset($_SESSION['vendorid']) )
                    {
                        ?><a href="<?php echo MAINSITE_URL; ?>order-history"><?php
                    }
                    else
                    {
                        ?><a href="<?php echo MAINSITE_URL; ?>adminpanel/order-history"><?php   
                    }
                    ?>
                    <i class="fa fa-fw fa-paper-plane-o"></i> Order History</a>
                </li>
                
                <?php 
                # Profile page of vendor
                if( isset($_SESSION['vendorid']) )
                {
                    ?>
                    <li>
                        <a href="<?php echo MAINSITE_URL; ?>profile"><i class="fa fa-fw fa-user-plus"></i> Profile</a>
                    </li>
                    <?php
                }
                ?>
               
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
