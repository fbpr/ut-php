<?php
$conn = new mysqli("localhost", "root", "", "ut");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'] ?? '';
    $id_sales = $_POST['sales'] ?? '';
    $nama_lead = $_POST['namaLead'] ?? '';
    $id_produk = $_POST['produk'] ?? '';
    $whatsapp = $_POST['whatsapp'] ?? '';
    $kota = $_POST['kota'] ?? '';

    $stmt = $conn->prepare("INSERT INTO leads (tanggal, id_sales, nama_lead, id_produk, no_wa, kota) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sissss", $tanggal, $id_sales, $nama_lead, $id_produk, $whatsapp, $kota);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href='/united-tractor/data_tampilan/TambahLeads.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='/united-tractor/data_tampilan/TambahLeads.php';</script>";
    }

    $stmt->close();
} else {
    header("Location: /united-tractor/data_tampilan/TambahLeads.php");
    exit();
}

$conn->close();
