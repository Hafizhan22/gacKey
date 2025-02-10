3<?php
header('Content-Type: application/json');
include "../application/config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $pic = $data["pic"];
    $returnTime = $data["time"];
    $historyList = $data["historyIdList"];
    $soc = $data["account"];
    $outputSchema = array();

    foreach ($historyList as $idHistory) {
        $sql_selectHistory = mysqli_query($koneksi, "SELECT * FROM history WHERE ID = '$idHistory'");
        $row_history = $sql_selectHistory->fetch_assoc();
        $sql_selectKey = mysqli_query($koneksi, "SELECT * FROM key_data WHERE RFID = '" . $row_history['key_RFID'] . "'");
        if ($sql_selectKey->num_rows > 0) {
            $row_key = $sql_selectKey->fetch_assoc();
            if ($row_key["status"] == "Borrowed") {
                //validasi status kunci
                $sql_upKey = mysqli_query($koneksi, "UPDATE key_data SET status = 'Available' WHERE RFID = '" . $row_history['key_RFID'] . "'");
                if ($sql_upKey === TRUE) {
                    $sql_updateHistory = mysqli_query($koneksi, "UPDATE history SET returnPIC = '$pic', returnTime = '$returnTime', returnSOC = '$soc' WHERE ID = '" . $row_history['ID'] . "'");
                    $sql_upKey = mysqli_query($koneksi, "UPDATE history SET status = 'Inactive' WHERE ID = '$idHistory'");
                    if ($sql_updateHistory === TRUE) {
                        $outputSchema[] = array(
                            "id" => $row_history["ID"],
                            "passId" => $row_history["pass_id"],
                            "key" => array(
                                "rfid" => $row_key["RFID"],
                                "type" => $row_key["type"],
                                "name" => $row_key["name"],
                                "quantity" => $row_key["quantity"],
                                "location" => $row_key["location"]
                            ),
                            "purpose" => $row_history["purpose"],
                            "borrowTime" => $row_history["borrowTime"],
                            "borrowPic" => $row_history["borrowPIC"],
                            "borrowSoc" => $row_history["borrowSOC"],
                            "returnTime" => $row_history["returnTime"],
                            "returnPic" => $row_history["returnPIC"],
                            "returnSoc" => $row_history["returnSOC"],
                            "status" => $row_history["Status"]
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
                        "errorMessage" => "Key with RFID ". $row_history['key_RFID']. " is not Borrow."
                    )
                ));
                exit;
            }
        } else {
            echo json_encode(array(
                "errorSchema" => array(
                    "errorCode" => 404,
                    "errorMessage" => "Key with RFID $". $row_history['key_RFID']. " not found."
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