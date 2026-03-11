<?php
include 'koneksi.php';

$json = file_get_contents("php://input");
$data = json_decode($json);

if(isset($data->taskId) && isset($data->comments)) {
    $taskId = (int)$data->taskId;
    
    // Ubah array chat dari React menjadi teks JSON untuk disimpan di MySQL
    $commentsJson = mysqli_real_escape_string($conn, json_encode($data->comments));

    $sql = "UPDATE initial_tasks SET comments='$commentsJson' WHERE id=$taskId";

    if(mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "Chat tersimpan"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan chat: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Data chat tidak lengkap"]);
}
?>