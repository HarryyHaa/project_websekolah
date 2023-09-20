<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Ubah Data Siswa</h5>
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
				<?php 
				echo form_open();
				echo form_hidden('ID', $student->ID);
				?>
				<div class="row">
					<div class="input-field col m12 s12">
						<input type="text" name="code" id="code"  autocomplete="off" required="" value="<?=$student->code;?>">
						<label for="#code">NIS</label>
						<span class="red-text"><?=form_error('code');?></span>
					</div>
				</div>

				<div class="row">
					<div class="input-field col m12 s12">
						<input type="text" name="name" id="name"  autocomplete="off" required="" value="<?=$student->name;?>">
						<label for="#name">Nama Siswa</label>
						<span class="red-text"><?=form_error('name');?></span>
					</div>
				</div>

				<div class="input-field col s12">
							<select name="group">
								<option value="" disabled selected>Pilih Jurusan</option>
								<?php foreach ($groups as $gr) {?>
									<option value="<?=$gr->ID;?>" <?=(($gr->ID == $student->group_ID) ? 'selected' : '');?>><?=$gr->name;?></option>
								<?php } ?>
							</select>
							<label>Pilih Jurusan</label>
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

