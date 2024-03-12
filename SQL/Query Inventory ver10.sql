CREATE DATABASE IF NOT EXISTS DB_MANAGEMENT_INVENTORY;
USE DB_MANAGEMENT_INVENTORY;

DROP TABLE IF EXISTS tb_login;
DROP TABLE IF EXISTS tb_br_in;
DROP TABLE IF EXISTS tb_br_out;
DROP TABLE IF EXISTS tb_stok;
-- DROP TABLE IF EXISTS tb_barang; 
DROP TABLE IF EXISTS tb_part; -- >>> Main
DROP TABLE IF EXISTS tb_pegawai;
DROP TABLE IF EXISTS tb_divisi; -- >>> Main
DROP TABLE IF EXISTS tb_level; -- >>> Main


-- ###### WORKER
-- ###### LEVEL USER
CREATE TABLE tb_level (
	-- id_level INT(2) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_level VARCHAR(18) NOT NULL PRIMARY KEY,
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);
INSERT INTO tb_level (user_level)
VALUES
('Developer'),
('Admin'),
('Anak Bu Yuyun');


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
('12345', 'Henry', '.K', 'Mt. Sindur', 2),
('11111', 'Yanti', '', 'Citra Maja', 1);


-- ###### USER AUTH
CREATE TABLE tb_login (
    iduser INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    password VARCHAR(5) NOT NULL,
    login_status ENUM('Forever', 'Allowed', 'Blocked', 'Expired'),
    berlaku_sdtgl DATETIME NULL,
    NIK VARCHAR(5) NOT NULL,  
    -- id_level INT(2) NOT NULL,
	user_level VARCHAR(18),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    FOREIGN KEY (NIK) REFERENCES tb_pegawai(NIK),
    FOREIGN KEY (user_level) REFERENCES tb_level(user_level)
);
INSERT INTO tb_login (password, login_status, berlaku_sdtgl, NIK, user_level)
VALUES
('51079', 'Forever', NULL, '51079', 'Developer'),
('12345', 'Forever', NULL, '12345', 'Admin'),
('11111', 'Forever', NULL, '11111', 'Anak Bu Yuyun');



-- ###### WAREHOUSE MGMT
CREATE TABLE tb_part (
	-- id_part INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    namapart VARCHAR(25) NOT NULL PRIMARY KEY,
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);
INSERT INTO tb_part(namapart)
VALUES
	('H2N1'),
	('COVID-19'),
	('SARS-28');



CREATE TABLE tb_stok (
	id_stockbarang INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    jmlh_ttl INT(11),
	-- id_part INT(10) NOT NULL,
	namapart VARCHAR(25) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (namapart) REFERENCES tb_part(namapart)
);
INSERT INTO tb_stok(jmlh_ttl, namapart)
VALUES 
(0,'H2N1'),
(0,'COVID-19'),
(0,'SARS-28');



CREATE TABLE tb_br_in (
	id_brin INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tanggal DATETIME,
	jmlh INT(11),
	NIK VARCHAR(5) NOT NULL,
	id_stockbarang INT(10),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (NIK) REFERENCES tb_pegawai(NIK),
	FOREIGN KEY (id_stockbarang) REFERENCES tb_stok(id_stockbarang)
);	-- picin VARCHAR(45) NOT NULL,
CREATE TABLE tb_br_out (
    id_brout INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tanggal DATETIME,
	jmlh INT(11),
	NIK VARCHAR(5) NOT NULL,
	id_stockbarang INT(10),
	updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	FOREIGN KEY (NIK) REFERENCES tb_pegawai(NIK),
	FOREIGN KEY (id_stockbarang) REFERENCES tb_stok(id_stockbarang)
	-- picout VARCHAR(45) NOT NULL,
);











-- -- -- FOR TABLE BRIN (QUERY SELECT)
-- QUESTION (UNKOWN ERR):
-- i have query above, and want to querying select like (below) into tabel:
-- SELECT tb_part.namapart, tb_br_in.id_brin, tb_br_in.tanggal, tb_br_in.jmlh, tb_br_in.update_at, tb_pegawai.NIK
-- FROM tb_part, tb_br_in, tb_pegawai
-- whats? wrong ??? do i need to use join?							
--
--
-- REPTITIFE QUESTION:
-- thn, if i have this query?
-- thn, if i have this query?
-- SELECT tb_br_in.id_brin, tb_br_in.tanggal, tb_br_in.jmlh, tb_br_in.id_stockbarang, tb_br_in.update_at, tb_br_in.NIK
-- FROM tb_br_in, tb_pegawai, tb_stok
--
-- ANSWER:
-- SELECT tb_br_in.id_brin, tb_br_in.tanggal, tb_br_in.jmlh, tb_br_in.id_stockbarang, tb_br_in.updated_at, tb_br_in.NIK
-- FROM tb_br_in
-- INNER JOIN tb_pegawai ON tb_br_in.NIK = tb_pegawai.NIK
-- INNER JOIN tb_stok ON tb_br_in.id_stockbarang = tb_stok.id_stockbarang;




-- -- -- FOR TABLE LOGIN (QUERY SELECT)
-- QUESTION (UNKOWN ERR):
-- i have query above, and want to querying select like (below) into tabel:
-- SELECT tb_login.password, tb_login.login_status, 
-- tb_login.berlaku_sdtgl, tb_login.created_at, tb_login.updated_at,
-- tb_pegawai.NIK, tb_level.user_level                     
-- FROM tb_login, tb_pegawai, tb_level;
-- 
-- 
-- ANSWER:
-- SELECT tb_login.password, tb_login.login_status, tb_login.berlaku_sdtgl, tb_login.created_at, tb_login.updated_at, tb_pegawai.NIK, tb_level.user_level
-- FROM tb_login
-- INNER JOIN tb_pegawai ON tb_login.NIK = tb_pegawai.NIK
-- INNER JOIN tb_level ON tb_login.id_level = tb_level.id_level;

SELECT tb_stok.*, tb_part.* 
FROM tb_stok 
INNER JOIN tb_part ON tb_stok.id_part = tb_part.id_part
WHERE tb_part.id_part = 'HOUDINI 2025';



-- Query For Incomming Table
------ KEYWORD GPT:
-- I have 3 ROW OF DATA records IN tb_br_in... then i want TO DO + WITH CURRENT tb_stok.jml+ttl BY LAST DATA ROW OF tb_br_in.jml
--
--ANSWER:
UPDATE tb_br_in
SET tanggal = NOW(),
   jmlh = 1,
   NIK = '12345'
WHERE id_stockbarang = (
   SELECT id_stockbarang
   FROM tb_stok
   WHERE namapart = 'COVID-19'
);

UPDATE tb_stok
SET jmlh_ttl = jmlh_ttl + (
    SELECT SUM(jmlh) AS total_jmlh
    FROM (
        SELECT jmlh
        FROM tb_br_in
        WHERE id_stockbarang = (
            SELECT id_stockbarang
            FROM tb_stok
            WHERE namapart = 'COVID-19'
        )
        ORDER BY id_brin DESC
        LIMIT 1
    ) AS latest_br_in
)
WHERE namapart = 'COVID-19';
