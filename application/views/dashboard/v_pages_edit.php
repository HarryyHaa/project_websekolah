<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pages
			<small>Edit Halaman</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url().'dashboard/pages'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br/>
		<br/>

		<?php foreach($halaman as $h){ ?>

		<form method="post" action="<?php echo base_url('dashboard/pages_update') ?>">
			<div class="row">
				<div class="col-lg-12">

					<div class="box box-primary">
						<div class="box-body">


							<div class="box-body">
								<div class="form-group">
									<label>Judul</label>
									<input type="hidden" name="id" value="<?php echo $h->halaman_id; ?>">
									<input type="text" name="judul" class="form-control" placeholder="Masukkan judul halaman.." value="<?php echo $h->halaman_judul; ?>">
									<br/>
									<?php echo form_error('judul'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Konten</label>
									<?php echo form_error('konten'); ?>
									<br/>
									<textarea class="form-control" id="editor" name="konten"> <?php echo $h->halaman_konten; ?> </textarea>
								</div>
							</div>

							<input type="submit" name="status" value="Publish" class="btn btn-success btn-block">

						</div>
					</div>

				</div>

			</div>
		</form>
		<?php } ?>

	</section>

</div>