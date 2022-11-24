<?php
$this->extend('layouts/app');
$this->section('content');
?>
<section class="section <?= strtolower($title) ?>">
    <div class="row">
        <!-- Left side columns -->
        <div class="row">
            <?php
            if (session()->get('level') != 'user') :
            ?>
            <div class="col-xxl-3 col-md-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Petugas</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                                    class="bi bi-person"></i></div>
                            <div class="ps-2">
                                <h6><?= number_format($petugas) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Penduduk Terdaftar</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                                    class="bi bi-people"></i></div>
                            <div class="ps-2">
                                <h6><?= number_format($penduduk) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Semua Approval</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                                    class="bi bi-card-text"></i></div>
                            <div class="ps-2">
                                <h6><?= number_format($approval) ?></h6> <span
                                    class="text-success small pt-1 fw-bold">12%</span> <span
                                    class="text-muted small pt-2 ps-1">increase</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Approval Diproses</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                                    class="bi bi-card-text"></i></div>
                            <div class="ps-2">
                                <h6><?= number_format($approval_proses) ?></h6> <span
                                    class="text-success small pt-1 fw-bold">12%</span> <span
                                    class="text-muted small pt-2 ps-1">increase</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Approval Selesai</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                                    class="bi bi-card-text"></i></div>
                            <div class="ps-2">
                                <h6><?= number_format($approval_selesai) ?></h6> <span
                                    class="text-success small pt-1 fw-bold">12%</span> <span
                                    class="text-muted small pt-2 ps-1">increase</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php elseif (session()->get('level') == 'user') :
            ?>
            <div class="mt-4 p-5 bg-primary text-white rounded">
                <h2><b>Status Pembuatan KTP</b> <?= $badge ?></h2>
                <table class="table table-responsive table-borderless text-white">
                    <thead>
                        <tr class="border-bottom border-white">
                            <th>Formulir</th>
                            <th class="text-center">Kelengakapan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Data Diri</td>
                            <td class="text-center">
                                <?= $biodata ? '<i class="bi bi-check-circle" style="color:#38c172"></i>' : '<i class="bi bi-x-circle" style="color:#fff"></i>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Foto</td>
                            <td class="text-center">
                                <?= $foto ? '<i class="bi bi-check-circle" style="color:#38c172"></i>' : '<i class="bi bi-x-circle" style="color:#fff"></i>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Sidik Jari</td>
                            <td class="text-center">
                                <?= $sidikjari ? '<i class="bi bi-check-circle" style="color:#38c172"></i>' : '<i class="bi bi-x-circle" style="color:#fff"></i>' ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </tr>
                <h3><b>Langkah - Langkah Pembuatan KTP</b></h3>
                <li>Pengisian data diri dimohon untuk melakukannya pada jam kerja, pukul 08:00 s/d 16:00 WIB</li>
                <li>Isi data diri sesuai dengan yang tercantum dalam KK anda.</li>
                <li>Jika semua sudah terisi dengan baik dan benar,mohon tunggu proses verifikasi yang dilakukan oleh
                    admin.</li>
                <li>Jika selama waktu 7x24 Jam admin belum memverifikasi pembuatan KTP, bisa hubungi di 
                    <a href="#">...</a>
                </li>
                <li>Jika dalam waktu 2 minggu KTP belum diproses maka hubungi admin DKTP atau datang ke kantor kecamatan daerah anda</li>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
$this->endSection();
?>