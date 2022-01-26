<?php
session_start();

$host = 'localhost'; // host
$username = 'root'; // username
$password = ''; // password
$database = 'db_apotek'; // nama database
$port = null; // port
$socket = null; // socket

$conn = new mysqli($host, $username, $password, $database, $port, $socket); // koneksi

// koneksi gagal
if ($conn->connect_error) {
    echo 'Koneksi gagal';
    exit();
}

require_once 'functions.php';
