<?php
include ('authentication.php');
include ('config/dbcon.php'); ?>

<?php 


if(isset($_POST['logout_btn'])){



    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
 
 
    $_SESSION['status'] = "LOGGED OUT SUCCESSFULLY";
    $_SESSION['status_code'] = "success";
    header('Location: login.php');
 exit();
 }




 if (isset($_POST['addPatient'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $contact_info = $_POST['contact_info'];
    $address = $_POST['address'];
    $covid_status = $_POST['covid_status'];
    echo $first_name;

    $add_patient = "INSERT INTO patients (first_name, last_name, date_of_birth, contact_info, address, covid_status) VALUES ('$first_name', '$last_name', '$date_of_birth', '$contact_info', '$address', '$covid_status')";
    $add_patient_start = mysqli_query($conn, $add_patient);

    if ($add_patient_start) {
        $_SESSION['status'] = "Patient added successfully";
        $_SESSION['status_code'] = "success";
        header("Location: patient.php");
        exit();
        
    } else {
        $_SESSION['status'] = "Patient registration failed";
        $_SESSION['status_code'] = "error";
        header("Location: patient.php");
        
        exit();
    }
}






if(isset($_POST['editPatient'])){
    $patient_id = $_POST['patient_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $contact_info = $_POST['contact_info'];
    $address = $_POST['address'];
    $covid_status = $_POST['covid_status'];

    $update_query = "UPDATE patients SET first_name = '$first_name', last_name = '$last_name', 
                    date_of_birth = '$date_of_birth', contact_info = '$contact_info', 
                    address = '$address', covid_status = '$covid_status' 
                    WHERE patient_id = '$patient_id'";
    
    $update_query_start = mysqli_query($conn, $update_query);

    if($update_query_start){
        $_SESSION['status'] = "Patient updated successfully";
        $_SESSION['status_code'] = "success";
        header("Location: patient.php"); // Redirect to patient.php or appropriate page after update
        exit();
    } else {
        $_SESSION['status'] = "Failed to update patient";
        $_SESSION['status_code'] = "error";
        header("Location: patient.php"); // Redirect to patient.php or appropriate page if update fails
        exit();
    }
};


if(isset($_POST['editVaccine'])){
    $vaccine_id = $_POST['vaccine_id'];
    $vaccine_name = $_POST['vaccine_name'];
    $availability = $_POST['availability'];

    $update_query = "UPDATE vaccines SET vaccine_name = '$vaccine_name', 
                    availability = '$availability'
                    WHERE vaccine_id = '$vaccine_id'";
    
    $update_query_run = mysqli_query($conn, $update_query);

    if($update_query_run){
        $_SESSION['status'] = "Vaccine updated successfully";
        $_SESSION['status_code'] = "success";
        header("Location: vaccine.php"); // Redirect to vaccine.php or appropriate page after update
        exit();
    } else {
        $_SESSION['status'] = "Failed to update vaccine";
        $_SESSION['status_code'] = "error";
        header("Location: edit-vaccine.php?vaccine_id=$vaccine_id"); // Redirect to edit-vaccine.php if update fails
        exit();
    }
}


if(isset($_POST['editHospital'])){
    $hospital_id = $_POST['hospital_id'];
    $hospital_name = $_POST['hospital_name'];
    $contact_info = $_POST['contact_info'];
    $address = $_POST['address'];
    $approval_status = $_POST['approval_status'];

    $update_query = "UPDATE hospitals SET 
                        hospital_name = '$hospital_name', 
                        contact_info = '$contact_info', 
                        address = '$address', 
                        approval_status = '$approval_status' 
                    WHERE hospital_id = '$hospital_id'";

    $update_query_run = mysqli_query($conn, $update_query);

    if($update_query_run){
        $_SESSION['status'] = "Hospital updated successfully";
        $_SESSION['status_code'] = "success";
        header("Location: hospital.php"); // Redirect to hospitals.php or appropriate page after update
        exit();
    } else {
        $_SESSION['status'] = "Failed to update hospital";
        $_SESSION['status_code'] = "error";
        header("Location: edit_hospital.php?hospital_id=$hospital_id"); // Redirect to edit_hospital.php if update fails
        exit();
    }
}



?>