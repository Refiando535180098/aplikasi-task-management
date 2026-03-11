<?php
include 'koneksi.php';

// Menangkap data dari React
$json = file_get_contents("php://input");
$data = json_decode($json);

// Cek apakah data benar-benar masuk
if(isset($data->nik) && isset($data->password)) {
    $nik = mysqli_real_escape_string($conn, $data->nik);
    $password = mysqli_real_escape_string($conn, $data->password);

    // Cari ke database
    $query = mysqli_query($conn, "SELECT * FROM initial_users WHERE nik='$nik' AND password='$password'");
    
    if(mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        $user['id'] = (int)$user['id']; 
        
        echo json_encode(["status" => "success", "user" => $user]);
    } else {
        echo json_encode(["status" => "error", "message" => "NIK atau Password tidak ditemukan di Database!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Data NIK dan Password kosong / tidak terkirim dari React."]);
}
?>