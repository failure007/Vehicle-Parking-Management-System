<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsuid']==0)) {
  header('location:logout.php');
  } else{
    // $_POST['selected_blocks'] = [];

    if (isset($_GET['floor_level'])) {
        $floorLevel = $_GET['floor_level'];
    }
    $user_name = $_SESSION['vpmsumn'];

    $bookedSlots = array();
    $bookedSlotsQuery = mysqli_query($con, "SELECT booked_slot FROM tbbookedslots WHERE floor_level = '$floorLevel' and veh_status='in'");
    while ($row = mysqli_fetch_assoc($bookedSlotsQuery)) {
        $bookedSlots[] = $row['booked_slot'];
    }

    if (isset($_POST['submit'])) {

        date_default_timezone_set('America/Chicago');

        if (isset($_POST['selected_slot'])) {
            if(isset($_POST['vehname']) && $_POST['vehname'] != 0) {
                $check_in = '';
                $validDate = true;
                $selected_date_time = true;
                $booking_type = $_POST['booking_type'];
                if($booking_type == 'future') {
                    if(isset($_POST['check_in_date']) && isset($_POST['check_in_time'])) {
                        $scheduled_date = $_POST['check_in_date'];
                        $scheduled_time = $_POST['check_in_time'];
                        if(empty($scheduled_date) || empty($scheduled_time)) {
                            $selected_date_time = false;
                        } else {
                            $maxAllowedDate = date('Y-m-d', strtotime('+2 days'));
                            if (strtotime($scheduled_date) >= strtotime(date('Y-m-d')) && strtotime($scheduled_date) <= strtotime($maxAllowedDate)) {
                                $check_in = $scheduled_date.' '.$scheduled_time;
                            } else {
                                $validDate = false;
                            }
                            
                        } 
                    } else {
                        $selected_date_time = false;
                    }
                }
                
                $selected_slot = $_POST['selected_slot'];
                $user_name = $_SESSION['vpmsumn'];
                $vehId = $_POST['vehname'];
                $vehLength = count($vehId);
                $slotsLength = count($selected_slot);
                
                if(count($vehId) != count($selected_slot)) {
                    echo "<script>alert('Please Select Vehicles and Slots Correctly.');</script>";
                } else if(!$selected_date_time) {
                    echo "<script>alert('Please Select Date and Time to Schedule Booking Slot.');</script>";
                } else if(!$validDate) {
                    echo "<script>alert('Selected date is not within the allowed range (up to 2 days from today). Please select a valid date.');</script>";
                } else {
                    foreach ($vehId as $key => $veh_id) {

                        $veh_cat_data = mysqli_query($con, "SELECT tc.id as veh_cat_id
                        FROM tblcategory tc
                        INNER JOIN tblvehicle v ON tc.VehicleCat = v.VehicleCategory
                        WHERE v.ID = '$veh_id'");
                        $catData = mysqli_fetch_array($veh_cat_data);
                        $catId = $catData['veh_cat_id'];
                        $user_selected_slot = $selected_slot[$key];
                        $current_time = date('Y-m-d H:i:s');

                        if($check_in == '') {
                            $query=mysqli_query($con, "insert into  tbbookedslots(user_name, vehicle_id, vehicle_cat, floor_level, booked_slot,veh_status,booking_type,check_in_time) value('$user_name','$veh_id','$catId','$floorLevel','$user_selected_slot','in','spot','$current_time')");
                        } else {
                            $query=mysqli_query($con, "insert into  tbbookedslots(user_name, vehicle_id, vehicle_cat, floor_level, booked_slot,veh_status,booking_type,check_in_time) value('$user_name','$veh_id','$catId','$floorLevel','$user_selected_slot','in','future','$check_in')");
                        }
                    }
                    if ($query) {
                        echo "<script>alert('Parking Slot(s) Booked successfully');</script>";
                        echo "<script>setTimeout(function(){ window.location = 'my-bookings.php'; }, 500);</script>";
                    } else {
                        echo "<script>alert('Something went wrong, Please Try again!');</script>";
                    }
                }
                
            } else {
                echo "<script>alert('Please select Vehicle');</script>";
            }
            
        } else {
            echo "<script>alert('No slots were selected');</script>";
        }
    }

  ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get references to the select and date input elements
        const bookingTypeSelect = document.getElementById('booking_type');
        const dateInputContainer = document.getElementById('date-input-container');

        // Add an event listener to the select element
        bookingTypeSelect.addEventListener('change', function () {
            // Check if the selected value is "future"
            if (bookingTypeSelect.value === 'future') {
                // If "future" is selected, show the date input
                dateInputContainer.style.display = 'block';
            } else {
                // If a different option is selected, hide the date input
                dateInputContainer.style.display = 'none';
            }
        });
        
    });
    
</script>
  
<!doctype html>

<html class="no-js" lang="">
<head>
   
    <title>VPMS - View Vehicle Parking Details</title>
   

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
    <link rel="stylesheet" type="text/css" href="../css/example-styles.css">
    <link rel="stylesheet" type="text/css" href="../css/demo-styles.css">
    <script type="text/javascript" src="../js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="../js/jquery.multi-select.js"></script>

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
                                    <li><a href="userslots-available.php">Slot Availabilities</a></li>
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
                   
         

                <div class="col-lg-12">
                    <div class="card">
                    
                        <div class="card-header">
                            <strong>Select Parking Slot</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post">
                                <div class="row p-2">
                                    <div class="col-md-4">
                                    <label for="people" style="color:gray;font-size:15px;">Select Parking Vehicle</label>
                                        <select name="vehname[]" id="people" class="form-control pl-24" multiple>
                                            <?php $query=mysqli_query($con,"SELECT DISTINCT v.ID, v.VehicleCompanyname, v.RegistrationNumber
                                            FROM tblvehicle v
                                            WHERE v.user_name = '$user_name'
                                            AND v.ID NOT IN (SELECT vehicle_id FROM tbbookedslots WHERE veh_status = 'in')");
                                               if (mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                    <option value="<?php echo $row['ID']; ?>"><?php echo $row['VehicleCompanyname'] . ' - ' . $row['RegistrationNumber']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                echo '</select>';
                                                echo '<a href="add-vehicle.php" class="btn btn-primary btn-sm">Add Vehicle</a>';
                                            }
                                             ?> 
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="booking_type" style="color: gray; font-size: 15px;">Booking Type</label>
                                        <select name="booking_type" id="booking_type" class="form-control pl-24" style="color: gray; height: 30px">
                                            <option value="spot" style="color: gray; font-size: 14px;">Spot Booking</option>
                                            <option value="future" style="color: gray; font-size: 14px;">Schedule Booking</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div id="date-input-container" style="display: none;">
                                    <div class="row p-2">
                                        <div class="col-md-4">
                                            <label for="check_in_date" style="color: gray; font-size: 15px;">Schedule Date <span style="font-size: 10px;">( select up to 2 days from today )</span></label>
                                            <input class="form-control pl-2" type="date" id="check_in_date" name="check_in_date" style="color: gray; height: 30px;width:300px">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="check_in_time" style="color: gray; font-size: 15px;">Schedule Time</label>
                                            <input class="form-control pl-2" type="time" id="check_in_time" name="check_in_time" style="color: gray; height: 30px; width: 335px">
                                        </div>
                                    </div>
                                </div>
                                <hr class="hr hr-blurry" />
                                <div class="d-flex flex-wrap">
                                    <?php
                                    $ret = mysqli_query($con, "SELECT no_of_blocks FROM tbparkingslots WHERE floor_level = '$floorLevel'");
                                    $row = mysqli_fetch_array($ret);
                                    $noOfBlocks = $row['no_of_blocks'];

                                    // Define the number of checkboxes to display in each row (e.g., 15)
                                    $checkboxesPerRow = 15;

                                    for ($i = 1; $i <= $noOfBlocks; $i++) {
                                        // Output a checkbox with a unique value
                                        $isDisabled = in_array($i, $bookedSlots) ? 'disabled' : '';
                                        ?>
                                            
                                            <label class="p-2" style="margin-right: 30px;">
                                                <input class="form-check-input p-24 larger-radio" type="checkbox" name="selected_slot[]" value="<?php echo $i; ?>" <?php echo $isDisabled; ?>>
                                                <span class="pl-1" style="font-size: 10px;"><?php echo $i; ?></span>
                                            </label>

                                        <?php

                                        // Check if it's time to start a new row
                                        if ($i % $checkboxesPerRow == 0) {
                                            echo '</div><div class="d-flex flex-wrap">';
                                        }
                                    }
                                    ?>
                                </div>
                                <button type="submit" name="submit" style="float: right;" class="btn btn-primary btn-sm">Book Slot</button>
                            </form>
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

<style>
    .larger-radio {
    width: 25px; /* Adjust the width to make the radio button larger */
    height: 25px; /* Adjust the height to make the radio button larger */
}

.larger-radio:checked {
    background-color: #007bff; /* Change the background color when the radio button is checked */
    border-color: #007bff; /* Change the border color when the radio button is checked */
}
#people {
    width: 400px;
    height: 100px;
}
</style>

<script type="text/javascript">
    $(function(){
        $('#people').multiSelect();
    });
    $('#people').multiselect({
    columns: 1,
    placeholder: 'Select Vehicle',
    search: true
});
$('#people').multiselect({
    columns: 1,
    placeholder: 'Select Languages',
    search: true,
    selectAll: true
});
</script>