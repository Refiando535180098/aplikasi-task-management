<?php
include 'koneksi.php';

// Buat folder uploads otomatis jika belum ada
if (!file_exists('uploads')) { mkdir('uploads', 0777, true); }

if(isset($_FILES['file']) && isset($_POST['taskId']) && isset($_POST['uploaderId'])) {
    $taskId = (int)$_POST['taskId'];
    $uploaderId = (int)$_POST['uploaderId'];
    
    $file = $_FILES['file'];
    // Ubah nama file agar unik (tidak tertimpa jika nama file sama)
    $fileName = time() . '_' . str_replace(' ', '_', basename($file['name']));
    $targetPath = 'uploads/' . $fileName;

    if(move_uploaded_file($file['tmp_name'], $targetPath)) {
        // Ambil data lampiran yang sudah ada di database
        $res = mysqli_query($conn, "SELECT attachments FROM initial_tasks WHERE id=$taskId");
        $row = mysqli_fetch_assoc($res);
        $attachments = $row['attachments'] ? json_decode($row['attachments'], true) : [];
        if (!is_array($attachments)) $attachments = [];

        // Buat objek lampiran baru
        $newAttachment = [
            'id' => time(),
            'name' => $file['name'],
            'url' => 'http://localhost/api_task/' . $targetPath, // Link asli file
            'type' => $file['type'],
            'uploaderId' => $uploaderId
        ];

        $attachments[] = $newAttachment;
        $newJson = mysqli_real_escape_string($conn, json_encode($attachments));
        mysqli_query($conn, "UPDATE initial_tasks SET attachments='$newJson' WHERE id=$taskId");

        echo json_encode(['status' => 'success', 'data' => $newAttachment]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal upload fisik ke server']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Data file tidak lengkap']);
}
?>