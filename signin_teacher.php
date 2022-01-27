<?php
include('config.php');

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
    <label for="name">Teacher Name:</label>
    <input type="text" name="teacher_name" id="name"><br>
    <label for="email">Email:</label>
    <input type="text" name="teacher_email" id="email"><br>
    <label for="password">Password:</label>
    <input type="password" name="teacher_pass" id="password"><br>
    <label for="name">Branch</label>
    <input type="text" name="teacher_branch" id="name"><br>
    <input type="submit" value="Submit" name="submit">    
</form>
</body>
</html>

<?php
  //$conn = mysqli_connect("localhost","root","","resultmanagement");
//   if(!$conn){
//       die("Cannot Connect to database");
//   }  
  if(isset($_REQUEST["submit"])){
      $name =  $_POST['teacher_name'];
      $email = $_POST['teacher_email'];
      $temp_password = $_POST['teacher_pass'];
      $password = password_hash($temp_password,PASSWORD_DEFAULT);
      $branch=$_POST['teacher_branch'];
    //   echo $password.length();
      $sql = "INSERT INTO `teachers` ( `teacher_name`, `teacher_email`, `teacher_password`, `teacher_branch`) 
      VALUES ( '$name', '$email', '$password', '$branch')";
      if(mysqli_query($conn,$sql)){
          echo "Sucess";
      }
      else{
          echo "unsucess".mysqli_error($conn);
      }
      header("Location:welcome.php");
    }
?>