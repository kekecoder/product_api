<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization');

$data = json_decode(file_get_contents("php://input"), true);

$search = $data['search'];

require_once 'dbconfig.php';

$query = "SELECT * FROM tbl_product WHERE product_name LIKE '%$search%' OR product_id LIKE '%$search%'";

$result = mysqli_query($conn, $query) or die("unable to perform search");

$count = mysqli_num_rows($result);

if ($count > 0) {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $response = [
        "data" => []
    ];
    foreach ($rows as $row) {
        $response["data"][] = [
            "type" => "product item",
            "product_id" => $row['product_id'],
            "attributes" => [
                "product_name" => ['product_name'],
                "product_price" => $row['product_price'],
                "created_at" => $row['created_at']
            ]
        ];
    }

    echo json_encode($response);
} else {
    http_response_code(404);
    echo json_encode(["message" => "no item found", "status" => false]);
}