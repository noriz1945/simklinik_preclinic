<!-- Form Header Start -->
<div class="container-fluid bg-white">
      <h5>Data Pasien</h5>
      <hr>
	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<label class="col-sm-3 col-form-label">No. RM</label>
				<label class="col-sm-9 col-form-label">:
					<?php echo $rs['id_pasien']; ?></label>
			</div>
			<div class="row">
				<label class="col-sm-3 col-form-label">Nama Pasien</label>
				<label class="col-sm-9 col-form-label">:
					<?php echo $rs['nama_pasien']; ?></label>
			</div>
			<div class="row">
				<label class="col-sm-3 col-form-label">Tanggal Lahir / Umur</label>
				<label class="col-sm-9 col-form-label">:
					<?php echo $rs['tgl_lahir']; ?> / <?php echo $rs['umur2']; ?>  </label>
			</div>
			<div class="row">
				<label class="col-sm-3 col-form-label">Jenis Kelamin</label>
				<label class="col-sm-9 col-form-label">:
					<?php echo $rs['gender1']; ?></label>
			</div>
			<div class="row">
				<label class="col-sm-3 col-form-label">Alamat</label>
				<label class="col-sm-9 col-form-label">:
					<?php echo $rs['alamat']; ?></label>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="row">
				<label class="col-sm-3 col-form-label">No. Registrasi</label>
				<label class="col-sm-9 col-form-label">:
					<?php echo $rs['id_reg']; ?></label>
			</div>
			<div class="row">
				<label class="col-sm-3 col-form-label">Tanggal Registrasi</label>
				<label class="col-sm-9 col-form-label">:
					<?php echo $rs['regdate']; ?></label>
			</div>
			<div class="row">
				<label class="col-sm-3 col-form-label">Poli</label>
				<label class="col-sm-9 col-form-label">:
					<?php echo $rs['poli_ruangan']; ?></label>
			</div>
			<div class="row">
				<label class="col-sm-3 col-form-label">Dokter</label>
				<label class="col-sm-9 col-form-label">:
					<?php echo $rs['dokter']; ?></label>
			</div>
			<div class="row">
				<label class="col-sm-3 col-form-label">Asuransi</label>
				<label class="col-sm-9 col-form-label">:
					<?php echo $rs['asuransi']; ?></label>
			</div>
		</div>
	</div>
</div>
<!-- Form Header End -->
