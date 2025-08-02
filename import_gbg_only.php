<?php
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
//live
//$con            = mysqli_connect('localhost','meta-laravel-app-qc', '?MHHifAH9+@$dt8(j))','meta-laravel-app-QC-database');


$con            = mysqli_connect('localhost','root', '','door_2025-07-09');
//$door_id        = 1022;
$door_id        = $_GET['door_id'];
$group_name     = 'GLASS_GRID';


//select measurements
$query          = "select id from door_measurements where door_id  = $door_id   order by id asc ";
$res            = mysqli_query($con , $query);

if($res>=1) {
    //measurements loop
    while($ressss   = mysqli_fetch_array($res)){
        $measure_id             =  $ressss['id'];

        echo   $swl10 = "INSERT INTO `additional_option_values`
            (`name`, `group_name`, `price`, `is_per_panel`, `is_per_light`, `door_id`, `door_measurement_id`, `image_id`, `created_at`,
             `updated_at`, `disabled`, `has_price`, `multiplier`, `is_custom_option`) VALUES
            ( '10-Lite GBG', '$group_name',   0, 0, 1, $door_id, $measure_id, -1, '2025-07-31 00:00:00', 
             '2025-07-25 00:00:00', 0, 1, 1, -1);";
        echo '<br>';

        echo   $swl10 = "INSERT INTO `additional_option_values`
            (`name`, `group_name`, `price`, `is_per_panel`, `is_per_light`, `door_id`, `door_measurement_id`, `image_id`, `created_at`,
             `updated_at`, `disabled`, `has_price`, `multiplier`, `is_custom_option`) VALUES
            ( '12-Lite GBG', '$group_name',   0, 0, 1, $door_id, $measure_id, -1, '2025-07-31 00:00:00', 
             '2025-07-25 00:00:00', 0, 1, 1, -1);";
        echo '<br>';
        echo   $swl10 = "INSERT INTO `additional_option_values`
            (`name`, `group_name`, `price`, `is_per_panel`, `is_per_light`, `door_id`, `door_measurement_id`, `image_id`, `created_at`,
             `updated_at`, `disabled`, `has_price`, `multiplier`, `is_custom_option`) VALUES
            ( '15-Lite GBG', '$group_name',   0, 0, 1, $door_id, $measure_id, -1, '2025-07-31 00:00:00', 
             '2025-07-25 00:00:00', 0, 1, 1, -1);";
        echo '<br>';
        echo   $swl10 = "INSERT INTO `additional_option_values`
            (`name`, `group_name`, `price`, `is_per_panel`, `is_per_light`, `door_id`, `door_measurement_id`, `image_id`, `created_at`,
             `updated_at`, `disabled`, `has_price`, `multiplier`, `is_custom_option`) VALUES
            ( '18-Lite GBG', '$group_name',   0, 0, 1, $door_id, $measure_id, -1, '2025-07-31 00:00:00', 
             '2025-07-25 00:00:00', 0, 1, 1, -1);";
        echo '<br>';



    }




}

mysqli_close($con);