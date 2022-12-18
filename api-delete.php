<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization');

$data = json_decode(file_get_contents("php://input"), true);

$pid = $data["product_id"];

require_once 'dbconfig.php';

$query = "DELETE FROM tbl_product WHERE product_id = '" . $pid . "'";

if (mysqli_query($conn, $query) or die("Delete Failed")) {
    echo json_encode(["message" => "product Deleted"]);
} else {
    echo json_encode(["message" => "unable to delete product"]);
}