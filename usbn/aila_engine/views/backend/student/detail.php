<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<div class="center">
					<h3><?=$classroom->name;?></h3>
					<h6><?=$classroom->description;?></h6>
				</div>
				<br/>

				<?php if ($this->session->flashdata()) { ?>
					<?php
					if ($this->session->flashdata('success')) 
					{
						echo "<div class='center white-text card-content green lighten-1'>".$this->session->flashdata('success')."</div>";
					}else{
						echo "<div class='center white-text card-content red lighten-1'>".$this->session->flashdata('failed')."</div>";
					}?>
					
				<?php };?>

				<hr/>
				<p>Pada kelas ini terdapat sebuah paket soal yaitu <b><?=$quiz->title;?></b> dengan waktu pengerjaan selama <b><?=$quiz->time;?> menit</b>, paket soal ini 
					<?php 
					if ($classroom->working_status == 0) 
					{
						echo "belum bisa dikerjakan karena waktu pengerjaannya belum dimulai.</p>";
					}
					elseif($classroom->working_status == 1 && $student_working_status->status != 2)
					{
						echo "bisa dikerjakan sekarang dan akan berakhir ketika guru merubah statusnya menjadi selesai.";
						echo "<br/><br/>";
						echo "</p> <p class='center'><a href='".site_url('student/quiz/question/'.encode(encode($classroom->ID)."/1").'/'.$classroom->code)."' class='btn green'>Mulai kerjakan</a></p>";
					}elseif ($classroom->working_status == 2 ||  $student_working_status->status == 2) {

						if ($classroom->show_result == 1) {
							
							echo "sudah selesai masa pengerjaannya. Nilai kamu untuk paket soal ini adalah:<br/>  <p style='text-align:center'>
							<b style='font-size:50px;'><b>".number_format($score_total,2)."</b></b> dari 100</p>
							<p>Jumlah nilai Pilihan Ganda adalah <b>".$multiple_choice_score."</b> dan nilai essay adalah <b>".$essay_score."</b>. Persentasi nilai <b>".$quiz->multiple_choice_percentage."%</b> diambil dari Pilihan Ganda dan <b>".$quiz->essay_percentage."%</b> dari essai.</p>
							";
							echo "<br/> <p class='center'><a href='".site_url('student/classroom/review/'.$classroom->code)."' class='btn green'>Lihat Detail</a></p>";

						}else{
							echo "sudah selesai masa pengerjaannya.";

						}
						
					}
					?>
				</p>
			</div>
		</div>
	</div>

	<!-- <div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				
			</div>
		</div>
	</div> -->
</div>
<!-- End First Row -->