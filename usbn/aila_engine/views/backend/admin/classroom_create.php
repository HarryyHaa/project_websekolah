<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Buat Kelas Ujian</h5>
				<p>Untuk membuat kelas ujian baru, silahkan: <br/>
					<ol>
						<li>Isi nama kelas</li>
						<li>Isi deskripsi (opsional)</li>
						<li>Pilih paket soal ujian yang sebelumnya telah dibuat</li>
						<li>Masukan jumlah soal pilihan ganda yang mau ditampilkan apabila hanya sebagian yang ingin ditampilkan, biarkan kosong jika ingin semua soal pilihan ganda ditampilkan</li>
						<li>Pilih apakah hasil pengerjaan akan ditampilkan di siswa ataukah tidak</li>
					</ol>
				</p>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->

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
				<?php echo form_open();?>
				<div class="row">
					<div class="input-field col m12 s12">
						<input type="text" name="name" id="name"  autocomplete="off" required="">
						<label for="#name">Nama Kelas</label>
						<span class="red-text"><?=form_error('question');?></span>
					</div>
				</div>

				<div class="row">
					<div class="input-field col m12 s12">
						<input type="text" name="description" id="description" autocomplete="off" required="" value="-">
						<label for="#description">Deskripsi Pendek</label>
						<span class="red-text"><?=form_error('question');?></span>
					</div>
				</div>

				<div class="row">
					<div class="input-field col m6 s12">
						<select required="" name="quiz_name_ID">
							<option value="" disabled selected>Pilih Paket Ujian</option>
							<?php foreach ($quiz_name as $row) {?>
								<option value="<?=$row->ID;?>"><?=$row->title;?></option>
							<?php }?>
							
						</select>
						<label>Pilih Paket Ujian</label>
					</div>

					<div class="input-field col m6 s12">
						<input type="number" name="limit" id="limit"  autocomplete="off">
						<label for="#limit">Jumlah Soal Pilihan Ganda yang Akan Ditampilkan</label>
						<span class="green-text"><i>*Biarkan kosong jika ingin semua soal pilihan ganda ditampilkan</i></span>
					</div>
				</div>

				<div class="row">
					<div class="input-field col m6 s12">
						<p>Tampilkan hasil di siswa ?  &nbsp; &nbsp; &nbsp;   
							<label>
								<input name="show_result" class="with-gap" name="group3" type="radio" value="1" />
								<span>Ya</span>
							</label>
							&nbsp; &nbsp; &nbsp; &nbsp; 
							<label>
								<input name="show_result" class="with-gap" name="group3" type="radio" value="0" checked />
								<span>Tidak</span>
							</label>
						</p>
					</div>

					<div class="input-field col m6 s12">
						<select  name="student_group">
							<option value="" disabled selected>Pilih Kelas / Jurusan</option>
							<option value="0">Tidak ada</option>
							<?php foreach ($student_groups as $row2) {?>
								<option value="<?=$row2->ID;?>"><?=$row2->name;?></option>
							<?php }?>
							
						</select>
						<label>Pilih Kelas / Jurusan (Opsional)</label>
						<span class="green-text"><i>*Biarkan kosong jika ingin membagikan kode kelas kepada siswa trtentu saja</i></span>
					</div>
				</div>

				<div class="row">
					<div class="input-field col m6 s12">
						<p>Acak Urutan Soal ?  &nbsp; &nbsp; &nbsp;   
							<label>
								<input name="random_number" class="with-gap" name="group3" type="radio" value="1" checked />
								<span>Ya</span>
							</label>
							&nbsp; &nbsp; &nbsp; &nbsp; 
							<label>
								<input name="random_number" class="with-gap" name="group3" type="radio" value="0" />
								<span>Tidak</span>
							</label>
						</p>
					</div>

				</div>
				
				<div class="row">
					<div class="col m12 s12">
						<button type="submit" class="btn blue">Simpan</button>
					</div>
				</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

