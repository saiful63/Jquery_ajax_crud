<?php
include('con.php');

$id = $_POST["id"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];

$sql = "update students set first_name='{$fname}',last_name='{$lname}' where id='{$id}'";

$result = mysqli_query($conn,$sql);

if($result){
    echo 1;
}else{
    echo 0;
}