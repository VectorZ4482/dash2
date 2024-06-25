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
                                        <h3 class="card-title mb-0">Edit - Hospital</h3>
                                        <a href="hospitals.php" class="btn btn-danger btn-sm">Back</a>
                                    </div>

                                    <div class="card-body">
                                        <?php
                                        if(isset($_GET['hospital_id'])){
                                            $hospital_id = $_GET['hospital_id'];

                                            $get_query = "SELECT * FROM hospitals WHERE hospital_id = '$hospital_id' LIMIT 1";
                                            $get_query_result  = mysqli_query($conn , $get_query) or die("Query Unsuccessful");

                                            if(mysqli_num_rows($get_query_result) > 0){
                                                while($row = mysqli_fetch_assoc($get_query_result)){
                                        ?>
                                        <form action="code.php" method="POST">
                                            <input type="hidden" name="hospital_id" value="<?php echo $row['hospital_id']; ?>">
                                            <div class="form-group">
                                                <label for="">Hospital Name</label>
                                                <input type="text" name="hospital_name" class="form-control" placeholder="Enter Hospital Name" value="<?php echo $row['hospital_name']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Contact Info</label>
                                                <input type="text" name="contact_info" class="form-control" placeholder="Enter Contact Info" value="<?php echo $row['contact_info']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" name="address" class="form-control" placeholder="Enter Address" value="<?php echo $row['address']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Approval Status</label>
                                                <?php
                                                $statuses = ['Approved', 'Pending', 'Rejected'];
                                                echo '<select name="approval_status" class="form-control" required>';
                                                foreach ($statuses as $status) {
                                                    $select = ($row['approval_status'] == $status) ? "selected" : "";
                                                    echo "<option {$select} value='{$status}'>{$status}</option>";
                                                }
                                                echo "</select>";
                                                ?>
                                            </div>

                                            <button type="submit" name="editHospital" class="btn btn-primary float-right mt-4">Edit Hospital</button>
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
