<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pages
			<small>Manajemen Halaman Website</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<a href="<?php echo base_url().'dashboard/pages_tambah'; ?>" class="btn btn-sm btn-primary">Buat halaman baru</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Halaman</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Judul Halaman</th>
									<th>URL Slug</th>
									<th width="15%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($halaman as $h){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $h->halaman_judul; ?></td>
										<td><?php echo base_url()."page/".$h->halaman_slug; ?></td>
										<td>
											<a target="_blank" href="<?php echo base_url()."page/".$h->halaman_slug; ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> </a>
											<a href="<?php echo base_url().'dashboard/pages_edit/'.$h->halaman_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<a href="<?php echo base_url().'dashboard/pages_hapus/'.$h->halaman_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						

					</div>
				</div>

			</div>
		</div>

	</section>

</div>