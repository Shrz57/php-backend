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
    <label for="name">Patient Name:</label>
    <input type="text" name="patient_name" id="name"><br>
    <label for="email">Email:</label>
    <input type="text" name="patient_email" id="email"><br>
    <label for="password">Password:</label>
    <input type="password" name="patient_pass" id="password"><br>
    <label for="gender">Gender:</label>
    <input type="radio" name="gender" id="male" value="M"><label for="male">Male</label>
    <input type="radio" name="gender" id="female" value="F"><label for="female">female</label>
    <input type="radio" name="gender" id="others" value="O" checked><label for="others">Others</label><br>
    <label for="age">Age</label>
    <input type="number" name="age" id="age" min="0"><br>
    <label for="blood group">Blood group</label>
    <input type="text" name="bg" id="bg"><br>
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
      $name =  $_POST['patient_name'];
      $email = $_POST['patient_email'];
      $temp_password = $_POST['patient_pass'];
      $gender = $_POST['gender'];
      $age = $_POST['age'];
      $bg = $_POST['bg'];
      $password = password_hash($temp_password,PASSWORD_DEFAULT);
    //   echo $password.length();
      $sql = "INSERT INTO `patients` (`patient_name`, `patient_email`, `patient_password`, `patient_gender`, `patient_age`, `patient_bg`)
       VALUES ('$name', '$email', '$password', '$gender', $age,'$bg');";
      if(mysqli_query($conn,$sql)){
          echo "Sucess";
      }
      else{
          echo "unsucess".mysqli_error($conn);
      }
    }
    mysqli_close($conn);
?>