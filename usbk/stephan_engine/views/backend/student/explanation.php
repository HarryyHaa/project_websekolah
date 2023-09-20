<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Pembahasan Soal</h5>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->

<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<table>
					<tr>
						<td width="150">Soal</td>
						<td width="20">:</td>
						<td><?=set_host_server($explanation->question);?></td>
					</tr>
					<tr>
						<td>Jawaban Benar</td>
						<td>:</td>
						<td><?=set_host_server($explanation->answer_key);?></td>
					</tr>
					<tr>
						<td>Pembahasan</td>
						<td>:</td>
						<td><?=set_host_server($explanation->explanation);?></td>
					</tr>
				</table>
			</div>
			<div class="card-action">
				<a href="javascript:history.back()" class="btn blue">Kembali</a>
			</div>
		</div>
	</div>
</div>