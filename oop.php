<?php

class CsvParser
{
    protected $filenames;
    protected $decoded;
    protected $converted;
    protected $trimmed;
    protected $results;

    public function __construct(
        $filenames
    ) {
        $this->filenames = $filenames;
    }

    public function decodeAll()
    {
        foreach ($this->filenames as $file) {
            if (($h = fopen($file, "r")) !== false) {
                // Convert each line into the local $data variable
                while (($data = fgetcsv($h, 1000, "\t")) !== false) {
                    $this->decoded[] = $data;
                }
                // Close the file
                fclose($h);
            }
        }
    }

    public function convertAll()
    {
        // Converts every array object to UTF-8 from UTF-16
        foreach (array_slice($this->decoded, 1) as $v) {
            $this->converted[] = mb_convert_encoding($v, "UTF-8", "UTF-16");
        }
    }

    public function trimAll()
    {
        foreach ($this->converted as $key => $values) {
            foreach ($values as $value) {
                $this->trimmed[$key][] = trim($value);
            }
        }
    }

    public function convertValue($value)
    {

        if (is_numeric($value)) {
            $floatval = floatval($value);
            return $floatval;
        } else if (is_string($value)) {
            return $value;
        } 
    }

    public function convertAllValues()
    {
        foreach ($this->trimmed as $k => $values) {
            foreach ($values as $value) {
                $this->results[$k][] = $this->convertValue($value);
            }
        }
    }

    public function getResults()
    {
        return $this->results;
    }

}

$object = new CsvParser(["weather_data.csv", "weather_data_2.csv"]);
$object->decodeAll();
$object->convertAll();
$object->trimAll();
$object->convertAllValues();
$test = $object->getResults();
var_dump($test);
