<?php include ('authentication.php');
include ("config/dbcon.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ("includes/header.php") ?>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <?php include ("includes/topbar.php") ?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <?php include ("includes/sidebar.php"); ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-table me-1"></i>
                                Patients
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModal">Add Patient</button>
                        </div>
                        <div class="card-body">

                            <?php

                            $sql = "SELECT * FROM patients";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {

                                ?>
                                <table id="datatablesSimple" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Date of Birth</th>
                                            <th>Contact Info</th>
                                            <th>Address</th>
                                            <th>COVID Status</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            ?>

                                            <tr>
                                                <td> <?php echo $row['patient_id'] ?> </td>
                                                <td> <?php echo $row['first_name'] ?> </td>
                                                <td> <?php echo $row['last_name'] ?> </td>
                                                <td> <?php echo $row['date_of_birth'] ?> </td>
                                                <td> <?php echo $row['contact_info'] ?> </td>
                                                <td> <?php echo $row['address'] ?> </td>
                                                <td> <?php echo $row['covid_status'] ?> </td>
                                                <td> <?php echo $row['created_at'] ?> </td>
                                                <td>
                                                    <a href="edit_patient.php?patient_id=<?php echo $row['patient_id'] ?>" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <input type="hidden" class="delete_id_value" value="<?php echo $row['patient_id'] ?>">
                                                    <a href="javascript:void(0)" class="deletebtn btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <?php include "includes/footer.php"; ?>
            </footer>
        </div>
    </div>
    <?php include "includes/script.php"; ?>
    <?php include ('includes/alert.php'); ?>  
    
    
<!-- Add Patient Modal -->
<div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="code.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPatientModalLabel">Add Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Contact Info</label>
                        <input type="email" class="form-control" id="contact_info" name="contact_info" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="covid_status" class="form-label">COVID Status</label>
                        <select class="form-control" id="covid_status" name="covid_status" required>
                            <option value="Positive">Positive</option>
                            <option value="Negative">Negative</option>
                            <option value="Not Tested">Not Tested</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="addPatient" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <script>
        $(document).ready(function () {
            $('.deletebtn').click(function (e) {
                e.preventDefault();

                var deleteid = $(this).closest("tr").find('.delete_id_value').val();

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "del.php",
                            data: {
                                "delete_btn_set": 1,
                                "delete_id": deleteid
                            },
                            success: function (response) {
                                swal("DATA DELETED SUCCESSFULLY", {
                                    icon: "success",
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
