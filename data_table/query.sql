-- a) Membuat masing-masing tabel menggunakan MySQL
CREATE TABLE produk (
    id_produk INT AUTO_INCREMENT,
    nama_produk VARCHAR(50),
    PRIMARY KEY (id_produk)
);

CREATE TABLE sales (
    id_sales INT AUTO_INCREMENT,
    nama_sales VARCHAR(50),
    PRIMARY KEY (id_sales)
);

CREATE TABLE leads (
    id_leads INT AUTO_INCREMENT,
    tanggal DATE,
    id_sales INT NOT NULL,
    id_produk INT NOT NULL,
    no_wa VARCHAR(15),
    nama_lead VARCHAR(50),
    kota VARCHAR(50),
    id_user INT,
    PRIMARY KEY (id_leads),
    FOREIGN KEY (id_sales) REFERENCES sales(id_sales),
    FOREIGN KEY (id_produk) REFERENCES produk(id_produk)
);
-- b) isi tabel produk dan sales
INSERT INTO sales (nama_sales) VALUES
('sales 1'),
('sales 2'),
('sales 3');

INSERT INTO produk (nama_produk) VALUES
('Cipta Residence 2'),
('The Rich'),
('Namorambe City'),
('Grand Banten'),
('Turi Mansion'),
('Cipta Residence 1');
