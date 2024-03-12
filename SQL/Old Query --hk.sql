DROP TABLE IF EXISTS login;
DROP TABLE IF EXISTS br_in;
DROP TABLE IF EXISTS br_out;
DROP TABLE IF EXISTS stok;
DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS pegawai;

-- ###### WORKER
-- ###### USER DATA
CREATE TABLE pegawai (
	NIK VARCHAR(5) NOT NULL PRIMARY KEY,
	nama_dpn VARCHAR(38) NOT NULL,
	nama_blk VARCHAR(38) NOT NULL,
	alamat_dom TEXT(255) NOT NULL,
	id_divisi INT(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT current_timestamp(),
	updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (id_divisi) REFERENCES divisi(id_divisi)
);
INSERT INTO pegawai (NIK, nama_dpn, nama_blk, alamat_dom)
VALUES
('51079', 'M.', 'Ramdan Pujiantoro', 'Balarajda RT/RW01'),
('12345', 'Henry', '.K', 'Mt. Sindur'),
('11111', 'M.', 'Abdul Yanto Fajar', 'Pamulang');

-- ###### DIVISI DATA
CREATE TABLE divisi (
	id_divisi INT(11) NOT NULL PRIMARY KEY,
	nama_div VARCHAR(38) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);


-- ###### USER AUTH
CREATE TABLE login (
	iduser INT(11) NOT NULL PRIMARY KEY,
	password VARCHAR(5) NOT NULL,
	user_level ENUM('Developer', 'Admin', 'Moderator'),
	NIK VARCHAR(5) NOT NULL,	
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (NIK) REFERENCES pegawai(NIK)
);
INSERT INTO login (iduser, password, user_level, NIK)
VALUES
(1, '51079', 'Admin','51079'),
(2, '12345', 'Developer','12345'),
(3, '11111', 'Moderator','11111');


-- ###### WAREHOUSE MGMT
CREATE TABLE barang (
	id_barang VARCHAR(50) NOT NULL PRIMARY KEY,
    namabr VARCHAR(25) NOT NULL,
    partnum VARCHAR(20),
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);
CREATE TABLE stok (
	id_stockbarang VARCHAR(50) NOT NULL PRIMARY KEY,
    jmlh_ttl INT(11),
	id_barang VARCHAR(25) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (id_barang) REFERENCES barang(id_barang)
);
CREATE TABLE br_in (
	id_brin INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tanggal DATETIME,
	--picin VARCHAR(45) NOT NULL,
	NIK INT(11) NOT NULL,
    jmlh INT(11),
	id_stockbarang VARCHAR(50),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (NIK) REFERENCES pegawai(NIK),
	FOREIGN KEY (id_stockbarang) REFERENCES stok(id_stockbarang)
);
CREATE TABLE br_out (
    id_brout INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tanggal DATETIME,
	--picout VARCHAR(45) NOT NULL,
	NIK INT(11) NOT NULL,
    jmlh INT(11),
	id_stockbarang VARCHAR(50),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (NIK) REFERENCES pegawai(NIK),
	FOREIGN KEY (id_stockbarang) REFERENCES stok(id_stockbarang)
);







-- ###### SET FIRST VALUE
-- Input manual
INSERT INTO stok (id_stockbarang, namabr, partnum, jmlh_ttl)
VALUES ('0001', 'Barang 1', '1', 1);
INSERT INTO br_in (id_brin, tanggal, picin, jmlh, id_stockbarang)
VALUES ('12345', '2021-01-01 00:00:00', 'John Doe', 0, '0001');
INSERT INTO br_out (id_brout, tanggal, picout, jmlh, id_stockbarang)
VALUES ('12345', '2021-01-01 00:00:00', 'John Doe', 0, '0001');
--  Query yg ditampilkan pada Dasboard Stok Umum:
SELECT stok.id_stockbarang, stok.namabr, stok.partnum, stok.jmlh_ttl AS "Jml Stok Saat Ini"
FROM br_in
JOIN br_out ON br_out.id_stockbarang = br_in.id_stockbarang
JOIN stok ON stok.id_stockbarang = br_in.id_stockbarang
WHERE stok.id_stockbarang = '0001';



-- ###### WORK ILLUSTRATION
-- Up In terhadap stok
UPDATE br_in
JOIN stok ON br_in.id_stockbarang = stok.id_stockbarang
SET br_in.jmlh = 10, stok.jmlh_ttl = stok.jmlh_ttl + 10
WHERE br_in.id_stockbarang = '0001';
--  Query yg ditampilkan pada Dasboard Stok Umum:
SELECT stok.id_stockbarang, stok.namabr, stok.partnum, stok.jmlh_ttl AS "Jml Stok Saat Ini", br_in.picin, br_in.jmlh, br_in.tanggal, br_in.updated_at,
br_out.picout, br_out.jmlh, br_out.tanggal, br_out.updated_at
FROM br_in
JOIN br_out ON br_out.id_stockbarang = br_in.id_stockbarang
JOIN stok ON stok.id_stockbarang = br_in.id_stockbarang
WHERE stok.id_stockbarang = '0001';


-- Up Out terhadap stok
UPDATE br_out
JOIN stok ON br_out.id_stockbarang = stok.id_stockbarang
SET br_out.jmlh = 2, br_out.picout = 'Abdul Yanto Fajar', stok.jmlh_ttl = stok.jmlh_ttl - 2
WHERE br_out.id_stockbarang = '0001';
--  Query yg ditampilkan pada Dasboard Stok Umum:
SELECT stok.id_stockbarang, stok.namabr, stok.partnum, stok.jmlh_ttl AS "Jml Stok Saat Ini", br_in.picin, br_in.jmlh, br_in.tanggal, br_in.updated_at,
br_out.picout, br_out.jmlh, br_out.tanggal, br_out.updated_at
FROM br_in
JOIN br_out ON br_out.id_stockbarang = br_in.id_stockbarang
JOIN stok ON stok.id_stockbarang = br_in.id_stockbarang
WHERE stok.id_stockbarang = '0001';





SELECT stok.id_stockbarang, stok.namabr, stok.partnum, stok.jmlh_ttl, br_in.picin, br_in.jmlh, br_in.tanggal, br_in.updated_at,
br_out.picout, br_out.jmlh, br_out.tanggal, br_out.updated_at
FROM br_in
JOIN br_out ON br_out.id_stockbarang = br_in.id_stockbarang
JOIN stok ON stok.id_stockbarang = br_in.id_stockbarang
WHERE stok.id_stockbarang = '0001';







-- -- CONTOH-CONTOH
-- -- Query select using FK method
-- SELECT br_in.*, stok.namabr, stok.partnum
-- FROM br_in
-- JOIN stok ON br_in.id_stockbarang = stok.id_stockbarang;

-- -- Query to update data table stok~br_in
-- UPDATE br_in
-- JOIN stok ON br_in.id_stockbarang = stok.id_stockbarang
-- SET br_in.jmlh = 10, stok.jmlh_ttl = stok.jmlh_ttl + br_in.jmlh
-- WHERE br_in.id_stockbarang = '0001';

-- -- Query select using FK method
-- SELECT br_in.*, stok.namabr, stok.partnum
-- FROM br_in
-- JOIN stok ON br_in.id_stockbarang = stok.id_stockbarang;

-- -- Query Get User Data from worker tabel, after login
-- SELECT pengguna.nama_dpn, pengguna.nama_blk, pengguna.alamat_dom, pengguna.created_at, pengguna.updated_at, login.user_level
-- FROM login
-- JOIN pengguna ON pengguna.NIK = login.NIK
-- WHERE pengguna.NIK = $loggedin_nik


-- -- Query to Input Barang in & Stock if using FK
-- INSERT INTO br_in (id_brin, tanggal, picin, jmlh, id_stockbarang), stok (id_stockbarang, namabr, partnum, jmlh_ttl)
-- VALUES ('12345', '2021-01-01 00:00:00', 'John Doe', 0, '0001'), ('0001', 'Barang 1', '1', 1);


-- -- Query to Show Data 4 table stock + in only (normal way):
-- SELECT stok.id_stockbarang, stok.namabr, stok.partnum, stok.jmlh_ttl, br_in.picin, br_in.jmlh, br_in.tanggal, br_in.updated_at
-- FROM br_in
-- JOIN stok ON stok.id_stockbarang = br_in.id_stockbarang;


-- -- CONTOH-CONTOH