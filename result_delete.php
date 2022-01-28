<?php 
   include("config.php");
   session_start();
    if(isset($_GET['id']))
	{
		$id = intval(trim($_GET['id']));
		
		$sql = "DELETE FROM `results` 
        WHERE `results`.`result_id` = $id";
		$deleteRs = mysqli_query($conn,$sql);
		
		if(mysqli_affected_rows($conn) == 0)
		{
            echo "<script>alert('Data not deleted');</script>"; 
			// $_SESSION['error_msg'] = 'Unable to delete record';
			header('location:dashboad.php');
			// exit();
		}
		else
		{   
			echo "<script>alert('Data deleted');</script>"; 
            // $_SESSION['success_msg'] = 'Record has been deleted successfully';
			header('location:dashboard.php');
			// exit();
		}
	}
?>
