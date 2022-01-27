<?php
    session_start();
    require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Appointment</title>
</head>
<?php
    $sql = "SELECT app_date,app_type,app_details, doctor_id
    FROM appointments WHERE appointment_id=".$_GET['id'];
    if($result = mysqli_query($conn, $sql)){
        $row = mysqli_fetch_assoc($result);
        $selected = $row['doctor_id'];
    }
    $_SESSION['app_id'] = $_GET['id']; 
    // $sql2 = "SELECT doctor_name, doctor_id FROM `doctors`;";
?>

<body>
    <form action="update_app.php" method="post">
        <label for="date">Date:</label>
        <input type="date" name="app_date" id="app_date" value="<?php echo $row['app_date'];?>"><br>
        <label for="type">Appointment Type: </label>
        <input type="text" name="type" id="type" value="<?php echo $row['app_type']; ?>"><br>
        <label for="details">Appointment Details:</label>
        <textarea name="details" id="" cols="30" rows="10"><?php echo $row['app_details'];?>
        </textarea><br>
        <label for="doctor">Doctor:</label>
        <select name="doctor" id="doctor">
        <?php
        $sql_query = "SELECT doctor_name, doctor_id FROM `doctors`;";
        $result2 = mysqli_query($conn,$sql_query);
        while($row2 = mysqli_fetch_array($result2)){
            if($selected == $row2['doctor_id']){
                echo '<option selected value='.$row2['doctor_id'].'>'.$row2['doctor_name'].'</option>';
                // echo "<option value =""></option>";
            }
            else{
                echo '<option value='.$row2['doctor_id'].'>'.$row2['doctor_name'].'</option>';
        }
        }
        ?>
        </select><br>
        <input type="submit" value="submit" name="submit">
    </form>
</body>

</html>
