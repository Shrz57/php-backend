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
    <title>Login</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="name">Email:</label>
        <input type="text" name="patient_email" id="email"><br>
        <label for="password">Password :</label>
        <input type="password" name="patient_password" id="password">
        <input type="submit" value="submit" name="submit">
    </form>
</body>

</html>
<?php
    if(isset($_POST['submit'])){
        $email = $_POST['patient_email'];
        $temp_password = $_POST['patient_password'];
        
        // $email = mysqli_real_escape_string($conn, $email);  
        // $password = mysqli_real_escape_string($conn, $password);  
        
        $sql = "SELECT patient_id,patient_name,patient_password FROM `patients`
                WHERE patient_email = '$email'";  
        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($result);
        if($num_rows == 1){  
            $row = mysqli_fetch_assoc($result);
            if(password_verify($temp_password,$row['patient_password'])){
                $_SESSION['patient_id']=$row['patient_id'];
                $_SESSION['name'] = $row['patient_name'];
                header("location:appointment_create.php");
            }else{
                echo "password invalid";
            }
        }  
        else{  
                echo "<h1> Login failed. Invalid username or password.</h1>";
                // echo $count;  
            }
        mysqli_close($conn);     
        }    
?>