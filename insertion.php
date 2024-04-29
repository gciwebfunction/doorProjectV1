<?php


$con        = mysqli_connect('localhost','root', '','');

$query      = 'select id from door_measurements where door_id = 1001';
$res        = mysqli_query($con , $query);

while($ressss = mysqli_fetch_array($res)){
    echo $ressss['id'];
    echo '<hr>';
}


mysqli_close($con);