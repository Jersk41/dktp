<?php
$this->extend('layouts/app');
$this->section('content');
?>
<div class="container-fluid">
    <?= session()->getFlashdata('msg') ?>
    <div class="row card">
        <form method="POST" action='<?= site_url("main/setting/update/". ($user['id_user']) ?? '') ?>' enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="id_user" value="<?= (session()->get('id')) ?? '' ?>">
            <div class="card-body g-2 py-3">
                <div class="form-group row mb-2">
                    <label for="kode_wilayah" class="form-label col-md-4">Kode Wilayah</label>
                    <div class="col-md">
                        <input type="text" class="form-control <?= (service('validation')->getError('kode_wilayah')) ? 'is-invalid' : ''; ?>" id="kode_wilayah" placeholder="" name="kode_wilayah" value="<?= set_value('kode_wilayah', ($setting['kode_wilayah']) ?? '') ?>" <?= ($setting['kode_wilayah']) ? 'disabled' : '' ?> >
                        <?php
                        if (service('validation')->getError('kode_wilayah')) : ?>
                            <div class="invalid-feedback">
                                <?= service('validation')->getError('kode_wilayah') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nama_wilayah" class="form-label col-md-4">Nama Wilayah</label>
                    <div class="col-md">
                        <input type="text" class="form-control <?= (service('validation')->getError('nama_wilayah')) ? 'is-invalid' : ''; ?>" id="nama_wilayah" placeholder="" name="nama_wilayah" value="<?= set_value('nama_wilayah', ($setting['nama_wilayah']) ?? '') ?>">
                        <?php
                        if (service('validation')->getError('nama_wilayah')) : ?>
                            <div class="invalid-feedback">
                                <?= service('validation')->getError('nama_wilayah') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="inputState" class="form-label col-md-4">Jenis Wilayah</label></br>
                    <div class="col-md mx-0 row row-cols-2">
                        <div class="form-check col-md-6">
                            <input type="radio" class="form-check-input" name="jenis_wilayah" value="kelurahan" id="kelurahan" <?= set_radio('jenis_wilayah', 'kelurahan',($setting['jenis_wilayah']) ?? '') ?>>
                            <label class="form-check-label" for="kelurahan">
                                Kelurahan
                            </label>
                        </div>
                        <div class="form-check col-md-6">
                            <input type="radio" class="form-check-input" name="jenis_wilayah" value="desa" id="desa" <?= set_radio('jenis_wilayah', 'desa',($setting['jenis_wilayah']) ?? '') ?>>
                            <label class="form-check-label" for="desa">
                                Desa
                            </label>
                        </div>
                        <?php
                        if (service('validation')->hasError('jenis_wilayah')) : ?>
                            <div class="invalid-feedback">
                                <?= service('validation')->getError('jenis_wilayah') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="kecamatan" class="form-label col-md-4">Kecamatan</label>
                    <div class="col-md">
                        <input type="text" name="kecamatan" class="form-control <?= (service('validation')->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" id="kecamatan" value="<?= set_value('kecamatan',($setting['kecamatan']) ?? '') ?>">
                        <?php
                        if (service('validation')->hasError('kecamatan')) : ?>
                            <div class="invalid-feedback">
                                <?= service('validation')->getError('kecamatan') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="kabKota" class="form-label col-md-4">Kabupaten/Kota</label>
                    <div class="col-md">
                        <input type="text" name="kab_kota" class="form-control <?= (service('validation')->hasError('kab_kota')) ? 'is-invalid' : ''; ?>" id="kabKota" value="<?= set_value('kab_kota',($setting['kab_kota']) ?? '') ?>">
                        <?php
                        if (service('validation')->hasError('kab_kota')) : ?>
                            <div class="invalid-feedback">
                                <?= service('validation')->getError('kab_kota') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="provinsi" class="form-label col-md-4">Provinsi</label>
                    <div class="col-md">
                        <input type="text" name="provinsi" class="form-control <?= (service('validation')->hasError('provinsi')) ? 'is-invalid' : ''; ?>" id="provinsi" value="<?= set_value('provinsi', ($setting['provinsi']) ?? '') ?>">
                        <?php
                        if (service('validation')->hasError('provinsi')) : ?>
                            <div class="invalid-feedback">
                                <?= service('validation')->getError('provinsi') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <hr>
                <div class="form-group row mb-2">
                    <div class="col">
                        <h5 class="text-center"><b>Pimpinan</b></h5>
                        <div class="form-group row mb-2">
                            <label for="nip_pimpinan" class="form-label col-md-4">NIP</label>
                            <div class="col-md">
                                <input type="text" name="nip_pimpinan" class="form-control <?= (service('validation')->hasError('nip_pimpinan')) ? 'is-invalid' : ''; ?>" id="nip_pimpinan" placeholder="Masukkan NIP Pimpinan" value="<?= set_value('nip_pimpinan',($setting['nip_pimpinan']) ?? '') ?>">
                                <?php
                                if (service('validation')->hasError('nip_pimpinan')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('nip_pimpinan') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="nama_pimpinan" class="form-label col-md-4">Nama</label>
                            <div class="col-md">
                                <input type="text" name="nama_pimpinan" class="form-control <?= (service('validation')->hasError('nama_pimpinan')) ? 'is-invalid' : ''; ?>" id="nama_pimpinan" placeholder="Masukkan Nama Pimpinan" value="<?= set_value('nama_pimpinan',($setting['nama_pimpinan']) ?? '') ?>">
                                <?php
                                if (service('validation')->hasError('nama_pimpinan')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('nama_pimpinan') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="ttd_pimpinan" class="form-label col-md-4">TTD</label>
                            <div class="col-md">
                                <input type="file" name="ttd_pimpinan" class="form-control <?= (service('validation')->hasError('ttd_pimpinan')) ? 'is-invalid' : ''; ?>" id="ttd_pimpinan" placeholder="Masukkan TTD Pimpinan">
                                <?php
                                if (service('validation')->hasError('ttd_pimpinan')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('ttd_pimpinan') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h5 class="text-center"><b>Sekretaris</b></h5>
                        <div class="form-group row mb-2">
                            <label for="nip_sekretaris" class="form-label col-md-4">NIP</label>
                            <div class="col-md">
                                <input type="text" name="nip_sekretaris" class="form-control <?= (service('validation')->hasError('nip_sekretaris')) ? 'is-invalid' : ''; ?>" id="nip_sekretaris" placeholder="Masukkan NIP Sekretaris" value="<?= set_value('nip_sekretaris',($setting['nip_sekretaris']) ?? '') ?>">
                                <?php
                                if (service('validation')->hasError('nip_sekretaris')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('nip_sekretaris') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="nama_sekretaris" class="form-label col-md-4">Nama</label>
                            <div class="col-md">
                                <input type="text" name="nama_sekretaris" class="form-control <?= (service('validation')->hasError('nama_sekretaris')) ? 'is-invalid' : ''; ?>" id="nama_sekretaris" placeholder="Masukkan Nama Sekretaris" value="<?= set_value('nama_sekretaris',($setting['nama_sekretaris']) ?? '') ?>">
                                <?php
                                if (service('validation')->hasError('nama_sekretaris')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('nama_sekretaris') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="ttd_sekretaris" class="form-label col-md-4">TTD</label>
                            <div class="col-md">
                                <input type="file" name="ttd_sekretaris" class="form-control <?= (service('validation')->hasError('ttd_sekretaris')) ? 'is-invalid' : ''; ?>" id="ttd_sekretaris" placeholder="Masukkan TTD Sekretaris">
                                <?php
                                if (service('validation')->hasError('ttd_sekretaris')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('ttd_sekretaris') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <?php if($setting): ?>
                <button type="submit" formaction="<?= site_url("main/setting/update/". ($user['id_user']) ?? '') ?>" class="btn btn-primary">Simpan</button>
                <?php else: ?>
                <button type="submit" formaction="<?= site_url("main/setting/create/") ?>" class="btn btn-primary">Tambah</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
</div>
<?php
$this->endSection();
?>