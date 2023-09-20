<html>
<head>
	<title>Lolipop | Cetak Kartu</title>
	<!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>stephan_cbt/global/plugins/jQuery/jQuery-2.1.4.min.js"></script>
</head>
<style>
	table {
		width: 100%;
		border: 0px;
		padding: 2px;
		font-size: 0.75em; 
		color: #000 !important; 
		font-family: Verdana, Arial, sans-serif; 
	}
	
	td {
		vertical-align: top;		
	}
	
	hr {
		border: 0.5px solid black;
	}

	.ukuran {
        font-size: 15px;
    }

     .ukuran2 {
        font-size: 12px;
    }
	
	.header {
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
	}
	
	.kartu {
		width: 310px;
		border: 2px solid black;
		border-radius: 8px;
		padding: 3px;
		margin: 10px;
		display: inline-block;
	}
</style>

<?php
	if (date('m') >= 7 and date('m') <= 12) {
		$ajaran = date('Y') . "/" . (date('Y') + 1); 
}  elseif (date('m') >= 1 and date('m') <= 6) {
	    $ajaran = (date('Y') - 1) . "/" . date('Y');
}
?>

<body>

<?php $code; foreach ($student_score as $row) {?>	
	<div class="kartu">
		<div class="header"><?=strip_tags($this->config->item('cbt_name')); ?><BR>
                      <?=strip_tags($this->config->item('card_test')); ?><BR>
                      TAHUN PELAJARAN <?= $ajaran ?>
        </div>    
		<hr/>
		<table>
			<tr>
				<td class="ukuran" valign="top">Kode</td>
				<td class="ukuran" valign="top">:</td>
				<td class="ukuran" valign="top"><?=$row->code;?></td>
			</tr>

			<tr>
				<td class="ukuran" valign="top">Password</td>
				<td class="ukuran" valign="top">:</td>
				<td class="ukuran" valign="top">12345678 (setelah login ganti password)</td>
			</tr>

			<tr>
				<td class="ukuran" valign="top">Nama</td>
				<td class="ukuran" valign="top">:</td>
				<td class="ukuran" valign="top"><?=$row->name;?></td>
		    </tr>

		   <!-- <tr>
                <td class="ukuran2" valign="top" align='right'>
                        Kepala Sekolah<br><br>
                        <br>
                        <b><?=strip_tags($this->config->item('head_master')); ?></b><br>
                        <b><?=strip_tags($this->config->item('nik_card')); ?></b>

                </td>
            </tr>-->

		</table>
	</div>
<?php  }?>
	
	<script lang="javascript">
		$(function(){
			window.print();
		});
	</script>
</body>
</html>