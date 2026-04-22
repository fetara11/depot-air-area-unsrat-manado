CREATE DATABASE IF NOT EXISTS web_depot;
USE web_depot;

CREATE TABLE IF NOT EXISTS depot (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    wilayah VARCHAR(100) NOT NULL,
    lat DOUBLE NOT NULL,
    lng DOUBLE NOT NULL,
    tanggal DATE NOT NULL
);

INSERT INTO depot (nama, alamat, wilayah, lat, lng, tanggal) VALUES
('Depot Pondang', 'Jl. Pondang, sekitar area Kampus UNSRAT', 'Pondang', 1.4518, 124.8251, '2026-04-20'),
('Depot Pondangow', 'Jl. Pondangow, dekat area kampus', 'Pondangow', 1.4478, 124.8269, '2026-04-20'),
('Depot Pulutan', 'Jl. Pulutan, area sekitar kampus UNSRAT', 'Pulutan', 1.4341, 124.8312, '2026-04-20');
