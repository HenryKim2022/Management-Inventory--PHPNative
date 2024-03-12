<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Jika belum dimulai, mulai sesi
}


//membuat keneksi antar databse
// $conn = mysqli_connect("localhost", "root", "", "stokbarang");
$conn = mysqli_connect("localhost", "root", "", "DB_MANAGEMENT_INVENTORY");