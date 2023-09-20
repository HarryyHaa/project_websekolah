<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Ubah Soal Ujian</h5>
				<p class="center">Disini Anda bisa merubah soal ujian berbentuk pilihan ganda dan juga essai, silahkan ubah sesuai dengan yang diinginkan.</p>
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
				<input type="hidden" name="ID" value="<?=$quiz->ID;?>">
				<div class="row">
					<div class="col m12 s12">
						<label id="textarea1">Pertanyaan</label>
					</div>
					<div class="input-field col m12 s12">
						<textarea id="textarea1" name="question" class="materialize-textarea wyswyg" ><?=set_value('question');?><?=set_host_server($quiz->question);?></textarea>
						<span class="red-text"><?=form_error('question');?></span>
					</div>
				</div>

				<div class="row">
					<div class="col m6 s6">
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
					<div class="col m6 s6">
						<?php 
						if (($quiz->audio != NULL) AND ($quiz->audio != '')) {
							if (file_exists('./stephan_cbt/audio/'.$quiz->quiz_name_ID.'/'.$quiz->audio)) {
								echo "<div class='row'> <div class='col m6 s6'>";
								echo "<label>File Audio saat ini</label><br/>";
								echo "<audio controls controlsList='nodownload'>";
								echo "<source src='../../../stephan_cbt/audio/".$quiz->quiz_name_ID."/".$quiz->audio."' type='audio/mpeg'>";
								echo "<source src='".base_url('stephan_cbt/audio/'.$quiz->quiz_name_ID."/".$quiz->audio)."' type='audio/mpeg'>";
								echo "</audio>";
								echo "</div>";
								echo "<div class='col m6 s6'>";
								echo "<br/><a onclick='return confirm(\"Apakah mau audio tersebut?\")' href='".site_url('admin/quiz/delete_audio/'.$quiz->audio.'/'.$ID)."' class='btn red'>Hapus Audio</a>";
								echo "</div></div>";
							}
						}?>
					</div>
				</div>
				
				<?php if ($quiz->quiz_type == '1') {?>
					
					<div class="row">
						<div class="col m12 s12">
							<label id="answer_1">Jabawan A</label>
						</div>
						<div class="input-field col m12 s12">
							<textarea id="answer_1" name="answer_1" class="materialize-textarea wyswyg" ><?=set_value('answer_1');?><?=set_host_server($quiz->answer_1);?></textarea>
							<span class="red-text"><?=form_error('answer_1');?></span>
						</div>

						<div class="input-field col m12 s12">
							<textarea id="answer_2" name="answer_2" class="materialize-textarea wyswyg" ><?=set_value('answer_2');?><?=set_host_server($quiz->answer_2);?></textarea>
							<div class="col m12 s12">
								<label id="answer_2">Jabawan B</label>
							</div>
							<span class="red-text"><?=form_error('answer_2');?></span>
						</div>
					</div>

					<div class="row">
						<div class="col m12 s12">
							<label id="answer_3">Jabawan C</label>
						</div>
						<div class="input-field col m12 s12">
							<textarea id="answer_3" name="answer_3" class="materialize-textarea wyswyg" ><?=set_value('answer_3');?><?=set_host_server($quiz->answer_3);?></textarea>
							<span class="red-text"><?=form_error('answer_3');?></span>
						</div>
						<div class="col m12 s12">
							<label id="answer_4">Jabawan D</label>
						</div>
						<div class="input-field col m12 s12">
							<textarea id="answer_4" name="answer_4" class="materialize-textarea wyswyg" ><?=set_value('answer_4');?><?=set_host_server($quiz->answer_4);?></textarea>

							<span class="red-text"><?=form_error('answer_4');?></span>
						</div>
						<div class="col m12 s12">
							<label id="answer_5">Jabawan E</label>
						</div>
						<div class="input-field col m12 s12">
							<textarea id="answer_5" name="answer_5" class="materialize-textarea wyswyg" ><?=set_value('answer_5');?><?=set_host_server($quiz->answer_5);?></textarea>

							<span class="red-text"><?=form_error('answer_5');?></span>
						</div>
					</div>

					<div class="row">
						<div class="col m2 s4">
							<p>Kunci Jawaban</p>
						</div>
						<div class="col m10 s8">
							<p>
								<label style="margin-right: 30px;">
									<input type="radio" name="answer_key" value="A" <?php if($quiz->answer_key=='A') echo "checked='checked'"?> required>
									<span>A</span>
								</label>

								<label  style="margin-right: 30px;">
									<input type="radio" name="answer_key" value="B" <?php if($quiz->answer_key=='B') echo "checked='checked'"?>>
									<span>B</span>
								</label>

								<label  style="margin-right: 30px;">
									<input type="radio" name="answer_key" value="C" <?php if($quiz->answer_key=='C') echo "checked='checked'"?>>
									<span>C</span>
								</label>

								<label  style="margin-right: 30px;">
									<input type="radio" name="answer_key" value="D" <?php if($quiz->answer_key=='D') echo "checked='checked'"?>>
									<span>D</span>
								</label>

								<label  style="margin-right: 30px;">
									<input type="radio" name="answer_key" value="E" <?php if($quiz->answer_key=='E') echo "checked='checked'"?>>
									<span>E</span>
								</label>
							</p>
							<span class="red-text"><?=form_error('answer_key');?></span>
						</div>
					</div>

				<?php }else{ ?>
					<div class="input-field col m12 s12">
						<input type="number" name="weight" id="weight" autocomplete="off" value="<?=$quiz->weight;?>">
						<label for="#weight">Bobot Essai</label>
					</div>
				<?php } ?>

				<div class="row">
					<div class="col m12 s12">
						<label id="explanation">Pembahasan</label>
					</div>
					<div class="input-field col m12 s12">
						<textarea id="explanation" name="explanation" class="materialize-textarea wyswyg" ><?=set_host_server($quiz->explanation);?></textarea>
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

