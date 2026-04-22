PROYEK: SIG DEPOT AIR AREA KAMPUS UNSRAT MANADO (XAMPP + PHP + MySQL + Leaflet)

ISI FILE:
- index.php                  -> halaman utama
- koneksi.php                -> koneksi database MySQL
- ambil_data.php             -> API untuk mengambil data depot dalam format JSON
- tambah.php                 -> proses simpan data depot
- script.js                  -> logika peta, marker, dan simpan data
- style.css                  -> desain UI
- depot.sql                  -> database dan tabel
- assets/depot-illustration.svg -> ilustrasi kiri bawah

LANGKAH MENJALANKAN DI XAMPP:
1. Copy folder project ke:
   C:\xampp\htdocs\depot2
   (nama folder boleh depot2, depot3, dll)

2. Jalankan XAMPP:
   - Start Apache
   - Start MySQL

3. Import database:
   - Buka http://localhost/phpmyadmin
   - Klik tab Import
   - Pilih file depot.sql
   - Jalankan import

4. Buka project di browser:
   http://localhost/depot2/

FITUR VERSI INI:
- Judul sudah diganti menjadi Depot Air Area Kampus Unsrat Manado
- Tampilan warna dibuat lebih estetik
- Peta default memakai citra satelit
- Tombol ganti mode peta satelit / peta jalan
- Ilustrasi kiri bawah sudah memakai file lokal SVG supaya pasti muncul
- Klik peta untuk mengambil koordinat otomatis

CATATAN:
- Citra satelit membutuhkan koneksi internet karena tile diambil online.
- Username database default XAMPP = root
- Password default XAMPP = kosong
