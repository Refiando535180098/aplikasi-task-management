<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM settings WHERE id=1");
$row = mysqli_fetch_assoc($query);

if($row) {
    // Ubah format data agar cocok dengan React
    $settings = [
        "brandName" => $row['brand_name'],
        "autoEmail" => (bool)$row['auto_email'],
        "maintenanceMode" => (bool)$row['maintenance_mode']
    ];
    echo json_encode(["status" => "success", "data" => $settings]);
} else {
    echo json_encode(["status" => "error", "message" => "Pengaturan tidak ditemukan"]);
}
?>