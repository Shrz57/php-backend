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
    <title>Update Result</title>
</head>
<body>
<?php
    if(isset($_SESSION['teacher_id'])){
        $id = $_SESSION['teacher_id'];
        $result_id = $_GET['id'];
        $sql = "SELECT r.result_percentage, r.subject_id, r.is_terminal, r.display_result , s.subject_name, st.student_name
        FROM results r 
        INNER JOIN subjects s
        ON s.subject_id = r.subject_id
        INNER JOIN students st
        ON st.student_id = r.student_id
        WHERE r.result_id = $result_id;";
        $_SESSION['result_id'] = $result_id;
        if($result = mysqli_query($conn, $sql)){
            $row = mysqli_fetch_assoc($result);
            // $selected = $row['doctor_id'];
            }
    }
?>
<h1>Update on Marks of student <?php echo $row['student_name'];?> On subject <?php echo $row['subject_name'];?> </h1>
<form action="update_result.php" method="post">
<label for="percentage">Percentage</label>
<input type="number" name="percentage" id="percentage" value="<?php echo $row["result_percentage"]?>"> <br>
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