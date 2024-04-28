<?php 
    include 'db.php';
    $contact = mysqli_query($conn, "SELECT admin_telp, admin_email FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($contact);
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
        <h1><a href="index.php">YummyBee</a></h1>
        <ul>
            <li><a href="view-product.php">Product</a></li>
        </ul>
        </div>
    </header>

    <!--search-->
    <div class="search">
        <div class="container">
            <form action="view-product.php">
                <input type="text" name="search" placeholder="type what are u looking for...">
                <input type="submit" name="cari" value="Search">
            </form>
        </div>
    </div>

    <!--category-->
    <div class="section">
        <div class="container">
            <h3>Category</h3>
            <div class="box">
                <?php 
                    $category = mysqli_query($conn, "SELECT *FROM tb_category ORDER BY category_id DESC");
                    if(mysqli_num_rows($category) > 0){
                        while($c =  mysqli_fetch_array($category)){
                ?>
                    <a href="view-product.php?cat=<?php echo $c['category_id'] ?>">
                        <div class="card">
                            <img src="img/<?php echo $c['category_name']?>-category.jpg" alt="">
                            <div class="container-card">
                                <p class="nama"><?php echo $c['category_name']?></p>
                            </div>
                        </div>
                    </a>
                <?php }} else { ?>
                    <p>Category does not exist</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- new product -->
    <div class="section">
        <div class="container">
            <h3>New Product!</h3>
            <div class="box">
                <?php 
                    $product = mysqli_query($conn, "SELECT *FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 4");
                    if(mysqli_num_rows($product) > 0){
                        while($p = mysqli_fetch_array($product)){
                ?>
                    <a href="detail-product.php?id=<?php echo $p['product_id']?>">
                        <div class="card">
                            <img src="product/<?php echo $p['product_image']?>" alt="">
                            <div class="container-card">
                                <p class="nama"><?php echo $p['product_name']?></p>
                                <p class="harga">Rp. <?php echo number_format($p['product_price'])?></p>
                            </div>
                        </div>
                    </a>
                <?php }} else { ?>
                    <p>No product here</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!--footer-->
    <div class="footer">
        <div class="container">
            <ul>
                <li>
                    <h5>Email</h5>
                    <p><?php echo $a->admin_email?></p>
                </li>
                <li>
                    <h5>Telp</h5>
                    <p><?php echo $a->admin_telp?></p>
                </li>
                <li>
                    <h5>Location</h5>
                    <p>Jakarta, Indonesia</p>
                </li>
            </ul>
            <small >Copyright &copy; 2021 YummyBee</small>
        </div>
    </div>
</body>
</html>