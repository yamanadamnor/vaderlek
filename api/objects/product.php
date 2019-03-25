<?php
class Product
{
    // database connection and table name
    private $conn;
    private $table_name = "weather_data";

    // object properties
    public $id;
    public $time;
    public $interval;
    public $temp_indoors;
    public $humidity_indoors;
    public $temp_outdoors;
    public $humidity_outdoors;
    public $relative_humidity;
    public $absolute_humidity;
    public $wind_velocity;
    public $wind_gust;
    public $wind_direction;
    public $dew_point;
    public $wind_cooldown;
    public $rain_amount_hour;
    public $rain_amount_day;
    public $rain_amount_week;
    public $rain_amount_month;
    public $rain_amount_total;

    // API specific properties
    // average
    public $average;
    public $field;
    public $offset;
    public $length;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {

// select all query
        $query = "SELECT * FROM $this->table_name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    public function readOne()
    {
        // query to read single record
        $query = "SELECT * FROM $this->table_name WHERE id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->time = $row["time"];
        $this->interval = $row["interval"];
        $this->temp_indoors = $row["temp_indoors"];
        $this->humidity_indoors = $row["humidity_indoors"];
        $this->temp_outdoors = $row["temp_outdoors"];
        $this->humidity_outdoors = $row["humidity_outdoors"];
        $this->relative_humidity = $row["relative_humidity"];
        $this->absolute_humidity = $row["absolute_humidity"];
        $this->wind_velocity = $row["wind_velocity"];
        $this->wind_gust = $row["wind_gust"];
        $this->wind_direction = $row["wind_direction"];
        $this->dew_point = $row["dew_point"];
        $this->wind_cooldown = $row["wind_cooldown"];
        $this->rain_amount_hour = $row["rain_amount_hour"];
        $this->rain_amount_day = $row["rain_amount_day"];
        $this->rain_amount_week = $row["rain_amount_week"];
        $this->rain_amount_month = $row["rain_amount_month"];
        $this->rain_amount_total = $row["rain_amount_total"];
    }

    public function getAverage()
    {
        $query = "SELECT AVG($this->field) FROM $this->table_name WHERE id>=$this->offset AND id<=$this->offset + $this->length";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->average = $row["AVG($this->field)"];
    }

    public function create()
    {
        // query to insert record
        $query = "INSERT INTO $this->table_name" .
            "SET
                time=:time,
                interval=:interval,
                temp_indoors=:temp_indoors,
                humidity_indoors=:humidity_indoors,
                temp_outdoors=:temp_outdoors,
                humidity_outdoors=:humidity_outdoors,
                relative_humidity=:relative_humidity,
                absolute_humidity=:absolute_humidity,
                wind_velocity=:wind_velocity,
                wind_gust=:wind_gust,
                wind_direction=:wind_direction,
                dew_point=:dew_point,
                wind_cooldown=:wind_cooldown,
                rain_amount_hour=:rain_amount_hour,
                rain_amount_day=:rain_amount_day,
                rain_amount_week=:rain_amount_week,
                rain_amount_month=:rain_amount_month,
                rain_amount_total=:rain_amount_total
            ";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->time = htmlspecialchars(strip_tags($this->time));
        $this->interval = htmlspecialchars(strip_tags($this->interval));
        $this->temp_indoors = htmlspecialchars(strip_tags($this->temp_indoors));
        $this->humidity_indoors = htmlspecialchars(strip_tags($this->humidity_indoors));
        $this->temp_outdoors = htmlspecialchars(strip_tags($this->temp_outdoors));
        $this->humidity_outdoors = htmlspecialchars(strip_tags($this->humidity_outdoors));
        $this->relative_humidity = htmlspecialchars(strip_tags($this->relative_humidity));
        $this->absolute_humidity = htmlspecialchars(strip_tags($this->absolute_humidity));
        $this->wind_velocity = htmlspecialchars(strip_tags($this->wind_velocity));
        $this->wind_gust = htmlspecialchars(strip_tags($this->wind_gust));
        $this->wind_direction = htmlspecialchars(strip_tags($this->wind_direction));
        $this->dew_point = htmlspecialchars(strip_tags($this->dew_point));
        $this->wind_cooldown = htmlspecialchars(strip_tags($this->wind_cooldown));
        $this->rain_amount_hour = htmlspecialchars(strip_tags($this->rain_amount_hour));
        $this->rain_amount_day = htmlspecialchars(strip_tags($this->rain_amount_day));
        $this->rain_amount_week = htmlspecialchars(strip_tags($this->rain_amount_week));
        $this->rain_amount_month = htmlspecialchars(strip_tags($this->rain_amount_month));
        $this->rain_amount_total = htmlspecialchars(strip_tags($this->rain_amount_total));

        // bind values
        $stmt->bindParam(":time", $this->time);
        $stmt->bindParam(":interval", $this->interval);
        $stmt->bindParam(":temp_indoors", $this->temp_indoors);
        $stmt->bindParam(":humidity_indoors", $this->humidity_indoors);
        $stmt->bindParam(":temp_outdoors", $this->temp_outdoors);
        $stmt->bindParam(":humidity_outdoors", $this->humidity_outdoors);
        $stmt->bindParam(":relative_humidity", $this->relative_humidity);
        $stmt->bindParam(":absolute_humidity", $this->absolute_humidity);
        $stmt->bindParam(":wind_velocity", $this->wind_velocity);
        $stmt->bindParam(":wind_gust", $this->wind_gust);
        $stmt->bindParam(":wind_direction", $this->wind_direction);
        $stmt->bindParam(":dew_point", $this->dew_point);
        $stmt->bindParam(":wind_cooldown", $this->wind_cooldown);
        $stmt->bindParam(":rain_amount_hour", $this->rain_amount_hour);
        $stmt->bindParam(":rain_amount_day", $this->rain_amount_day);
        $stmt->bindParam(":rain_amount_week", $this->rain_amount_week);
        $stmt->bindParam(":rain_amount_month", $this->rain_amount_month);
        $stmt->bindParam(":rain_amount_total", $this->rain_amount_total);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function insertData($dataArr)
    {
        // Adding data to database
        foreach ($dataArr as $key => $value) {
            $query = "INSERT INTO weather_data VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($query);

            if (
                isset($dataArr[$key][1]) &&
                isset($dataArr[$key][2]) &&
                isset($dataArr[$key][3]) &&
                isset($dataArr[$key][4]) &&
                isset($dataArr[$key][5]) &&
                isset($dataArr[$key][6]) &&
                isset($dataArr[$key][7]) &&
                isset($dataArr[$key][8]) &&
                isset($dataArr[$key][9]) &&
                isset($dataArr[$key][10]) &&
                isset($dataArr[$key][11]) &&
                isset($dataArr[$key][12]) &&
                isset($dataArr[$key][13]) &&
                isset($dataArr[$key][14]) &&
                isset($dataArr[$key][15]) &&
                isset($dataArr[$key][16]) &&
                isset($dataArr[$key][17]) &&
                isset($dataArr[$key][18])
            ) {
                # code...
                $this->id = null;
                $this->time = $dataArr[$key][1];
                $this->interval = $dataArr[$key][2];
                $this->temp_indoors = $dataArr[$key][3];
                $this->humidity_indoors = $dataArr[$key][4];
                $this->temp_outdoors = $dataArr[$key][5];
                $this->humidity_outdoors = $dataArr[$key][6];
                $this->relative_humidity = $dataArr[$key][7];
                $this->absolute_humidity = $dataArr[$key][8];
                $this->wind_velocity = $dataArr[$key][9];
                $this->wind_gust = $dataArr[$key][10];
                $this->wind_direction = $dataArr[$key][11];
                $this->dew_point = $dataArr[$key][12];
                $this->wind_cooldown = $dataArr[$key][13];
                $this->rain_amount_hour = $dataArr[$key][14];
                $this->rain_amount_day = $dataArr[$key][15];
                $this->rain_amount_week = $dataArr[$key][16];
                $this->rain_amount_month = $dataArr[$key][17];
                $this->rain_amount_total = $dataArr[$key][18];
            }

            $stmt->bindParam(1, $this->id);
            $stmt->bindParam(2, $this->time);
            $stmt->bindParam(3, $this->interval);
            $stmt->bindParam(4, $this->temp_indoors);
            $stmt->bindParam(5, $this->humidity_indoors);
            $stmt->bindParam(6, $this->temp_outdoors);
            $stmt->bindParam(7, $this->humidity_outdoors);
            $stmt->bindParam(8, $this->relative_humidity);
            $stmt->bindParam(9, $this->absolute_humidity);
            $stmt->bindParam(10, $this->wind_velocity);
            $stmt->bindParam(11, $this->wind_gust);
            $stmt->bindParam(12, $this->wind_direction);
            $stmt->bindParam(13, $this->dew_point);
            $stmt->bindParam(14, $this->wind_cooldown);
            $stmt->bindParam(15, $this->rain_amount_hour);
            $stmt->bindParam(16, $this->rain_amount_day);
            $stmt->bindParam(17, $this->rain_amount_week);
            $stmt->bindParam(18, $this->rain_amount_month);
            $stmt->bindParam(19, $this->rain_amount_total);

            $stmt->execute();

        }

    }

}
