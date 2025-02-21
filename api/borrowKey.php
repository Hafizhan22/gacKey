<?php
header('Content-Type: application/json');
include "../application/config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $pic = $data["pic"];
    $passId = $data["passId"];
    $purpose = $data["purpose"];
    $borrowTime = $data["time"];
    $RFIDlist = $data["keyIdList"];
    $soc = $data["account"];

    // Fungsi untuk mendapatkan ID baru dengan format LOG
    function getNewId($koneksi) {
        $sql_getMaxId = mysqli_query($koneksi, "SELECT MAX(id) as max_id FROM history");
        $row = $sql_getMaxId->fetch_assoc();
        $maxId = $row['max_id'];

        if ($maxId) {
            $newIdNum = intval(substr($maxId, 3)) + 1;
            $newId = 'LOG' . str_pad($newIdNum, 3, '0', STR_PAD_LEFT);
        } else {
            $newId = 'LOG001';
        }

        return $newId;
    }

    $outputSchema = array();

    foreach ($RFIDlist as $RFID) {
        $sql_selectKey = mysqli_query($koneksi, "SELECT * FROM key_data WHERE RFID = '$RFID'");
        if ($sql_selectKey->num_rows > 0) {
            $row_key = $sql_selectKey->fetch_assoc();
            if ($row_key["status"] == "Available") {
                //validasi status kunci
                $sql_upKey = mysqli_query($koneksi, "UPDATE key_data SET status = 'Borrowed' WHERE RFID = '$RFID'");
                if ($sql_upKey === TRUE) {
                    $newId = getNewId($koneksi);
                    $sql_inHistory = mysqli_query($koneksi, "INSERT INTO history VALUES ('$newId', '$passId', '$RFID', '$purpose', '$borrowTime', '$pic', '$soc', '', '', '', 'Active')");
                    if ($sql_inHistory === TRUE) {
                        $outputSchema[] = array(
                            "id" => $newId,
                            "passId" => $passId,
                            "key" => array(
                                "rfid" => $row_key["RFID"],
                                "type" => $row_key["type"],
                                "name" => $row_key["name"],
                                "quantity" => $row_key["quantity"],
                                "location" => $row_key["location"]
                            ),
                            "purpose" => $purpose,
                            "borrowTime" => $borrowTime,
                            "borrowPic" => $pic,
                            "borrowSoc" => $soc,
                            "returnTime" => "",
                            "returnPic" => "",
                            "returnSoc" => "",
                            "status" => "Active"
                        );
                    } else {
                        echo json_encode(array(
                            "errorSchema" => array(
                                "errorCode" => 500,
                                "errorMessage" => "Error inserting into history: " . $koneksi->error
                            )
                        ));
                        exit;
                    }
                } else {
                    echo json_encode(array(
                        "errorSchema" => array(
                            "errorCode" => 500,
                            "errorMessage" => "Error updating key status: " . $koneksi->error
                        )
                    ));
                    exit;
                }
            } else {
                echo json_encode(array(
                    "errorSchema" => array(
                        "errorCode" => 400,
                        "errorMessage" => "Key with RFID $RFID is not available."
                    )
                ));
                exit;
            }
        } else {
            echo json_encode(array(
                "errorSchema" => array(
                    "errorCode" => 404,
                    "errorMessage" => "Key with RFID $RFID not found."
                )
            ));
            exit;
        }
    }

    $response = array(
        "errorSchema" => array(
            "errorCode" => 200,
            "errorMessage" => "OK"
        ),
        "outputSchema" => $outputSchema
    );

    http_response_code(200);
    echo json_encode($response);
} else {
    echo json_encode(array(
        "errorSchema" => array(
            "errorCode" => 405,
            "errorMessage" => "Method Not Allowed"
        )
    ));
    http_response_code(405);
}
?>