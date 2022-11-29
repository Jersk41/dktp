<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laporan Pengaduan Masyarakat</title>
    <link href="<?= site_url('assets/img/bg.svg') ?>" rel="icon">
    <link href="<?= site_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>

<body>
    <style>
        body {
            font-family: 'Open Sans';
        }
        .text-center{
            text-align: center;
        }
        .table{
            width: 100%;
        }
        thead{
            background: skyblue;
        }
        .table,th,td{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <div id="wrapper">
        <div class="container-fluid">
            <h1 class="text-center">Laporan Approval Pembuatan KTP</h1>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" width="5%">No</th>
                        <th scope="col" width="15%">NIK</th>
                        <th scope="col" width="10%">Tanggal Pembuatan</th>
                        <th scope="col" width="5%">Status</th>
                        <th scope="col" width="25%">Tanggapan</th>
                        <th scope="col" width="10%">Tanggal Tanggapan</th>
                        <th scope="col" width="30%">Wilayah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($approval as $a) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $a['nik'] ?></td>
                            <td class="text-center"><?= $a['tgl_pembuatan'] ?></td>
                            <td class="text-center">
                                <?php
                                switch ($a['status_approval']) {
                                    case 'verifikasi':
                                        echo '<span class="badge bg-warning text-dark">Verifikasi</span>';
                                        break;
                                    case 'proses':
                                        echo '<span class="badge bg-info text-dark">Proses</span>';
                                        break;
                                    case 'selesai':
                                        echo '<span class="badge bg-success text-dark">Selesai</span>';
                                        break;
                                    case 'ditolak':
                                        echo '<span class="badge bg-dark text-white">Ditolak</span>';
                                        break;
                                    default:
                                        echo '<span class="badge bg-danger text-dark">Data Belum Lengkap</span>';
                                        break;
                                }
                                ?>
                            </td>
                            <td><?= $a['tanggapan_approval'] == null ? '-' : $a['tanggapan_approval']; ?></td>
                            <td class="text-center"><?= $a['tgl_tanggapan'] == null ? '-' : $a['tgl_tanggapan']; ?></td>
                            <td><?= $a['nama_wilayah'] == null ? '-' : ucwords("$a[jenis_wilayah] $a[nama_wilayah], Kec. $a[kecamatan], $a[kab_kota]"); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="<?= site_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= site_url('assets/js/main.js') ?>"></script>
    <!-- Custom scripts for all pages-->
    <!-- <script src="<?= base_url() ?>assets/backend/js/sb-admin-2.min.js"></script> -->
</body>

</html>