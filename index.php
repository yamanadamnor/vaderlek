<?php

// Front controller

if (empty($_GET["url"])) {
    $_GET["url"] = "";
}

$urlArray = explode("/", $_GET["url"]);

$page = array_shift($urlArray);
$parameter = array_shift($urlArray);

var_dump($_GET);
// var_dump($parameter);


switch ($page) {
    case '/':
        require "views/welcome.php";
        break;
    case "";
        require "views/welcome.php";
        break;
    case "read";
        require "api/product/read.php";
        break;
    case "readOne";
        include "api/product/read_one.php";
        break;
    case "insertData";
        require "api/product/insertAction.php";
        break;
    case "info";
        require "views/info.php";
        break;
    default:
        require "views/welcome.php";
        break;
}

?>
