<?php
$host = 'localhost';
$dbuser = 'postgres';
$dbpass = 'postgres';
$port = '5432';
$dbname = 'umrah';
// $koneksi = pg_connect("host={$host} post={$port} dbname={$dbname} user={$dbuser} password={$dbpass}");
// try {
    //code...
    $koneksi = new PDO("pgsql:dbname=$dbname;host=$host", $dbuser, $dbpass);
    // set error mode
    // $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
    // tampilkan pesan kesalahan jika koneksi gagal
//     print "Koneksi atau query bermasalah : " . $e->getMessage() . "<br/>";
//     die();
// }
session_start();