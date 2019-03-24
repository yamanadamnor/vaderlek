<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection
include_once "../config/database.php";
include_once "../objects/product.php";

// Instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// Initialize object
$product = new Product($db);

// read products
// query products
$stmt = $product->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // products array
    $products_arr = array();
    $products_arr["records"] = array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $product_item = array(
            "id" => $id,
            "time" => $time,
            "interval" => $interval,
            "temp_indoors" => $temp_indoors,
            "humidity_indoors" => $humidity_indoors,
            "temp_outdoors" => $temp_outdoors,
            "humidity_outdoors" => $humidity_outdoors,
            "relative_humidity" => $relative_humidity,
            "absolute_humidity" => $absolute_humidity,
            "wind_velocity" => $wind_velocity,
            "wind_gust" => $wind_gust,
            "wind_direction" => $wind_direction,
            "dew_point" => $dew_point,
            "wind_cooldown" => $wind_cooldown,
            "rain_amount_hour" => $rain_amount_hour,
            "rain_amount_day" => $rain_amount_day,
            "rain_amount_week" => $rain_amount_week,
            "rain_amount_month" => $rain_amount_month,
            "rain_amount_total" => $rain_amount_total,
        );
        array_push($products_arr["records"], $product_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($products_arr);
}

// no products found will be here
else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
