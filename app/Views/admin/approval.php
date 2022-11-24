<?php
$this->extend('layouts/app');
$this->section('content');
?>
<div class="container-fluid">
	<?= session()->getFlashdata('msg') ?>
	<div class="table-responsive">
		<table class="datatable">
			<thead class="thead-dark">
				<tr>
					<th scope="col">No</th>
					<th scope="col">Nama</th>
					<th scope="col">NIK</th>
					<th scope="col">Status</th>
					<th scope="col">Tanggapan</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; ?>
				<?php foreach ($approval as $row) : ?>
					<tr>
						<th scope="row"><?= $no++; ?></th>
						<td><?= $row['nama'] ?></td>
						<td><?= $row['nik'] ?></td>
						<td>
							<?php
							if ($row['status_approval'] == 'verifikasi') :
								echo '<span class="badge bg-warning">Sedang diverifikasi</span>';
							elseif ($row['status_approval'] == 'proses') :
								echo '<span class="badge bg-info">Sedang diproses</span>';
							elseif ($row['status_approval'] == 'selesai') :
								echo '<span class="badge bg-success">Approval Selesai</span>';
							elseif ($row['status_approval'] == 'ditolak') :
								echo '<span class="badge bg-danger">Approval ditolak</span>';
							else :
								echo '-';
							endif;
							?>
						</td>
						<td><?= ($row['tanggapan_approval']) ?? '-' ?></td>
						<td>
							<a href="<?= base_url('main/approval/detail/' . $row['id_approval']) ?>" class="btn btn-primary">
								<span class="bi bi-eye-fill"></span> Lihat
							</a>
							<a href="<?= base_url('main/approval/edit/' . $row['id_approval']) ?>" class="btn btn-info">
								<span class="bi bi-pencil-fill"></span> Edit
							</a>
							<a href="<?= base_url('main/approval/delete/' . $row['id_approval']) ?>" class="btn btn-outline-danger">
								<span class="bi bi-trash-fill"></span> Hapus
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<?php
$this->endSection();
?>