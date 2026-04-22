<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Metode request tidak valid.'
    ]);
    exit;
}

$nama    = trim($_POST['nama'] ?? '');
$alamat  = trim($_POST['alamat'] ?? '');
$wilayah = trim($_POST['wilayah'] ?? '');
$lat     = trim($_POST['lat'] ?? '');
$lng     = trim($_POST['lng'] ?? '');
$tanggal = trim($_POST['tanggal'] ?? '');

if ($nama === '' || $alamat === '' || $wilayah === '' || $lat === '' || $lng === '' || $tanggal === '') {
    echo json_encode([
        'success' => false,
        'message' => 'Semua field wajib diisi.'
    ]);
    exit;
}

if (!is_numeric($lat) || !is_numeric($lng)) {
    echo json_encode([
        'success' => false,
        'message' => 'Latitude dan longitude harus berupa angka.'
    ]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO depot (nama, alamat, wilayah, lat, lng, tanggal) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('sssdds', $nama, $alamat, $wilayah, $lat, $lng, $tanggal);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Lokasi depot berhasil disimpan.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Gagal menyimpan data: ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
