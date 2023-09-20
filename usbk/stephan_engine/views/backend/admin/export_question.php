<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=".$quiz_name->title.".xlsx");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");

?>

<table>
	<thead>
		<tr>
			<th>Pertanyaan</th>
			<th>Jenis (1=PD, 2=Essai)</th>
			<th>Jawaban A</th>
			<th>Jawaban B</th>
			<th>Jawaban C</th>
			<th>Jawaban D</th>
			<th>Jawaban E</th>
			<th>Kunci Jawaban</th>
			<th>Bobot Essai</th>
		</tr>
	</thead>
	<tbody>
		<?php $no =1; foreach ($quiz as $row) { ?>
			<tr>
				<td><?php echo stripslashes($row->question);?></td>
				<td><?php echo $row->quiz_type;?></td>
				<td><?php echo stripslashes($row->answer_1);?></td>
				<td><?php echo stripslashes($row->answer_2);?></td>
				<td><?php echo stripslashes($row->answer_3);?></td>
				<td><?php echo stripslashes($row->answer_4);?></td>
				<td><?php echo stripslashes($row->answer_5);?></td>
				<td><?php echo stripslashes($row->answer_key);?></td>
				<td><?php echo stripslashes($row->weight);?></td>
			</tr>
			<?php $no++; } ;?>
		</tbody>
	</table>
