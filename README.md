# United Tractor Leads

Aplikasi ini dibuat untuk mengelola data leads, sales, dan produk.

- [United Tractor Leads](#united-tractor-leads)
  - [Cara Instalasi](#cara-instalasi)
  - [Cara Menjalankan Aplikasi](#cara-menjalankan-aplikasi)
  - [Fitur Aplikasi](#fitur-aplikasi)

## Cara Instalasi

1. **Install XAMPP**

   - Download dan install XAMPP
   - Pastikan service Apache dan MySQL sudah berjalan

2. **Clone atau Download Repository**

   - Letakkan folder `united-tractor` ke dalam direktori `htdocs` XAMPP

3. **Setup Database**
   - Buka phpMyAdmin
   - Buat database baru dengan nama `ut`
   - Pilih database `ut`
   - Buka tab SQL
   - Import file SQL dengan memilih atau copy paste isi file [data_table/query.sql](data_table/query.sql)
   - Jalankan query untuk membuat tabel dan mengisi data awal

## Cara Menjalankan Aplikasi

1. **Pastikan XAMPP sudah berjalan**

   - Start service Apache dan MySQL di XAMPP Control Panel

2. **Akses Aplikasi**

   - Buka browser dan akses: <http://localhost/united-tractor/tampilan_keseluruhan/>

3. **Menggunakan Aplikasi**
   - Halaman utama menampilkan daftar leads yang sudah tersimpan
   - Untuk menambah lead baru, klik tombol "Tambah Lead Baru"
   - Untuk mencari data berdasarkan produk, gunakan dropdown "Produk"
   - Untuk mencari data berdasarkan sales dan bulan, gunakan dropdown "Sales" dan "Bulan"

## Fitur Aplikasi

1. **Menampilkan Data Leads**

   - Menampilkan seluruh data leads dengan informasi lengkap
   - Filter data berdasarkan produk, sales, dan bulan

2. **Menambahkan Data Lead Baru**
   - Form input untuk data lead baru dengan field:
     - Tanggal
     - Sales
     - Nama Lead
     - Produk
     - WhatsApp
     - Kota
