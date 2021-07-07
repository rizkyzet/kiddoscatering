<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mpdf</title>

    <style>
        *,
        html,
        body {
            font-family: Calibri;
            color: #4d4f4d;
            margin: 0 !important;
        }

        .header {
            text-align: center;
            border: 1px solid black;
        }

        .header p {}

        .sub-header {
            text-align: center;
            border: 1px solid black;
            margin-top: 40px;
        }

        .contents {
            text-align: center;
            border: 1px solid black;
            margin-top: 50px;
        }

        .table {
            margin-left: auto;
            margin-right: auto;
        }

        .footer {
            margin-top: 80px;

        }

        .footer .ttd {
            margin-left: auto;
            /* margin-right: 50px; */
            width: 180px;
            /* height: 120px; */


        }



        /* .footer .ttd hr {
            border: 0.2px solid black;
        } */

        .ttd p,
        .ttd hr {

            margin: 0;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="<?= base_url('assets/img/logo_kiddos.jpeg') ?>" alt="" width="50" height="70">
        <h3>Lorem ipsum dolor sit amet consectetur <br> adipisicing elit. Rem, nam.</h3>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto maiores dolore esse?</p>
    </div>

    <div class="sub-header">
        <h4>Lorem ipsum dolor sit amet consectetur <br> adipisicing elit. Est nihil libero voluptatum reprehenderit voluptate qui!</h4>
    </div>

    <div class="contents">
        <table class="table" cellpadding=10>
            <tr>
                <th width=100>Nama</th>
                <td> :</td>
                <td>Lorem ipsum dolor sit amet.</td>
            </tr>
            <tr>
                <th width=100>Kelas</th>
                <td> :</td>
                <td>Lorem ipsum dolor sit amet.</td>
            </tr>
            <tr>
                <th width=100>Nama</th>
                <td> :</td>
                <td>Lorem ipsum dolor sit amet.</td>
            </tr>
            <tr>
                <th width=100>Nama</th>
                <td> :</td>
                <td>Lorem ipsum dolor sit amet.</td>
            </tr>
            <tr>
                <th width=100>Nama</th>
                <td> :</td>
                <td>Lorem ipsum dolor sit amet.</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <div class="ttd">
            <p>Serang, <?= date('Y-m-d') ?></p>
            <p>Ketua Program Studi</p>
            <p style="margin-top: 100px;border-bottom:1px solid black;">Muhamad Rizki, S. Kom</p>
            <p>NIDN : 1201161042</p>
        </div>
    </div>
</body>

</html>