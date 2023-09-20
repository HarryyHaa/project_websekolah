<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pengguna
			<small>Tambah Pengguna</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/pengguna'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Pengguna</h3>
					</div>
					<div class="box-body">
						
						<?php foreach($pengguna as $p){ ?>

							<form method="post" action="<?php echo base_url('dashboard/pengguna_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Nama</label>
										<input type="hidden" name="id" value="<?php echo $p->pengguna_id; ?>">
										<input type="text" name="nama" class="form-control" placeholder="Masukkan nama pengguna .." value="<?php echo $p->pengguna_nama; ?>">
										<?php echo form_error('nama'); ?>
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="email" class="form-control" placeholder="Masukkan email pengguna .." value="<?php echo $p->pengguna_email; ?>">
										<?php echo form_error('email'); ?>
									</div>
									<div class="form-group">
										<label>Username</label>
										<input type="text" name="username" class="form-control" placeholder="Masukkan username pengguna.." value="<?php echo $p->pengguna_username; ?>">
										<?php echo form_error('username'); ?>
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="password" class="form-control" placeholder="Masukkan password pengguna..">
										<?php echo form_error('password'); ?>
										<small>Kosongkan jika tidak ingin mengubah password</small>
									</div>
									<div class="form-group">
										<label>Level</label>
										<select class="form-control" name="level">
											<option value="">- Pilih Level -</option>
											<option <?php if($p->pengguna_level == "admin"){ echo "selected='selected'";} ?> value="admin">Admin</option>
											<option <?php if($p->pengguna_level == "penulis"){ echo "selected='selected'";} ?> value="penulis">Penulis</option>
										</select>
										<?php echo form_error('level'); ?>
									</div>
									<div class="form-group">
										<label>Status</label>
										<select class="form-control" name="status">
											<option value="">- Pilih Status -</option>
											<option <?php if($p->pengguna_status == "1"){ echo "selected='selected'"; } ?> value="1">Aktif</option>
											<option <?php if($p->pengguna_status == "0"){ echo "selected='selected'"; } ?> value="0">Non-Aktif</option>
										</select>
										<?php echo form_error('status'); ?>
									</div>
								</div>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Simpan">
								</div>
							</form>

						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>