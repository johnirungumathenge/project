<?php

// session_start();

// Database connection parameters (replace with your actual credentials)
$db_host = 'localhost';
$db_name = 'project';
$db_user = 'root';
$db_password = '';

$conn = mysqli_connect($db_host,$db_user,$db_password, $db_name);
if(!$conn){
    die("Something went wrong?". mysqli_connect_error());
}
// else {
//     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }

?>
