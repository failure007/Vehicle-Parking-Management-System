<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsuid']==0)) {
  header('location:logout.php');
  } else{

    if($_GET['payId']){
        $payId=$_GET['payId'];
        $vehId=$_GET['veh_id'];
        mysqli_query($con,"Update tbbookedslots SET veh_status = 'out' where id ='$payId'");
        mysqli_query($con,"Update tblvehicle SET Status = 'Out' where id ='$vehId'");
        echo "<script>alert('Payment done successfully.');</script>";
        echo "<script>window.location.href='my-bookings.php'</script>";
    }
    
    $booking_id = $_GET['booking_id'];
    $booking_data = mysqli_query($con, "SELECT bs.id as booking_id, check_in_time, VehicleCost 
    FROM tbbookedslots bs
    INNER JOIN tblcategory v ON bs.vehicle_cat = v.ID
    WHERE bs.id = '$booking_id'");
    $BookData = mysqli_fetch_array($booking_data);
    $checkInTime = $BookData['check_in_time'];
    $VehicleCost = $BookData['VehicleCost'];

    // echo "<script>alert('$BookData');</script>";
  }

  ?>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentDateTime = new Date();
        var formattedDateTime = currentDateTime.toLocaleString();
        var checkInTime = new Date('<?php echo $checkInTime; ?>');
        var VehicleCost = '<?php echo $VehicleCost; ?>';
        var timeDifference = currentDateTime - checkInTime;
        var hoursDifference = timeDifference / (1000 * 60 * 60); // Convert milliseconds to hours

        var parkingCharge = Math.round(hoursDifference * VehicleCost);
        parkingCharge = parseInt(parkingCharge);

        document.getElementById("parkingChargeDisplay").textContent = parkingCharge;
    });

        
    </script>
   
    
<!doctype html>

<html class="no-js" lang="">
<head>
   
    <title>VPMS - View Vehicle Detail</title>
   

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="../admin/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../admin/assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
    <!-- Left Panel -->

  <?php include_once('includes/sidebar.php');?>

    <!-- Left Panel -->

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
                                    <li><a href="view-vehicle.php">View Vehicle</a></li>
                                    <li class="active">View Vehicle details</li>
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
                   
         

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Vehicle Parking Payment details</strong>
                        </div>
                        <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Parking Number</th>
                                    <th>Owner Name</th>
                                    <th>Vehicle Reg Number</th>
                                    <th>Parking Charge</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php
                                $ownerno=$_SESSION['vpmsumn'];
                                $ret=mysqli_query($con,"SELECT bs.id as booking_id, v.ID as veh_id, v.ParkingNumber, v.OwnerName, v.RegistrationNumber
                                FROM tbbookedslots bs
                                INNER JOIN tblvehicle v ON bs.vehicle_id = v.ID
                                WHERE bs.id = '$booking_id'");
                                $cnt=1;
                                while ($row=mysqli_fetch_array($ret)) {
                                ?>
                            
                                <tr>                 
                                    <td><?php  echo $row['ParkingNumber'];?></td>
                                    <td><?php  echo $row['OwnerName'];?></td>
                                    <td><?php  echo $row['RegistrationNumber'];?></td>
                                    <td>$<span id="parkingChargeDisplay"></span>.00</td>
                                    <td>
                                        <!-- <button name="submit" class="btn btn-primary btn-sm">pay</button> -->
                                        <a href="payment-detail.php?payId=<?php echo $row['booking_id'];?>&veh_id=<?php echo $row['veh_id'];?>" class="btn btn-primary btn-sm">Pay</a>

                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
                

  


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
<script src="../admin/assets/js/main.js"></script>


</body>
</html>
<?php }  ?>