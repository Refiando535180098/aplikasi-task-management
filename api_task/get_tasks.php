<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM initial_tasks ORDER BY id DESC");

// Cek apakah query error
if (!$query) {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    exit();
}

$tasks = [];
while($row = mysqli_fetch_assoc($query)) {
    // Paksa pastikan formatnya angka (Integer)
    $row['id'] = (int)$row['id'];
    $row['assignedBy'] = (int)$row['assignedBy'];
    
    // Decode JSON, jika kosong/error maka jadikan array kosong []
    $row['assignedTo'] = json_decode($row['assignedTo']) ?: [];
    $row['comments'] = json_decode($row['comments']) ?: [];
    $row['attachments'] = json_decode($row['attachments']) ?: [];
    
    $tasks[] = $row;
}

echo json_encode(["status" => "success", "data" => $tasks]);
?>