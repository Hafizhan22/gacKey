<?php
header("Content-Type: application/json");
include "../application/config/koneksi.php";
// Cek apakah metode request adalah POST
$sql = mysqli_query($koneksi,"SELECT * FROM account WHERE initial = '$initial' AND password = '$password'");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari body request
    $input = json_decode(file_get_contents('php://input'), true);

    // Validasi data
    
    if (isset($input['name']) && isset($input['email'])) {
        $name = $input['name'];
        $email = $input['email'];

        // Buat response
        $response = [
            'status' => 'success',
            'message' => 'Data received',
            'data' => [
                'name' => $name,
                'email' => $email
            ]
        ];

        // Set response code 200 OK
        http_response_code(200);
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Invalid input'
        ];

        // Set response code 400 Bad Request
        http_response_code(400);
    }

    // Kirim response dalam format JSON
    echo json_encode($response);
} else {
    // Set response code 405 Method Not Allowed
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>