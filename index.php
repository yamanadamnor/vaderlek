<?php
// require "conn.php";



$filename = "weather_data.csv";

// The nested array that holds the other arrays 
$weatherDataArr = [];


// Open the file for reading
if (($h = fopen($filename, "r")) !== FALSE) 
{
  // Convert each line into the local $data variable
  while (($data = fgetcsv($h, 1000, "\t")) !== FALSE) 
  {		
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
    $trimmed [$key][] = trim($value);
  }
}

function stringToFloat($value) {
  if(is_numeric($value)) {
    $floatval = floatval($value);
    return $floatval;
  } else {
    return $value;
  }
}

foreach ($trimmed as $key => $values) {
  foreach ($values as $value) {
    $converted[$key][] = stringToFloat($value);
  }
}



// Var_dump variables
// echo "Trimmed";
// var_dump($trimmed);

echo "Converted";
var_dump($converted);

// echo "Exploded header";
// var_dump($explodedHeader);

// echo "Original str";
// var_dump($str);

// echo "Results";
// var_dump($results);
