<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'remember_me');
    $dbcon = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        echo "Failed to connect" . mysqli_connect_error();
    }
?>