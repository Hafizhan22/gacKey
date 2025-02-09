<?php
header('Content-Type: application/json');
include "../application/config/koneksi.php";

$sql = mysqli_query($koneksi,"SELECT * FROM key_data");
$data = array();

if ($sql->num_rows > 0) {
    // Ambil data dari query
    while($row = $sql->fetch_assoc()) {
        $data[] = $row;
    }

    // Buat array untuk menyimpan error
    $error = array(
        "code" => 200,
        "message" => "OK"
    );

    // Buat array untuk menyimpan output
    $output = array(
        "errorSchema" => $error,
        "outputSchema" => $data
    );
    header('Content-Type: application/json');
    echo json_encode($output);
} else {
    // Buat array untuk menyimpan error
    $error = array(
        "errorSchema" => 404,
        "outputSchema" => "Not Found"
    );
    header('Content-Type: application/json');
    echo json_encode($error);
}

$koneksi->close();
?>