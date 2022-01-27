<?php
       include("config.php");
       session_start();    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Create</title>
</head>
<?php
 $sql = "SELECT doctor_name, doctor_id FROM `doctors`;";
 $result = mysqli_query($conn,$sql);
?>
<body>
    <form action="<?php  echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="date">Date:</label>
        <input type="date" name="app_date" id="app_date"><br>
        <label for="type">Appointment Type: </label>
        <input type="text" name="type" id="type"><br>
        <label for="details">Appointment Details:</label>
        <textarea name="details" id="" cols="30" rows="10"></textarea><br>
        <label for="doctor">Doctor:</label>
        <select name="doctor" id="doctor">
            <?php
                while($row = mysqli_fetch_array($result)){
                    echo '<option value='.$row['doctor_id'].'>'.$row['doctor_name'].'</option>';
                }
            ?>
        </select><br>
        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>
<?php
    if(isset($_POST['submit'])){
        echo "submitted.";
        $date = $_POST['app_date'];
        $type = $_POST['type'];
        $details = $_POST['details'];
        $doctor_id = $_POST['doctor'];
        if(isset($_SESSION['patient_id'])){
            echo "patient_id selected";
            $patient_id = $_SESSION['patient_id'];
            $is_reported = 0;
            $sql = "INSERT INTO `appointments` (`app_date`, `app_type`, `app_details`, `is_reported`, `patient_id`, `doctor_id`) 
            VALUES ('$date', '$type', '$details', $is_reported, $patient_id, $doctor_id);";
            if(mysqli_query($conn,$sql)){
                echo "Sucess";
                // header("location:patient_dashboard.php");
            }
          else{
                echo "unsucess".mysqli_error($conn);
            }
        }
        mysqli_close($conn);
    }
?>