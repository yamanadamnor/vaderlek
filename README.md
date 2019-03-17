# vaderlek
API for weather data

| Field             | Type          | Null | Key | Default             | Extra                         |
|-------------------|---------------|------|-----|---------------------|-------------------------------|
| id                | int(11)       | NO   | PRI | NULL                | auto_increment                |
| time              | timestamp     | NO   |     | current_timestamp() | on update current_timestamp() |
| interval          | int(11)       | YES  |     | NULL                |                               |
|  temp_indoors     | decimal(11,2) | YES  |     | NULL                |                               |
| humidity_indoors  | int(11)       | YES  |     | NULL                |                               |
| temp_outdoors     | decimal(11,2) | YES  |     | NULL                |                               |
| humidity_outdoors | int(11)       | YES  |     | NULL                |                               |
| relative_humidity | decimal(11,2) | YES  |     | NULL                |                               |
| absolute_humidity | decimal(11,2) | YES  |     | NULL                |                               |
| wind_velocity     | decimal(11,2) | YES  |     | NULL                |                               |
| wind_gust         | decimal(11,2) | YES  |     | NULL                |                               |
| wind_direction    | varchar(255)  | YES  |     | NULL                |                               |
| dew_point         | decimal(11,2) | YES  |     | NULL                |                               |
| wind_cooldown     | decimal(11,2) | YES  |     | NULL                |                               |
| rain_amount_hour  | decimal(11,2) | YES  |     | NULL                |                               |
| rain_amount_day   | decimal(11,2) | YES  |     | NULL                |                               |
| rain_amount_week  | decimal(11,2) | YES  |     | NULL                |                               |
| rain_amount_month | decimal(11,2) | YES  |     | NULL                |                               |
| rain_amount_total | decimal(11,2) | YES  |     | NULL                |                               |
