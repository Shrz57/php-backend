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

<body>
    <table>
        <tr>
            <th>SN</th>
            <th>Student Name</th>
            <th>Semester</th>
            <th>DOB</th>
            <th>Address</th>
            <th>Action I</th>
            <th>Action II</th>
            <!-- <th>Appointment Details</th>
            <th>Doctor Name</th> -->
        </tr>
        <?php
        if(isset($_SESSION['teacher_id'])){
            // echo "Sucess";
            $id = $_SESSION['teacher_id'];
            $sql = "SELECT student_name, semester_id, student_id,student_address,student_dob
            FROM students;";
            $result = mysqli_query($conn,$sql);
            
            if(!(mysqli_num_rows($result)>0)){
                echo "No records Found!";
            }
            else{
                
                $i = 1;
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$i++."</td>";
                    echo "<td>".$row['student_name']."</td>";
                    echo "<td>".$row['semester_id']."</td>";
                    echo "<td>".$row['student_dob']."</td>";
                    echo "<td>".$row['student_address']."</td>";

                    echo '<td><a href="result_create.php?id='.$row['semester_id'].'&&s_id='.$row['student_id'].'">Create Result</a></td>';
                    echo '<td><a href="result_create.php?id='.$row['semester_id'].'&&s_id='.$row['student_id'].'">Create Result</a></td>';
                    // echo "<td>".$row['app_details']."</td>";            
                    // echo "<td>".$row['doctor_name']."</td>";
                    echo "</tr>";
                }                // echo "</table>";
                // echo $_SESSION['patient_id'];
            } 
        }        
        ?>
    </table>

    <a href="subject_create.php">Create Subject</a>
    <!-- <a href="logout.php">logout</a> -->
</body>
</html>