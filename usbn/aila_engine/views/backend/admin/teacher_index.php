<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
.card-content ul li{
	list-style: disc !important;
	margin-left: 20px;
}
</style>
<!-- Start First Row -->

<div class="row">
	<div class="col m12 s12">
		<nav class="white">
			<div class="nav-wrapper">
				<div class="col s12">
					<a href="<?=site_url('admin/home');?>" class="breadcrumb">Home</a>
					<a href="#!" class="breadcrumb">Guru</a>
				</div>
			</div>
		</nav> 
	</div>
</div>

<?php if ($this->session->userdata('teacher_guide') == TRUE) { ?>
	<div class="row">
		<div class="col m12 s12">
			<div class="card">
				<div class="card-content">
					<h5 class="center">Panduan Manajemen Akun Guru </h5>
					<ul>
						<li>Disini admin bisa menambah, merubah dan mengarsipkan akun guru.</li>
						<li>Untuk menambah akun guru baru, cukup dengan memasukan NIP dan nama lengkap, karena passwordnya akan otomatis di genret menjadi <b>12345678</b>.</li>
						<li>Guru bisa masuk ke aplikasi ini menggunakan NIP dan password default (12345678), begitu guru masuk pertama kali maka guru diwajibkan untuk mlengkapi profil dan juga merubah passwordnya.</li>
					</ul>
					<p class="center">(<a href="<?php echo site_url('admin/teacher/teacher_guide_hide') ;?>">Klik disini untuk menutup panduan</a>)</p>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<?php if ($this->session->flashdata()) 
				{
					if ($this->session->flashdata('success')) 
					{
						echo "<div class='center white-text card-content green lighten-1'>".$this->session->flashdata('success')."</div>";
					}else{
						echo "<div class='center white-text card-content red lighten-1'>".$this->session->flashdata('failed')."</div>";
					}
				};?>
				<h5>Daftar Akun Guru <a href="#add_teacher" class="btn-small green modal-trigger"><i class="material-icons" title="Tambah baru">add</i></a> 
					<a href="#techer_import" class="btn-small green modal-trigger"><i class="material-icons" title="Upload Banyak">add</i><i class="material-icons" title="Upload Banyak">add</i></a> 
					<?php if ($this->session->userdata('teacher_guide') == FALSE) { ?>
						<a href="<?php echo site_url('admin/teacher/teacher_guide_show');?>" class="right"><small style="font-size: 15px;">(Tampilkan panduan)</small></a>
					<?php }?>
				</h5>

				<table class=" responsive-table" id="dataTables">
					<thead>
						<tr>
							<th>No.</th>
							<th>NIP</th>
							<th>Nama</th>
							<th>Email</th>
							<th>No. HP</th>
							<th>Terakhir Masuk</th>
							<th>Aksi</th>
							<th>Password</th>
						</tr>
					</thead>
					<tbody>
						<?php $no =1; foreach ($teacher as $row) { ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->code;?></td>
								<td><?php echo $row->name;?></td>
								<td><?php echo $row->email;?></td>
								<td><?php echo $row->phone_number;?></td>
								<td><?php echo $row->last_login;?></td>
								<td>
									<a href="#edit_teacher<?php echo encode($row->ID);?>" class="btn-small blue modal-trigger">Ubah</a>

									<!-- Start Moadal Add teacher-->
									<div id="edit_teacher<?php echo encode($row->ID);?>" class="modal">
										<div class="modal-content">
											<h5>Ubah Guru</h5>
											<?php echo form_open(site_url('admin/teacher/update'));?>
											<input type="hidden" name="ID" value="<?php echo $row->ID;?>">
											<div class="row">
												<div class="input-field col s12">
													<input type="text" name="code" id="code" autocomplete="off" required="" value="<?php echo $row->code;?>">
													<label for="#code">NIP</label>
												</div>
												<div class="input-field col s12">
													<input type="text" name="name" id="name" autocomplete="off" required=""  value="<?php echo $row->name;?>">
													<label for="#name">Nama Guru</label>
												</div>
												<div class="col s12">
													<button type="submit" class="waves-effect waves-green btn green">Ubah</button>
													<a href="#!" class="modal-close waves-effect waves-white btn red">Batal</a>
												</div>
											</div>
											<?php echo form_close();?>
										</div>
									</div>
									<!-- End Modal Add teacher-->

									<a onclick="return confirm('Apakah yakin akun guru ini mau diarsipkan ?');" href="<?php echo site_url('admin/teacher/soft_delete/'.encode($row->ID));?>" class="btn-small brown">Arsipkan</a>
								</td>
								<td>
									<a onclick="return confirm('Apakah yakin mau mereset password menjadi 12345678 ?');" href="<?php echo site_url('admin/teacher/password_reset/'.encode($row->ID));?>" class="btn-small green">Reset</a>
								</td>
							</tr>
							<?php $no++; } ;?>
						</tbody>
					</table>
				</div>
			</div>

		</div>

	</div>
	<!-- Start Second Row -->


	<!-- Start Moadal Add teacher-->
	<div id="add_teacher" class="modal">
		<div class="modal-content">
			<h5>Tambah Guru</h5>
			<?php echo form_open(site_url('admin/teacher/create'));?>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" name="code" id="code" autocomplete="off" required="">
					<label for="#code">NIP</label>
				</div>
				<div class="input-field col s12">
					<input type="text" name="name" id="name" autocomplete="off" required="">
					<label for="#name">Nama Guru</label>
				</div>
				<div class="col s12">
					<button type="submit" class="waves-effect waves-green btn green">Simpan</button>
					<a href="#!" class="modal-close waves-effect waves-white btn red">Batal</a>
				</div>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
<!-- End Modal Add teacher-->

<!-- Start Modal Import Mahasiswa -->
	 <div id="techer_import" class="modal">
            <div class="modal-content">
              <h4>Import Guru</h4>
              <p>Untuk mengimport data guru, silahkan gunakan  <a href="<?php echo base_url('aila_cbt/xls_template/template_guru.xls');?>"> template ini</a></p>
              <hr/>
              	<?php echo form_open_multipart(site_url('admin/teacher/import')) ;?>
                <div class="row">
                  <div class="input-field col s10">
                    <div class="file-field input-field">
                      <div class="btn">
                        <span>File</span>
                        <input type="file" name="file" class="green">
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Pilih photo profil anda">
                      </div>
                    </div>
                  </div>
                  <div class="col s2">
                    <button type="submit" class="waves-effect waves-green btn green" style="margin-top: 25px;">Import</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
<!-- End Modal Import Mahasiswa -->