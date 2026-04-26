<?php
header('Content-Type: application/json');

// --- KONFIGURASI DATA ANDA ---
$username = "USERNAME_ANDA"; // Masukkan Username DigiFlazz Anda
$apiKey   = "PRODUCTION_KEY_ANDA"; // Masukkan Production Key Anda
// -----------------------------

// Ambil data dari Frontend
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
    exit;
}

$buyer_sku_code = $data['sku']; // Kode produk (misal: ml10)
$customer_no    = $data['phone'];
$ref_id         = $data['orderId'];

// Membuat Signature MD5 (username + apiKey + ref_id)
$sign = md5($username . $apiKey . $ref_id);

$payload = [
    'username'   => $username,
    'buyer_sku_code' => $buyer_sku_code,
    'customer_no' => $customer_no,
    'ref_id'     => $ref_id,
    'sign'       => $sign
];

$ch = curl_init('https://api.digiflazz.com/v1/transaction');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
curl_close($ch);

echo $response; // Kirim balik jawaban DigiFlazz ke browser
