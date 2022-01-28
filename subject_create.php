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
    <title>Create Subject</title>
</head>
<?php
if(isset($_SESSION['teacher_id'])){
    $id = $_SESSION['teacher_id'];
    echo $id;
    $sql = "SELECT semester_name, semester_id FROM semesters;";
    $result = mysqli_query($conn,$sql);
}
?>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <label for="name"> Subject Name:</label>
        <input type="text" name="subject_name" id="name"><br>
        <label for="credit">Credit Hour:</label>
        <input type="number" name="credit" id="credit"><br>
        <label for="semester_name">Semester Name:</label>
        <select name="semester" id="semester">
            <?php
                while($row = mysqli_fetch_array($result)){
                    echo '<option value='.$row['semester_id'].'>'.$row['semester_name'].'</option>';
                }
            ?>
        </select><br>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>
<?php
  if(isset($_REQUEST["submit"])){
    $name =  $_POST['subject_name'];
    $credit_hr = $_POST['credit'];
    // $address =$_POST['student_address'];
    $semester_id =$_POST['semester'];
    // $noofsub=$_POST['number_subject'];
  //   echo $password.length();
    $sql = "INSERT INTO subjects ( subject_name, credit_hr, semester_id) 
    VALUES ( '$name', '$credit_hr', $semester_id)";
    if(mysqli_query($conn,$sql)){
        echo "Sucess";
        header("location:dashboard.php");
    }
    else{
        echo "unsucess".mysqli_error($conn);
    }
    // header("Location:dashboard.php");
  }
?>