<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style type="text/css">
	.card-content ul li {
		list-style: disc !important;
		margin-left: 20px;
	}
</style>
<!-- Start First Row -->

<div class="row">
	<div class="col m12 s12">
		<nav class="white">
			<div class="nav-wrapper">
				<div class="col s12">
					<a href="<?= site_url('admin/home'); ?>" class="breadcrumb">Home</a>
					<a href="#!" class="breadcrumb"><?= $this->config->item('student'); ?></a>
				</div>
			</div>
		</nav>
	</div>
</div>

<?php if ($this->session->userdata('student_guide') == TRUE) { ?>
	<div class="row">
		<div class="col m12 s12">
			<div class="card">
				<div class="card-content">
					<h5 class="center">Panduan Manajemen print card euy<?= $this->config->item('student'); ?> </h5>
					<ul>
						<li>Disini admin bisa print card siswa</li>
						<li>Untuk menambah akun <?= $this->config->item('student'); ?> baru, cukup dengan memasukan <?= $this->config->item('student_code'); ?> dan nama lengkap, karena passwordnya akan otomatis di genret menjadi <b>12345678</b>.</li>
						<li>Untuk menambahkan <?= $this->config->item('student'); ?> secara masal, bisa dengan menggunakan fitur import <?= $this->config->item('student'); ?>.</li>
						<li><?= $this->config->item('student'); ?> bisa masuk ke aplikasi ini menggunakan <?= $this->config->item('student_code'); ?> dan password default (12345678), begitu <?= $this->config->item('student'); ?> masuk pertama kali maka <?= $this->config->item('student'); ?> diwajibkan untuk mlengkapi profil dan juga merubah passwordnya.</li>
					</ul>
					<p class="center">(<a href="<?php echo site_url('admin/student/student_guide_hide'); ?>">Klik disini untuk menutup panduan</a>)</p>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">

				<?php if ($this->session->flashdata()) { ?>
					<div id="flashSuccess" data-success="<?= $this->session->flashdata('success'); ?>"> </div>
					<div id="flashFailed" data-failed="<?= $this->session->flashdata('failed'); ?>"> </div>
				<?php }; ?>

				<?php
				if (isset($group_name)) {
					echo "<h4 class='center'>Jurusan " . $group_name . "</h4><hr/>";
				}
				?>
				<h5>Cetak Kartu <?= $this->config->item('student'); ?>
					<a href="#filter_group" class="btn-small green modal-trigger">Filter Siswa <i class="material-icons right" title="Filter Jurusan">filter_list</i></a>

					<!--<a href="javascript:window.open('<?=site_url('admin/student_card/print_card_student/'.strtoupper($student->id));?>','mywindowtitle','width=700,height=700')" class="btn-small green" title="Print">Print <i class="material-icons right">local_printshop</i></a> -->

					<?php if ($this->session->userdata('student_guide') == FALSE) { ?>
						<a href="<?php echo site_url('admin/student/student_guide_show'); ?>" class="right"><small style="font-size: 15px;">(Tampilkan panduan)</small></a>
					<?php } ?>
				</h5>

				<table class=" responsive-table" id="studentTable">
					<thead>
						<tr>
							<th>No.</th>
							<th><?= $this->config->item('student_code'); ?></th>
							<th>Nama</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>

</div>
<!-- Start Second Row -->

<!-- Start Filter Group -->
<div id="filter_group" class="modal">
	<div class="modal-content">
		<?php foreach ($groups as $group) { ?>
			<a href="<?= site_url('admin/student_card/index/' . $group->ID); ?>">
				<div class="card">
					<div class="card-content center">
						<?= strtoupper($group->name); ?>

						<a href="javascript:window.open('<?=site_url('admin/student_card/print_card_student/'.strtoupper($group->ID));?>','mywindowtitle','width=700,height=700')" class="btn-small green" title="Print">Print <i class="material-icons right">local_printshop</i></a>

					</div>
				</div>
			</a>
		<?php } ?>
	</div>
</div>
<!-- End Modal Filter Group -->

