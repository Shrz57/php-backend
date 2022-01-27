<?php
    include("config.php");
    session_start();
    if(isset($_POST['submit'])){
        $prescription = $_POST['name'];
        $r_details = $_POST['details'];
        $a_id = $_SESSION['appointment_id'];
        $d_id = $_SESSION['doctor_id'];
        echo $prescription;
        echo $r_details;
        echo $a_id;
        echo "<br>";
        echo $d_id;
        $sql = "INSERT INTO `reports` (`prescription_name`, `report_details`, `appointment_id`, `doctor_id`) 
        VALUES ( '$prescription', '$r_details', $a_id, $d_id);";
        if(mysqli_query($conn,$sql)){
            // echo "Sucess";
            $sql_2 = "UPDATE `appointments` SET `is_reported` = '1' 
            WHERE `appointments`.`appointment_id` =".$a_id;
            if(mysqli_query($conn,$sql_2)){
                echo "sucess";
            }
        }else{
            echo "Failure";
        }
    }
?>