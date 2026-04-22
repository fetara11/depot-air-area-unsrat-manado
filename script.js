const unsratCenter = [1.4586, 124.8260];
const map = L.map('map').setView(unsratCenter, 15);

const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
});

const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri &mdash; Source: Esri, Maxar, Earthstar Geographics'
});

satelliteLayer.addTo(map);

const customIcon = L.divIcon({
    className: 'custom-marker',
    html: '<div class="marker-pin"><span>💧</span></div>',
    iconSize: [42, 42],
    iconAnchor: [14, 38],
    popupAnchor: [8, -30]
});

const markersLayer = L.layerGroup().addTo(map);
let tempMarker = null;
let currentBase = 'satellite';

const form = document.getElementById('formDepot');
const notif = document.getElementById('notif');
const jumlahDepot = document.getElementById('jumlahDepot');
const latInput = document.getElementById('lat');
const lngInput = document.getElementById('lng');
const toggleMapBtn = document.getElementById('toggleMap');

function showNotif(message, type = 'success') {
    notif.innerHTML = `<div class="alert ${type}">${message}</div>`;
    setTimeout(() => {
        notif.innerHTML = '';
    }, 3500);
}

function popupContent(item) {
    return `
        <div class="popup-card">
            <h3>${item.nama}</h3>
            <p><strong>Alamat:</strong> ${item.alamat}</p>
            <p><strong>Wilayah:</strong> ${item.wilayah}</p>
            <p><strong>Tanggal:</strong> ${item.tanggal}</p>
            <p><strong>Koordinat:</strong> ${Number(item.lat).toFixed(6)}, ${Number(item.lng).toFixed(6)}</p>
        </div>
    `;
}

function switchBaseMap() {
    if (currentBase === 'satellite') {
        map.removeLayer(satelliteLayer);
        streetLayer.addTo(map);
        currentBase = 'street';
        toggleMapBtn.textContent = 'Ganti ke Citra Satelit';
    } else {
        map.removeLayer(streetLayer);
        satelliteLayer.addTo(map);
        currentBase = 'satellite';
        toggleMapBtn.textContent = 'Ganti ke Peta Jalan';
    }
}

async function loadData() {
    try {
        const res = await fetch('ambil_data.php');
        const result = await res.json();

        markersLayer.clearLayers();
        jumlahDepot.textContent = result.total ?? 0;

        if (Array.isArray(result.data) && result.data.length > 0) {
            const bounds = [];

            result.data.forEach(item => {
                const marker = L.marker([item.lat, item.lng], { icon: customIcon })
                    .addTo(markersLayer)
                    .bindPopup(popupContent(item));

                bounds.push([item.lat, item.lng]);
            });

            if (bounds.length > 1) {
                map.fitBounds(bounds, { padding: [50, 50] });
            } else {
                map.setView(bounds[0], 16);
            }
        }
    } catch (error) {
        console.error(error);
        showNotif('Gagal mengambil data depot.', 'error');
    }
}

map.on('click', function (e) {
    const { lat, lng } = e.latlng;
    latInput.value = lat.toFixed(6);
    lngInput.value = lng.toFixed(6);

    if (tempMarker) {
        map.removeLayer(tempMarker);
    }

    tempMarker = L.marker([lat, lng], { icon: customIcon })
        .addTo(map)
        .bindPopup('Titik depot baru dipilih di sini.')
        .openPopup();
});

form.addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(form);

    try {
        const res = await fetch('tambah.php', {
            method: 'POST',
            body: formData
        });

        const result = await res.json();

        if (result.success) {
            showNotif(result.message, 'success');
            form.reset();
            if (tempMarker) {
                map.removeLayer(tempMarker);
                tempMarker = null;
            }
            loadData();
        } else {
            showNotif(result.message, 'error');
        }
    } catch (error) {
        console.error(error);
        showNotif('Terjadi kesalahan saat menyimpan data.', 'error');
    }
});

toggleMapBtn.addEventListener('click', switchBaseMap);

loadData();
