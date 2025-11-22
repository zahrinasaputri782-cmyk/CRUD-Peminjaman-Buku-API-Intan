<?php
// Mengimpor koneksi database
include 'db.php';

// Header CORS & JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Handle preflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Function untuk response JSON
function sendResponse($status, $message, $data = null, $total = 0) {
    $res = [
        "status" => $status,
        "message" => $message,
        "total_data" => $total,
        "data" => $data
    ];

    echo json_encode($res, JSON_PRETTY_PRINT);
    exit;
}

// Ambil method request
$method = $_SERVER['REQUEST_METHOD'];

// Ambil input (POST, PUT, DELETE lewat JSON body)
if ($method == "GET") {
    $input = $_GET;
} else {
    $raw = file_get_contents("php://input");
    $input = json_decode($raw, true) ?? [];
}

// --------------------------------------------
//                ROUTING API
// --------------------------------------------

switch ($method) {

    // =======================
    //   GET (READ)
    // =======================
    case "GET":
        $id = isset($input['id']) ? (int)$input['id'] : 0;

        // Ambil buku berdasarkan ID
        if ($id > 0) {
            $q = mysqli_query($koneksi, "SELECT * FROM buku WHERE id = $id");
            $data = mysqli_fetch_assoc($q);

            if ($data) {
                sendResponse("success", "Data buku ditemukan", $data, 1);
            } else {
                sendResponse("error", "Buku dengan ID $id tidak ditemukan");
            }
        }

        // Ambil semua buku
        $q = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id DESC");
        $rows = [];
        while ($d = mysqli_fetch_assoc($q)) {
            $rows[] = $d;
        }

        sendResponse("success", "Daftar buku berhasil diambil", $rows, count($rows));
        break;

    // =======================
    //   POST (CREATE)
    // =======================
    case "POST":
        $judul   = $input['judul']   ?? '';
        $penulis = $input['penulis'] ?? '';
        $tahun   = $input['tahun']   ?? '';
        $stok    = $input['stok']    ?? '';

        if (!$judul || !$penulis || !$tahun || $stok === '') {
            sendResponse("error", "Semua field wajib diisi (judul, penulis, tahun, stok)");
        }

        $sql = "INSERT INTO buku (judul, penulis, tahun, stok)
                VALUES ('$judul', '$penulis', $tahun, $stok)";

        if (mysqli_query($koneksi, $sql)) {
            sendResponse("success", "Buku berhasil ditambahkan", ["id" => mysqli_insert_id($koneksi)], 1);
        } else {
            sendResponse("error", "Gagal menambahkan buku: " . mysqli_error($koneksi));
        }
        break;

    // =======================
    //   PUT (UPDATE)
    // =======================
    case "PUT":
        $id = $input['id'] ?? 0;

        if ($id == 0) {
            sendResponse("error", "ID wajib dikirim untuk update");
        }

        $judul   = $input['judul']   ?? '';
        $penulis = $input['penulis'] ?? '';
        $tahun   = $input['tahun']   ?? '';
        $stok    = $input['stok']    ?? '';

        if (!$judul || !$penulis || !$tahun || $stok === '') {
            sendResponse("error", "Semua field wajib diisi");
        }

        $sql = "UPDATE buku SET 
                    judul='$judul',
                    penulis='$penulis',
                    tahun=$tahun,
                    stok=$stok
                WHERE id=$id";

        if (mysqli_query($koneksi, $sql)) {
            if (mysqli_affected_rows($koneksi) > 0) {
                sendResponse("success", "Data buku ID $id berhasil diperbarui");
            } else {
                sendResponse("warning", "Tidak ada perubahan atau ID tidak ditemukan");
            }
        } else {
            sendResponse("error", "Gagal update buku: " . mysqli_error($koneksi));
        }
        break;

    // =======================
    //   DELETE
    // =======================
    case "DELETE":
        $id = $input['id'] ?? 0;

        if ($id == 0) {
            sendResponse("error", "ID wajib dikirim untuk delete");
        }

        $sql = "DELETE FROM buku WHERE id=$id";

        if (mysqli_query($koneksi, $sql)) {
            if (mysqli_affected_rows($koneksi) > 0) {
                sendResponse("success", "Buku ID $id berhasil dihapus");
            } else {
                sendResponse("warning", "Buku tidak ditemukan");
            }
        } else {
            sendResponse("error", "Gagal menghapus buku: " . mysqli_error($koneksi));
        }
        break;

    // =======================
    // METHOD TIDAK DIIZINKAN
    // =======================
    default:
        sendResponse("error", "Method $method tidak diperbolehkan");
        break;
}

?>
