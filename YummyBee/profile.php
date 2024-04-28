<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true) {
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT *FROM tb_admin WHERE admin_id = '".$_SESSION['a_id']."'");
    $d = mysqli_fetch_object($query);
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
            <h3>Profile</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
                    <input type="text" name="hp" placeholder="No Telp" class="input-control" value="<?php echo $d->admin_telp ?>" required>
                    <input type="submit" name="submit" value="Change Profile" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])){

                        $nama   = ucwords($_POST['nama']);
                        $user   = $_POST['user'];
                        $email  = $_POST['email'];
                        $hp     = $_POST['hp'];

                        $update = mysqli_query($conn, "UPDATE tb_admin SET
                                            admin_name = '".$nama."',
                                            username = '".$user."',
                                            admin_email = '".$email."',
                                            admin_telp = '".$hp."' 
                                            WHERE admin_id = '".$d->admin_id."'");
                        
                        if($update){
                            echo '<script>alert("Successfully changed data")</script>';
                            echo '<script>window.location="profile.php"</script>';
                        } else {
                            echo 'failed'.mysqli_error($conn);
                        }

                    }
                ?>
            </div>

            <h3>Change Password?</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Enter Your New Password" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Confirm Your New Password" class="input-control" required>
                    <input type="submit" name="change_password" value="Change Password" class="btn">
                </form>
                <?php 
                    if(isset($_POST['change_password'])){

                        $pass1   = $_POST['pass1'];
                        $pass2   = $_POST['pass2'];

                        if($pass2 != $pass1) {
                            echo '<script>alert("New password confirmed does not match")</script>';
                        } else {

                            $u_pass = mysqli_query($conn, "UPDATE tb_admin SET 
                                            a_password = '".MD5($pass1)."',
                                            WHERE admin_id = '".$d->admin_id."'");
                            
                            if($u_pass) {
                                echo '<script>alert("Successfully changed password")</script>';
                                echo '<script>window.location="profile.php"</script>';
                            } else {
                                echo 'failed'.mysqli_error($conn);
                            }
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