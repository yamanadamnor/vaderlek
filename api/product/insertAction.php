<?php
// require "conn.php";
require "api/objects/CsvParser.php";

$entry = new CsvParser(["weather_data_2.csv"]);
$results = $entry->getResults();;

include_once "api/config/database.php";
include_once "api/objects/product.php";

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);

// read the details of product to be edited
$product->insertData($results);

header('Location: views/inserted.php');