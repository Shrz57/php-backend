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
    <title>Dashboard</title>
</head>
<?php 
   if(isset($_SESSION['doctor_id'])){
    // echo "Sucess";
    $id = $_SESSION['doctor_id'];
    $sql = "SELECT a.appointment_id, a.app_date, a.app_type, a.app_details
    FROM appointments a
    WHERE a.doctor_id =$id AND a.is_reported = 0";
    echo $id;
    if($result = mysqli_query($conn,$sql)){
        echo "sucess";
    }
    else{
        echo "unsucess";
    }
    }
?>
<body>
    <table>
        <tr>
            <th>SN</th>
            <th>Appointment Date</th>
            <th>Appointment Type</th>
            <th>Appointment Details</th>
            <th>Action</th>
        </tr>
        <?php
            if(!(mysqli_num_rows($result)>0)){
                echo "No records Found!";
            }
            else{
                $i = 1;
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$i++."</td>";
                    echo "<td>".$row['app_date']."</td>";
                    echo "<td>".$row['app_type']."</td>";
                    echo "<td>".$row['app_details']."</td>";            
                    echo '<td><a href="report_create.php?id='.$row['appointment_id'].'">Report</a></td>';
                    // echo '<td><a href="appointment_update.php?id='.$row['appointment_id'].'">Edit</a></td>';";
                    echo "</tr>";
                }                // echo "</table>";
                // echo $_SESSION['patient_id'];
            }         
        ?>
    </table>
    <a href="signup_doctor.php">Create Doctor</a>
    <a href="logout.php">logout</a>
</body>
</html>

