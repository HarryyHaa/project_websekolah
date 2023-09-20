<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Buat Soal Ujian</h5>
				<p>* Disini Anda bisa membuat soal ujian berbentuk pilihan ganda dan essai.</p>
				<p>* Untuk membuat soal pilihan ganda, silahkan masukan soal / pertanyaan, pilihan jawaban beserta kunji jawabannya.</p>
				<p>* Sedangkan untuk membuat soal essai, silahkan masukan soal / pertanyaan dan isi bagian bobot soal essai, sedangkan bagian pilihan A, B, C, D dan E nya wajib dikosongkan. </p>
				<p>* Bobot Essai diisi hanya ketika soal berbentuk essai. </p>
				<p>* Pembahasan boleh diisi dan boleh juga dikosongkan</p>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">

	<?php if ($this->session->flashdata()) { ?>
		<div id="flashSuccess" data-success="<?=$this->session->flashdata('success');?>"> </div>
		<div id="flashFailed" data-failed="<?=$this->session->flashdata('failed');?>"> </div>
	<?php };?>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<?php echo form_open_multipart();?>
				<div class="row">
					<div class="col m12 s12">
						<label id="textarea1">Pertanyaan</label>
					</div>
					<div class="input-field col m12 s12">
						<textarea id="textarea1" name="question" class="materialize-textarea wyswyg" ><?=set_value('question');?></textarea>
						<span class="red-text"><?=form_error('question');?></span>
					</div>
				</div>

				<div class="row">
					<div class="col m12 s12">
						<label id="textarea1">File Audio (Hanya diisi ketika merupakan soal listening)</label>
					</div>
					<div class="input-field col s12">
						<div class="file-field input-field">
							<div class="btn">
								<span>File Audio</span>
								<input type="file" name="audio_file" class="green">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path validate" type="text" placeholder="Pilih file audio dari komputer anda">
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col m12 s12">
						<label id="answer_1">Jabawan A</label>
					</div>
					<div class="input-field col m12 s12">
						<textarea id="answer_1" name="answer_1" class="materialize-textarea wyswyg" ><?=set_value('answer_1');?></textarea>
						<span class="red-text"><?=form_error('answer_1');?></span>
					</div>
					
					<div class="col m12 s12">
						<label id="answer_2">Jabawan B</label>
					</div>
					<div class="input-field col m12 s12">
						<textarea id="answer_2" name="answer_2" class="materialize-textarea wyswyg" ><?=set_value('answer_2');?></textarea>
						
						<span class="red-text"><?=form_error('answer_2');?></span>
					</div>
				</div>
				<div class="row">
					<div class="col m12 s12">
						<label id="answer_3">Jabawan C</label>
					</div>
					<div class="input-field col m12 s12">
						<textarea id="answer_3" name="answer_3" class="materialize-textarea wyswyg" ><?=set_value('answer_3');?></textarea>
						<span class="red-text"><?=form_error('answer_3');?></span>
					</div>
					<div class="col m12 s12">
						<label id="answer_4">Jabawan D</label>
					</div>
					<div class="input-field col m12 s12">
						<textarea id="answer_4" name="answer_4" class="materialize-textarea wyswyg" ><?=set_value('answer_4');?></textarea>
						
						<span class="red-text"><?=form_error('answer_4');?></span>
					</div>

					<div class="col m12 s12">
						<label id="answer_5">Jabawan E</label>
					</div>
					<div class="input-field col m12 s12">
						<textarea id="answer_5" name="answer_5" class="materialize-textarea wyswyg" ><?=set_value('answer_5');?></textarea>
						
						<span class="red-text"><?=form_error('answer_5');?></span>
					</div>
					<div class="input-field col m12 s12">
						<input type="number" name="weight" id="weight" autocomplete="off" >
						<label for="#weight">Bobot Essai</label>
					</div>
				</div>
				<div class="row">
					<div class="col m2 s4">
						<p>Kunci Jawaban</p>
					</div>
					<div class="col m10 s8">
						<p>
							<label style="margin-right: 30px;">
								<input type="radio" name="answer_key" value="A">
								<span>A</span>
							</label>

							<label  style="margin-right: 30px;">
								<input type="radio" name="answer_key" value="B">
								<span>B</span>
							</label>

							<label  style="margin-right: 30px;">
								<input type="radio" name="answer_key" value="C">
								<span>C</span>
							</label>

							<label  style="margin-right: 30px;">
								<input type="radio" name="answer_key" value="D">
								<span>D</span>
							</label>
							<label  style="margin-right: 30px;">
								<input type="radio" name="answer_key" value="E">
								<span>E</span>
							</label>
						</p>
						<span class="red-text"><?=form_error('answer_key');?></span>
					</div>
				</div>

				<div class="row">
					<div class="col m12 s12">
						<label id="explanation">Pembahasan</label>
					</div>
					<div class="input-field col m12 s12">
						<textarea id="explanation" name="explanation" class="materialize-textarea wyswyg" ><?=set_value('explanation');?></textarea>
						<span class="red-text"><?=form_error('explanation');?></span>
					</div>
				</div>

				<div class="row">
					<div class="col m12 s12">
						<hr/>
						<button type="submit" class="btn blue right">Simpan</button>
					</div>
				</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

