<?php
$this->extend('layouts/app');
$this->section('content');
?>
<div class="container-fluid">
    <?= session()->getFlashdata('msg') ?>
    <div class="row g-2">
        <div class="col-12 card">
            <div class="card-body p-1">
                <h5 class="card-title">Data Admin:
                    <a href="<?= site_url("main/setting/edit/$setting[nip_pimpinan]") ?>" class="btn btn-sm btn-primary">
                        <span class="bi bi-pencil-square text-white"></span>
                    </a>
                </h5>
                <div class="row">
                    <div class="col-lg d-flex align-center align-self-center justify-content-center">
                        <img src="https://source.unsplash.com/random/240x240" class="img-thumbnail" alt="">
                    </div>
                    <div class="col-lg d-flex align-center align-self-center justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td><b>Nama</b></td>
                                    <td><?= (session()->get('nama') ?: $user['nama_user']) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Email</b></td>
                                    <td><?= (session()->get('nama') ?: $user['email']) ?></td>
                                </tr>
                                <tr>
                                    <td><b>No.Telepon</b></td>
                                    <td><?= ($user['no_telp']) ?? '' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 card">
            <div class="card-body p-1">
                <h5 class="card-title">Data Pimpinan & Sekretaris:</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td colspan="2" class="h5 text-center"><b>Pimpinan</b></td>
                            <td colspan="2" class="h5 text-center"><b>Sekretaris</b></td>
                        </tr>
                        <tr>
                            <td><b>NIP</b></td>
                            <td><?= ($setting['nip_pimpinan']) ?? '' ?></td>
                            <td><b>NIP</b></td>
                            <td><?= ($setting['nip_sekretaris']) ?? '' ?></td>
                        </tr>
                        <tr>
                            <td><b>Nama</b></td>
                            <td><?= ($setting['nama_pimpinan']) ?? '' ?></td>
                            <td><b>Nama</b></td>
                            <td><?= ($setting['nama_sekretaris']) ?? '' ?></td>
                        </tr>
                        <tr>
                            <td><b>TTD</b></td>
                            <td><img src="<?= site_url() . 'uploads/' . ($setting['ttd_pimpinan']) ?? '' ?>" class="img-thumbnail" alt=""></td>
                            <td><b>TTD</b></td>
                            <td><img src="<?= site_url() . 'uploads/' . ($setting['ttd_sekretaris']) ?? '' ?>" class="img-thumbnail" alt=""></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 card">
            <div class="card-body p-1">
                <h5 class="card-title">Data Wilayah :</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td><b>Kode Wilayah</b></td>
                            <td><?= ($setting['kode_wilayah']) ?? '' ?></td>
                        </tr>
                        <tr>
                            <td><b>Nama Wilayah</b></td>
                            <td><?= ($setting['nama_wilayah']) ?? '' ?></td>
                        </tr>
                        <tr>
                            <td><b>Jenis Wilayah</b></td>
                            <td><?= ($setting['jenis_wilayah']) ?? '' ?></td>
                        </tr>
                        <tr>
                            <td><b>Kecamatan</b></td>
                            <td><?= ($setting['kecamatan']) ?? '' ?></td>
                        </tr>
                        <tr>
                            <td><b>Kabupaten/Kota</b></td>
                            <td><?= ($setting['kab_kota']) ?? '' ?></td>
                        </tr>
                        <tr>
                            <td><b>Provinsi</b></td>
                            <td><?= ($setting['provinsi']) ?? '' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
$this->endSection();
?>