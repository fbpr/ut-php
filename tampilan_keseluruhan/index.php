<?php
$conn = new mysqli("localhost", "root", "", "ut");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentMonth = date('m');
$currentYear = date('Y');

$searchQuery = "WHERE MONTH(l.tanggal) = '$currentMonth' AND YEAR(l.tanggal) = '$currentYear'";

if (isset($_GET['produk']) && !empty($_GET['produk'])) {
    $id_produk = $conn->real_escape_string($_GET['produk']);
    $searchQuery = "WHERE l.id_produk = '$id_produk'";
}

if (isset($_GET['sales']) && !empty($_GET['sales'])) {
    $id_sales = $conn->real_escape_string($_GET['sales']);
    $month = isset($_GET['bulan']) && !empty($_GET['bulan']) ?
        $conn->real_escape_string($_GET['bulan']) : $currentMonth;

    $searchQuery .= " AND l.id_sales = '$id_sales' AND MONTH(l.tanggal) = '$month'";
}

$leadsQuery =
    "SELECT l.id_leads, l.tanggal, s.nama_sales, p.nama_produk, l.nama_lead, l.no_wa, l.kota 
    FROM leads l
    LEFT JOIN sales s ON l.id_sales = s.id_sales
    LEFT JOIN produk p ON l.id_produk = p.id_produk
    $searchQuery
    ORDER BY l.id_leads";

$leadsData = $conn->query($leadsQuery);

$salesQuery = "SELECT id_sales, nama_sales FROM sales";
$salesData = $conn->query($salesQuery);

$productQuery = "SELECT id_produk, nama_produk FROM produk";
$productData = $conn->query($productQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>United Tractor - Leads Table</title>
    <link href="/united-tractor/data_tampilan/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Data Leads</h2>
            <a href="/united-tractor/data_tampilan/TambahLeads.php" class="btn btn-primary">Tambah Lead Baru</a>
        </div>

        <div class="search-form">
            <div class="row">
                <div class="col-md-6">
                    <form method="GET" action="" class="row">
                        <div class="col-md-8">
                            <label for="produk" class="form-label">Cari berdasarkan Produk</label>
                            <select name="produk" id="produk" class="form-select" onchange="this.form.submit();">
                                <option value="">--Pilih Produk--</option>
                                <?php
                                if ($productData->num_rows > 0) {
                                    while ($row = $productData->fetch_assoc()) {
                                        $selected = (isset($_GET['produk']) && $_GET['produk'] == $row['id_produk']) ? 'selected' : '';
                                        echo "<option value='" . $row['id_produk'] . "' $selected>" . $row['nama_produk'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <form method="GET" action="" class="row">
                        <div class="col-md-4">
                            <label for="sales" class="form-label">Sales</label>
                            <select name="sales" id="sales" class="form-select" onchange="if(this.value && document.getElementById('bulan').value) this.form.submit();">
                                <option value="">--Pilih Sales--</option>
                                <?php
                                if ($salesData->num_rows > 0) {
                                    $salesData->data_seek(0);
                                    while ($row = $salesData->fetch_assoc()) {
                                        $selected = (isset($_GET['sales']) && $_GET['sales'] == $row['id_sales']) ? 'selected' : '';
                                        echo "<option value='" . $row['id_sales'] . "' $selected>" . $row['nama_sales'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select name="bulan" id="bulan" class="form-select" onchange="if(document.getElementById('sales').value) this.form.submit();">
                                <option value="">--Pilih Bulan--</option>
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    $monthNum = sprintf("%01d", $i);
                                    $monthName = date('F', mktime(0, 0, 0, $i, 10));
                                    $selected = (isset($_GET['bulan']) && $_GET['bulan'] == $monthNum) ? 'selected' : '';
                                    echo "<option value='$monthNum' $selected>$monthName</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive rounded-3 mt-3">
            <table class="table table-striped">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>ID Input</th>
                        <th>Tanggal</th>
                        <th>Sales</th>
                        <th>Nama Lead</th>
                        <th>Produk</th>
                        <th>WhatsApp</th>
                        <th>Kota</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($leadsData->num_rows > 0) {
                        $no = 1;
                        while ($row = $leadsData->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . sprintf("%03d", $row['id_leads']) . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row['tanggal'])) . "</td>";
                            echo "<td>" . $row['nama_sales'] . "</td>";
                            echo "<td>" . $row['nama_lead'] . "</td>";
                            echo "<td>" . $row['nama_produk'] . "</td>";
                            echo "<td>" . $row['no_wa'] . "</td>";
                            echo "<td>" . $row['kota'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>Tidak ada data leads</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>