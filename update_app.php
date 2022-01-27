<?php
   include("config.php");
   session_start();    
    if(isset($_POST['submit'])){
        $date = $_POST['app_date'];
        $type = $_POST['type'];
        $details = $_POST['details'];
        $doctor_id = $_POST['doctor'];
        if(isset($_SESSION['patient_id'])){
            echo "patient_id selected";
            $patient_id = $_SESSION['patient_id'];
            $is_reported = 0;
            $sql = "UPDATE `appointments` 
            SET `app_date` = '$date', `app_type` = '$type', `app_details` = '$details', `doctor_id` = '$doctor_id' 
            WHERE `appointments`.`appointment_id`=".$_SESSION['app_id'];
            if(mysqli_query($conn,$sql)){
                echo "Sucess";
                header("location:patient_dashboard.php");
            }
          else{
                echo "unsucess".mysqli_error($conn);
            }
        }
        mysqli_close($conn);
    }
?>