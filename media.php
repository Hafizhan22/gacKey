<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include "application/config/koneksi.php";
$module = "module";
$module = $_GET["module"];
$NIP = $_SESSION['nip_login'];
$name = $_SESSION['name_login'];
$initial = $_SESSION['initial_login'];
$role = $_SESSION['role_login'];
$image = $_SESSION['image_login'];
if ($NIP == "") {
    echo "<script>location.href='index.php';</script>";
} else {
    ?>

    <!doctype html>
    <html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>GAC KEY</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>

    <body>
        <div id="preloader">
            <div class="loader"></div>
        </div>

        <div class="page-container">

            <div class="sidebar-menu">
                <div class="sidebar-header">
                    <div class="logo">
                        <?php
                        if ($role == "Security Operation Center") {
                            ?>
                            <img src="application/gambar/logomenu.png" alt="logo">
                            <?php

                        } else {
                            ?>
                            <img src="application/gambar/logopengguna.jpg" alt="logo">

                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="main-menu">
                    <div class="menu-inner">
                        <?php include "application/models/menu.php"; ?>
                    </div>
                </div>
            </div>
            <!-- sidebar menu area end -->
            <!-- main content area start -->
            <div class="main-content">
                <!-- header area start -->
                <div class="header-area">
                    <div class="row align-items-center">
                        <!-- nav and search button -->
                        <div class="col-md-6 col-sm-8 clearfix">
                            <div class="nav-btn pull-left">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="search-box pull-left">
                                <!--
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                            -->
                            </div>
                        </div>
                        <!-- profile info & task notification -->
                        <div class="col-md-6 col-sm-4 clearfix">
                            <ul class="notification-area pull-right">
                                <li id="full-view"><i class="ti-fullscreen"></i></li>
                                <li id="full-view-exit"><i class="ti-zoom-out"></i></li>



                            </ul>
                        </div>
                    </div>
                </div>
                <!-- header area end -->
                <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">

                                <?php
                                $module = $_GET["module"];
                                if ($module == "home") {
                                    if ($role == "Security Operation System") {
                                        $judul_masuk = "SOC $initial";
                                    }
                                } else if ($module == "sale") {
                                    $judul_masuk = "Halaman Monitoring Sale";
                                } else if ($module == "keydata") {
                                    $judul_masuk = "Page data key";
                                } else if ($module == "profil_pengguna") {
                                    $judul_masuk = "Halaman Profil";
                                } else {
                                    $judul_masuk = "Selamat Datang Admin";
                                }

                                ?>
                                <?php
                                echo "<h4 class='page-title pull-left'>$judul_masuk</h4>";
                                ?>




                            </div>
                        </div>
                        <div class="col-sm-6 clearfix">
                            <div class="user-profile pull-right">

                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM account where NIP='$NIP'");
                                $d = mysqli_fetch_array($query);
                                $image_login = $d["image"];
                                $name_login = $d['name'];
                                ?>
                                <!-- poto -->
                                <img src="<?php echo "application/gambar/$image_login"; ?>" class="avatar user-thumb"
                                    alt="avatar" width='36' height='36' />
                                <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo "$name_login"; ?> <i
                                        class="fa fa-angle-down"></i></h4>
                                <div class="dropdown-menu">
                                    <?php
                                    if ($role == "Security Operation System") {
                                        echo "<a class='dropdown-item' href='media.php?module=profil'>Profile</a>";
                                    }
                                    // else if ($level_masuk == "Pengguna") {
                                    //     echo "<a class='dropdown-item' href='media.php?module=profil_pengguna'>Profil</a>";
                                    // }
                                    ?>

                                    <a class="dropdown-item" href="media.php?module=logout">Log Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- page title area end -->
                <div class="main-content-inner">
                    <?php
                    //-----------------------------------------
                    if ($module == "home") {
                        include "application/models/home.php";
                    } else if ($module == "user") {
                        include "application/models/user.php";
                    } else if ($module == "account") {
                        include "application/models/account.php";
                    } else if ($module == "pic_data") {
                        include "application/models/picData.php";
                    } else if ($module == "sale") {
                        include "application/models/sale.php";
                    } else if ($module == "profil") {
                        include "application/models/profil.php";
                    } else if ($module == "keydata") {
                        include "application/models/keyData.php";
                    } else if ($module == "logout") {
                        $terakhir = date('d-m-Y h:i:s');
                        $id_masuk = $_SESSION['id_masuk'];

                        #kill session
                        #$queryupdate = mysqli_query($koneksi, "UPDATE tbuser SET terakhir_login='$terakhir' WHERE id_user = '$id_masuk'");
                
                        session_destroy();
                        echo "<script>location.href='./index.php';</script>";
                        #alert('Akses anda Telah Berakhir.');
                
                    } else {
                        if ($role == "Security Operation System") {
                            include "application/models/home.php";
                        } else {
                            include "application/models/home_pengguna.php";
                        }
                    }


                    ?>
                </div>
            </div>
            <!-- main content area end -->
            <!-- footer area start-->
            <footer>
                <div class="footer-area">
                    <p>© Copyright 2025. GAC KEY Beta Version</p>
                </div>
            </footer>
            <!-- footer area end-->
        </div>
        <!-- page container area end -->
        <!-- offset area start -->
        <!-- offset area end -->
        <!-- jquery latest version -->
        <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
        <!-- bootstrap 4 js -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>
        <script src="assets/js/jquery.slicknav.min.js"></script>

        <!-- start chart js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
        <!-- start highcharts js -->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <!-- start zingchart js -->
        <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
        <script>
            zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
            ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
        </script>
        <!-- all line chart activation -->
        <script src="assets/js/line-chart.js"></script>
        <!-- all pie chart -->
        <script src="assets/js/pie-chart.js"></script>
        <!-- others plugins -->
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>

    </html>
    <?php
}
?>