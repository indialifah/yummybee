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
            <h3>Add Category</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="New Category" class="input-control" required>
                    <input type="submit" name="submit" value="Add" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){

                        $nama = ucwords($_POST['nama']);

                        $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES ( 
                                            null,
                                            '".$nama."')");
                        if($insert){
                            echo '<script>alert("Data successfully added")</script>';
                            echo '<script>window.location="category.php"</script>';
                        } else {
                            echo 'failed'.mysqli_error($conn);
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
</body>
</html>