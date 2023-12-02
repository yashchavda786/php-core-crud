<?php
$host = 'localhost';
$dbname = 'demo';
$user = 'root';
$pass = '';
try{
    $conn = mysqli_connect($host,$user,$pass,$dbname);
}catch(Exception $e){
    echo $e->getMessage();
}
?>