<?php
// Mengizinkan website mana pun (termasuk React localhost:3000/5173) untuk mengakses
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Penting: Tangani request preflight (OPTIONS) dari browser
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Sesuaikan dengan nama database yang Anda buat di phpMyAdmin
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_task_management"; 

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Gagal terhubung ke Database MySQL"]);
    exit();
}
?>