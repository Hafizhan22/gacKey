<?php
header('Content-Type: application/json');
include "../application/config/koneksi.php";

function login($initial, $password) {
    global $koneksi;
    $sql = mysqli_query($koneksi,"SELECT * FROM account WHERE initial = '$initial' AND password = '$password'");
    if ($sql->num_rows > 0) {
        $row = $sql->fetch_assoc();
        $output = array(
            "errorSchema" => array(
                "errorCode" => 200,
                "errorMessage" => "OK"
            ),
            "outputSchema" => array(
                "name" => $row["name"],
                "initial" => $row["initial"],
                "role" => $row["role"]
            )
        );
        http_response_code(200);
        return json_encode($output);
    } else {
        $output = array(
            "errorSchema" => array(
                "errorCode" => 401,
                "errorMessage" => "Unauthorized"
            )
        );
        http_response_code(401);
        return json_encode($output);
    }
}

// jagain metode request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $initial = $data["initial"];
    $password = $data["password"];
    echo login($initial, $password);
} else {
    $output = array(
        "errorSchema" => array(
            "errorCode" => 405,
            "errorMessage" => "Method Not Allowed"
        )
    );
    http_response_code(405);
    echo json_encode($output);
}

$koneksi->close();
?>