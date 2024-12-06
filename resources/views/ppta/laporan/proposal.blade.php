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
            <h1>Laporan Data Dummy</h1>
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
                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ $item['nim'] }}
                            {{ $item['nama'] }}
                        </td>
                        <td>{{ $item['judul'] }}</td>
                        <td>
                            1. {{ $item['pembimbing_1'] }}
                            <br>
                            2. {{ $item['pembimbing_2'] }}
                        </td>
                        <td>
                            1. {{ $item['penguji_1'] }}
                            @if ($item['penguji_2'] !== '')
                                <br>
                                2. {{ $item['penguji_2'] }}
                            @endif
                        </td>
                        <td>{{ $item['tgl_sidang'] }}</td>
                        <td>{{ $item['hasil'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>

</html>
