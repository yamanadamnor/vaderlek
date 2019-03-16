DROP TABLE IF EXISTS `weather_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weather_data` (
  `id`                   INT(11) NOT NULL AUTO_INCREMENT,
  `time`                 TIMESTAMP,
  `interval`            INT(11), 
  `temp_indoors`         DECIMAL(11,2),
  `humidity_indoors`     INT(11),
  `temp_outdoor`         INT(11),
  `humidity_outdoors`    INT(11),
  `relative_humidity`    DECIMAL(11,2),
  `absolute_humidity`    DECIMAL(11,2),
  `wind_velocity`        DECIMAL(11,2),
  `wind_gust`            DECIMAL(11,2),
  `wind_direction`       VARCHAR(255),
  `dew_point`            DECIMAL(11,2),
  `wind_cooldown`        DECIMAL(11,2),
  `rain_amount_hour`     DECIMAL(11,2),
  `rain_amount_day`      DECIMAL(11,2),
  `rain_amount_week`     DECIMAL(11,2),
  `rain_amount_month`    DECIMAL(11,2),
  `rain_amount_total`    DECIMAL(11,2),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- TODO: Testa använda loadtable