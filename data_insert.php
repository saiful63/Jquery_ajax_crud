<?php

include('con.php');

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];



$sql = "insert into students(first_name, last_name) values('{$first_name}','{$last_name}')";

$result = mysqli_query($conn,$sql);

if($result){
    echo 1;
}else{
    echo 0;
}



