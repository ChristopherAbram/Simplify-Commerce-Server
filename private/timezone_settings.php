<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Date timezone Settings
 *
 * @package    private
 * @author     Christopher Abram
 * @version    1.0
 * @date	23.07.2015
 */
 
// Default timezone settings:
ini_set( 'date.timezone', 'Europe/Warsaw' ) && date_default_timezone_set( 'Europe/Warsaw' );

/* Object style ($data_time must be global)
$date_time_zone = new DateTimeZone( 'Europe/Warsaw' );
$date_time = new DateTime( "now", $date_time_zone );
$date_time->setTimezone( $date_time_zone );*/