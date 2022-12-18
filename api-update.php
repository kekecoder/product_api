<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization');

$data = json_decode(file_get_contents("php://input"), true);

$pid = $data['product_id'];
$pname = $data['product_name'];
$pprice = $data['product_price'];

require_once "dbconfig.php";

$query = 'UPDATE tbl_product SET product_name = "' . $pname . '", product_price = "' . $pprice . '" WHERE product_id = "' . $pid . '"';

if (mysqli_query($conn, $query) or die("Update failed")) {
    echo json_encode(["message" => "product updated"]);
} else {
    echo json_encode(["message" => "unable to update project"]);
}