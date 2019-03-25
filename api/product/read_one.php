
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
// include_once "../config/database.php";
// include_once "../objects/product.php";

include_once "api/config/database.php";
include_once "api/objects/product.php";

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);

// set ID property of record to read
$product->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$product->readOne();

if($product->id!=null){
// create array
$product_arr = array(
    "id" => $product->id,
    "time" => $product->time,
    "interval" => $product->interval,
    "temp_indoors" => $product->temp_indoors,
    "humidity_indoors" => $product->humidity_indoors,
    "temp_outdoors" => $product->temp_outdoors,
    "humidity_outdoors" => $product->humidity_outdoors,
    "relative_humidity" => $product->relative_humidity,
    "absolute_humidity" => $product->absolute_humidity,
    "wind_velocity" => $product->wind_velocity,
    "wind_gust" => $product->wind_gust,
    "wind_direction" => $product->wind_direction,
    "dew_point" => $product->dew_point,
    "wind_cooldown" => $product->wind_cooldown,
    "rain_amount_hour" => $product->rain_amount_hour,
    "rain_amount_day" => $product->rain_amount_day,
    "rain_amount_week" => $product->rain_amount_week,
    "rain_amount_month" => $product->rain_amount_month,
    "rain_amount_total" => $product->rain_amount_total,
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