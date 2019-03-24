<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once "../config/database.php";
include_once "../objects/product.php";



// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->time) &&
    !empty($data->interval) &&
    !empty($data->temp_indoors) &&
    !empty($data->humidity_indoors) &&
    !empty($data->temp_outdoors) &&
    !empty($data->humidity_outdoors) &&
    !empty($data->relative_humidity) &&
    !empty($data->absolute_humidity) &&
    !empty($data->wind_velocity) &&
    !empty($data->wind_gust) &&
    !empty($data->wind_direction) &&
    !empty($data->dew_point) &&
    !empty($data->wind_cooldown) &&
    !empty($data->rain_amount_hour) &&
    !empty($data->rain_amount_day) &&
    !empty($data->rain_amount_week) &&
    !empty($data->rain_amount_month) &&
    !empty($data->rain_amount_total) 
){
 
    // set product property values
    $product->time = $data->time;
    $product->interval = $data->interval;
    $product->temp_indoors = $data->temp_indoors;
    $product->humidity_indoors = $data->humidity_indoors;
    $product->temp_outdoors = $data->temp_outdoors;
    $product->humidity_outdoors = $data->humidity_outdoors;
    $product->relative_humidity = $data->relative_humidity;
    $product->absolute_humidity = $data->absolute_humidity;
    $product->wind_velocity = $data->wind_velocity;
    $product->wind_gust = $data->wind_gust;
    $product->wind_direction= $data->wind_direction;
    $product->dew_point = $data->dew_point;
    $product->wind_cooldown = $data->wind_cooldown;
    $product->rain_amount_hour = $data->rain_amount_hour;
    $product->rain_amount_day = $data->rain_amount_day;
    $product->rain_amount_week = $data->rain_amount_week;
    $product->rain_amount_month = $data->rain_amount_month;
    $product->rain_amount_total = $data->rain_amount_total;
 
    // create the product
    if($product->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>