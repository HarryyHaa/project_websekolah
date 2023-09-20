<?php 
$directory = 'backend/template/_partial/';

$this->load->view($directory.'header');

?>
<script type="text/javascript">
	var baseUrl = "<?=base_url();?>"
</script>

<style type="text/css">

	nav{
		box-shadow: none;
	}

	textarea.materialize-textarea{height: 6rem;}

	.question_choice{
		margin-bottom: 10px;
	}

	label span {
		width: 100%;
		height: 100% !important;
	} 

	.header-quiz{
		background-color: #336799;
		border-bottom: 4px solid #adadad;
		height: 90px;
	}

	.nav-wrapper{
		padding-top: 15px;
	}

	.right-account{
		background-color: rgb(51, 51, 51);
		padding: 0px 40px 5px 100px;
		margin-top: -25px;
		margin-right: -35px;
		border-radius: 0px;
	}

	.collection .collection-item.avatar{
		margin-top: 5px;
	}

	.collection{
		border: none;
	}

	.collection .collection-item{
		background-color: transparent;
	}

	.collection .collection-item .circle{
		width: 60px !important;
		height: 60px !important;
		border-radius: 0% !important;
		margin-top: 9px;
		line-height: 1rem !important;
	}

	.collection .collection-item.avatar .title
	{
		font-size: 14px;
		margin-left: 15px !important;
		margin-top: 3px;
	}	

	.collection .collection-item.avatar p{
		margin-left: 15px !important;
		font-weight: bold;
	}

	.collection .collection-item.avatar a{
		margin-left: -15px !important;
		font-weight: 400;
	}

	[type="radio"]+span:before, [type="radio"]+span:after{
		width: 23px;
		height: 23px;
	}

	[type="radio"]:not(:checked)+span:before, [type="radio"]:not(:checked)+span:after{
		border: 2px solid #9e9e9e;
	}

	<?php if ($quiz->quiz_type == '1') {?>
		.question_choice{
			display: block;
		}
		#answer_essay{
			display: none;
		}
	<?php }else{ ?>
		.question_choice{
			display: none;
		}
		#answer_essay{
			display: block;
		}
	<?php }?>

	<?php if (($quiz->audio != NULL) AND ($quiz->audio != '')) { ?>
		#audio{
			display: block;
		}
	<?php }else{ ?>
		#audio{
			display: none;
		}
	<?php } ?>

</style>

<!-- Start Header -->
<header>

	<div class="navbar">
		<nav class="header-quiz" role="navigation">
			<div class="nav-wrapper">
				<!-- <a href="#" data-target="slide-out" class="sidenav-trigger" style="display: block;"> <i class="material-icons">menu</i> </a> -->
				<a href="#" class="brand-logo"><?=strtoupper($this->config->item('student'));?></a>
				<div>
					
					<ul class="right hide-on-med-and-down right-account collection">
						<li class="collection-item avatar">
							<img class="circle" src="<?php echo base_url('');?>stephan_cbt/images/avatar.png">
							<span class="title">Selamat datang</span>
							<p><?php echo $this->session->userdata('name');?><br>
								<a onclick="return confirm('Apakah Anda yakin akan keluar dari aplikasi ini?');" href="<?php echo site_url('student/home/logout');?>">Logout</a>
							</p>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>

	<!-- Start Sidenav -->
	<ul class="sidenav" id="slide-out">
		<li><a class="waces-effect" href="<?php echo site_url('student/home');?>">Beranda <i class="material-icons left">home</i> </a></li>
		<li><a class="waces-effect" href="<?php echo site_url('student/home/profile');?>">Profil <i class="material-icons left">person</i> </a></li>
		<li><a class="waces-effect" href="<?php echo site_url('student/classroom');?>">Daftar Kelas Ujian	 <i class="material-icons left">folder_open</i> </a></li>
		<li><a class="waces-effect" href="<?php echo site_url('student/home/logout');?>">Sign Out <i class="material-icons left">exit_to_app</i> </a></li>
	</ul>
	<!-- End Sidenav -->
</header>
<!-- End Header -->

<noscript>
	<meta http-equiv="refresh" content="0; url=<?=site_url('student/classroom');?>" />
</noscript>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
	textarea.materialize-textarea:disabled{
		color: rgb(27, 27, 27);
	}

	span.badge {
		min-width: 0px !important;
		margin-bottom: 10px;
		float: left;
		width: 40px;
		height: 40px;
		padding: 13px;
		font-size: 15px;
	}

	body{
		background: grey;
	}
</style>

<br/>

<!-- Start Second Row -->
<div class="row">

	<?php if ($this->session->flashdata()) { ?>
		<div id="flashSuccess" data-success="<?=$this->session->flashdata('success');?>"> </div>
		<div id="flashFailed" data-failed="<?=$this->session->flashdata('failed');?>"> </div>
	<?php };?>

	<div class="col m9 s12">
		<div class="card">
			<!-- <?php echo form_open('student/quiz/save_answer');?> -->
			<div class="card-action" style="border-bottom: 2px solid rgb(189, 189, 189);">
				<div>
					<b>SOAL NO. <span id="quiz_number" class="white-text" style="padding : 5px 10px 5px 10px;     background-color: #336799 !important; font-weight: bold;"><?=$quiz->number;?></span></b>
				</div>
				<div style="float: right; margin-top: -20px;">
					<!-- <b><span id="timer"></span></b> -->
					<b><span class="grey lighten-1 white-text" style="padding : 5px 10px 5px 10px; margin-right:-5px;">SISA WAKTU</span> <span class="white-text darken-3" style="padding : 5px 10px 5px 10px; background-color: #336799 !important; font-weight: bold;" id="countdown"></span></b>
				</div>
			</div>
			
			<div class="card-content">
				<div class="border-quiz" style="border: 2px solid #bdbdbd;
				padding: 20px;
				border-radius: 3px;">

				<input type="hidden" name="ID" id="ID" value="<?=encode($quiz->ID);?>">
				<input type="hidden" name="classroom_ID" id="classroom_ID" value="<?=encode($quiz->classroom_ID);?>">
				<input type="hidden" name="quiz_type" id="quiz_type" value="<?=encode($quiz->quiz_type);?>">

				<div class="row">
					<div class="col m12 s12" id="question">
						<p><?=set_host_server($quiz->question);?></p>
					</div>
					<div class="col m12 s12" id="audio">
						
						<audio id='audio_core' controls controlsList='nodownload'>
							<source src="<?=base_url('stephan_cbt/audio/'.$quiz->quiz_name_ID.'/'.$quiz->audio);?>" type="audio/mpeg">
							</audio>
						</div>
					</div>



					<hr style="border: 1px solid #bdbdbd; margin-bottom: 20px;}" />

					<div class="row question_choice">
						<div class="col m12 s12">
							<label  style="margin-right: 30px;     color: #1b1b1b;">
								<input type="radio" id="selectedA" name="answer" value="A" <?php if($quiz->answer=='A') echo "checked='checked'"?> required>
								<span>
									<div class="row">

										<div class="col m11 s11" id="answer1">
											<?=remove_tag_p(set_host_server($quiz->answer_1));?>
										</div>
									</div>
								</span>
							</label>
						</div>
					</div>
					<div class="row question_choice">
						<div class="col m12 s12">
							<label  style="margin-right: 30px;     color: #1b1b1b;">
								<input type="radio" id="selectedB" name="answer" value="B" <?php if($quiz->answer=='B') echo "checked='checked'"?>>
								<span>
									<div class="row">

										<div class="col m11 s11"  id="answer2">
											<?=remove_tag_p(set_host_server($quiz->answer_2));?>
										</div>
									</div>
								</span>
							</label>
						</div>
					</div>

					<?php if (($quiz->answer_3) != '') { ?>
						<div class="row question_choice">
							<div class="col m12 s12">
								<label  style="margin-right: 30px;     color: #1b1b1b;">
									<input type="radio" id="selectedC" name="answer" value="C" <?php if($quiz->answer=='C') echo "checked='checked'"?>>
									<span>
										<div class="row">

											<div class="col m11 s11"  id="answer3">
												<?=remove_tag_p(set_host_server($quiz->answer_3));?>
											</div>
										</div>
									</span>
								</label>
							</div>
						</div>
					<?php } ?>

					<?php if (($quiz->answer_4) != '') { ?>
						<div class="row question_choice">
							<div class="col m12 s12">
								<label  style="margin-right: 30px;     color: #1b1b1b;">
									<input type="radio" id="selectedD" name="answer" value="D" <?php if($quiz->answer=='D') echo "checked='checked'"?>>
									<span>
										<div class="row">

											<div class="col m11 s11"  id="answer4">
												<?=remove_tag_p(set_host_server($quiz->answer_4));?>
											</div>
										</div>
									</span>
								</label>
							</div>
						</div>
					<?php } ?>

					<?php if (($quiz->answer_5) != '') { ?>
						<div class="row question_choice">
							<div class="col m12 s12">
								<label  style="margin-right: 30px;     color: #1b1b1b;">
									<input type="radio" id="selectedE" name="answer" value="E" <?php if($quiz->answer=='E') echo "checked='checked'"?>>
									<span>
										<div class="row">

											<div class="col m11 s11"  id="answer5">
												<?=remove_tag_p(set_host_server($quiz->answer_5));?>
											</div>
										</div>
									</span>
								</label>
							</div>
						</div>
					<?php } ?>

					<div class="row" id="answer_essay">
						<div class="input-field col m12 s12">
							<div style="border: 2px solid #bdbdbd; padding: 20px; border-radius: 3px;">
								<textarea id="answer" name="answer" class="materialize-textarea" placeholder="Masukan jawaban kamu disini" autofocus=""><?=$quiz->answer_essay;?><?=set_value('answer');?></textarea>
							</div>
							<span class="red-text"><?=form_error('answer');?></span>
						</div>
					</div>
				</div>
			</div>

		</div>




		<div class="card-action">
			<div class="row">
				<div class="col m4">
					<button type="submit" id="prev" name="submit" value="prev" class="btn blue "> <i class="material-icons left">chevron_left</i> Soal Sebelumnya</button>
				</div>

				<div class="col m4 center">
					<label class="btn orange">
						<input type="checkbox" 
						<?php if ($quiz->is_doubtful == 'on') {
							echo "checked=''";
						}?> 
						name="doubtful" id="doubtful" value="<?=($quiz->is_doubtful == NULL ? '0' : '1');?>"/>
						<span>Ragu-Ragu</span>
					</label>
				</div>

				<div class="col m4">
					<button type="submit" id="next" name="submit" value="next" class="btn blue right">Soal Selanjutnya <i class="material-icons right">chevron_right</i></button>
				</div>
			</div>
		</div>
		<!-- <?php echo form_close();?> -->
	</div>

	<div class="col m3 s12">
		<div class="card">
			<div class="card-action" style="border-bottom: 2px solid rgb(189, 189, 189);">
				<b>NOMOR SOAL</b>
			</div>
			<div class="card-content" style="    padding-bottom: 100%;">
				<div style="box-sizing: border-box;">
					<?php ?>
					<?php foreach ($number_option as $row) {
						echo "<a class='number_option' data-id='".$row->number."' href='#'><span id='number_option_".$row->number."' class='badge ".(($row->answer != '' || $row->answer_essay != '') ? (($row->is_doubtful == NULL) ? 'green' : 'orange') : 'grey')." white-text' style='float:left;' >".$row->number."
						</a>";
						?>

					<?php }?>
				</div>
				<br/>
			</div>
			<div class="card-action" style="position: initial;">
				<span class="badge badge-small green white-text" style="float: none;">Hijau</span> = Sudah dijawab <br/>
				<span class="badge badge-small orange white-text" style="float: none;">Orange</span> = Ragu-ragu <br/>
				<span class="badge badge-small grey white-text" style="float: none;">Abu-abu</span> = Belum dijawab
			</div>
		</div>

		<div class="card">
			<div class="card-action center">
				<a href="#stopQuiz" class="btn red modal-trigger">Hentikan Ujian</a>
			</div>
		</div>

	</div>

</div>
<!-- Start Second Row -->



<!-- Start Moadal stop Quiz-->
<div id="stopQuiz" class="modal">
	<div class="modal-content ">
		<h5>PERINGATAN</h5>
		<?php echo form_open(site_url('student/quiz/forced_stop/'.$quiz->classroom_ID));?>
		<div class="row">
			<div class="col s12">
				<p>Setelah waku ujian dihentikan, Anda tidak akan bisa lagi mengerjakan soal ini dan nilai dari soal pilihan ganda  Anda akan langsung ditampilkan.</p>
				<p>
					<label style="width: 100px;">
						<input type="checkbox" name="stop" id="stop" required="" />
						<span for="stop">Saya yakin ingin menghentikan pengerjaan soal ini.</span>
					</label>
				</p>
				<div class="">
					<button type="submit" class="btn green">Hentikan</button>
					<a href="#!" class="modal-close waves-effect waves-white btn red">Batal</a>
				</div>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>
<!-- End Modal Moadal stop Quiz-->

<!-- <script type="text/javascript">
	document.onkeydown = function(e) {
		if(event.keyCode == 123) {
			return false;
		}
		if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
			return false;
		}
		if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
			return false;
		}
		if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
			return false;
		}
		if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
			return false;
		}
	}

	document.addEventListener('contextmenu', function(e) {
		e.preventDefault();
	});


</script> -->

<script src = "<?=base_url('stephan_cbt/js/');?>jquery-1.10.2.min.js"
	type = "text/javascript" > </script>

	<script type = "text/javascript" >
		$(document).ready(function() {

			var detik = <?=$detik;?>;
			var menit = <?=$remaining_time?>;
			var jam = 0;

			function hitung() {

				setTimeout(hitung, 1000);

				detik--;

				$('#countdown').html(
					jam + ':' + menit + ':' + detik
					);

				if (detik < 0) {
					detik = 59;
					menit--;
				}
				if (menit < 0 && jam == 0) {
					window.location = '<?=base_url('student/quiz/quiz_stop/'.$quiz->classroom_ID);?>';
				}
			}
			hitung();
		});
	</script>

<script src="<?=base_url('stephan_cbt/js/aila_cbt.js');?>"></script>	


<?php $this->load->view($directory.'footer') ;?>