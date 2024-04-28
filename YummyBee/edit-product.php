<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true) {
        echo '<script>window.location="login.php"</script>';
    }

    $product = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($product) == 0){
        echo '<script>window.location="product.php"</script>';
    }
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
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
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
            <h3>Edit Product</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="category" required>
                        <option value="">--Choose--</option>
                        <?php 
                            $category = mysqli_query($conn, "SELECT *FROM tb_category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($category)){
                        ?>
                        <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id)? 'selected':''; ?>> <?php echo $r['category_name']?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Product Name" value="<?php echo $p->product_name ?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Price" value="<?php echo $p->product_price ?>" required>
                    
                    <img src="product/<?php echo $p->product_image ?>" width="100px" alt="">
                    <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="input-control">
                    <textarea class="input-control" name="deskripsi" id="" rows="3" placeholder="Description"><?php echo $p->product_desc ?></textarea><br>
                    <select class="input-control" name="status" id="">
                        <option value="">--Choose--</option>
                        <option value="1" <?php echo ($p->product_status == 1)? 'selected':''; ?>>Available</option>
                        <option value="0" <?php echo ($p->product_status == 0)? 'selected':''; ?>>Sold Out</option>
                    </select>
                    <input type="submit" name="submit" value="Update" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){

                        // data input dari form
                        $category   = $_POST['category'];
                        $nama       = ucwords($_POST['nama']);
                        $harga      = $_POST['harga'];
                        $deskripsi  = $_POST['deskripsi'];
                        $status     = $_POST['status'];
                        $foto       = $_POST['foto'];

                        // data gambar baru 
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];
                        
                        
                        // jika ganti gambar
                        if($filename != ''){
                            $type1 = explode('.', $filename);
                            $type2 = $type1[1];

                            $newname = 'product'.time().'.'.$type2;

                            // menampung format file yg diizinkan
                            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');


                            // validasi format file
                            if(!in_array($type2, $tipe_diizinkan)){

                                echo '<script>alert("Invalid file format")</script>';

                            } else {
                                unlink('./product/'.$foto);
                                // proses upload file sekaligus insert ke database
                                move_uploaded_file($tmp_name, './product/'.$newname);
                                $namagambar = $newname;
                            }

                        } else {

                            // jika tidak ganti gambar
                            $namagambar = $foto;

                        }

                        // query update data produk
                        $update = mysqli_query($conn, "UPDATE tb_product SET
                                                category_id = '".$category."', 
                                                product_name = '".$nama."', 
                                                product_price = '".$harga."', 
                                                product_desc = '".$deskripsi."',
                                                product_image = '".$namagambar."',  
                                                product_status = '".$status."' 
                                                WHERE product_id = '".$p->product_id."' ");
                        if($update){
                            echo '<script>alert("Update succeed")</script>';
                            echo '<script>window.location="product.php"</script>';
                        } else {
                            echo 'Update failed'.mysqli_error($conn);
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2021 YummyBee</small>
        </div>
    </footer>
    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>