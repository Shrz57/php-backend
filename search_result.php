<?php
    include('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result</title>
</head>

<body>
    <form action="" method="post">
        <label for="name">Name :</label>
        <input type="text" name="name" id="name"><br>
        <label for="date">Date of Birth :</label>
        <input type="date" name="dob" id="dob"><br>
        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>
<?php
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $sql ="SELECT r.result_percentage, r.result_grade, su.subject_name
        FROM results r
        INNER JOIN students s
        ON s.student_id = r.student_id
        INNER JOIN subjects su
        ON r.subject_id = su.subject_id
        WHERE s.student_name = '$name' AND s.student_dob='$dob';";
        if($result = mysqli_query($conn, $sql)){
            // echo "Sucess";
            while($row = mysqli_fetch_assoc($result)){
                echo $row['subject_name'];
                echo $row['result_percentage'];
                echo $row['result_grade'];
        }
    }
    else{
        echo "Unsucess";
    }
}
?>