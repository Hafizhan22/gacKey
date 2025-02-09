<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include "application/config/koneksi.php";
#$module="module";
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- login mulai -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action=''>
                    <div class="login-form-head">

                        <!-- 
                       -->
                        <a href="index.html"><img src="application/gambar/logoerp.png" alt="logo"></a>

                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label>Initial</label>
                            <input name='initial' value="" required>

                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="exampleInputPassword1" name='password' value="" required>

                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">

                                </div>
                            </div>
                            <div class="col-6 text-right">

                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name='login'>Login <i
                                    class="ti-arrow-right"></i></button>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>

<?php
if (isset($_POST['login'])) {

    $initial = $_POST['initial'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM account where initial='$initial' and password='$password'");
    if (mysqli_num_rows($query) == 0) {
        echo "<script>alert('Email atau Password Anda Salah, Silahkan Ulangi Kembali.');location.href='$_SERVER[PHP_SELF]';</script>";
    } else {
        $data = mysqli_fetch_array($query);
        $NIP = $data['NIP'];
        $name = $data['name'];
        $initial = $data['initial'];
        $role = $data['role'];
        $image = $data['image'];

        $_SESSION['nip_login'] = $NIP;
        $_SESSION['name_login'] = $name;
        $_SESSION['initial_login'] = $initial;
        $_SESSION['role_login'] = $role;
        $_SESSION['image_login'] = $image;
       
        echo "<script>location.href='media.php?module=home';</script>";
    }

}
?>