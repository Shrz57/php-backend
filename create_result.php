<?php
   include("config.php");
   session_start();
?>
<?php
$id = $_SESSION['teacher_id'];
$student_id=$_SESSION['student_id'];
if(isset($_POST['submit']))
{
    $subject=$_POST['subject'];
    $percentage=$_POST['percentage'];
    $terminal=$_POST['is_terminal'];
    $display=$_POST['display_result'];
    if($terminal=="yes")
    {
        $is_terminal=1;
    }
    else
    {
        $is_terminal=0;
    }
    if($display=="yes")
    {
        $display_result=1;
    }
    else
    {
        $display_result=0;
    }
    
    if($percentage>=80)
    {
        $grade="A";
    }
    elseif($percentage>=60&&$percentage<80)
    {
        $grade="B";
    }
    elseif($percentage>=50&&$percentage<60)
    {
        $grade="C";
    }
    elseif($percentage>=40&&$percentage<50)
    {
        $grade="D";
    }
    else
    {
        $grade="F";
    }
    $sql_1 = "SELECT student_id, subject_id 
    FROM results
    WHERE student_id = $student_id AND subject_id = $subject;";
    $result = mysqli_query($conn, $sql_1);
    if(mysqli_num_rows($result)>0){
        echo "Cannot Create Multiple result, Try to Update!";
        $url = "dashboard.php";
        echo "<br> <a href= 'dashboard.php'>Get Back to dashboard </a>";
    }
    else{
        $sql_2= "INSERT INTO `results` ( `result_percentage`, `is_terminal`, `result_grade`, `display_result`, `teacher_id`, `student_id`, `subject_id`) 
        VALUES ( '$percentage', '$is_terminal', '$grade', '$display_result', '$id', '$student_id', '$subject');";
        if(mysqli_query($conn,$sql_2)){
            echo "Sucess";
            header("Location:dashboard.php");
        }
        else{
            echo "unsucess".mysqli_error($conn);
        }
    }
    }
?>