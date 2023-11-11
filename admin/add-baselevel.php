<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Iterator Design Pattern
class ParkingLevelIterator implements Iterator
{
    private $position = 0;
    private $parkingLevelData = [];

    public function __construct($con)
    {
        // Using Iterator to fetch parking level data
        $result = mysqli_query($con, "SELECT floor_level FROM tbparkingslots ORDER BY floor_level DESC LIMIT 1");
        $this->parkingLevelData = mysqli_fetch_assoc($result);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->parkingLevelData;
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return $this->position === 0; // Allow only one iteration
    }
}

if (strlen($_SESSION['vpmsaid']) == 0) {
    header('location:logout.php');
} else {
    $parkingLevelIterator = new ParkingLevelIterator($con);
    $floorLevel = $parkingLevelIterator->current()['floor_level'] + 1;

    if (isset($_POST['submit'])) {
        $no_of_blocks = $_POST['no_of_blocks'];

        // Decorator Design Pattern
        // Adding a new parking level with additional information
        $query = mysqli_query($con, "INSERT INTO tbparkingslots (floor_level, no_of_blocks) VALUES ('$floorLevel', '$no_of_blocks')");
        if ($query) {
            echo "<script>alert('Parking Level added successfully');</script>";
            header('location:slots-available.php');
        }
    }

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
    </head>

    <body>
        <?php include_once('includes/sidebar.php'); ?>
        <!-- Right Panel -->

        <?php include_once('includes/header.php'); ?>

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
                                    <li><a href="add-vehicle.php">Vehicle</a></li>
                                    <li class="active">slots Availabilities</li>
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
            <strong>Add Parking Level</strong>
        </div>
        <div class="card-body card-block">
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Parking Level</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="floor_level" name="floor_level" class="form-control" disabled="true" required="true" value="<?php echo 'B' . $floorLevel; ?>">
                    </div>
                    <div class="col col-md-3 mt-4">
                        <label for="text-input" class=" form-control-label">No of Slots</label>
                    </div>
                    <div class="col-12 col-md-9 mt-4">
                        <input type="number" id="no_of_blocks" name="no_of_blocks" class="form-control" required="true">
                    </div>
                </div>
                <p style="text-align: center;"><button type="submit" class="btn btn-primary btn-sm" name="submit">Add</button></p>
            </form>
        </div>
    </div>

                    </div>
                    <div class="col-lg-6">
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
        </div><!-- .content -->
        <div class="clearfix"></div>
        <?php include_once('includes/footer.php'); ?>
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
<?php } ?>