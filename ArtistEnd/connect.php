<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "melodise_db";
try {
    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);
} catch (mysqli_sql_exception) {
    echo "Connection to the database failed!";
}
