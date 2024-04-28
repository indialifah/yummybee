<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true) {
        echo '<script>window.location="login.php"</script>';
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YummyBee</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="dashboard.php">YummyBee</a></h1>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="category.php">Category</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="out.php">Logout</a></li>
        </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Product</h3>
            <div class="box">
                <p id="btn-add"><a href="add-product.php">Add Data</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th width="80px">Category</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th width="175px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            $product = mysqli_query($conn, "SELECT *FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                            if(mysqli_num_rows($product) > 0) {
                            while($row = mysqli_fetch_array($product)){ 
                        ?>
                        <tr>
                            <td id="content-middle"><?php echo $no++ ?></td>
                            <td id="content-middle"><?php echo $row['category_name']?></td>
                            <td id="content-middle"><?php echo $row['product_name']?></td>
                            <td id="content-middle">Rp. <?php echo number_format($row['product_price']) ?></td>
                            <td id="desc-p"><?php echo $row['product_desc']?></td>
                            <td id="content-middle"><a href="product/<?php echo $row['product_image']?>" target="_blank"><img src="product/<?php echo $row['product_image']?>" width="60px"></a></td>
                            <td id="content-middle"><?php echo ($row['product_status'] == 0)? 'Sold Out':'Available'; ?></td>
                            <td id="content-middle">
                                <a id="btn-act" href="edit-product.php?id=<?php echo $row['product_id'] ?>">Edit</a> 
                                <a id="btn-act" href="delete-product.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm('Are you sure to delete it?')">Delete</a>
                            </td>
                        </tr>
                        <?php }} else { ?>
                            <tr>
                                <td id="content-middle" colspan="8">Oops! you have not input the data yet</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2021 YummyBee</small>
        </div>
    </footer>
</body>
</html>