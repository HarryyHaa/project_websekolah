<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pengguna
			<small>Konfirmasi Hapus Pengguna</small>
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
						<h3 class="box-title">Konfirmasi Hapus</h3>
					</div>
					<div class="box-body">
						
						<p><b><?php echo $pengguna_hapus->pengguna_nama; ?></b> akan dihapus. dan semua artikel yang ditulis oleh <b><?php echo $pengguna_hapus->pengguna_nama; ?></b> akan dipindahkan ke ?</p>
						
						<form method="post" action="<?php echo base_url('dashboard/pengguna_hapus_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Nama Pengguna</label>
									<input type="hidden" name="pengguna_hapus" value="<?php echo $pengguna_hapus->pengguna_id; ?>">

									<select class="form-control" name="pengguna_tujuan" required="required">
										<option value="">- Pilih Level -</option>
										<?php foreach($pengguna_lain as $pl){ ?>
											<option value="<?php echo $pl->pengguna_id ?>"><?php echo $pl->pengguna_nama; ?></option>
										<?php } ?>
									</select>
								</div>

							</div>

							<div class="box-footer">
								<input type="submit" class="btn btn-success" value="Hapus Pengguna & Pindahkan Artikel">
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>