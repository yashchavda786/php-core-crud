<?php 
include_once('conn.php');
if(!empty($_GET['id'])){
    // remove image
    $qry=mysqli_query($conn,"SELECT * FROM products WHERE id  = ".$_GET['id']);
    $data = mysqli_fetch_assoc($qry);
    unlink('uploads/'.$data['img']);
    
    $qry=mysqli_query($conn,"DELETE FROM products WHERE id  = ".$_GET['id']);
    header('location:index.php');
}

?>
