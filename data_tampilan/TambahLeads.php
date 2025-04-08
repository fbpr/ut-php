<?php
$conn = new mysqli("localhost", "root", "", "ut");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$salesQuery = "SELECT id_sales, nama_sales FROM sales";
$salesData = $conn->query($salesQuery);

$productQuery = "SELECT id_produk, nama_produk FROM produk";
$productData = $conn->query($productQuery);

$salesOptions = "";
if ($salesData->num_rows > 0) {
    while ($row = $salesData->fetch_assoc()) {
        $salesOptions .= "<option value='" . $row['id_sales'] . "'>" . $row['nama_sales'] . "</option>";
    }
}

$productOptions = "";
if ($productData->num_rows > 0) {
    while ($row = $productData->fetch_assoc()) {
        $productOptions .= "<option value='" . $row['id_produk'] . "'>" . $row['nama_produk'] . "</option>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>United Tractor - Tambah Leads</title>
    <link href="/united-tractor/data_tampilan/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container mt-5">
        <h2>Selamat Datang Di Tambah Leads</h2>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card rounded-4">
                    <div class="card-header rounded-top-4">
                        <a href="/united-tractor/tampilan_keseluruhan/" class="btn btn-success rounded-5">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="/united-tractor/data_tampilan/service/Simpan.php" method="POST">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="sales" class="form-label">Sales</label>
                                    <select class="form-select" id="sales" name="sales" required>
                                        <option value="" selected disabled>--Pilih Sales--</option>
                                        <?php echo $salesOptions; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="namaLead" class="form-label">Nama Lead</label>
                                    <input type="text" class="form-control" id="namaLead" name="namaLead"
                                        placeholder="Nama Lead" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="produk" class="form-label">Produk</label>
                                    <select class="form-select" id="produk" name="produk" required>
                                        <option value="" selected disabled>--Pilih Produk--</option>
                                        <?php echo $productOptions; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="whatsapp" class="form-label">WhatsApp</label>
                                    <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                                        placeholder="No. WhatsApp" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="kota" class="form-label">Kota</label>
                                    <input type="text" class="form-control" id="kota" name="kota"
                                        placeholder="Asal Kota" required>
                                </div>
                            </div>
                            <div class="gap-2 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary me-2 rounded-4 px-3 py-2">Simpan</button>
                                <button type="reset" class="btn btn-secondary rounded-4 px-3 py-2">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>