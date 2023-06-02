<?php
include('con.php');
$id = $_POST["id"];

$sql = "select * from students where id='{$id}'";

$result=mysqli_query($conn,$sql);

$output="";

if(mysqli_num_rows($result)>0){
while($row=mysqli_fetch_assoc($result)){
    $output.="
    <tr>
    <td>First name</td>
    <td><input type='text' id='edit_fname' value='{$row["first_name"]}'></td>
    <td><input type='hidden' id='edit_id' value='{$row["id"]}'></td>
    </tr>

    <tr>
    <td>Last name</td>
    <td><input type='text' id='edit_lname' value='{$row["last_name"]}'></td>
    </tr>

    <tr>
    <td><input type='submit' class='edit_form' value='Update'></td>
    </tr>
    
    ";
}
mysqli_close($conn);

echo $output;

}else{
    echo "Data not found";
}

