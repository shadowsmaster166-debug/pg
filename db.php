<?php
$host     = "localhost";
$port     = "5432";
$dbname   = "perpusdb";
$user     = "postgres";
$password = "Reza11";

$connection_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

$dbconn = pg_connect($connection_string);

if(!$dbconn) {
    echo "Koneksi gagal!";
}
?>