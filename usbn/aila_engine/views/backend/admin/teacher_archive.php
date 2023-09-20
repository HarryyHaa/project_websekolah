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
					<h5 class="center">Arsip Akun Guru </h5>
					<p class="center">Disini anda bisa mengkatifkan kembali atau menghapus secara permanen akun guru</p>
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
				<h5>Daftar Arsip Akun Guru 
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
									<a onclick="return confirm('Apakah anda yakin akan mengaktifkan kembali akun guru ini ?');" href="<?php echo site_url('admin/teacher/reactivate/'.encode($row->ID));?>" class="btn-small blue modal-trigger">Aktifkan Kembali</a>
									<a onclick="return confirm('Apakah anda yakin akan menghapus akun guru ini secara permanen ?');" href="<?php echo site_url('admin/teacher/permanen_delete/'.encode($row->ID));?>" class="btn-small red">Hapus Permanen</a>
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