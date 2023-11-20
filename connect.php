<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'kiemtra';
$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    die('Khong the ket noi').mysqli_error($conn);
    exit();
}
mysqli_query($conn,"set names 'utf8'");
?>