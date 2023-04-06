<?php
$connection = new mysqli("localhost", "developer", "elc2022prtc", "desarollo");
if ($connection->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}




?>