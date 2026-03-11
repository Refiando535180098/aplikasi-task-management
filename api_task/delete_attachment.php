<?php
include 'koneksi.php';
$data = json_decode(file_get_contents("php://input"));

if(isset($data->taskId) && isset($data->attachmentId)) {
    $taskId = (int)$data->taskId;
    $attachmentId = (int)$data->attachmentId;

    $res = mysqli_query($conn, "SELECT attachments FROM initial_tasks WHERE id=$taskId");
    $row = mysqli_fetch_assoc($res);
    $attachments = $row['attachments'] ? json_decode($row['attachments'], true) : [];

    // Filter/Hapus file yang ID-nya cocok
    $newAttachments = array_filter($attachments, function($a) use ($attachmentId) {
        return (string)$a['id'] !== (string)$attachmentId;
    });

    // Susun ulang urutan array dan simpan kembali ke MySQL
    $newAttachments = array_values($newAttachments);
    $newJson = mysqli_real_escape_string($conn, json_encode($newAttachments));
    
    mysqli_query($conn, "UPDATE initial_tasks SET attachments='$newJson' WHERE id=$taskId");
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID Tugas atau Lampiran kosong']);
}
?>