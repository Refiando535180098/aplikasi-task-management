<?php
// 1. Wajib panggil koneksi di paling atas agar aturan CORS ikut terbawa
include 'koneksi.php';

// 2. Menangkap data JSON yang dikirim oleh React (fetch)
$json = file_get_contents("php://input");
$data = json_decode($json);

// 3. Pengecekan apakah data benar-benar ada
if(isset($data->title) && isset($data->assignedBy)) {
    
    // Bersihkan karakter aneh agar tidak error di MySQL
    $title = mysqli_real_escape_string($conn, $data->title);
    $description = mysqli_real_escape_string($conn, $data->description);
    
    // Array dari React diubah kembali jadi format String JSON untuk disimpan di MySQL
    $assignedTo = mysqli_real_escape_string($conn, json_encode($data->assignedTo));
    
    $assignedBy = (int)$data->assignedBy;
    $priority = mysqli_real_escape_string($conn, $data->priority);
    
    // Pastikan tanggal tidak kosong
    $dueDate = isset($data->dueDate) ? mysqli_real_escape_string($conn, $data->dueDate) : date('Y-m-d');
    
    $status = 'pending';
    $comments = '[]';
    $attachments = '[]';

    // 4. Masukkan ke database
    $sql = "INSERT INTO initial_tasks (title, description, assignedTo, assignedBy, status, priority, dueDate, comments, attachments) 
            VALUES ('$title', '$description', '$assignedTo', $assignedBy, '$status', '$priority', '$dueDate', '$comments', '$attachments')";

    if(mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "Berhasil disimpan!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal Query: " . mysqli_error($conn)]);
    }
} else {
    // Balasan jika form kosong
    echo json_encode(["status" => "error", "message" => "Data judul atau pembuat tugas kosong"]);
}
?>