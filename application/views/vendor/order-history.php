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
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th class="text-center">View</th>
                                </tr>
                             </thead>
                             <tbody>
                                 <tr>
                                     <td>1</td>
                                     <td>03-05-2017</td>
                                     <td>Aleem Javed</td>
                                     <td>9015080818</td>
                                     <td class="text-center"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#myModal"></i></td>
                                 </tr>
                                 <tr>
                                     <td>2</td>
                                     <td>03-05-2017</td>
                                     <td>Aleem Javed</td>
                                     <td>9015080818</td>
                                     <td class="text-center"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#myModal"></i></td>
                                 </tr>
                                 <tr>
                                     <td>3</td>
                                     <td>03-05-2017</td>
                                     <td>Aleem Javed</td>
                                     <td>9015080818</td>
                                     <td class="text-center"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#myModal"></i></td>
                                 </tr>
                                 <tr>
                                     <td>4</td>
                                     <td>03-05-2017</td>
                                     <td>Aleem Javed</td>
                                     <td>9015080818</td>
                                     <td class="text-center"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#myModal"></i></td>
                                 </tr>
                                 <tr>
                                     <td>5</td>
                                     <td>03-05-2017</td>
                                     <td>Aleem Javed</td>
                                     <td>9015080818</td>
                                     <td class="text-center"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#myModal"></i></td>
                                 </tr>
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

<!-- Modal -->
<div id="myModal" class="modal user_detail_modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <!-- <div class="modal-header">
       
        <h4 class="modal-title">Modal Header</h4>
      </div> -->
      <div class="modal-body">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <div class="user_info">
           <span class="ref_no">1</span>
           <ul>
               <li><p><span class="title"><i class="fa fa-user" aria-hidden="true"></i></span> Aleem Javed</p></li>
               <li><p><span class="title"><i class="fa fa-phone" aria-hidden="true"></i></span> +91 9015080818, +91 9871104290</p></li>
               <!-- <li><p><span class="title"><i class="fa fa-envelope" aria-hidden="true"></i></span> example@gmail.com</p></li> -->
           </ul> 
       </div>
       <div class="block">
           <div class="file_info">
               <div class="header">
                   <p><span class="title"><i class="fa fa-file" aria-hidden="true"></i></span> resume.pdf</p>
                   <span class="download"><i class="fa fa-download" aria-hidden="true"></i></span>
               </div>
               <ul class="clearfix">
                   <li><p><span class="title">Paper Size:-</span> A4</p></li>
                   <li><p><span class="title">Print Option:-</span> Black & White</p></li>
                   <li><p><span class="title">Print Side:-</span> Print Both Side</p></li>
                   <li><p><span class="title">Orientation:-</span> Landscape</p></li>
                   <li><p><span class="title">Pages/Sheet:-</span> 5 Pages</p></li>
                   <li><p><span class="title">No of Copies:-</span> 3 Copies</p></li>
                   <li><p><span class="title">Total Pages:-</span> 15 Pages</p></li>
                   <li><p><span class="title">Binding:-</span> Wiro Binding</p></li>
                   <li><p><span class="title">Pick-up Date:-</span> 05-052017</p></li>
                   <li><p><span class="title">Print:-</span> All Pages</p></li>
               </ul>
           </div>
           <div class="file_info">
               <div class="header">
                   <p><span class="title"><i class="fa fa-file" aria-hidden="true"></i></span> resume.pdf</p>
                   <span class="download"><i class="fa fa-download" aria-hidden="true"></i></span>
               </div>
               <ul class="clearfix">
                   <li><p><span class="title">Paper Size:-</span> A4</p></li>
                   <li><p><span class="title">Print Option:-</span> Black & White</p></li>
                   <li><p><span class="title">Print Side:-</span> Print Both Side</p></li>
                   <li><p><span class="title">Orientation:-</span> Landscape</p></li>
                   <li><p><span class="title">Pages/Sheet:-</span> 5 Pages</p></li>
                   <li><p><span class="title">No of Copies:-</span> 3 Copies</p></li>
                   <li><p><span class="title">Total Pages:-</span> 15 Pages</p></li>
                   <li><p><span class="title">Binding:-</span> Wiro Binding</p></li>
                   <li><p><span class="title">Pick-up Date:-</span> 05-052017</p></li>
                   <li><p><span class="title">Print:-</span> All Pages</p></li>
               </ul> 
           </div>
           <div class="file_info">
               <div class="header">
                   <p><span class="title"><i class="fa fa-file" aria-hidden="true"></i></span> resume.pdf</p>
                   <span class="download"><i class="fa fa-download" aria-hidden="true"></i></span>
               </div>
               <ul class="clearfix">
                   <li><p><span class="title">Paper Size:-</span> A4</p></li>
                   <li><p><span class="title">Print Option:-</span> Black & White</p></li>
                   <li><p><span class="title">Print Side:-</span> Print Both Side</p></li>
                   <li><p><span class="title">Orientation:-</span> Landscape</p></li>
                   <li><p><span class="title">Pages/Sheet:-</span> 5 Pages</p></li>
                   <li><p><span class="title">No of Copies:-</span> 3 Copies</p></li>
                   <li><p><span class="title">Total Pages:-</span> 15 Pages</p></li>
                   <li><p><span class="title">Binding:-</span> Wiro Binding</p></li>
                   <li><p><span class="title">Pick-up Date:-</span> 05-052017</p></li>
                   <li><p><span class="title">Print:-</span> All Pages</p></li>
               </ul> 
           </div>
           <div class="file_info">
               <div class="header">
                   <p><span class="title"><i class="fa fa-file" aria-hidden="true"></i></span> resume.pdf</p>
                   <span class="download"><i class="fa fa-download" aria-hidden="true"></i></span>
               </div>
               <ul class="clearfix">
                   <li><p><span class="title">Paper Size:-</span> A4</p></li>
                   <li><p><span class="title">Print Option:-</span> Black & White</p></li>
                   <li><p><span class="title">Print Side:-</span> Print Both Side</p></li>
                   <li><p><span class="title">Orientation:-</span> Landscape</p></li>
                   <li><p><span class="title">Pages/Sheet:-</span> 5 Pages</p></li>
                   <li><p><span class="title">No of Copies:-</span> 3 Copies</p></li>
                   <li><p><span class="title">Total Pages:-</span> 15 Pages</p></li>
                   <li><p><span class="title">Binding:-</span> Wiro Binding</p></li>
                   <li><p><span class="title">Pick-up Date:-</span> 05-052017</p></li>
                   <li><p><span class="title">Print:-</span> All Pages</p></li>
               </ul> 
           </div>
           <div class="file_info">
               <div class="header">
                   <p><span class="title"><i class="fa fa-file" aria-hidden="true"></i></span> resume.pdf</p>
                   <span class="download"><i class="fa fa-download" aria-hidden="true"></i></span>
               </div>
               <ul class="clearfix">
                   <li><p><span class="title">Paper Size:-</span> A4</p></li>
                   <li><p><span class="title">Print Option:-</span> Black & White</p></li>
                   <li><p><span class="title">Print Side:-</span> Print Both Side</p></li>
                   <li><p><span class="title">Orientation:-</span> Landscape</p></li>
                   <li><p><span class="title">Pages/Sheet:-</span> 5 Pages</p></li>
                   <li><p><span class="title">No of Copies:-</span> 3 Copies</p></li>
                   <li><p><span class="title">Total Pages:-</span> 15 Pages</p></li>
                   <li><p><span class="title">Binding:-</span> Wiro Binding</p></li>
                   <li><p><span class="title">Pick-up Date:-</span> 05-052017</p></li>
                   <li><p><span class="title">Print:-</span> All Pages</p></li>
               </ul> 
           </div>
           <div class="file_info">
               <div class="header">
                   <p><span class="title"><i class="fa fa-file" aria-hidden="true"></i></span> resume.pdf</p>
                   <span class="download"><i class="fa fa-download" aria-hidden="true"></i></span>
               </div>
               <ul class="clearfix">
                   <li><p><span class="title">Paper Size:-</span> A4</p></li>
                   <li><p><span class="title">Print Option:-</span> Black & White</p></li>
                   <li><p><span class="title">Print Side:-</span> Print Both Side</p></li>
                   <li><p><span class="title">Orientation:-</span> Landscape</p></li>
                   <li><p><span class="title">Pages/Sheet:-</span> 5 Pages</p></li>
                   <li><p><span class="title">No of Copies:-</span> 3 Copies</p></li>
                   <li><p><span class="title">Total Pages:-</span> 15 Pages</p></li>
                   <li><p><span class="title">Binding:-</span> Wiro Binding</p></li>
                   <li><p><span class="title">Pick-up Date:-</span> 05-052017</p></li>
                   <li><p><span class="title">Print:-</span> All Pages</p></li>
               </ul> 
           </div>
           <div class="file_info">
               <div class="header">
                   <p><span class="title"><i class="fa fa-file" aria-hidden="true"></i></span> resume.pdf</p>
                   <span class="download"><i class="fa fa-download" aria-hidden="true"></i></span>
               </div>
               <ul class="clearfix">
                   <li><p><span class="title">Paper Size:-</span> A4</p></li>
                   <li><p><span class="title">Print Option:-</span> Black & White</p></li>
                   <li><p><span class="title">Print Side:-</span> Print Both Side</p></li>
                   <li><p><span class="title">Orientation:-</span> Landscape</p></li>
                   <li><p><span class="title">Pages/Sheet:-</span> 5 Pages</p></li>
                   <li><p><span class="title">No of Copies:-</span> 3 Copies</p></li>
                   <li><p><span class="title">Total Pages:-</span> 15 Pages</p></li>
                   <li><p><span class="title">Binding:-</span> Wiro Binding</p></li>
                   <li><p><span class="title">Pick-up Date:-</span> 05-052017</p></li>
                   <li><p><span class="title">Print:-</span> All Pages</p></li>
               </ul> 
           </div>
           <div class="file_info">
               <div class="header">
                   <p><span class="title"><i class="fa fa-file" aria-hidden="true"></i></span> resume.pdf</p>
                   <span class="download"><i class="fa fa-download" aria-hidden="true"></i></span>
               </div>
               <ul class="clearfix">
                   <li><p><span class="title">Paper Size:-</span> A4</p></li>
                   <li><p><span class="title">Print Option:-</span> Black & White</p></li>
                   <li><p><span class="title">Print Side:-</span> Print Both Side</p></li>
                   <li><p><span class="title">Orientation:-</span> Landscape</p></li>
                   <li><p><span class="title">Pages/Sheet:-</span> 5 Pages</p></li>
                   <li><p><span class="title">No of Copies:-</span> 3 Copies</p></li>
                   <li><p><span class="title">Total Pages:-</span> 15 Pages</p></li>
                   <li><p><span class="title">Binding:-</span> Wiro Binding</p></li>
                   <li><p><span class="title">Pick-up Date:-</span> 05-052017</p></li>
                   <li><p><span class="title">Print:-</span> All Pages</p></li>
               </ul> 
           </div>
           <div class="file_info">
               <div class="header">
                   <p><span class="title"><i class="fa fa-file" aria-hidden="true"></i></span> resume.pdf</p>
                   <span class="download"><i class="fa fa-download" aria-hidden="true"></i></span>
               </div>
               <ul class="clearfix">
                   <li><p><span class="title">Paper Size:-</span> A4</p></li>
                   <li><p><span class="title">Print Option:-</span> Black & White</p></li>
                   <li><p><span class="title">Print Side:-</span> Print Both Side</p></li>
                   <li><p><span class="title">Orientation:-</span> Landscape</p></li>
                   <li><p><span class="title">Pages/Sheet:-</span> 5 Pages</p></li>
                   <li><p><span class="title">No of Copies:-</span> 3 Copies</p></li>
                   <li><p><span class="title">Total Pages:-</span> 15 Pages</p></li>
                   <li><p><span class="title">Binding:-</span> Wiro Binding</p></li>
                   <li><p><span class="title">Pick-up Date:-</span> 05-052017</p></li>
                   <li><p><span class="title">Print:-</span> All Pages</p></li>
               </ul> 
           </div>
           <div class="file_info">
               <div class="header">
                   <p><span class="title"><i class="fa fa-file" aria-hidden="true"></i></span> resume.pdf</p>
                   <span class="download"><i class="fa fa-download" aria-hidden="true"></i></span>
               </div>
               <ul class="clearfix">
                   <li><p><span class="title">Paper Size:-</span> A4</p></li>
                   <li><p><span class="title">Print Option:-</span> Black & White</p></li>
                   <li><p><span class="title">Print Side:-</span> Print Both Side</p></li>
                   <li><p><span class="title">Orientation:-</span> Landscape</p></li>
                   <li><p><span class="title">Pages/Sheet:-</span> 5 Pages</p></li>
                   <li><p><span class="title">No of Copies:-</span> 3 Copies</p></li>
                   <li><p><span class="title">Total Pages:-</span> 15 Pages</p></li>
                   <li><p><span class="title">Binding:-</span> Wiro Binding</p></li>
                   <li><p><span class="title">Pick-up Date:-</span> 05-052017</p></li>
                   <li><p><span class="title">Print:-</span> All Pages</p></li>
               </ul> 
           </div>
       </div>
      </div>
      <div class="modal-footer">
        <a class="print_btn btn btn-primary pull-left" href="javascript:void(0);"><i class="fa fa-print" aria-hidden="true"></i> Print Reciept</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


</body>

 <?php include'includes/foot.php'; ?>

</html>
