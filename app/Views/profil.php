<?php
$this->extend('layouts/app');
$this->section('content');
?>
<section class="section">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body pt-4 d-flex flex-column align-items-center">
                    <img src="<?= site_url('assets/img/') . session()->get('foto') ?>" alt="Profile" class="rounded-circle img-thumbnail">
                    <h4><?= session()->get('nama') ?></h4>
                    <p><?= (session()->get('level') != 'penduduk') ? session()->get('level') : session()->get('level') ?></p>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-detail">Profil Detail</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                Profile</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ganti Password</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-3">
                        <div class="tab-pane fade show active" id="profile-detail">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 text-secondary">Nama Lengkap</div>
                                <div class="col-lg-9 col-md-8"><?= $user['nama_user'] ?></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 text-secondary">Email</div>
                                <div class="col-lg-9 col-md-8"><?= $user['email'] ?></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 text-secondary">No Telepon</div>
                                <div class="col-lg-9 col-md-8"><?= $user['no_telp'] ?></div>
                            </div>
                            <?php
                            if (session()->get('level') != 'penduduk') : ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 text-secondary">Level</div>
                                    <div class="col-lg-9 col-md-8"><?= $user['level'] ?></div>
                                </div>
                            <?php
                            endif;
                            ?>
                        </div>
                        <div class="tab-pane fade pt-3" id="profile-edit">
                            <!-- Profile Edit Form -->
                            <form method="POST" action="profile/edit">
                            <?= csrf_field() ?>
                                <div class="row mb-3">
                                    <label for="fotoProfil" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                                    <div class="col-md-8 col-lg-9">
                                        <img src="<?= site_url('assets/img/') . session()->get('foto') ?>" class="img-thumbnail w-50" alt="Profile">
                                        <div class="pt-2">
                                            <a href="#" class="btn btn-primary btn-sm" title="Upload foto profil baru"><i class="bi bi-upload"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" title="Hapus foto profil saya"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="namaUser" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="nama_user" type="text" class="form-control" id="namaUser" value="<?= $user['nama_user'] ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="noTelp" class="col-md-4 col-lg-3 col-form-label">No Telepon</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="no_telp" type="tel" class="form-control" id="noTelp" value="<?= $user['no_telp'] ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="email" value="<?= $user['email'] ?>">
                                    </div>
                                </div>
                                <?php
                                if(session()->get('level') =='admin'):?>
                                <div class="row mb-3">
                                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="country" type="text" class="form-control" id="Country" value="USA">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="address" type="text" class="form-control" id="Address" value="A108 Adam Street, New York, NY 535022">
                                    </div>
                                </div>
                                <?php
                                endif;
                                ?>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form><!-- End Profile Edit Form -->
                        </div>
                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form method="POST" action="profile/ganti_password">
                                <?= csrf_field() ?>
                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Lama</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password_lama" type="password" class="form-control" id="currentPassword">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password_baru" type="password" class="form-control" id="newPassword">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password Baru</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="konfirmasi_password" type="password" class="form-control" id="renewPassword">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                                </div>
                            </form><!-- End Change Password Form -->
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->endSection();
?>