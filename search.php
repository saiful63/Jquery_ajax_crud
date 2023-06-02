<?php
include('con.php');

$searchable = $_POST['searchable'];

$sql="select * from students where first_name like '%{$searchable}%' or last_name like '%{$searchable}%'";

$query=mysqli_query($conn,$sql);

$output="";

if(mysqli_num_rows($query) > 0){
    $output='
    <table border="1" width="100%" cellspacing="0" cellpadding="10px">
     <tr>
     <th>Id</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Edit</th>
     <th>Delete</th>
     </tr>
    ';
    while($rows=mysqli_fetch_assoc($query)){
        $output.="
        <tr>
        <td>{$rows["id"]}</td>
        <td>{$rows["first_name"]}</td>
        <td>{$rows["last_name"]}</td>
        <td><button class='edit_btn' data-eid='{$rows["id"]}'>Edit</button></td>
        <td><button class='delete_btn' data-id='{$rows["id"]}'>Delete</button></td>
        </tr>
        ";

      
    }

    $output.='</table>';
    mysqli_close($conn);
    echo $output;
    
}else{
    echo"<h2>No Record found</h2>";
}

