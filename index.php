<?php
require "conn.php";

$filename = "weather_data.csv";

// The nested array that holds the other arrays
$weatherDataArr = [];

// Open the file for reading
if (($h = fopen($filename, "r")) !== false) {
    // Convert each line into the local $data variable
    while (($data = fgetcsv($h, 1000, "\t")) !== false) {
        $weatherDataArr[] = $data;
    }

    // Close the file
    fclose($h);
}
// var_dump($weatherDataArr);

// Converts every array object to UTF-8 from UTF-16
for ($i = 0; $i < count($weatherDataArr); $i++) {
    $results[$i] = mb_convert_encoding($weatherDataArr[$i], "UTF-8", "UTF-16");
}
// var_dump($results);

// Shifting the first element of the array and saving it to $header
$header[] = array_shift($results);

// Explodes $header
$explodedHeader = explode("\t", $header[0][0]);

foreach ($results as $key => $values) {
    foreach ($values as $value) {
        $trimmed[$key][] = trim($value);
    }
}

function stringToFloat($value)
{
    if (is_numeric($value)) {
        $floatval = floatval($value);
        return $floatval;
    } else if (is_string($value)) {
        return $value;
    } else {
        $value = "inte ett värde";
        return $value;
    }
}

foreach ($trimmed as $key => $values) {
    foreach ($values as $value) {
        $converted[$key][] = stringToFloat($value);
    }
}

// Adding data to database
foreach ($converted as $key => $value) {
    $query = "INSERT INTO weather_data
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    runQuery(
        $query,
        [
            null,
            $converted[$key][1],
            $converted[$key][2],
            $converted[$key][3],
            $converted[$key][4],
            $converted[$key][5],
            $converted[$key][6],
            $converted[$key][7],
            $converted[$key][8],
            $converted[$key][9],
            $converted[$key][10],
            $converted[$key][11],
            $converted[$key][12],
            $converted[$key][13],
            $converted[$key][14],
            $converted[$key][15],
            $converted[$key][16],
            $converted[$key][17],
            $converted[$key][18],
        ],
        false
    );
    // var_dump($converted[$key][1]);
}

// Var_dump variables
// echo "Query";
// var_dump($query);

// echo "Converted";
// foreach ($converted as $key => $value) {
//     var_dump($value);
// }
// var_dump($converted);

// echo "Exploded header";
// var_dump($explodedHeader);

// echo "Original str";
// var_dump($str);

// echo "Results";
// var_dump($results);
