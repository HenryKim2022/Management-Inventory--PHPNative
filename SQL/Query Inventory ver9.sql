CREATE DATABASE IF NOT EXISTS DB_MANAGEMENT_INVENTORY;
USE DB_MANAGEMENT_INVENTORY;

DROP TABLE IF EXISTS tb_login;
DROP TABLE IF EXISTS tb_br_in;
DROP TABLE IF EXISTS tb_br_out;
DROP TABLE IF EXISTS tb_stok;
DROP TABLE IF EXISTS tb_barang; 
DROP TABLE IF EXISTS tb_part; -- >>> Main
DROP TABLE IF EXISTS tb_pegawai;
DROP TABLE IF EXISTS tb_divisi; -- >>> Main
DROP TABLE IF EXISTS tb_level; -- >>> Main


-- ###### WORKER
-- ###### LEVEL USER
CREATE TABLE tb_level (
	id_level INT(2) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_level VARCHAR(18) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);
INSERT INTO tb_level (user_level)
VALUES
('Developer'),
('Admin');

-- ###### DIVISI DATA
CREATE TABLE tb_divisi (
	id_divisi INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nama_div VARCHAR(38) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);
INSERT INTO tb_divisi (nama_div)
VALUES
('Human Resources'),
('IT');


-- ###### USER DATA
CREATE TABLE tb_pegawai (
	NIK VARCHAR(5) NOT NULL PRIMARY KEY,
	nama_dpn VARCHAR(38) NOT NULL,
	nama_blk VARCHAR(38) NULL,
	alamat_dom TEXT(255) NULL,
	id_divisi INT(11) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (id_divisi) REFERENCES tb_divisi(id_divisi)
);
INSERT INTO tb_pegawai (NIK, nama_dpn, nama_blk, alamat_dom, id_divisi)
VALUES
('51079', 'M.', 'Ramdan Pujiantoro', 'Balarajda RT/RW01', 1),
('12345', 'Henry', '.K', 'Mt. Sindur', 2);


-- ###### USER AUTH
CREATE TABLE tb_login (
    iduser INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    password VARCHAR(5) NOT NULL,
    login_status ENUM('Forever', 'Allowed', 'Blocked', 'Expired'),
    berlaku_sdtgl DATETIME NULL,
    NIK VARCHAR(5) NOT NULL,  
    id_level INT(2) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    FOREIGN KEY (NIK) REFERENCES tb_pegawai(NIK),
    FOREIGN KEY (id_level) REFERENCES tb_level(id_level)
);
INSERT INTO tb_login (password, login_status, berlaku_sdtgl, NIK, id_level)
VALUES
('51079', 'Forever', NULL, '51079', 1),
('12345', 'Forever', NULL, '12345', 2);


-- ###### WAREHOUSE MGMT
CREATE TABLE tb_part (
	id_part INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    namapart VARCHAR(25) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);
CREATE TABLE tb_barang (
	id_barang INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    namabr VARCHAR(25) NOT NULL,
    id_part INT(10) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (id_part) REFERENCES tb_part(id_part)
);
CREATE TABLE tb_stok (
	id_stockbarang INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    jmlh_ttl INT(11),
	id_barang INT(10) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (id_barang) REFERENCES tb_barang(id_barang)
);
CREATE TABLE tb_br_in (
	id_brin INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tanggal DATETIME,
	NIK VARCHAR(5) NOT NULL,
    jmlh INT(11),
	id_stockbarang INT(10),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (NIK) REFERENCES tb_pegawai(NIK),
	FOREIGN KEY (id_stockbarang) REFERENCES tb_stok(id_stockbarang)
);	-- picin VARCHAR(45) NOT NULL,
CREATE TABLE tb_br_out (
    id_brout INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tanggal DATETIME,
	NIK VARCHAR(5) NOT NULL,
    jmlh INT(11),
	id_stockbarang INT(10),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (NIK) REFERENCES tb_pegawai(NIK),
	FOREIGN KEY (id_stockbarang) REFERENCES tb_stok(id_stockbarang)
	-- picout VARCHAR(45) NOT NULL,
);





