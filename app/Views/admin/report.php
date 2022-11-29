<?php
$this->extend('layouts/app');
$this->section('content');
?>
<div class="container-fluid">
    <?= session()->getFlashdata('msg') ?>
    <div class="table-responsive">
        <table class="table datatable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Tanggal Pembuatan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggapan</th>
                    <th scope="col">Tanggal Tanggapan</th>
                    <th scope="col">Wilayah</th>
                </tr>
            </thead>
            <tbody>

                <?php $no = 1; ?>
                <?php foreach ($approval as $a) : ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td><?= $a['nama'] ?></td>
                        <td><?= $a['nik'] ?></td>
                        <td><?= $a['tgl_pembuatan'] ?></td>
                        <td>
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
                        <td><?= $a['tgl_tanggapan'] == null ? '-' : $a['tgl_tanggapan']; ?></td>
                        <td><?= $a['nama_wilayah'] == null ? '-' : ucwords("$a[jenis_wilayah] $a[nama_wilayah], Kec. $a[kecamatan], $a[kab_kota]"); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="<?= site_url('main/report/download') ?>" class="btn btn-primary mt-2">
        <span class="bi bi-download"></span> Download
    </a>
    <a target="_blank" href="<?= site_url('main/report/preview') ?>" class="btn btn-outline-primary mt-2">
        <span class="bi bi-eye"></span> Preview
    </a>
</div>
<?php
$this->endSection();
?>