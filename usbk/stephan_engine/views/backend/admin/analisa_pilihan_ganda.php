<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// header('Content-Type: application/vnd.ms-word');
// header('Expires: 0');
// header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
// header("Content-Disposition: attachment; filename=Analisa.xls");
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('') ;?>stephan_cbt/css/materialize.min.css">

<style type="text/css">
	.card-content ul li{
		list-style: disc !important;
		margin-left: 20px;
	}

	.bold {
		font-weight: bold;
	}


</style>

<!-- Start Second Row -->
<div class="row">

	<div class="col m12 s12">
		<h5 class="center">Analisa Soal Pilihan ganda</h5>

		<table border="all">
			<tdead>
				<tr>
					<td rowspan="2">No</td>
					<td rowspan="2"><?=$this->config->item('student_code');?></td>
					<td rowspan="2">Nama</td>
					<td>Soal</td>
					<?php for ($i=1; $i <= $jumlah ; $i++) { 
						echo "<td>".$i."</td>";
					}
					?>
					<td>Jumlah Benar</td>
					<td>Nilai</td>
				</tr>
				<tr>
					<td>Kunci</td>
					<?php foreach ($answer_key as $row) {
						echo "<td class='center'>".$row->answer_key."</td>";
					}?>
				</tr>
			</tdead>
			<tbody>
				<?php 
				$no 	= 1 ;
				$benar 	= 0;
				
				foreach ($analisa as $key => $value): ?>
					<tr>
						<td class="center"><?php echo $no;?></td>
						<td><?php echo $code[$key];?></td>
						<td><?php echo $name[$key];?></td>
						<td></td>

						<?php foreach ($value as $row) { ?>
							<td class="<?=(($row->is_correct == 0) ? 'red-text' :'' );?> center"><?php echo $row->answer;?></td>
							<?php 
							if ($row->is_correct == 1) {
								$benar += 1;
							} 
						} ?>
						<td class="bold"><?=$benar;?></td>
						<td><?=count_score_multiple_choice($key, $classroom_ID, $jumlah);?></td>
					</tr>
					<?php $benar=0; $no++;?>
				<?php endforeach ?>

				<tr class="bold">
					<td colspan="4" class="center">JUMLAH BENAR</td>

					<?php for ($i2=0; $i2 < $jumlah ; $i2++) { ?>
						
						<?php $jml = 0;?>
						<?php foreach ($analisa as $key1 => $value1) { ?>
							<?php $jml += $value1[$i2]->is_correct ;?>
						<?php } ?>
						<td><?=$jml;?></td>

					<?php } ?>

				</tr>
			</tbody>
		</table>
	</div>

</div>
<!-- Start Second Row -->

