<?php
include_once('conn.php');

// GET DATA FROM DATABASE FOR EDIT
if (!empty($_GET['id'])) {
    $qry = mysqli_query($conn, "SELECT * FROM products WHERE id = ".$_GET['id']);
    $data = mysqli_fetch_assoc($qry);
}
else{
    header('location:index.php');
}

//UPDATE DATA
if (!empty($_POST)) {
    extract($_POST);
    if (!empty($_FILES['img']['name'])) {
        // NEW IMAGE UPLOAD
        $file = $_FILES["img"]["tmp_name"];
        $file_extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $file_name = rand(0, 99999999999) . '.' . $file_extension;
        $path = "uploads/" . $file_name;

        // REMOVE OLDER IMAGE 
        unlink("uploads/".$old_img);

        if (move_uploaded_file($file, $path)) {
            $img = $file_name;
            $qry = mysqli_query($conn, "UPDATE products SET `name`='$name',`price`='$price',`img`='$img' WHERE `id` = $id");
        } else {
            $qry = mysqli_query($conn, "UPDATE products SET `name`='$name',`price`='$price' WHERE `id` = $id");
        }
    }
    else{
        $qry = mysqli_query($conn, "UPDATE products SET `name`='$name',`price`='$price' WHERE `id` = $id");
    }
    if ($qry) {
        header('location:index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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
                            <input type="text" id="name" name="name" class="form-control" value="<?= $data['name'] ?>" required>
                        </div>
                        <div class="col-6">
                            <label for="price">Price</label>
                            <input name="price" id="price" class="form-control" required value="<?= $data['price'] ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <input type="file" name="img" id="img" class="form-control">
                            <?php 
                                if(!empty($data['img'])){
                                    echo '<img src="uploads/'.$data['img'].'" alt="image" width="150px">';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <input type="hidden" name="old_img" value="<?= $data['img'] ?>">
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