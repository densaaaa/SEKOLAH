// Konfigurasi Chart.js dengan desain baru
const websiteVisitsCtx = document.getElementById('websiteVisitsChart').getContext('2d');
const visitorDistributionCtx = document.getElementById('visitorDistributionChart').getContext('2d');

// Data awal
const visitorCategories = ['Siswa', 'Guru', 'Orangtua', 'Umum'];
let visitorCounts = [45, 25, 20, 10];
let websiteVisits = [12000, 19000, 15000, 22000, 18000, 25000];

// Gradient untuk line chart
const gradient = websiteVisitsCtx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(75, 192, 192, 0.6)');
gradient.addColorStop(1, 'rgba(75, 192, 192, 0)');

// Grafik Kunjungan Website
const websiteVisitsChart = new Chart(websiteVisitsCtx, {
    type: 'line',
    data: {
         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
            label: 'Kunjungan Website',
            data: websiteVisits,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: gradient,
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 7
        }]
    },
    options: {
        responsive: true,
        plugins: {
            tooltip: {
                enabled: true,
                mode: 'index',
                intersect: false
            }
        }
    }
});

// Grafik Distribusi Pengunjung
const visitorDistributionChart = new Chart(visitorDistributionCtx, {
    type: 'doughnut',
    data: {
        labels: visitorCategories,
        datasets: [{
            data: visitorCounts,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)'
            ],
            borderWidth: 2,
            borderRadius: 5
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return `${tooltipItem.label}: ${tooltipItem.raw} pengunjung`;
                    }
                }
            }
        }
    }
});

        // Fungsi untuk menghasilkan data pengunjung palsu
        function generateFakeVisitorData() {
            const categories = ['Siswa', 'Guru', 'Orangtua', 'Umum'];
            const locations = ['Lab Komputer', 'Perpustakaan', 'Halaman Depan', 'Ruang Kelas'];
            
            // Simulasi perubahan jumlah pengunjung
            visitorCounts = visitorCounts.map(count => 
                Math.max(0, count + Math.floor(Math.random() * 5 - 2))
            );

            // Update grafik distribusi
            visitorDistributionChart.data.datasets[0].data = visitorCounts;
            visitorDistributionChart.update();

            // Tambah kunjungan website
            const newVisit = websiteVisits[websiteVisits.length - 1] + Math.floor(Math.random() * 500);
            websiteVisits.push(newVisit);
            websiteVisits.shift(); // Hapus data tertua

            // Update grafik kunjungan
            websiteVisitsChart.data.labels.push(new Date().toLocaleTimeString());
            websiteVisitsChart.data.labels.shift();
            websiteVisitsChart.data.datasets[0].data = websiteVisits;
            websiteVisitsChart.update();

            // Update total pengunjung
            const totalVisitors = visitorCounts.reduce((a, b) => a + b, 0);
            document.getElementById('websiteVisitorCount').textContent = 
                `Total Pengunjung: ${totalVisitors}`;

            // Tambah log pengunjung
            const visitorLogBody = document.getElementById('visitorLogBody');
            const newLog = document.createElement('tr');
            newLog.innerHTML = `
                <td>${new Date().toLocaleTimeString()}</td>
                <td>${categories[Math.floor(Math.random() * categories.length)]}</td>
                <td>${locations[Math.floor(Math.random() * locations.length)]}</td>
            `;
            visitorLogBody.insertBefore(newLog, visitorLogBody.firstChild);

            // Batasi jumlah log
            if (visitorLogBody.children.length > 10) {
                visitorLogBody.removeChild(visitorLogBody.lastChild);
            }
        }

        // Simulasi koneksi realtime (update setiap 3 detik)
        const realtimeInterval = setInterval(generateFakeVisitorData, 3000);

        // Fungsi untuk menangani status koneksi
        function handleConnectionStatus() {
            const statusBadge = document.getElementById('realtimeStatus');
            
            // Simulasi kemungkinan kehilangan koneksi
            if (Math.random() < 0.05) { // 5% kemungkinan terputus
                statusBadge.textContent = 'Terputus';
                statusBadge.classList.remove('badge-green');
                statusBadge.classList.add('badge-red');
                clearInterval(realtimeInterval);
            }
        }

        // Jalankan status koneksi bersamaan dengan data realtime
        setInterval(handleConnectionStatus, 3000);

        function fetchRealtimeData() {
            fetch('get_visitors.php')
                .then(response => response.json())
                .then(data => {
                    updateVisitorCounter(data.total_visitors);
                    updateVisitorLog(data.visitor_logs);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function updateVisitorCounter(total) {
            document.getElementById('active-visitors').textContent = total;
        }

        function updateVisitorLog(logs) {
            const logBody = document.getElementById('visitor-log-body');
            logBody.innerHTML = ''; // Bersihkan log sebelumnya

            logs.forEach(log => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${log.timestamp}</td>
                    <td>${log.ip_address}</td>
                    <td>${log.page_visited}</td>
                    <td>${log.visitor_category}</td>
                `;
                logBody.appendChild(row);
            });
        }

        // Polling data setiap 5 detik
        setInterval(fetchRealtimeData, 5000);

        // Ambil data pertama kali saat halaman dimuat
        fetchRealtimeData();