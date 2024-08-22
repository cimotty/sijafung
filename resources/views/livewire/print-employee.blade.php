<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .container {
                width: 100%;
                margin: 0 auto;
            }
            .header {
                text-align: center;
                margin-bottom: 30px;
            }
            .header h1 {
                margin: 0;
            }
            .table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            .table,
            .table th,
            .table td {
                border: 1px solid black;
            }
            .table th,
            .table td {
                padding: 8px;
                text-align: left;
            }

            li {
                margin-top: 6px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="header">
                <h1>IDENTITAS PEGAWAI</h1>
                <p>Tanggal : {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
            </div>

            <table class="table">
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $employee->nama }}</td>
                </tr>
                <tr>
                    <th>NIP</th>
                    <td>{{ $employee->NIP }}</td>
                </tr>
                <tr>
                    <th>OPD</th>
                    <td>{{ $employee->divisi }}</td>
                </tr>
                <tr>
                    <th>Jabatan Fungsional</th>
                    <td>{{ $employee->jabatan }}</td>
                </tr>
                <tr>
                    <th>Unit Kerja</th>
                    <td>{{ $employee->unitKerja }}</td>
                </tr>
                <tr>
                    <th>Sertifikat</th>
                    <td>
                        <ul>
                            <li>Sertifikat 1</li>
                            <li>Sertifikat 2</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Pelatihan yang Diikuti</th>
                    <td>
                    <ul>
                            @foreach(explode(',', $employee->keterangan) as $item)
                                <li>{{ trim($item) }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
    </body>

    <script>
        window.print();
    </script>
</html>