

<?php 


include ("config/dbcon.php"); ?>



<?php

$name = $_SESSION['auth_admin']['admin_name'];

$query = "SELECT * FROM admin WHERE admin_name = '$name'";
$query_run = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($query_run)) {
    $role = $row['role'];


    $_SESSION["role"] = $role;

    
}

if($role == 'Admin'){






?>





<div class="sb-sidenav-menu">
    <div class="nav">
        <div class="sb-sidenav-menu-heading">Core</div>
        <a class="nav-link" href="index.php">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
        </a>

           
        <div class="sb-sidenav-menu-heading">ADMIN</div>
      

        <!-- New Addons Links -->
        <a class="nav-link" href="./patient.php">
            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
            All Patient Details
        </a>
        <a class="nav-link" href="report_covid_test_vaccination.html">
            <div class="sb-nav-link-icon"><i class="fas fa-file-medical-alt"></i></div>
            Report of Covid Test
        </a>
        <a class="nav-link" href="vaccine.php">
            <div class="sb-nav-link-icon"><i class="fas fa-syringe"></i></div>
            List of Vaccine
        </a>

        <a class="nav-link" href="hospital_logins.php">
            <div class="sb-nav-link-icon"><i class="fas fa-hospital-user"></i></div>
            Hospital Logins
        </a>
        <a class="nav-link" href="hospital.php">
            <div class="sb-nav-link-icon"><i class="fas fa-hospital"></i></div>
            List of Hospitals
        </a>
        <a class="nav-link" href="booking_details.html">
            <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
            Booking Details
        </a>
        <div class="sb-sidenav-menu-heading">Interface</div>
        
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
            Admin
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                    Error
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="401.html">401 Page</a>
                        <a class="nav-link" href="404.html">404 Page</a>
                        <a class="nav-link" href="500.html">500 Page</a>
                    </nav>
                </div>
            </nav>
        </div>
     
    </div>
</div>
<div class="sb-sidenav-footer">
    <div class="small">Logged in as:</div>
   <?php
   
   if(isset( $_SESSION['auth'] )){
    echo  $_SESSION['auth_admin'] ['admin_name'];
  }else{
  
    echo "No Login Found";
  }
   
   
   ?>
</div>




<?php }elseif($role == 'Hospital'){   ?>
    
    <div class="sb-sidenav-menu">
    <div class="nav">
       


        <div class="sb-sidenav-menu-heading">Hospital</div>
      
        <!-- New Addons Links -->
        <a class="nav-link" href="./patient.php">
            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
            All Patient Details
        </a>
        <a class="nav-link" href="report_covid_test_vaccination.html">
            <div class="sb-nav-link-icon"><i class="fas fa-file-medical-alt"></i></div>
            Report of Covid Test
        </a>
        <a class="nav-link" href="vaccine.php">
            <div class="sb-nav-link-icon"><i class= "fas fa-syringe"></i></div>
            List of Vaccine
        </a>
    </div>
</div>
<div class="sb-sidenav-footer">
    <div class="small">Logged in as:</div>
   <?php
   
   if(isset( $_SESSION['auth'] )){
    echo  $_SESSION['auth_admin'] ['admin_name'];
  }else{
  
    echo "No Login Found";
  }
   
   
   ?>
</div>



    
<?php }?>

