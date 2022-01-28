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
    <title>Result</title>
</head>
<body>
<form action="create_result.php" method="post">
<label for="subject">Subject</label>
<select name="subject" id="subject">
<?php
    $semester_id = $_GET['id'];
    $student_id = $_GET['s_id'];
    if(isset($_SESSION['teacher_id'])){
        $id = $_SESSION['teacher_id'];
        $_SESSION['student_id']=$student_id;
        $sql = "SELECT subject_name, subject_id FROM subjects
        WHERE semester_id = $semester_id ;";
        $result = mysqli_query($conn,$sql);
        if(!(mysqli_num_rows($result)>0)){
            echo "No records Found!";
        }
        else{
            while($row = mysqli_fetch_array($result)){
                            echo '<option value='.$row['subject_id'].'>'.$row['subject_name'].'</option>';
                        }
        }
    }
    ?>


</select> <br>
<label for="percentage">Percentage</label>
<input type="number" name="percentage" id="percentage"> <br>
<label for="terminal">Is Terminal</label>
<input type="radio" name="is_terminal" id="yes" value="yes"> <label for="yes">Yes</label>
<input type="radio" name="is_terminal" id="no" value="no"> <label for="no">No</label> <br>
<label for="displayresult">Dispaly Result</label>
<input type="radio" name="display_result" id="yes" value="yes"> <label for="yes">Yes</label>
<input type="radio" name="display_result" id="no" value="no"> <label for="no">No</label> <br>
<input type="submit" value="submit" name="submit">

</form>
</body>
</html>
