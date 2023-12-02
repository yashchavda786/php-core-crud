<?php
include_once('conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Records</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <h1>Products</h1>
            </div>
            <div class="col-6 text-end">
                <a href="create.php" class="btn btn-primary">Add Products</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $qry = mysqli_query($conn, "SELECT * FROM products");
                $data = mysqli_fetch_all($qry,MYSQLI_ASSOC);
                
                if (!empty($data)) {
                    foreach ($data as $row) {
                        $edit_link  = "<a class='btn btn-info' href='edit.php?id=" . $row['id'] . "'>edit</a>";
                        $del_link  = " <a class='btn btn-danger' href='delete.php?id=" . $row['id'] . "'>Delete</a>";
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $edit_link . "  " . $del_link . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="assets/bootstrap.js"></script>
</body>
</html>