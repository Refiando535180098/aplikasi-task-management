<?php
include 'koneksi.php'; // Wajib agar CORS/izin akses terbawa

$json = file_get_contents("php://input");
$data = json_decode($json);

if(isset($data->taskId) && isset($data->status)) {
    $taskId = (int)$data->taskId;
    $newStatus = mysqli_real_escape_string($conn, $data->status);

    $sql = "UPDATE initial_tasks SET status='$newStatus' WHERE id=$taskId";

    if(mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "Berhasil update"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal SQL: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Data ID atau Status tidak dikirim oleh React"]);
}
?>