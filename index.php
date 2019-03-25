<?php
// Front controller
if (empty($_GET["url"])) {
    $_GET["url"] = "";
}

$urlArray = explode("/", $_GET["url"]);

$controller = array_shift($urlArray);
$action = array_shift($urlArray);

switch ($action) {
    case 'id':
        $parameter = array_shift($urlArray);
        $_GET["id"] = $parameter;
        break;
    default:
        break;
}

switch ($controller) {
    case '/':
        require "views/welcome.php";
        break;
    case "";
        require "views/welcome.php";
        break;
    case "read";
        require "api/product/read.php";
        break;
    case "calc";
        switch ($action) {
            case 'average':
                $field = array_shift($urlArray);
                $_GET["field"] = $field;
                $offset = array_shift($urlArray);
                $_GET["offset"] = $offset;
                $length = array_shift($urlArray);
                $_GET["length"] = $length;
                require "api/product/average.php";
                break;
            case 'min':
                $field = array_shift($urlArray);
                $_GET["field"] = $field;
                $offset = array_shift($urlArray);
                $_GET["offset"] = $offset;
                $length = array_shift($urlArray);
                $_GET["length"] = $length;
                require "api/product/min.php";
                break;
            case 'max':
                $field = array_shift($urlArray);
                $_GET["field"] = $field;
                $offset = array_shift($urlArray);
                $_GET["offset"] = $offset;
                $length = array_shift($urlArray);
                $_GET["length"] = $length;
                require "api/product/max.php";
                break;
            default:
                break;
        }
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
