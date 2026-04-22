<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIG Depot Air Area Kampus Unsrat Manado</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="background-glow glow-left"></div>
    <div class="background-glow glow-right"></div>

    <main class="app-shell">
        <header class="topbar">
            <div class="brand-box">
                <div class="drop-icon">💧</div>
                <div>
                    <h1>SIG Depot Air <span>Area Kampus Unsrat Manado</span></h1>
                    <p>Monitoring persebaran depot air galon terintegrasi di sekitar area kampus.</p>
                </div>
            </div>

            <div class="counter-box">
                <span class="counter-icon">📍</span>
                <div>
                    <small>Jumlah Depot Air</small>
                    <strong id="jumlahDepot">0</strong>
                </div>
            </div>
        </header>

        <section class="content-grid">
            <aside class="sidebar-card">
                <div class="sidebar-head">
                    <div>
                        <h2>+ Tambah Titik Depot Air</h2>
                        <p class="sidebar-subtitle">Isi data depot lalu klik peta untuk memilih koordinat.</p>
                    </div>
                </div>

                <form id="formDepot">
                    <div class="input-group">
                        <input type="text" name="nama" placeholder="Nama Depot Air" required>
                    </div>
                    <div class="input-group">
                        <textarea name="alamat" placeholder="Alamat Lengkap" required></textarea>
                    </div>
                    <div class="input-group">
                        <input type="text" name="wilayah" placeholder="Wilayah/Desa" required>
                    </div>

                    <div class="grid-2">
                        <div class="input-group">
                            <input type="number" step="any" id="lat" name="lat" placeholder="Latitude" required>
                        </div>
                        <div class="input-group">
                            <input type="number" step="any" id="lng" name="lng" placeholder="Longitude" required>
                        </div>
                    </div>

                    <div class="input-group date-wrap">
                        <input type="date" name="tanggal" required>
                        <span class="calendar-icon">📅</span>
                    </div>

                    <button type="submit" class="btn-save">SIMPAN LOKASI</button>
                    <p class="helper-text">Tips: klik pada peta untuk mengisi latitude dan longitude otomatis.</p>
                    <div id="notif"></div>
                </form>

                <div class="illustration-box">
                    <img src="assets/depot-illustration.svg" alt="Ilustrasi depot air" class="depot-illustration">
                </div>
            </aside>

            <section class="map-card">
                <div class="map-toolbar">
                    <div>
                        <h3>Peta Persebaran Depot Air</h3>
                        <p>Mode satelit aktif. Gunakan zoom untuk melihat area kampus Unsrat dan sekitarnya.</p>
                    </div>
                    <button type="button" id="toggleMap" class="btn-map-toggle">Ganti ke Peta Jalan</button>
                </div>
                <div id="map"></div>
            </section>
        </section>
    </main>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="script.js"></script>
</body>
</html>
