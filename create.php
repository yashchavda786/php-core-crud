<?php 
include_once('conn.php');
if(!empty($_POST)){
    extract($_POST);
    if(!empty($_FILES['img']['name'])){
        $file = $_FILES["img"]["tmp_name"];
        $file_extension = pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);
        $file_name = rand(0,99999999999).'.'.$file_extension;
        $path = "uploads/".$file_name;
        if(move_uploaded_file($file,$path)){
            $img = $file_name;
        }else{
            $img='';
        }
    }
    $qry = mysqli_query($conn,"INSERT INTO products(`name`,`price`,`img`) VALUES('$name','$price','$img')");
    if($qry){
        header('location:index.php');   
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="price">Price</label>
                            <input name="price" id="price" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <input type="file" name="img" id="img" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <input type="submit" value="submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap.js"></script>
</body>

</html>