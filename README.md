<h1>📚 Project API Perpustakaan – Perpus_Intan</h1>

<p>
Proyek ini adalah API sederhana untuk mengelola data perpustakaan.  
Dibuat menggunakan <b>PHP Native</b>, <b>MySQL</b>, dan dites menggunakan <b>Postman</b>.
</p>

<hr>

<h2>📁 Struktur Folder</h2>

<pre>
Perpus_Intan/
│── api/
│   ├── index.php
│   ├── tambah.php
│   ├── update.php
│   ├── hapus.php
│   └── config.php
│
│── assets/
│   └── images/
│       └── postman (1).png
│
└── README.md
</pre>

<hr>

<h2>📝 Penjelasan File</h2>

<ul>
  <li><b>config.php</b> → Berisi konfigurasi koneksi database MySQL.</li>
  <li><b>index.php</b> → Menampilkan seluruh data buku (GET).</li>
  <li><b>tambah.php</b> → Menambah data buku baru (POST).</li>
  <li><b>update.php</b> → Mengubah data buku berdasarkan ID (PUT).</li>
  <li><b>hapus.php</b> → Menghapus data buku berdasarkan ID (DELETE).</li>
</ul>

<hr>

<h2>🛠️ Cara Menjalankan API</h2>

<h3>1️⃣ Import Database</h3>
<p>
Import file SQL ke MySQL:
</p>

<pre>
CREATE TABLE buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255),
    penulis VARCHAR(255),
    tahun INT
);
</pre>

<hr>

<h2>📌 API Endpoint</h2>

<table border="1" cellpadding="6" cellspacing="0">
<thead>
<tr>
<th>Method</th>
<th>Endpoint</th>
<th>Deskripsi</th>
</tr>
</thead>
<tbody>
<tr>
<td>GET</td>
<td>/api/index.php</td>
<td>Menampilkan semua data buku</td>
</tr>
<tr>
<td>POST</td>
<td>/api/tambah.php</td>
<td>Menambah buku baru</td>
</tr>
<tr>
<td>PUT</td>
<td>/api/update.php</td>
<td>Update data buku</td>
</tr>
<tr>
<td>DELETE</td>
<td>/api/hapus.php</td>
<td>Hapus data buku</td>
</tr>
</tbody>
</table>

<hr>

<h2>📬 Contoh Penggunaan API di Postman</h2>

<h3>🔹 1. POST – Tambah Buku</h3>

<pre>
URL: http://localhost/Perpus_Intan/api/tambah.php
Method: POST
Body (JSON):
{
  "judul": "Laskar Pelangi",
  "penulis": "Andrea Hirata",
  "tahun": 2005
}
</pre>

<h3>🔹 2. GET – Tampilkan Semua Buku</h3>

<pre>
URL: http://localhost/Perpus_Intan/api/index.php
Method: GET
</pre>

<h3>🔹 3. PUT – Update Buku</h3>

<pre>
URL: http://localhost/Perpus_Intan/api/update.php
Method: PUT
Body (JSON):
{
  "id": 1,
  "judul": "Bumi Manusia",
  "penulis": "Pramoedya Ananta Toer",
  "tahun": 1980
}
</pre>

<h3>🔹 4. DELETE – Hapus Buku</h3>

<pre>
URL: http://localhost/Perpus_Intan/api/hapus.php?id=1
Method: DELETE
</pre>

<hr>

<h2>📸 Screenshot Pengujian API via Postman</h2>

<p><i>Contoh tampilan hasil testing API menggunakan Postman:</i></p>

<img src="postman (1).png" width="600">

<img src="postman (2).png" width="600">

<img src="postman (3).png" width="600">

<img src="postman (4).png" width="600">


<hr>

<h2>✔️ Kesimpulan</h2>

<p>
API ini sangat cocok untuk latihan dasar membuat backend sederhana menggunakan PHP Native.
Struktur folder rapi, endpoint lengkap (CRUD), dan dapat langsung diuji melalui Postman.
</p>
