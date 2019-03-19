<?php
require "conn.php";

function insertData() {
  global $dbm;
    $query = "INSERT INTO weather_data(
      'intervall',
      'temp_indoors',
      'humidity_indoors',
      'temp_outdoors',
      'relative_humidity',
      'absolute_humidity',
      'wind_velocity',
      'wind_gust',
      'wind_direction',
      'dew_point',
      'vindavskylning',
      'rain_amout_hour',
      'rain_amount_day',
      'rain_amount_week',
      'rain_amount_month',
      'rain_amounr_total'
    )
  values(null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,)";
    runQuery(
        $query,
        [
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
    );
}

