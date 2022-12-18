<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization');

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['product_id'];
require_once 'dbconfig.php';

$query = "SELECT * FROM tbl_product WHERE product_id = '" . $id . "'";

$result = mysqli_query($conn, $query) or die("unable to fetch item");

// $count = mysqli_fetch_row($result);


if ($rows = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
    $response = [
        "data" => []
    ];

    foreach ($rows as $row) {
        $response["data"][] = [
            "type" => "Product Item",
            "product_id" => $row['product_id'],
            "attributes" => [
                "product_name" => $row["product_name"],
                "product_price" => $row["product_price"],
                "created_at" => $row["created_at"]
            ]
        ];
    }
    echo json_encode($response);
} else {
    http_response_code(404);
    echo json_encode(["message" => "product does not exist", "status" => false]);
}