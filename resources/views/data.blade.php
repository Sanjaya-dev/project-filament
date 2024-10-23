<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kasus</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link  rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div style="width: 500px; height: 500px; margin: 0 auto;">
                    <canvas id="totalPerKasusChart"></canvas>
                </div>
            </div>
            <div class="col-lg-6">
                <table id="myTable" class="display table-bordered table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Tersangka</th>
                            <th>Jenis Perkara</th>
                            <th>Tanggal SPDP</th>
                            <th>Tanggal P-17</th>
                            <th>Tanggal Tahap I</th>
                            <th>Tanggal P-18</th>
                            <th>Tanggal P-19</th>
                            <th>Tanggal P-20</th>
                            <th>Tanggal P-21A</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataKasus as $item)
                        <tr>
                                <td>
                                    @php
                                    // Uraikan JSON dari kolom 'nama'
                                    $namaArray = $item->nama;
                                    
                                    // Konversi menjadi string dengan pemisah koma
                                    $namaString = is_array($namaArray) ? implode(', ', array_column($namaArray, 'value')) : 'Tidak ada data';
                                    @endphp
                                    {{ $namaString }}
                                </td>
                                <td>{{ $item->jenisKejahatan->nama_jenis}}</td>
                                <td>{{ $item->tanggal_SPDP }}</td>
                                <td>{{$item->tanggal_P17}}</td>
                                <td>{{$item->tanggal_tahap_I}}</td>
                                <td>{{$item->tanggal_P18}}</td>
                                <td>{{$item->tanggal_P19}}</td>
                                <td>{{$item->tanggal_P20}}</td>
                                <td>{{$item->tanggal_P21A}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <th>Nama Tersangka</th>
                            <th>Jenis Perkara</th>
                            <th>Tanggal SPDP</th>
                            <th>Tanggal P-17</th>
                            <th>Tanggal Tahap I</th>
                            <th>Tanggal P-18</th>
                            <th>Tanggal P-19</th>
                            <th>Tanggal P-20</th>
                            <th>Tanggal P-21A</th>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </div>
    
    
    <script>
        async function renderTotalPerKasusChart() {
            try {
                // Ambil data dari backend
                const response = await fetch('http://filament-2.test:800/api/total-per-kasus');
                const data = await response.json();
    
                // Ekstrak label dan data untuk grafik lingkaran
                const labels = data.map(item => item.jenis_kejahatan);
                const totals = data.map(item => item.total);
                
                const backgroundColors = elegantColors.slice(0, labels.length);
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
                        maintainAspectRatio: false,
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

        const elegantColors = [
            '#B39DDB', // Light purple
            '#90CAF9', // Light blue
            '#80CBC4', // Light teal
            '#FFAB91', // Soft orange
            '#CE93D8', // Lavender
            '#A5D6A7', // Light green
            '#FFCDD2', // Light pink
            '#FFE082', // Soft yellow
            '#B0BEC5', // Light gray
            '#D1C4E9'  // Soft violet
        ];
    
        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', renderTotalPerKasusChart);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#myTable',{
            scrollX: true,
            scrollY: 200,
            pageLength: 6,
            lengthMenu: [6, 10, 25, 50, 100]
        });
    </script>
</body>
</html>