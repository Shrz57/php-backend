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
    <title>Sign Up</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="name">Doctor Name:</label>
    <input type="text" name="doctor_name" id="name"><br>
    <label for="email">Email:</label>
    <input type="text" name="doctor_email" id="email"><br>
    <label for="password">Password:</label>
    <input type="password" name="doctor_pass" id="password"><br>
    <label for="qualification">Qualification</label>
    <input type="radio" name="qualification" id="MBBS" value="MBBS" checked><label for="MBBS">MBBS</label>
    <input type="radio" name="qualification" id="MD" value="MD"><label for="MD">MD</label>
    <input type="radio" name="qualification" id="DM" value="DM" ><label for="DM">DM</label><br>
    <input type="submit" value="Submit" name="submit">    
</form>
</body>
</html>

<?php
  $conn = mysqli_connect("localhost","root","","appointment_system");
  if(!$conn){
      die("Cannot Connect to database");
  }  
  if(isset($_REQUEST["submit"])){
      $name =  $_POST['doctor_name'];
      $email = $_POST['doctor_email'];
      $temp_password = $_POST['doctor_pass'];
      $qualification = $_POST['qualification'];
      $password = password_hash($temp_password,PASSWORD_DEFAULT);
      
      if(!isset($_SESSION['admin_id'])){
          header("location:login.php");
      }
      else{
          $admin_id = $_SESSION['admin_id'];
          $is_archived =  0;
          $sql = "INSERT INTO `doctors` (`doctor_name`, `patient_email`, `doctor_password`, `doctor_qualification`, `is_archived`, `admin_id`) 
          VALUES ('$name', '$email', '$password', '$qualification', $is_archived, $admin_id)";
          if(mysqli_query($conn,$sql)){
                echo "Sucess";
                header("location:admin_dashboard.php");
            }
          else{
                echo "unsucess".mysqli_error($conn);
            }
      }
    }
    mysqli_close($conn);
?>