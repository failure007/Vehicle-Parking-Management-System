<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

class FloorLevelIterator implements Iterator
{
    private $position = 0;
    private $floorLevels = [];

    public function __construct($con)
    {
        $result = mysqli_query($con, "select DISTINCT floor_level from tbparkingslots");
        while ($row = mysqli_fetch_array($result)) {
            $this->floorLevels[] = $row['floor_level'];
        }
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->floorLevels[$this->position];
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
        return isset($this->floorLevels[$this->position]);
    }
}

if (strlen($_SESSION['vpmsaid'] == 0)) {
    header('location:logout.php');
} else {
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


    <!-- Remaining head content unchanged -->

</head>
<body>
   <?php include_once('includes/sidebar.php');?>
    <!-- Right Panel -->

   <?php include_once('includes/header.php');?>

        <!-- Remaining content unchanged -->

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Select Basement Level</strong>
                    <a href="add-baselevel.php" style="float:right" class="btn btn-primary btn-sm">Add</a>
                </div>
                <div class="card-body card-block">
                    <div class="row">
                        <?php
                        $floorIterator = new FloorLevelIterator($con);
                        foreach ($floorIterator as $floorLevel) {
                        ?>
                            <div class="col-md-1">
                                <a href="booking-slots-list.php?floor_level=<?php echo $floorLevel; ?>" class="btn btn-success">B<?php echo $floorLevel; ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Remaining content unchanged -->

        <div class="clearfix"></div>

       <?php include_once('includes/footer.php');?>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <!-- Remaining script tags unchanged -->

</body>
</html<?php } ?>
