<?php 
    error_reporting(0);
    include 'db.php';
    $contact = mysqli_query($conn, "SELECT admin_telp, admin_email FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($contact);

    $product = mysqli_query($conn, "SELECT *FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($product);
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
                <input type="text" name="search" placeholder="type what are u looking for..." value="<?php echo $_GET['search']?>">
                <input type="hidden" name="cat" value="<?php echo $_GET['cat']?>">
                <input type="submit" name="cari" value="Search">
            </form>
        </div>
    </div>

    <!--detail product-->
    <div class="section">
        <div class="container">
            <h3>Detail Product</h3>
            <div class="box">
                <div class="cards">
                    <img src="product/<?php echo $p->product_image?>" alt="">
                </div>
                <div class="cards-desc">
                    <div class="container-cards">
                        <h3><?php echo $p->product_name?></h3>
                        <h4 class="harga">Rp. <?php echo number_format($p->product_price)?></h4>
                        <p id="desc">Description: <br>
                            <?php echo $p->product_desc?>
                        </p>
                        <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp?>&text=Hi, can i order this yummies?" target="_blank">Order by Whatsapp</a></p>
                    </div>
                </div>
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