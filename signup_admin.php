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
    <label for="name">Admin Name:</label>
    <input type="text" name="admin_name" id="name"><br>
    <label for="email">Email:</label>
    <input type="text" name="admin_email" id="email"><br>
    <label for="password">Password:</label>
    <input type="password" name="admin_pass" id="password"><br>
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
      $name =  $_POST['admin_name'];
      $email = $_POST['admin_email'];
      $temp_password = $_POST['admin_pass'];
      $password = password_hash($temp_password,PASSWORD_DEFAULT);
    //   echo $password.length();
      $sql = "INSERT INTO `admins` (`admin_name`, `admin_email`, `admin_password`) 
      VALUES ('$name','$email', '$password');";
      if(mysqli_query($conn,$sql)){
          echo "Sucess";
      }
      else{
          echo "unsucess".mysqli_error($conn);
      }
      header("Location:admin_dashboard.php");
    }
?>