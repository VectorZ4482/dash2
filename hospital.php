<?php include ('authentication.php');
include ("config/dbcon.php"); ?>


<?php 

if(isset($_SESSION['role']) && $_SESSION["role"] != 'Admin'){
    header('Location: vaccine.php');
    $_SESSION['status'] = "You Don't Have Permission To Access this";
    $_SESSION['status_code'] = "warning";
    exit();
   
}
?>

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
                    <ol class="breadcrumb mb_4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-table me-1"></i>
                                Hospitals
                            </div>
                            <button type="button" class="btn btn-sm btn-primary">Add Hospital</button>
                        </div>
                        <div class="card-body">

                            <?php
                            $sql = "SELECT * FROM hospitals";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                ?>
                                <table id="datatablesSimple" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Hospital Name</th>
                                            <th>Contact Info</th>
                                            <th>Address</th>
                                            <th>Approval Status</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td> <?php echo $row['hospital_id'] ?> </td>
                                                <td> <?php echo $row['hospital_name'] ?> </td>
                                                <td> <?php echo $row['contact_info'] ?> </td>
                                                <td> <?php echo $row['address'] ?> </td>
                                                <td> <?php echo $row['approval_status'] ?> </td>
                                                <td> <?php echo $row['created_at'] ?> </td>
                                                <td>
                                                    <a href="edit_hospital.php?hospital_id=<?php echo $row['hospital_id'] ?>" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <input type="hidden" class="delete_id_value" value="<?php echo $row['hospital_id'] ?>">
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
</body>
</html>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>

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
                        url: "del_hospital.php",
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
