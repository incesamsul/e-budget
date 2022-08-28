<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak laporan</title>
    <style>
        body {
            /* color: rgba(0, 0, 0, 0.8); */
        }

        .full-width {
            width: 100%;
        }

        .logo {
            float: left;
            margin-bottom: 15px;
            margin-right: 5px;
            margin-left: 100px;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .header {
            color: #000000;
            border-bottom: 4px double #000000;
            margin-bottom: 10px;
        }

        .header-text {
            text-align: center;
        }

        .header-text * {
            margin: 1px;
        }

        .header-text p {
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mt-50 {
            margin-top: 50px;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

        table {
            font-size: 14px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header clearfix">
            <div class="logo">
                <img src="{{'data:image/png;base64,' . base64_encode(file_get_contents('img/logo.png'))}}" alt="image" width="100">
            </div>
            <div class="header-text">
                <br><br>
                <h4>STIKES GRAHA EDUKASI MAKASSAR</h4>
                <P>jL. Perintis kemerdekan km 12. Kel. Kapasa, Kec Tamalanrea Makassar</P>
            </div>
        </div>
        <h4 class="text-center">Laporan Pengajuan Anggaran</h4>
        
        <table class="full-width mt-10 mb-30" border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th width="5%" class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">ID <span id="id_icon"></span></th>
                    <td>Pengaju</td>
                    <td>jenis anggaran</td>
                    <td>jumlah anggaran</td>
                    <td>tahun akademik</td>
                    <td>tanggal pengajuan</td>
                    <td>status</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuan as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->pengaju->name }}</td>
                        <td>{{ $row->jenisAnggaran->nama_anggaran }}</td>
                        <td>{{ $row->jumlah_anggaran }}</td>
                        <td>{{ $row->tahunAkademik->nama_tahun_akademik }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>
                            {!! getStatus($row) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</body>
</html>
