<!DOCTYPE html>
<html>

    <head>
        <title>Laporan Data Dummy</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }

            .header {
                text-align: center;
                margin-bottom: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            table,
            th,
            td {
                border: 1px solid #000;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <h1>Laporan Proposal</h1>
            <p>Tanggal Cetak: {{ date('d F Y') }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nim / Nama</th>
                    <th>Judul</th>
                    <th>Pembimbing</th>
                    <th>Penguji</th>
                    <th>Tgl Sidang</th>
                    <th>Hasil</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            {{ $item['nim'] }}
                            {{ $item['nama'] }}
                        </td>
                        <td>{{ $item['jdl_proposal'] }}</td>
                        <td>
                            <ol>
                                <li>{{ $item['pembimbing_1_nama'] }}</li>
                                <li>{{ $item['pembimbing_2_nama'] }}</li>
                            </ol>
                        </td>
                        <td>
                            <ol>
                                <li>{{ $item['penguji_1_nama'] }}</li>
                                @if ($item['penguji_2_nama'] !== ' ')
                                    <li>{{ $item['penguji_2_nama'] }}</li>
                                @endif
                            </ol>
                        </td>
                        <td>{{ $item['wkt_proposal'] }}</td>
                        <td>{{ $item['sts_proposal'] === 'Y' ? 'Diterima' : 'Ditolak' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>

</html>
