<?php
// Start the user session and suppress error reporting
session_start();
error_reporting(0);
// Include the database connection file
include('includes/dbconnection.php');
// Check if the admin is logged in; if not, redirect to the logout page
if (strlen($_SESSION['vpmsaid']==0)) {
  header('location:logout.php');
  } else{
// If the admin is logged in, proceed with the following logic

// Check if the form is submitted
if(isset($_POST['submit']))
  {
    // Get session and form data
    $aid=$_SESSION['vpmsaid'];
    $catname=$_POST['catename'];
    $vehicle_cost=$_POST['vehicle_cost'];
    $eid=$_GET['editid'];
   // Update category details in the database
    $query=mysqli_query($con, "update tblcategory set VehicleCat='$catname', VehicleCost='$vehicle_cost' where ID='$eid'");
    // Check if the update was successful
    if ($query) {
    // Redirect to the manage-category.php page
    // echo "<script>alert('Category Details updated');</script>";
    header('location:manage-category.php');
  }
  else
    {
     // Display an error message if the update fails
      echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }

  }
  ?>
<!doctype html>
<html class="no-js" lang="">
<head>
    
    <title>VPMS - Manage Category</title>
   

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
   <?php include_once('includes/sidebar.php');?>
    <!-- Right Panel -->

   <?php include_once('includes/header.php');?>

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li><a href="manage-category.php">Category</a></li>
                                    <li class="active">Update Category</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            
                           
                        </div> <!-- .card -->

                    </div><!--/.col-->

              

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Update </strong> Category
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    
                     
                     <?php
 $cid=$_GET['editid'];
$ret=mysqli_query($con,"select * from  tblcategory where ID='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>              
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Category Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="catename" name="catename" class="form-control" placeholder="Vehicle Category" required="true" value="<?php  echo $row['VehicleCat'];?>"></div>

                                        <div class="col col-md-3 mt-4"><label for="text-input" class=" form-control-label">Vehicle Cost</label></div>
                                        <div class="col-12 col-md-9 mt-4"><input type="number" id="vehicle_cost" name="vehicle_cost" class="form-control" placeholder="Vehicle Cost $/h" required="true" value="<?php  echo $row['VehicleCost'];?>"></div>
                                    </div>
                                 
                                    <?php } ?>
                                    
                                   <p style="text-align: center;"> <button type="submit" class="btn btn-primary btn-sm" name="submit" >Update</button></p>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-lg-6">
                        
                  
                </div>

           

            </div>


        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

   <?php include_once('includes/footer.php');?>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
<?php }  ?>