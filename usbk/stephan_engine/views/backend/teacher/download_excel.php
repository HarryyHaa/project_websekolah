
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Content-Type: application/vnd.ms-word');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header("Content-Disposition: attachment; filename=Nilai Siswa ".$classroom->name.".xls");
?>
<div class="row">
		<table>
			<tr>
				<td>Nama Kelas</td>
				<td>: <?=$classroom->name;?></td>
			</tr>
			<tr>
				<td>Deskripsi</td>
				<td>: <?=$classroom->description;?></td>
			</tr>
			<tr>
				<td>Nama Paket Soal</td>
				<td>: <?=$classroom->name;?></td>
			</tr>
			<tr>
				<td>Nama Kelas</td>
				<td>: <?=$classroom->title;?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
		</table>

		<table>
			<thead>
				<tr>
					<th>No.</th>
					<th><?=$this->config->item('student_code');?></th>
					<th>Nama Lengkap</th>
					<th>Perolehan PG</th>
					<th>Nilai PG</th>
					<th>Nilai Essai</th>
					<th>Nilai Total</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; foreach ($nilai_siswa as $row) {?>
					<tr>
						<td style="text-align: center;"><?=$no;?></td>
						<td><?=$row->code;?></td>
						<td><?=$row->name;?></td>
						<td class="text-center"><?=count_correct_multiple_choice($row->ID, $classroom->ID).' / '. $quiz_total;?></td>
						<td style="text-align: center;"><?=count_score_multiple_choice($row->ID, $classroom->ID, $quiz_total);?></td>
						<td><?=count_score_essay($row->ID, $classroom->ID, $classroom->quiz_name_ID);?></td>
						<td><?=count_score_total($row->ID, $classroom->ID, $classroom->quiz_name_ID, $quiz_name->multiple_choice_percentage, $quiz_name->essay_percentage);?></td>
					</tr>
					<?php $no++; }?>
				</tbody>
			</table>
		</div>
