<?php

include('con.php');

$sid = $_POST['sid'];

$sql = "delete from students where id='{$sid}'";
$result = mysqli_query($conn,$sql);

if($result){
    echo 1;
}else{
    echo 0;
}



// $student_id = $_POST["id"];

// $conn = mysqli_connect("localhost","root","","ajax_php") or die("Connection Failed");

// $sql = "DELETE FROM students WHERE id = {$student_id}";

// if(mysqli_query($conn, $sql)){
//   echo 1;
// }else{
//   echo 0;
// }