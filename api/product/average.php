<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');


include_once "api/config/database.php";
include_once "api/objects/product.php";

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);

// set field, offset and length property of record to read
$product->field = isset($_GET['field']) ? $_GET['field'] : die();
$product->offset = isset($_GET['offset']) ? $_GET['offset'] : die();
$product->length = isset($_GET['length']) ? $_GET['length'] : die();

$product->getAverage();

if ($product->field!=null) {
  $product_arr = array(
    "average" => $product->average
  );

// set response code - 200 OK
http_response_code(200);

// make it json format
echo json_encode($product_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>