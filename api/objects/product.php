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
}
