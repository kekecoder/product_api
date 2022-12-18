<?php
header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');

require_once 'dbconfig.php';

$query = "SELECT * FROM tbl_product";

$result = mysqli_query($conn, $query) or die("failed");

$count = mysqli_num_rows($result);

if ($count > 0) {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $response = [
        "data" => []
    ];
    foreach ($rows as $row) {
        $response["data"][] = [
            "type" => "Product Item",
            "product_id" => $row['product_id'],
            "attributes" => [
                "product_name" => $row['product_name'],
                "product_price" => $row['product_price'],
                "created_at" => $row['created_at']
            ]
        ];
    }
    echo json_encode($response);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'No Product Found', "status" => false]);
}