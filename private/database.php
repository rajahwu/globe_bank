<?php 

require_once('db_credentials.php');


function db_connect() {
    // echo DB_SERVER, "<br />", DB_USER, "<br />", DB_PASS, "<br />", DB_NAME, "<br />";
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if(!$connection) {
        die("Connection failed:  msg-> " . mysqli_connect_error() . "<br /> Error code: " . mysqli_connect_errno());
    }
    return $connection;
}

function db_disconnect($connection) {
    if(isset($connection)) {
        mysqli_close($connection);
    }
}
?>