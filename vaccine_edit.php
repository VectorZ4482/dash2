<?php
include('authentication.php');
include('config/dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/header.php") ?>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <?php include("includes/topbar.php") ?>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <?php include("includes/sidebar.php"); ?>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <!-- Main content -->
                <section class="content mt-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">

                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3 class="card-title mb-0">Edit - Vaccine</h3>
                                        <a href="vaccine.php" class="btn btn-danger btn-sm">Back</a>
                                    </div>

                                    <div class="card-body">
                                        <?php
                                        if(isset($_GET['vaccine_id'])){
                                            $vaccine_id = $_GET['vaccine_id'];

                                            $get_query = "SELECT * FROM vaccines WHERE vaccine_id = '$vaccine_id' LIMIT 1";
                                            $get_query_result  = mysqli_query($conn , $get_query) or die("Query Unsuccessful");

                                            if(mysqli_num_rows($get_query_result) > 0){
                                                while($row1 = mysqli_fetch_assoc($get_query_result)){
                                        ?>
                                        <form action="code.php" method="POST">
                                            <input type="hidden" name="vaccine_id" value="<?php echo $row1['vaccine_id']; ?>">
                                            <div class="form-group">
                                                <label for="">Vaccine Name</label>
                                                <input type="text" name="vaccine_name" class="form-control" placeholder="Enter Vaccine Name" value="<?php echo $row1['vaccine_name']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Availability</label>
                                                <?php
                                                $statuses = ['Available', 'Unavailable'];
                                                echo '<select name="availability" class="form-control" required>';
                                                foreach ($statuses as $status) {
                                                    $select = ($row1['availability'] == $status) ? "selected" : "";
                                                    echo "<option {$select} value='{$status}'>{$status}</option>";
                                                }
                                                echo "</select>";
                                                ?>
                                            </div>

                                            <button type="submit" name="editVaccine" class="btn btn-primary float-right mt-4">Edit Vaccine</button>
                                        </form>
                                        <?php
                                                }
                                            } else {
                                                echo "<h4>No Record Found</h4>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <?php include "includes/footer.php"; ?>
        </footer>
    </div>
</div>
<?php include "includes/script.php"; ?>
<?php include ('includes/alert.php'); ?>
</body>
</html>
