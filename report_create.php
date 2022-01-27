<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Report</title>
</head>
<?php
   include("config.php");
   session_start();
    if(isset($_SESSION['doctor_id'])){
        $id = $_GET['id'];
        $_SESSION['appointment_id'] = $id; 
        $sql = "SELECT a.appointment_id, a.app_date, a.app_type, a.app_details
        FROM appointments a
        WHERE a.appointment_id =".$id;
        $result = mysqli_query($conn,$sql);
        // print_r($result);
        echo "Appointment Description:<br>";
        while($row = mysqli_fetch_array($result)){
            echo "Appointment Date :".$row['app_date'];
            echo "<br>";
            echo "Appointment Details :".$row['app_details'];
            echo "<br>";
        }
    }
    else{
        echo "Unsucess.";
    }
?>
<body>
    <form action="create_report.php" method="post">
    <label for="name">prescription name:</label>
    <input type="text" name="name" id="name"><br>
    <label for="details">Details: </label>
    <textarea name="details" id="" cols="30" rows="10"></textarea><br>
    <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>