<?php
require "conn.php";
require "CsvParser.php";
function insertData($dataArr)
{
    // Adding data to database
    foreach ($dataArr as $key => $value) {
        $query = "INSERT INTO weather_data VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        runQuery(
            $query,
            [
                null,
                $dataArr[$key][1],
                $dataArr[$key][2],
                $dataArr[$key][3],
                $dataArr[$key][4],
                $dataArr[$key][5],
                $dataArr[$key][6],
                $dataArr[$key][7],
                $dataArr[$key][8],
                $dataArr[$key][9],
                $dataArr[$key][10],
                $dataArr[$key][11],
                $dataArr[$key][12],
                $dataArr[$key][13],
                $dataArr[$key][14],
                $dataArr[$key][15],
                $dataArr[$key][16],
                $dataArr[$key][17],
                $dataArr[$key][18],
            ],
            false
        );
    }

}

$entry = new CsvParser(["weather_data.csv", "weather_data_2.csv"]);
$results = $entry->getResults();;
insertData($results);
header('Location:index.php');