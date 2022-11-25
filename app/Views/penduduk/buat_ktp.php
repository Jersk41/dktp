<?php
$this->extend('layouts/app');
$this->section('content');
?>
<div class="container-fluid">
    <?= session()->getFlashdata('msg') ?>
    <div class="card">
        <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-body">
                <h5 class="card-title">Formulir Membuat KTP</h5>
                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="formTab" role="tablist">
                    <li class="nav-item flex-fill" role="presentation"> <button class="nav-link w-100 active" id="biodata-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-biodata" type="button" role="tab" aria-controls="biodata" aria-selected="true">Biodata</button></li>
                    <li class="nav-item flex-fill" role="presentation"> <button class="nav-link w-100" id="foto-ttd-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-foto-ttd" type="button" role="tab" aria-controls="foto-ttd" aria-selected="false" tabindex="-1">Foto & Tanda Tangan</button></li>
                    <li class="nav-item flex-fill" role="presentation"> <button class="nav-link w-100" id="sidikjari-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-sidikjari" type="button" role="tab" aria-controls="sidikjari" aria-selected="false" tabindex="-1">Sidik Jari</button></li>
                </ul>
                <div class="tab-content pt-2" id="formTabContent">
                    <div class="tab-pane fade active show row needs-validation" id="bordered-justified-biodata" role="tabpanel" aria-labelledby="biodata-tab">
                        <div class="form-group row mb-2">
                            <label for="nik" class="form-label col-md-4">NIK</label>
                            <div class="col-md">
                                <input type="text" name="nik" class="form-control <?= (service('validation')->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" <?= set_value('nik') ?>>
                                <?php
                                if (service('validation')->hasError('nik')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('nik') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="nokk" class="form-label col-md-4">NO. KK</label>
                            <div class="col-md">
                                <input type="text" name="no_kk" class="form-control <?= (service('validation')->hasError('no_kk')) ? 'is-invalid' : ''; ?>" id="nokk" <?= set_value('no_kk') ?>>
                                <?php
                                if (service('validation')->hasError('nik')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('nik') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="nama" class="form-label col-md-4">Nama Lengkap</label>
                            <div class="col-md">
                                <input type="text" name="nama" class="form-control <?= (service('validation')->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" <?= set_value('nama') ?> value="<?= session()->get('nama') ?>">
                                <?php
                                if (service('validation')->hasError('nama')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('nama') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="tempatlahir" class="form-label col-md-4">Tempat Lahir</label>
                            <div class="col-md">
                                <input type="text" name="tempat_lahir" class="form-control <?= (service('validation')->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>" id="tempatlahir" <?= set_value('tempat_lahir') ?>>
                                <?php
                                if (service('validation')->hasError('tempat_lahir')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('tempat_lahir') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="tgl_lahir" class="form-label col-md-4">Tanggal Lahir</label>
                            <div class="col-md">
                                <input type="date" name="tgl_lahir" class="form-control <?= (service('validation')->hasError('tgl_lahir')) ? 'is-invalid' : ''; ?>" id="tgl_lahir" <?= set_value('tempat_lahir') ?>>
                                <?php
                                if (service('validation')->hasError('tgl_lahir')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('tgl_lahir') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="jk" class="form-label col-md-4">Jenis Kelamin</label>
                            <div class="col-md" id="jk">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input <?= (service('validation')->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" value="L" id="jk_lk" <?= set_radio('jenis_kelamin', 'L') ?>>
                                    <label class="form-check-label" for="jk_lk">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input <?= (service('validation')->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" value="P" id="jk_pr" <?= set_radio('jenis_kelamin', 'P') ?>>
                                    <label class="form-check-label" for="jk_pr">
                                        Perempuan
                                    </label>
                                </div>
                                <?php
                                if (service('validation')->hasError('jenis_kelamin')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('jenis_kelamin') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="alamat" class="form-label col-md-4">Alamat</label>
                            <div class="col-md">
                                <textarea name="alamat" class="form-control <?= (service('validation')->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" rows="2"></textarea>
                                <?php
                                if (service('validation')->hasError('alamat')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('alamat') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="alamat" class="form-label col-md-4">RT/RW</label>
                            <div class="col-md">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="rt" class="form-control <?= (service('validation')->hasError('rt_rw')) ? 'is-invalid' : ''; ?>" placeholder="RT" aria-label="RT">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="rw" class="form-control <?= (service('validation')->hasError('rt_rw')) ? 'is-invalid' : ''; ?>" placeholder="RW" aria-label="RW">
                                    </div>
                                </div>
                                <?php
                                if (service('validation')->hasError('rt_rw')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('rt_rw') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="wilayah" class="form-label col-md-4">Wilayah</label>
                            <div class="col-md">
                                <input class="form-control <?= (service('validation')->hasError('wilayah')) ? 'is-invalid' : ''; ?>" name="wilayah" list="listWilayah" id="datalistWilayah" placeholder="Cari wilayah...">
                                <datalist id="listWilayah">
                                    <?php
                                    foreach ($wilayah as $w): ?>
                                        <option value="<?= $w['kode_wilayah'] ?>"><?= "$w[jenis_wilayah] $w[nama_wilayah] - $w[kecamatan] - $w[kab_kota] - $w[provinsi]" ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </datalist>
                                <?php
                                if (service('validation')->hasError('wilayah')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('wilayah') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="inputState" class="form-label col-md-4">Golongan Darah</label></br>
                            <div class="col-md mx-0 row row-cols-2">
                                <div class="form-check col-md-6">
                                    <input type="radio" class="form-check-input" name="golongan_darah" value="-" id="tidaktahu" <?= set_radio('golongan_darah', '-', true) ?>>
                                    <label class="form-check-label" for="tidaktahu">
                                        -
                                    </label>
                                </div>
                                <div class="form-check col-md-6">
                                    <input type="radio" class="form-check-input" name="golongan_darah" value="A" id="A" <?= set_radio('golongan_darah', 'A') ?>>
                                    <label class="form-check-label" for="A">
                                        A
                                    </label>
                                </div>
                                <div class="form-check col-md-6">
                                    <input type="radio" class="form-check-input" name="golongan_darah" value="B" id="B" <?= set_radio('golongan_darah', 'B') ?>>
                                    <label class="form-check-label" for="B">
                                        B
                                    </label>
                                </div>
                                <div class="form-check col-md-6">
                                    <input type="radio" class="form-check-input" name="golongan_darah" value="AB" id="AB" <?= set_radio('golongan_darah', 'AB') ?>>
                                    <label class="form-check-label" for="AB">
                                        AB
                                    </label>
                                </div>
                                <div class="form-check col-md-6">
                                    <input type="radio" class="form-check-input" name="golongan_darah" value="O" id="O" <?= set_radio('golongan_darah', 'O') ?>>
                                    <label class="form-check-label" for="O">
                                        O
                                    </label>
                                </div>
                                <?php
                                if (service('validation')->hasError('golongan_darah')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('golongan_darah') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="agama" class="form-label col-md-4">Agama</label>
                            <div class="col-md">
                                <select id="agama" name="agama" class="form-select <?= (service('validation')->hasError('agama')) ? 'is-invalid' : ''; ?>">
                                    <option <?= set_select('agama', '', true) ?>>Pilih...</option>
                                    <option <?= set_select('agama', 'islam') ?> value="islam">Islam</option>
                                    <option <?= set_select('agama', 'kristen') ?> value="kristen">Kristen</option>
                                    <option <?= set_select('agama', 'hindu') ?> value="hindu">Hindu</option>
                                    <option <?= set_select('agama', 'buddha') ?> value="buddha">Buddha</option>
                                    <option <?= set_select('agama', 'konghucu') ?> value="konghucu">Konghucu</option>
                                </select>
                                <?php
                                if (service('validation')->hasError('agama')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('agama') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- <div class="form-group row mb-2">
                            <label for="pendidikan" class="form-label col-md-4">Pendidikan</label>
                            <div class="col-md">
                                <select id="pendidikan" name="pendidikan" class="form-select <?= (service('validation')->hasError('pendidikan')) ? 'is-invalid' : ''; ?>">
                                    <option <?= set_select('pendidikan', '', true) ?>>Pilih...</option>
                                    <option <?= set_select('pendidikan', 'SD') ?> value="SD">SD/Sederajat</option>
                                    <option <?= set_select('pendidikan', 'SMP') ?> value="SMP">SMP/Sederajat</option>
                                    <option <?= set_select('pendidikan', 'SMA') ?> value="SMA">SMA/Sederajat</option>
                                    <option <?= set_select('pendidikan', 'D4') ?> value="D4">D4/S1</option>
                                    <option <?= set_select('pendidikan', 'S2') ?> value="S2">S2</option>
                                    <option <?= set_select('pendidikan', 'S3') ?> value="S3">S3</option>
                                    <option <?= set_select('pendidikan', 'D1') ?> value="D1">D1</option>
                                    <option <?= set_select('pendidikan', 'D2') ?> value="D2">D2</option>
                                    <option <?= set_select('pendidikan', 'D3') ?> value="D3">D3</option>
                                    <option <?= set_select('pendidikan', 'Lainnya') ?> value="Lainnya">Lainnya</option>
                                </select>
                                <?php
                                if (service('validation')->hasError('pendidikan')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('pendidikan') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div> -->
                        <div class="form-group row mb-2">
                            <label for="pekerjaan" class="form-label col-md-4">Pekerjaan</label>
                            <div class="col-md">
                                <input class="form-control <?= (service('validation')->hasError('pekerjaan')) ? 'is-invalid' : ''; ?>" name="pekerjaan" list="opsiPekerjaan" id="datalistWilayah" placeholder="Cari pekerjaan..">
                                <datalist id="opsiPekerjaan">
                                    <option value="Belum Memiliki Pekerjaan">
                                    <option value="Pelajar/Mahasiswa">
                                    <option value="Wirausaha">
                                    <option value="Wiraswasta">
                                </datalist>
                                <?php
                                if (service('validation')->hasError('pekerjaan')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('pekerjaan') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="kewarganegaraan" class="form-label col-md-4">Kewarganegaraan</label>
                            <div class="col-md">
                                <select id="kewarganegaraan" name="kewarganegaraan" class="form-select <?= (service('validation')->hasError('kewarganegaraan')) ? 'is-invalid' : ''; ?>">
                                    <option <?= set_select('kewarganegaraan', '', true) ?>>Pilih...</option>
                                    <option <?= set_select('kewarganegaraan', 'wni') ?> value="wni">WNI</option>
                                    <option <?= set_select('kewarganegaraan', 'wna') ?> value="wna">WNA</option>
                                </select>
                                <?php
                                if (service('validation')->hasError('kewarganegaraan')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('kewarganegaraan') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="statusperkawinan" class="form-label col-md-4">Status</label>
                            <div class="col-md">
                                <select id="statusperkawinan" name="status_perkawinan" class="form-select <?= (service('validation')->hasError('status_perkawinan')) ? 'is-invalid' : ''; ?>">
                                    <option <?= set_select('status_perkawinan', '', true) ?>>Pilih...</option>
                                    <option <?= set_select('status_perkawinan', 'kawin') ?> value="kawin">Kawin</option>
                                    <option <?= set_select('status_perkawinan', 'belum kawin') ?> value="belum kawin">Belum Kawin</option>
                                </select>
                                <?php
                                if (service('validation')->hasError('status_perkawinan')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('status_perkawinan') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-foto-ttd" role="tabpanel" aria-labelledby="foto-ttd-tab">
                        <div class="form-group row mb-2">
                            <label for="foto" class="form-label col-md-4">Foto Pribadi</label>
                            <div class="col-md">
                                <input type="file" name="foto" class="form-control <?= (service('validation')->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto">
                                <?php
                                if (service('validation')->hasError('foto')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('foto') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="ttd" class="form-label col-md-4">Tanda Tangan</label>
                            <div class="col-md row mx-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signatureModel">
                                            <span class="bi bi-pencil"></span> Gambar Disini
                                        </button>
                                    </div>
                                    <input type="file" class="form-control mb-1 <?= (service('validation')->hasError('ttd')) ? 'is-invalid' : ''; ?>" id="signature-image" name="ttd">
                                </div>
                                <?php
                                if (service('validation')->hasError('ttd')) : ?>
                                    <div class="invalid-feedback">
                                        <?= service('validation')->getError('ttd') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-sidikjari" role="tabpanel" aria-labelledby="sidikjari-tab">
                        <div class="form-group row mb-2">
                            <label for="sidikjari" class="form-label col md-4">Sidik Jari Tangan Kanan</label>
                            <div class="col-md row mx-0">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="kanan_jempol" data-bs-target="#sidik_jari">
                                    <span class="">Scan Jempol</span>
                            </div>
                            <div class="col-md row mx-0">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="kanan_telunjuk" data-bs-target="#sidik_jari">
                                    <span class="">Scan Telunjuk</span>
                            </div>
                            <div class="col-md row mx-0">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="kanan_jaritengah" data-bs-target="#sidik_jari">
                                    <span class="">Scan Jari Tengah</span>
                            </div>
                            <div class="col-md row mx-0">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="kanan_jarimanis" data-bs-target="#sidik_jari">
                                    <span class="">Scan Jari Manis</span>
                            </div>
                            <div class="col-md row mx-0">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="kanan_kelingking" data-bs-target="#sidik_jari">
                                    <span class="">Scan Kelingking</span>
                            </div>
                        </div>
                        </br>
                        <div class="form-group row mb-2">
                            <label for="sidikjari" class="form-label col md-4">Sidik Jari Tangan Kiri</label>
                            <div class="col-md row mx-0">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="kanan_jempol" data-bs-target="#sidik_jari">
                                    <span class="">Scan Jempol</span>
                            </div>
                            <div class="col-md row mx-0">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="kanan_telunjuk" data-bs-target="#sidik_jari">
                                    <span class="">Scan Telunjuk</span>
                            </div>
                            <div class="col-md row mx-0">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="kanan_jaritengah" data-bs-target="#sidik_jari">
                                    <span class="">Scan Jari Tengah</span>
                            </div>
                            <div class="col-md row mx-0">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="kanan_jarimanis" data-bs-target="#sidik_jari">
                                    <span class="">Scan Jari Manis</span>
                            </div>
                            <div class="col-md row mx-0">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="kanan_kelingking" data-bs-target="#sidik_jari">
                                    <span class="">Scan Kelingking</span>
                            </div>
                        </div>
                        </br>
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                                    Saya Telah Menyetujui dan Memahami Prosedur Pembuatan KTP disini
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                                    Informasi Yang Saya Berikan Sudah Benar
                                </label>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Tambah</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade hidden" id="signatureModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="signatureModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h5 class="modal-title" id="signatureModelLabel">Tanda Tangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body flex justify-content-center">
                <div id="signature-pad" class="w-100 d-md-flex justify-content-md-center">
                    <canvas id="signature-canvas" width="250px" height="100px" style="border:1px solid black;"></canvas>
                </div>
            </div>
            <div class="modal-footer flex justify-content-center">
                <button type="button" id="clear_btn" class="btn btn-danger" data-action="clear">
                    <span class="bi bi-trash"></span> Hapus
                </button>
                <button type="submit" id="save_btn" class="btn btn-primary" data-action="save">
                    <span class="bi bi-save"></span> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= site_url('assets/js/signature.js') ?>"></script>
<script type="text/javascript" src="<?= site_url('assets/js/sign.js') ?>"></script>
<?php
$this->endSection();
?>