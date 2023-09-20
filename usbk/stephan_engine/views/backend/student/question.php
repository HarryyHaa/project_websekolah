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
		margin-bottom: 0px;
	}

	label span {
		width: 100%;
		height: 100% !important;
	} 

	.header-quiz{
		background: url(<?=base_url('stephan_cbt/images/');?>header-bg.png) no-repeat;
		background-color: #336799;
		background-attachment: scroll;
		padding-top: 37px;
		height: 200px;
	}

	.nav-wrapper{
		padding-top: 15px;
		margin-left: 10px;
		margin-right: 10px;
	}

	.right-account{
		padding: 0px 40px 5px 100px;
		margin-top: -25px;
		margin-right: -35px;
		border-radius: 0px;
	}

	.quiz-form{
		margin-top: -90px;
	}

	.quiz-form > .card, .card-action{
		border-radius: 10px;
	}

	.card-shadow{
		box-shadow: 0 30px 60px -30px #336799;
		-webkit-box-shadow: 0 30px 60px -30px #336799;
	}

	.navigation .btn{
		border-radius: 17px;
		height: 40px;
		line-height: 40px;
		font-weight: bold;
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

	.collection .collection-item.avatar p{
		font-weight: bold;
		float: right;
		margin-right: 10px;
	}

	.btn-exit{
		height: 30px;
		color: #2d81c5;
		line-height: 30px;
		border-radius: 5px;
		text-transform: lowercase;
	}

	.card{
		padding-left: 10px;
		padding-right: 10px;
	}

	.card-action{
		padding-top: 30px !important;
	}

	
	#quiz_number{
		padding : 5px 10px 5px 10px;     
		background-color: #336799 !important; 
		font-weight: bold;
	}

	.countdown_time{
		float: right;
		margin-top: -20px;
		border: 1px solid #f44336;
		border-radius: 25px;
		line-height: 39px;
		width: 100%;
		text-align: center;
	}

	.quiz_list{
		float: right;
		margin-top: -20px;
		border: 1px solid #2196f3;
		border-radius: 25px;
		line-height: 39px;
		width: 100%;
		text-align: center;
		background-color: #2196f3;
		color: #fff;
	}

	.quiz_list i{
		float: right;
		margin-right: 60px;
		color: #fff;
		margin-left: -60px;
		margin-top: 7px;
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

	@media only screen and (max-width: 600px) {
		.quiz_header{
			margin-bottom: -50px;
		}

		.quiz_header .s12{
			margin-bottom: 35px;
		}

		.navigation .btn{
			width: 100%;
			margin-bottom: 10px;
		}
	}

</style>

<!-- Start Header -->
<header>

	<div class="navbar">
		<nav class="header-quiz" role="navigation">
			<div class="nav-wrapper">
				<a href="#" class="brand-logo"><img src="<?=base_url('stephan_cbt/images/logo-cbt.png');?>"></a>
				<div>
					
					<ul class="right hide-on-med-and-down right-account collection">
						<li class="collection-item avatar">
							<img style="float: right;" src="<?php echo base_url('');?>stephan_cbt/images/avatar.png">
							<p><?php echo $this->session->userdata('name');?><br>
								<a class="btn btn-exit white" onclick="return confirm('Apakah Anda yakin akan keluar dari aplikasi ini?');" href="<?php echo site_url('student/home/logout');?>">Logout</a>
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

	<div class="container1">
		
		<div class="col m12 s12 quiz-form">
			<div class="card card-shadow">
				<div class="card-action">
					<div class="row quiz_header">
						<div class="col m8 s12">
							<div class="row">
								<div class="col m4 s6">
									<b>SOAL NO. <span id="quiz_number" class="white-text"><?=$quiz->number;?></span></b>
								</div>

								<?php if (!is_mobile()) { ?>
									<div class="col m8 s6">
										<div class="progress" id="progress" style="display: none;">
											<div class="indeterminate">

											</div>
										</div>
									</div>
								<?php } ?>

							</div>

						</div>
						<div class="col m2 s12">
							<div class="countdown_time">
								<span style="padding : 5px 10px 5px 10px; margin-right:-5px;">SISA WAKTU:</span> <b><span style="padding : 5px 10px 5px 10px; font-weight: bold;" id="countdown"></span></b>
							</div>
						</div>
						<div class="col m2 s12">
							<a href="#quizNumber" class="modal-trigger">
								<span class="quiz_list">Daftar Soal <i class="material-icons">view_module</i></span></a>
							</div>
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


								<audio  autoplay="autoplay" id='audio_core' controls controlsList='nodownload'>



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

							<?php if (($quiz->answer_2) != '') { ?>
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
							<?php } ?>

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
									<div style="padding: 20px; border-radius: 3px;">
										<textarea id="answer" name="answer" class="materialize-textarea" placeholder="Masukan jawaban kamu disini" autofocus=""><?=$quiz->answer_essay;?><?=set_value('answer');?></textarea>
									</div>
									<span class="red-text"><?=form_error('answer');?></span>
								</div>
							</div>
						</div>

						<hr style="margin-top: 25px;
						margin-bottom: 25px;" />

						<?php if (is_mobile()) { ?>
							<div class="col m12 s12">
								<div class="progress" id="progress" style="display: none;">
									<div class="indeterminate">

									</div>
								</div>
							</div>
						<?php } ?>

						<div class="row navigation">
							<div class="col m4 s12">
								<button type="submit" id="prev" name="submit" value="prev" class="btn blue navigation-btn"> <i class="material-icons left">chevron_left</i> Soal Sebelumnya</button>
							</div>

							<div class="col m4 s12 center">
								<label class="btn orange">
									<input class=" navigation-btn" type="checkbox" 
									<?php if ($quiz->is_doubtful == 'on') {
										echo "checked=''";
									}?> 
									name="doubtful" id="doubtful" value="<?=($quiz->is_doubtful == NULL ? '0' : '1');?>"/>
									<span>Ragu-Ragu</span>
								</label>
							</div>

							<div class="col m4 s12" id="next_button">
								<button type="submit" id="next" name="submit" value="next" class="btn blue right next navigation-btn">Soal Selanjutnya <i class="material-icons right">chevron_right</i></button>
							</div>

							<div id="finish_button" style="display: none;">
								<div class="col m2 s12">
									<button type="submit" name="submit" value="next" class="btn blue right next navigation-btn">Selanjutnya <i class="material-icons right">chevron_right</i></button>
								</div>
								<div class="col m2 s12">
									<a  href="#stopQuiz" class="btn red  navigation-btn modal-trigger">Hentikan <i class="material-icons right">close</i></a>
								</div>
							</div>

						</div>
					</div>

				</div>

			</div>


		</div>

	</div>
	<!-- Start Second Row -->


	<!-- Start Moadal stop Quiz-->
	<div id="quizNumber" class="modal">
		<div class="modal-content ">
			<div style="box-sizing: border-box;">
				<?php ?>
				<?php foreach ($number_option as $row) {
					echo "<a class='number_option' data-id='".$row->number."'><span id='number_option_".$row->number."' class='badge ".(($row->answer != '' || $row->answer_essay != '') ? (($row->is_doubtful == NULL) ? 'green' : 'orange') : 'grey')." white-text' style='float:left;' >".$row->number."
					</a>";
					?>

				<?php }?>
			</div>
		</div>
	</div>

	<!-- Start Moadal stop Quiz-->
	<div id="stopQuiz" class="modal">
		<div class="modal-content ">
			<h5>PERINGATAN</h5>
			<!-- <?php echo form_open(site_url('student/quiz/forced_stop/'.$quiz->classroom_ID));?> -->
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
						<!-- <button type="submit" class="btn green">Hentikan</button> -->
						<a id="stop_button" disabled href="<?=site_url('student/quiz/forced_stop/'.$quiz->classroom_ID);?>" class="btn green">Hentikan</a>
						<a id="cancel_stop" class="modal-close waves-effect waves-white btn red">Batal</a>
					</div>
				</div>
			</div>
			<!-- <?php echo form_close();?> -->
		</div>
	</div>
	<!-- End Modal Moadal stop Quiz-->

	<script type="text/javascript">
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

</script>

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
					menit + ':' + detik
					);

				if (detik < 0) {
					detik = 59;
					menit--;
				}
				if (menit < 0 && jam == 0) {
					window.location = '<?=site_url('student/quiz/quiz_stop/'.$quiz->classroom_ID);?>';
				}

				// waktu tampil tombol selesaikan, ganti anga 29 dengan jumlah menit yang diinginkan dan ganti angka 0 dengan jam yang diinginkan
				if (menit < 120 && jam == 0) {
					$("#next_button").hide();
					$("#finish_button").show();
				}
			}
			hitung();
		});

		$("#stop").click(function(){
			var checkbox = $("#stop").val();
			if($(this).is(":checked")) {
				$("#stop_button").removeAttr('disabled');
			}else{
				$("#stop_button").attr('disabled', '');
			}
		})

		$("#cancel_stop").click(function(){
			$("#stop_button").attr('disabled', '');
			$('#stop').attr('checked', false);
		})
	</script>


	<script src="<?=base_url('stephan_cbt/js/aila_cbt.js');?>"></script>	


	<script type="text/javascript" async src="<?=base_url('stephan_cbt/vendor/tinymce');?>/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image"></script>

	<?php $this->load->view($directory.'footer') ;?>
