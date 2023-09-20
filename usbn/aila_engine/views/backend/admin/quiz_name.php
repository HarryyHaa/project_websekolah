<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Daftar Paket Soal Ujian <a href="#create_quiz_name" class="btn-small green modal-trigger" title="Tambah Baru"><i class="material-icons left">add</i>Baru</a></h5>
				<p>Disini anda bisa membuat, merubah dan mengarsipkan paket soal ujian, lengkap dengan daftar pertanyaan berserta pilihan jawaban. <br/>
				Untuk soal text bisa langsung diimport menggunakan template excel, lalu untuk gambar dan audionya bisa diinput secara manual.</p>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->


<!-- Start Moadal Add quiz name -->
<div id="create_quiz_name" class="modal">
	<div class="modal-content">
		<h5>Tambah Paket Soal</h5>
		<?php echo form_open(site_url('admin/quiz/create_quiz_name'));?>
		<div class="row">
			<div class="input-field col s12">
				<select name="teacher">
					<option value="" disabled selected>Pilih Guru</option>
					<?php foreach ($teacher as $teac1) {
						echo "<option value='".$teac1->ID."'>".$teac1->name."</option>";
					} ?>
				</select>
				<label>Pilih Guru</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="title" id="title" autocomplete="off" required="">
				<label for="#title">Judul</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="description" id="description" autocomplete="off" >
				<label for="#description">Deskripsi (Opsional)</label>
			</div>
			<div class="input-field col s4">
				<input type="number" name="time" id="time" autocomplete="off" required="">
				<label for="#time">Waktu Mengerjakan</label>
			</div>
			<div class="input-field col s4">
				<input type="number" name="multiple_choice_percentage" id="multiple_choice_percentage" autocomplete="off" required="">
				<label for="#multiple_choice_percentage">Bobot Pilihan Ganda (%)</label>
			</div>
			<div class="input-field col s4">
				<input type="number" name="essay_percentage" id="essay_percentage" autocomplete="off" required="">
				<label for="#essay_percentage">Bobot Essai (%)</label>
			</div>
			<div class="col s12">
				<button type="submit" class="waves-effect waves-green btn green">Simpan</button>
				<a href="#!" class="modal-close waves-effect waves-white btn red">Batal</a>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>
<!-- End Modal Add quiz name -->


<!-- Start Second Row -->
<div class="row">

	<?php if ($this->session->flashdata()) { ?>
		<div class="col m12 s12">
			<div class="card">
				<div class="card-content">
					<?php
					if ($this->session->flashdata('success')) 
					{
						echo "<div class='center white-text card-content green lighten-1'>".$this->session->flashdata('success')."</div>";
					}else{
						echo "<div class='center white-text card-content red lighten-1'>".$this->session->flashdata('failed')."</div>";
					}?>
				</div>
			</div>
		</div>
	<?php };?>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<table class="table responsive-table" id="dataTables">
					<thead>
						<tr>
							<th>No.</th>
							<th>Guru</th>
							<th>Judul</th>
							<th>PG</th>
							<th>Essai</th>
							<th>Waktu</th>
							<th>Daftar Pertanyaan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach ($quiz as $row) { ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->name;?></td>
								<td><?php echo $row->title;?></td>
								<td><?php echo $this->quiz_model->count_mutiple_choice($row->ID);?></td>
								<td><?php echo $this->quiz_model->count_mutiple_essay($row->ID);?></td>
								<td><?php echo $row->time;?> menit</td>
								<th><a href="<?php echo site_url('admin/quiz/questions_list/'.encode($row->ID));?>" class="btn-small blue">Selengkapnya</a></th>
								<td>
									<a  href="<?=site_url('admin/quiz/update_quiz_name/').encode($row->ID);?>" class="btn-small green modal-trigger">Ubah</a>
									<a onclick="return confirm('Apakah mau mengarsipkan quiz ini beserta seluruh pertanyaannya?');" href="<?php echo site_url('admin/quiz/make_an_archive/'.encode($row->ID));?>" class="btn-small orange">Arsipkan</a>
									<a target="_blank" class="btn-small blue" href="<?=site_url('admin/quiz/export_question/'.encode($row->ID));?>">Eksport Soal</a>
								</td>
							</tr>
							<?php $no++; }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
	<!-- Start Second Row -->

