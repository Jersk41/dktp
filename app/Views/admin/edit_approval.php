<?php
$this->extend('layouts/app');
$this->section('content');
?>
<div class="container-fluid">
    <?= session()->getFlashdata('msg') ?>
    <div class="row">
    <div class="col-sm col-md-3 mb-2">
            <img src="<?= site_url() . 'uploads/' . $approval['foto'] ?>" class="img-thumbnail" alt="">
        </div>
        <div class="col-lg mb-2 card">
            <div class="card-body p-1">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td><b>NIK</b></td>
                            <td><?= $approval['nik'] ?></td>
                        </tr>
                        <tr>
                            <td><b>No KK</b></td>
                            <td><?= $approval['no_kk'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Nama</b></td>
                            <td><?= $approval['nama'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Tempat Lahir</b></td>
                            <td><?= $approval['tempat_lahir'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Lahir</b></td>
                            <td><?= $approval['tgl_lahir'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Jenis Kelamin</b></td>
                            <td><?= $approval['jenis_kelamin'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Alamat</b></td>
                            <td><?= $approval['alamat'] ?></td>
                        </tr>
                        <tr>
                            <td><b>RT/RW</b></td>
                            <td><?= $approval['rt_rw'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Kelurahan/Desa</b></td>
                            <td><?= $approval['nama_wilayah'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Kecamatan</b></td>
                            <td><?= $approval['kecamatan'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Agama</b></td>
                            <td><?= $approval['agama'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Golongan Darah</b></td>
                            <td><?= $approval['golongan_darah'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Status Perkawinan</b></td>
                            <td><?= $approval['status_perkawinan'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Pekerjaan</b></td>
                            <td><?= $approval['pekerjaan'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Kewarganegaraan</b></td>
                            <td><?= $approval['kewarganegaraan'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Pembuatan</b></td>
                            <td><?= $approval['tgl_pembuatan'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Tanda Tangan</b></td>
                            <td><img src="<?= site_url() . 'uploads/' . $approval['ttd'] ?>" class="img-thumbnail" alt=""></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12 card">
            <div class="card-header">
                <h3 class="text-primary">Edit Approval</h3>
                <p>Status Sekarang : <b class="text-dark"><?= ucfirst($approval['status_approval']) ?></b></p>
            </div>
            <div class="card-body">
                <form method="POST" action='<?= site_url("main/approval/update/$approval[id_approval]") ?>'>
                    <?php csrf_field(); ?>
                    <div class="form-group mb-2">
                        <label for="tanggapan_approval">Tanggapan</label>
                        <input type="text" class="form-control <?= (service('validation')->getError('tanggapan_approval')) ? 'is-invalid' : ''; ?>" id="tanggapan_approval" placeholder="" name="tanggapan_approval" value="<?= set_value('tanggapan_approval',$approval['tanggapan_approval']); ?>">
                        <?php
                        if (service('validation')->getError('tanggapan_approval')) : ?>
                            <div class="invalid-feedback">
                                <?= service('validation')->getError('tanggapan_approval') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-2">
                        <label for="status_approval">Status</label>
                        <div class="col-md mx-0 row row-cols-2">
                            <div class="form-check col-md-6">
                                <input type="radio" class="form-check-input" name="status_approval" value="verifikasi" id="verifikasi" <?= set_radio('status_approval', 'verifikasi',($approval['status_approval'] == 'verifikasi')??false) ?>>
                                <label class="form-check-label badge bg-secondary text-white" for="verifikasi">
                                    Verifikasi
                                </label>
                            </div>
                            <div class="form-check col-md-6">
                                <input type="radio" class="form-check-input" name="status_approval" value="proses" id="proses" <?= set_radio('status_approval', 'proses',($approval['status_approval'] == 'proses')??false) ?>>
                                <label class="form-check-label badge bg-warning text-dark" for="proses">
                                    Proses
                                </label>
                            </div>
                            <div class="form-check col-md-6">
                                <input type="radio" class="form-check-input" name="status_approval" value="selesai" id="selesai" <?= set_radio('status_approval', 'selesai',($approval['status_approval'] == 'selesai')??false) ?>>
                                <label class="form-check-label badge bg-success text-white" for="selesai">
                                    Selesai
                                </label>
                            </div>
                            <div class="form-check col-md-6">
                                <input type="radio" class="form-check-input" name="status_approval" value="ditolak" id="ditolak" <?= set_radio('status_approval', 'ditolak', ($approval['status_approval'] == 'ditolak')??false) ?>>
                                <label class="form-check-label badge bg-danger text-white" for="ditolak">
                                    Ditolak
                                </label>
                            </div>
                            <?php
                            if (service('validation')->hasError('status_approval')) : ?>
                                <div class="invalid-feedback">
                                    <?= service('validation')->getError('status_approval') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$this->endSection();
?>