<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if (isset($_GET['floor_level'])) {
        $floorLevel = $_GET['floor_level'];
    }

    $availableSlotsQuery = mysqli_query($con, "SELECT * FROM tbparkingslots WHERE floor_level='$floorLevel'");
    $get_no_of_slots = mysqli_fetch_assoc($availableSlotsQuery);
    $no_of_slots = $get_no_of_slots['no_of_blocks'];

    $getSlotsCount = mysqli_query($con, "SELECT COUNT(*) AS bookingSlotsCount FROM tbbookedslots WHERE floor_level='$floorLevel' and veh_status='in'");
    $resultCount = mysqli_fetch_assoc($getSlotsCount);
    $bookingCount = $resultCount['bookingSlotsCount'];

    $actualSlotsAvailable = $no_of_slots - $bookingCount;

  ?>
<!doctype html>
<html class="no-js" lang="">
<head>
    
    <title>VPMS - Add Vehicle</title>
   

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
                                    <li><a href="slots-available.php">slots Bookings</a></li>
                                    <li class="active">B<?php echo $floorLevel; ?></li>
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
                                <strong>B<?php echo $floorLevel; ?> Parking Slot Bookings</strong>
                                <span style="float:right;color:blue">Available Slots : <?php echo $actualSlotsAvailable; ?></span>
                            </div>
                            <div class="card-body card-block">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Parking Number</th>
                                            <th>Owner Name</th>
                                            <th>Owner Contact</th>
                                            <th>Reg Number</th>
                                            <th>Vehicle Company</th>
                                            <th>Slot Number</th>
                                            <th>Check In Date</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $ownerno=$_SESSION['vpmsumn'];
                                        $ret=mysqli_query($con,"SELECT bs.id as booking_id, bs.check_in_time as check_in, bs.booked_slot as slot_num, v.ParkingNumber, v.OwnerName, v.RegistrationNumber, v.VehicleCompanyname, v.OwnerContactNumber	
                                        FROM tbbookedslots bs
                                        INNER JOIN tblvehicle v ON bs.vehicle_id = v.ID WHERE bs.floor_level = '$floorLevel' and bs.veh_status='in'");
                                        while ($row=mysqli_fetch_array($ret)) {
                                        ?>
                
                                    <tr>
                                        <td><?php  echo $row['ParkingNumber'];?></td>
                                        <td><?php  echo $row['OwnerName'];?></td>
                                        <td><?php  echo $row['OwnerContactNumber'];?></td>
                                        <td><?php  echo $row['RegistrationNumber'];?></td>
                                        <td><?php  echo $row['VehicleCompanyname'];?></td>
                                        <td><?php  echo $row['slot_num'];?></td>
                                        <td><?php  echo $row['check_in'];?></td>
                                        
                                        </td>
                                    </tr>
                                    <?php }?>
                                </table>
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