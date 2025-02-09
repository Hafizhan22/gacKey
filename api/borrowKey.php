<?php
header('Content-Type: application/json');
include "../application/config/koneksi.php";

function borrow($RFID)
{
    global $koneksi;
    $sql = mysqli_query($koneksi, "SELECT * FROM key_data WHERE RFID = '$RFID'");
    if ($sql->num_rows > 0) {
        $row = $sql->fetch_assoc();
        if ($row["status"] == "Available") {
            //validasi status kunci
            foreach ($RFIDlist as $RFID){

            }
            $borrowKey = mysqli_query($koneksi, "UPDATE key_data SET status = 'Borrowed' WHERE RFID = '$row[status]'");
            if ($borrowKey === TRUE) {
                $output = array(
                    "errorSchema" => array(
                        "errorCode" => 200,
                        "errorMessage" => "OK"
                    ),
                    "outputSchema" => array(
                        "RFID" => $row["RFID"],
                    )
                );
                http_response_code(200);
                return json_encode($output);
            } else {
                // Handle update error
                $output = array(
                    "errorSchema" => array(
                        "errorCode" => 500,
                        "errorMessage" => "Failed to update status"
                    )
                );
                http_response_code(500);
                return json_encode($output);
            }
        } else {
            $output = array(
                "errorSchema" => array(
                    "errorCode" => 404,
                    "errorMessage" => "The key is being borrowed"
                )
            );
            http_response_code(404);
            return json_encode($output);
        }
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
    $passId = $data["passId"];
    $purpose = $data["purpose"];
    $time = $data["time"];
    $RFIDlist = $data["keyIdList"];

    // Assuming you need to process the RFID based on the keyIdList
    foreach ($RFIDlist as $keyId) {
        echo borrow($keyId);
    }
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