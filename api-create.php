<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization');

$data = json_decode(file_get_contents("php://input"), true);

$pname = trim(htmlspecialchars($data["name"]), ENT_QUOTES);
$pprice = trim(htmlspecialchars($data["price"]), ENT_QUOTES);

if (!$pname) {
    http_response_code(400);
    echo json_encode(["message" => "this field cannot be empty"]);
    exit;
}

if (!$pprice) {
    http_response_code(404);
    echo json_encode(["message" => "this field cannot be empty"]);
    exit;
}

require_once "dbconfig.php";

$query = 'INSERT INTO tbl_product(product_name, product_price, created_at) VALUES("' . $pname . '", "' . $pprice . '", NOW())';

if (mysqli_query($conn, $query) or die("Insert failed")) {
    http_response_code(201);
    echo json_encode(['message' => 'Product created']);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Fail to create product', "status" => false]);
}