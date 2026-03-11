<?php
include 'koneksi.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->brandName)) {
    $brand = mysqli_real_escape_string($conn, $data->brandName);
    $email = $data->autoEmail ? 1 : 0;
    $maintenance = $data->maintenanceMode ? 1 : 0;

    $sql = "UPDATE settings SET brand_name='$brand', auto_email=$email, maintenance_mode=$maintenance WHERE id=1";

    if(mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "error"]);
}
?>