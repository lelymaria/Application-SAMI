<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .paper-a4 {
            width: 21cm;
            height: 29.7cm;
            margin: auto;
            border: 1px solid black;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }

        img {
            width: 150px;
            height: 150px;
        }
</style>
<body>
    <div  class="papper-a4">
        <table >
            <tr>
                <td rowspan="4" width="150px">
                    <center>
                        <img src="../../../../public/images/polindra1.png" alt="" style="width: 150px; height: 150px;">
                    </center>
                </td>
                <th rowspan="1">Formulir</th>
                <th>No. Dokumen</th>
                <td>{{  }}</td>
            </tr>
            <tr>
                <th rowspan="3">{{  }}</th>
                <th>No. Revisi</th>
                <td>{{  }}</td>
            </tr>
            <tr>
                <th>Tgl. Berlaku</th>
                <td>{{  }}</td>
            </tr>
            <tr>
                <th>Halaman</th>
                <td>{{  }}</td>
            </tr>
        </table>
        <table style="margin-top: 10px;" >
            <tr>
                <th align="left">No. Audit :</th>
                <th align="left">{{  }}</th>
                <th align="left">Tanggal :</th>
                <th align="left">{{  }}</th>
                <th align="left">Auditor :</th>
                <th align="left">{{  }}</th>
                <th align="left">NIP/NIK :</th>
                <th align="left">{{  }}</th>
            </tr>
        </table>

        <table  style="margin-top: 10px;">
            <tr>
                <th rowspan="2">Prosedur Opersional/Dokumen Mutu</th>
                <th rowspan="2">Daftar Pertanyaan</th>
                <th rowspan="2">Nama Dokumen (*)</th>
                <th colspan="2">Ketersediaan Dokumen</th>
                <th rowspan="2">PIC</th>
            </tr>
            <tr>
                <th>Ada</th>
                <th>Tidak</th>
            </tr>
            <tr>
                <td>{{  }}</td>
                <td>{{  }}</td>
                <td>{{  }}</td>
                <td>{{  }}</td>
                <td>{{  }}</td>
                <td>{{  }}</td>
            </tr>
        </table>
        <br>
        <span>NB :</span>
        <p>* Pengisian Kolom Nama Dokumen dapat diisi oleh Auditee sesuai dengan keadaan di Program Studi.</p>
    </div>
</body>

</html>
