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
    function getID_history($koneksi)
    {
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
    foreach ($RFIDlist as $RFID) {
        global $koneksi;
        $sql_selectKey = mysqli_query($koneksi, "SELECT * FROM key_data WHERE RFID = '$RFID'");
        if ($sql_selectKey->num_rows > 0) {
            $row_key = $sql_selectKey->fetch_assoc();
            if ($row_key["status"] == "Available") {
                //validasi status kunci
                $sql_upKey = mysqli_query($koneksi, "UPDATE key_data SET status = 'Borrowed' WHERE RFID = '$row_key[status]'");
                if ($sql_upKey === TRUE) {
                    $newId = getNewId($koneksi);
                    $sql_inHistory = mysqli_query($koneksi, "INSERT INTO historyVALUES ('$newId','$passId', '$RFID', '$purpose', '$borrowTime', '$pic', '$soc', '', '', 'Active')");
                    if ($sql_inHistory === TRUE) {
                        $sql_select = mysqli_query($koneksi, "SELECT * FROM key_data WHERE RFID = '$RFID'");
                        $outputSchema[] = array(
                            "id" => $newId,
                            "passId" => $passId,
                            "key" => array(
                                "rfid" => $row_key["RFID"],
                                "type" => $row_key["type"],
                                "name" => $row_key["name"],
                                "room" => $row_key["room"],
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
                        http_response_code(200);
                        return json_encode($output);
                    } else {
                        // Handle insert error
                        $output = array(
                            "errorSchema" => array(
                                "errorCode" => 500,
                                "errorMessage" => "Failed to insert history"
                            )
                        );
                        http_response_code(500);
                        return json_encode($output);
                    }
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
    $response = array(
        "errorSchema" => array(
            "errorCode" => 200,
            "errorMessage" => "OK"
        ),
        "outputSchema" => $outputSchema
    );

    http_response_code(200);
    echo json_encode($response);


    // jagain metode request
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