<?php
$currentURL = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Parse the URL to extract the path
$urlParts = parse_url($currentURL);

// Get the file name from the path
$fileName = basename($urlParts['path']);

?>

<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li <?php if ($fileName == 'dashboard.php') echo 'class="active"'; ?>>
                        <a href="dashboard.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                   
                   
                    <li class="<?php if ($fileName == 'add-category.php' || $fileName == 'manage-category.php') echo 'active'; ?> menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Vehicle Category</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="add-category.php">Add Category</a></li>
                            <li><i class="fa fa-table"></i><a href="manage-category.php">Manage Category</a></li>
                        </ul>
                    </li>
                    <li <?php if ($fileName == 'add-vehicle.php') echo 'class="active"'; ?>>
                        <a href="add-vehicle.php"> <i class="menu-icon ti-email"></i>Add Vehicle </a>
                    </li>
                    <li <?php if ($fileName == 'slots-available.php') echo 'class="active"'; ?>>
                        <a href="slots-available.php"> <i class="menu-icon ti-email"></i>Slot Bookings </a>
                    </li>
                    <li class="<?php if ($fileName == 'manage-incomingvehicle.php' || $fileName == 'manage-outgoingvehicle.php') echo 'active'; ?> menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Manage Vehicle</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="manage-incomingvehicle.php">Manage In  Vehicle</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="manage-outgoingvehicle.php">Manage Out Vehicle</a>
                        </li>

                        </ul>
                    </li>
                    <li class="<?php if ($fileName == 'bwdates-report-ds.php') echo 'active'; ?> menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Reports</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="bwdates-report-ds.php">Between Dates Reports</a></li>
                           
                        </ul>
                    </li>
                    <li <?php if ($fileName == 'search-vehicle.php') echo 'class="active"'; ?>>
                        <a href="search-vehicle.php"> <i class="menu-icon fa fa-search"></i>Search Vehicle </a>
                    </li>
                    <li <?php if ($fileName == 'reg-users.php') echo 'class="active"'; ?>>
                        <a href="reg-users.php"> <i class="menu-icon ti-user"></i>Reg Users </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>