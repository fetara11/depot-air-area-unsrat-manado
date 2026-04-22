<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'koneksi.php';

$sql = "SELECT id, nama, alamat, wilayah, lat, lng, tanggal FROM depot ORDER BY id DESC";
$result = $conn->query($sql);

$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['lat'] = (float)$row['lat'];
        $row['lng'] = (float)$row['lng'];
        $data[] = $row;
    }
}

echo json_encode([
    'success' => true,
    'total' => count($data),
    'data' => $data
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
