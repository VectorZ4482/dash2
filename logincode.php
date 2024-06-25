<?php 

session_start();

include ('includes/alert.php'); 

include ('config/dbcon.php');

if(isset($_POST['login_btn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $log_query = "SELECT * FROM admin WHERE admin_email = '$email' AND admin_password = '$password' LIMIT 1";

    $log_query_run = mysqli_query($conn, $log_query);

    if(mysqli_num_rows($log_query_run) > 0){
        foreach($log_query_run as $row){
            $admin_id   = $row['admin_id'];
            $admin_name   = $row['admin_name'];
            $admin_email   = $row['admin_email'];
        }

        $_SESSION['auth'] = true;
        $_SESSION['auth_admin'] = [
            'admin_id' => $admin_id,
            'admin_name' => $admin_name,
            'admin_email' => $admin_email,
            'role' => $role
        ];
          
        $_SESSION['status'] = "LOGGED IN SUCCESSFULLY";
        $_SESSION['status_code'] = "success";
        header('Location: index.php');
        exit();
    } else {
        header('Location: login.php');
        $_SESSION['status'] = "Invalid Email or Password";
        $_SESSION['status_code'] = "error";
        exit();
    }
} else {
    $_SESSION['status'] = "ACCESS DENIED";
    $_SESSION['status_code'] = "warning";
    header('Location: login.php');
    exit();
}





?>
