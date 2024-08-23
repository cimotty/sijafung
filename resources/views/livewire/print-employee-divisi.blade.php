<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Pegawai - Divisi {{ $divisi }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
        }

        #catatan {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Data Pegawai {{ $divisi }}</h2>
        <p>Tanggal: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
    </div>

    <table class="table">
        <tr>
            <th>NO</th>
            <th>Nama Lengkap</th>
            <th>NIP</th>
            <th>Jabatan Fungsional</th>
            <th>Unit Kerja</th>
            <th>Pelatihan yang Diikuti</th>
        </tr>
        @foreach ($employees as $index => $employee)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $employee->nama }}</td>
                <td>{{ $employee->NIP }}</td>
                <td>{{ $employee->jabatan }}</td>
                <td>{{ $employee->unitKerja }}</td>
                <td>
                    <ul>
                        @if (empty($employee->keterangan))
                            Belum Ada
                        @else
                            @foreach (explode(',', $employee->keterangan) as $item)
                                <li>{{ trim($item) }}</li>
                            @endforeach
                        @endif
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>

    <script>
        // Script untuk mencetak halaman
        window.print();
    </script>
</body>

</html>
