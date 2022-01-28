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
    <h5>Student's List Table</h5>
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
            echo $id;
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
    <h5>Student's Result Table</h5>
    <table>
        <tr>
            <th>S.N.</th>
            <th>Student Name </th>
            <th>Subject Name</th>
            <th>Result Grade</th>
            <th>Terminal</th>
            <th>Display Result</th>
        </tr>
        <tr>
            <?php
                $sql_1 = "SELECT rt.result_id, st.student_name , su.subject_name, rt.is_terminal, rt.result_grade,rt.display_result
                FROM results rt
                INNER JOIN subjects su
                ON su.subject_id = rt.subject_id
                INNER JOIN students st
                ON st.student_id = rt.student_id;
                ";
                if(isset($_SESSION['teacher_id'])){
                    $result = mysqli_query($conn,$sql_1);
                    if(!(mysqli_num_rows($result)>0)){
                    echo "No records Found!";
                }
                else{
                    $i = 1;
                    while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$i++."</td>";
                    echo "<td>".$row['student_name']."</td>";
                    echo "<td>".$row['subject_name']."</td>";
                    echo "<td>".$row['result_grade']."</td>";
                    echo "<td>".$row['is_terminal']."</td>";
                    echo "<td>".$row['display_result']."</td>";
                    echo '<td><a href="result_update.php?id='.$row['result_id'].'">Update</a></td>';
                    echo '<td><a href="result_delete.php?id='.$row['result_id'].'">Delete</a></td>';
                    echo "</tr>";
                }
                } 
                } 
            ?>
        </tr>
    </table><br>
    <a href="subject_create.php">Create Subject</a><br>
    <a href="student_create.php">Create Student</a><br>
    <a href="logout.php">Logout</a><br>
</body>
</html>