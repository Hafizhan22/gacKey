

<?php
date_default_timezone_set('Asia/Jakarta');



$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "gackey_base";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
 
if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
}
$date = date('d/m/20y');
$mounth = date('m');
$queryH = mysqli_query($koneksi, "SELECT * FROM sale WHERE date = '$date'");
$queryM = mysqli_query($koneksi, "SELECT SUBSTRING($date, 4, 2) FROM sale WHERE date LIKE '%$mounth%';");
if (!$queryH || mysqli_num_rows($queryH) == 0) {
    $trxH = 0;
} else {
    $jmldata = mysqli_num_rows($queryH);
    $trxH = $jmldata;
    
}
if (!$queryM || mysqli_num_rows($queryM) == 0) {
    $trxM = 0;
} else {
    $jmldata1 = mysqli_num_rows($queryM);
    $trxM =  $jmldata1;
    
}
$response = "<div id='content'>$trxH</div>";
$responsee = "<div id='contentt'>$trxM</div>";

// Mengirimkan respons
//echo "<span style='font-size: 1px; color: white;'>$response $responsee</span>";

?>











