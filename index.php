<?php


$filename = "weather_data.csv";

// The nested array that holds the other arrays 
$weatherDataArr = [];


// Open the file for reading
if (($h = fopen($filename, "r")) !== FALSE) 
{
  // Convert each line into the local $data variable
  while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
  {		
      $weatherDataArr[] = $data;
  }

  // Close the file
  fclose($h);
}

// Converts every array object to UTF-8 from UTF-16
for ($i = 0; $i < count($weatherDataArr); $i++) {
  $results[$i] = mb_convert_encoding($weatherDataArr[$i], "UTF-8", "UTF-16");
}


var_dump($results);
