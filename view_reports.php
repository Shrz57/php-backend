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
    <title>Archived Reports</title>
</head>
<?php 
   if(isset($_SESSION['patient_id'])){
    $id = $_SESSION['patient_id'];
    // $sql = "SELECT a.appointment_id, a.app_date, a.app_type, a.app_details, a.doctor_id, d.doctor_name
    // FROM appointments a
    // INNER JOIN doctors d
    // ON d.doctor_id = a.appointment_id
    // WHERE a.patient_id = 4 AND a.is_reported = 0;";
    $sql = "SELECT a.app_date, d.doctor_name, a.app_details, r.report_details, r.prescription_name
    FROM doctors d 
    INNER JOIN appointments a 
    ON a.doctor_id = d.doctor_id 
    INNER JOIN reports r 
    ON r.appointment_id = a.appointment_id 
    WHERE a.patient_id = $id
    ";
    $result = mysqli_query($conn,$sql);
    }
?>
<body>
    <table>
        <tr>
            <th>SN</th>
            <th>Appointment Date</th>
            <th>Doctor Name</th>
            <th>Appointment Details</th>
            <th>Report Details</th>
            <th>Prescription Name</th>
            <!-- <th></th> -->
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
                    echo "<td>".$row['doctor_name']."</td>";
                    echo "<td>".$row['app_details']."</td>";            
                    echo "<td>".$row['report_details']."</td>";
                    echo "<td>".$row['prescription_name']."</td>";
                    echo "</tr>";
                }                // echo "</table>";
                // echo $_SESSION['patient_id'];
            }         
        ?>
    </table>
    
</body>
</html>