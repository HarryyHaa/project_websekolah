<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
textarea.materialize-textarea:disabled{
	color: rgb(27, 27, 27);
}
</style>
<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		
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
				<?php echo form_open();?>
				<input type="hidden" name="ID" value="<?=$quiz->ID;?>">
				<div class="row">
					<div class="col m12 s12 pading-button-30">
						<p><?=$quiz->question;?></p>
					</div>
				</div>

				<?php if ($quiz->quiz_type == '1') {?>

					<div class="row">
						<div class="col m12 s12 pading-button-30">
							<span>A. <?=remove_tag_p($quiz->answer_1);?></span>
						</div>
						<div class="col m12 s12 pading-button-30">
							<span>B. <?=remove_tag_p($quiz->answer_2);?></span>
						</div>
						<div class="col m12 s12 pading-button-30">
							<span>C. <?=remove_tag_p($quiz->answer_3);?></span>
						</div>

						<div class="col m12 s12 pading-button-30">
							<span>D. <?=remove_tag_p($quiz->answer_4);?></span>
						</div>
						<div class="col m12 s12 pading-button-30">
							<span>E. <?=remove_tag_p($quiz->answer_5);?></span>
						</div>
					</div>
					<br/>

					<div class="row">
						<div class="col m2 s4">
							<p>Kunci Jawaban</p>
						</div>
						<div class="col m10 s8">
							<p>
								<label style="margin-right: 30px;">
									<input type="radio" name="answer_key" value="A" <?php if($quiz->answer_key=='A') echo "checked='checked'"?> disabled="">
									<span>A</span>
								</label>

								<label  style="margin-right: 30px;">
									<input type="radio" name="answer_key" value="B" <?php if($quiz->answer_key=='B') echo "checked='checked'"?> disabled="">
									<span>B</span>
								</label>

								<label  style="margin-right: 30px;">
									<input type="radio" name="answer_key" value="C" <?php if($quiz->answer_key=='C') echo "checked='checked'"?> disabled="">
									<span>C</span>
								</label>

								<label  style="margin-right: 30px;">
									<input type="radio" name="answer_key" value="D" <?php if($quiz->answer_key=='D') echo "checked='checked'"?> disabled="">
									<span>D</span>
								</label>

								<label  style="margin-right: 30px;">
									<input type="radio" name="answer_key" value="E" <?php if($quiz->answer_key=='E') echo "checked='checked'"?> disabled="">
									<span>E</span>
								</label>
							</p>
							<span class="red-text"><?=form_error('answer_key');?></span>
						</div>
					</div>

				<?php }else{ ?>
					<div class="col m12 s12">
						<p>Bobot Essai = <?=$quiz->weight;?></p>
					</div>
				<?php } ?>
				
				<div class="row">
					<div class="col m12 s12">
						<hr/>
						<a href="javascript:history.back()" class="btn blue">Kembali</a>
					</div>
				</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

