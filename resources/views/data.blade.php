<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kasus</title>
</head>
<body>
    <div>
        <canvas id="totalPerKasusChart" width="10" height="10"></canvas>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        async function renderTotalPerKasusChart() {
            try {
                // Ambil data dari backend
                const response = await fetch('http://filament-2.test:800/api/total-per-kasus');
                const data = await response.json();
    
                // Ekstrak label dan data untuk grafik lingkaran
                const labels = data.map(item => item.jenis_kejahatan);
                const totals = data.map(item => item.total);
                
                // Menghasilkan warna gradien elegan sesuai jumlah jenis kasus
                const baseColor = '#80CBC4'; // Warna dasar yang elegan
                const backgroundColors = generateGradientColors(baseColor, labels.length);
                // Buat grafik lingkaran menggunakan Chart.js
                const ctx = document.getElementById('totalPerKasusChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut', // Bisa juga 'pie' untuk grafik pie
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Total Per Kasus',
                                data: totals,
                                backgroundColor: backgroundColors
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Fungsi untuk menghasilkan warna acak
        // function generateRandomColor() {
        //     const letters = '0123456789ABCDEF';
        //     let color = '#';
        //     for (let i = 0; i < 6; i++) { 
        //         color +=letters[Math.floor(Math.random() * 16)]; 
        //     } return color; 
        // } 

        // function generateColorsArray(length) { 
        //     const colors=[]; for (let i=0; i < length; i++) { 
        //         colors.push(generateRandomColor());
        //     } 
        //     return colors; 
        // }

        // Fungsi untuk menghasilkan warna gradien elegan
    function generateGradientColors(baseColor, numColors) {
        const colors = [];
        const [r, g, b] = hexToRgb(baseColor);
        const step = Math.floor(255 / numColors); // Mengatur perubahan gradien

        for (let i = 0; i < numColors; i++) {
            const newR = Math.min(255, r + step * i);
            const newG = Math.min(255, g + step * i);
            const newB = Math.min(255, b + step * i);
            colors.push(rgbToHex(newR, newG, newB));
        }

        return colors;
    }

    function hexToRgb(hex) {
        const bigint = parseInt(hex.slice(1), 16);
        const r = (bigint >> 16) & 255;
        const g = (bigint >> 8) & 255;
        const b = bigint & 255;
        return [r, g, b];
    }

    function rgbToHex(r, g, b) {
        return '#' + [r, g, b].map(x => x.toString(16).padStart(2, '0')).join('');
    }
    
        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', renderTotalPerKasusChart);
    </script>
</body>
</html>