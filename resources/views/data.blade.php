<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kasus</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
</head>

<body class="bg-light-subtle">
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">name</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li> --}}
                </ul>
                {{-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> --}}
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-center bg-success text-white">
                            <h4>
                                JENIS PERKARA
                            </h4>
                        </div>
                        <div class="card-body mt-4" style="margin-bottom: 38px;">
                            <canvas id="totalPerKasusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center bg-success text-white">
                        <h4>
                            TAHAP PRA-PENUNTUTAN
                        </h4>
                    </div>
                    <div class="card-body">
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
                                    <th>Status</th>
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
                                        $namaString = is_array($namaArray) ? implode(', ', array_column($namaArray,
                                        'value')) : 'Tidak ada data';
                                        @endphp
                                        {{ $namaString }}
                                    </td>
                                    <td>{{ $item->jenisKejahatan->nama_jenis}}</td>
                                    <td>{{ $item->tanggal_SPDP ? \Carbon\Carbon::parse($item->tanggal_SPDP)->format('d-m-Y') : '-' }}</td>
                                    <td>{{$item->tanggal_P17 ? \Carbon\Carbon::parse($item->tanggal_P17)->format('d-m-Y') : '-'}}</td>
                                    <td>{{$item->tanggal_tahap_I ? \Carbon\Carbon::parse($item->tanggal_tahap_I)->format('d-m-Y') : '-'}}</td>
                                    <td>{{$item->tanggal_P18 ? \Carbon\Carbon::parse($item->tanggal_P18)->format('d-m-Y') : '-'}}</td>
                                    <td>{{$item->tanggal_P19 ? \Carbon\Carbon::parse($item->tanggal_P19)->format('d-m-Y') : '-'}}</td>
                                    <td>{{$item->tanggal_P20 ? \Carbon\Carbon::parse($item->tanggal_P20)->format('d-m-Y') : '-'}}</td>
                                    <td>{{$item->tanggal_P21A ? \Carbon\Carbon::parse($item->tanggal_P21A)->format('d-m-Y') : '-'}}</td>
                                    <td>{{$item->status}}</td>
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
        </div>
        <div class="row mt-3">
            <div class="col-lg-6">
                <div class="card bg-danger px-3 py-4 text-white">
                    <h4>
                        Jumlah perkara pada tahap penuntutan : {{$totalKasusPenuntutan}}
                    </h4>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card bg-warning px-3 py-4 text-white">
                    <h4>
                        Jumlah perkara pada tahap pra-penuntutan : {{$totalKasusPraPenuntutan}}
                    </h4>
                </div>
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
                                label: 'Total Kasus',
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
                                position: 'left'
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

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
            '#D1C4E9', // Soft violet
            '#C5CAE9', // Pale periwinkle
            '#F48FB1', // Rosy pink
            '#81D4FA', // Sky blue
            '#B2EBF2', // Soft cyan
            '#FFCC80', // Peach orange
            '#FFABAB', // Coral pink
            '#E6EE9C', // Pale lime
            '#B2DFDB', // Mint green
            '#D7CCC8', // Beige
            '#F3E5F5', // Lavender blush
            '#FFECB3', // Cream yellow
            '#C8E6C9', // Pastel green
            '#FFCCBC', // Apricot
            '#F0F4C3', // Light olive
            '#CFD8DC', // Cool gray
            '#D7A9E3', // Mauve
            '#AED581', // Soft lime green
            '#FF8A80', // Soft red
            '#FFE0B2', // Light apricot
            '#E1BEE7' // Soft mauve
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