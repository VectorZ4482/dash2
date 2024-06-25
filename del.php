<?php 


if(isset($_POST['delete_btn_set'])){

    $del_id = $_POST['delete_id'];
    $reg_query = "DELETE FROM patients WHERE patient_id = '$del_id'";
    $reg_query_run = mysqli_query($conn,$reg_query);
 }
 
?>