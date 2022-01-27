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
   if(isset($_SESSION['admin_id'])){
    echo "Sucess";
    $id = $_SESSION['admin_id'];
    // $sql = "SELECT a.appointment_id, a.app_date, a.app_type, a.app_details, a.doctor_id, d.doctor_name
    // FROM appointments a
    // INNER JOIN doctors d
    // ON d.doctor_id = a.appointment_id
    // WHERE a.patient_id = 4 AND a.is_reported = 0;";
    $sql = "SELECT a.appointment_id, a.app_date, a.app_type, a.app_details, d.doctor_name
    FROM appointments a
    INNER JOIN doctors d
    ON d.doctor_id = a.doctor_id;
    ";
    $result = mysqli_query($conn,$sql);
    }
?>
<body>
    <table>
        <tr>
            <th>SN</th>
            <th>Appointment Date</th>
            <th>Appointment Type</th>
            <th>Appointment Details</th>
            <th>Doctor Name</th>
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
                    echo "<td>".$row['doctor_name']."</td>";
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

