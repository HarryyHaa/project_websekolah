<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html translate="no">
<head>
	<meta name="theme-color" content="#2196F3">
	<meta name="google" content="notranslate">
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<!-- Custom -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('') ;?>aila_cbt/css/style.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('') ;?>aila_cbt/css/materialize.min.css">

	<!-- Datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('') ;?>aila_cbt/css/dataTables.material.min.css">

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('aila_cbt/images/logo.png') ?>" />

	<?php if ($this->uri->segment(1) != 'student') { ?>
		
		<script src="<?=base_url('aila_cbt/vendor/tinymce');?>/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image"></script>
		<script src="<?=base_url('aila_cbt/vendor/tinymce');?>/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector: ".wyswyg",
				plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"advlist autolink lists link image charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars code fullscreen",
				"insertdatetime nonbreaking save table contextmenu directionality",
				"emoticons template paste textcolor colorpicker textpattern",
				"tiny_mce_wiris"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager | tiny_mce_wiris_formulaEditor",
				automatic_uploads: true,
				image_advtab: true,
				images_upload_url: "<?php 
				if (($this->uri->segment(1)) == 'admin') {
					echo site_url("admin/quiz/tinymce_upload");
				}else{
					echo site_url("teacher/quiz/tinymce_upload");
				}
				?>",
				file_picker_types: 'image', 
				paste_data_images:true,
				relative_urls: false,
				images_reuse_filename: true,
				remove_script_host: false,
				file_picker_callback: function(cb, value, meta) {
					var input = document.createElement('input');
					input.setAttribute('type', 'file');
					input.setAttribute('accept', 'image/*');
					input.onchange = function() {
						var file = this.files[0];
						var reader = new FileReader();
						reader.readAsDataURL(file);
						reader.onload = function () {
							var id = 'image-' + (new Date()).getTime();
							var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
							var blobInfo = blobCache.create(id, file, reader.result);
							blobCache.add(blobInfo);
							cb(blobInfo.blobUri(), { title: file.name });
						};
					};
					input.click();
				}
			});
		</script>

	<?php } ?>

	<title>Halaman 
		<?php 
		switch ($this->uri->segment(1)) {
			case 'admin':
			echo "Admin";
			break;

			case 'teacher':
			echo "Guru";
			break;

			case 'student':
			echo "Siswa";
			break;
			
			default:
			echo "";
			break;
		}
		?> - <?=strip_tags($this->config->item('cbt_name'));?> | Stephan CBT </title>

		<style type="text/css">

			main,
			footer {
				padding-left: 260px;
				padding-top: 23px;
				padding-right: 15px;
			}	

			.nav-wrapper{
				margin-left: 35px;
				margin-right: 35px;
			}

			.sidenav{
				top: 65px;
				width: 250px;
			}

			.collapsible-body a{
				margin-left: 21px;
			}

			.collapsible-body i{
				font-size: 20px;
			}

			.avatar{
				margin-bottom: 0px;
				padding-top: 20px;
				padding-bottom: 5px;
			}

			.sidenav-footer {
				margin-bottom: 0px;
				padding: 0;
			}
			.sidenav-footer .row {
				margin-bottom: 0;
			}
			.sidenav-footer .row .social-icons a {
				opacity: 0.5;
				padding: 0;
				text-align: center;
			}
			.sidenav-footer .row .social-icons a:hover {
				background-color: inherit;
				opacity: 1;
			}

			.breadcrumb{
				color: rgb(117, 117, 117);
			}

			.breadcrumb:before{
				color: rgb(117, 117, 117) ;
			}

			.breadcrumb:last-child{
				color: rgb(117, 117, 117);
			}

			/* Menu dashborad*/
			.gradient-45deg-light-blue-cyan{
				background: -webkit-linear-gradient(45deg,#0288d1,#26c6da)!important;
				background: linear-gradient(45deg,#0288d1,#26c6da)!important;
			}

			.gradient-45deg-red-pink{
				background: -webkit-linear-gradient(45deg,#ff5252,#f48fb1)!important;
				background: linear-gradient(45deg,#ff5252,#f48fb1)!important;
			}

			.gradient-45deg-amber-amber{
				background: -webkit-linear-gradient(45deg,#ff6f00,#ffca28)!important;
				background: linear-gradient(45deg,#ff6f00,#ffca28)!important;
			}

			.gradient-45deg-green-teal {
				background: -webkit-linear-gradient(45deg,#43a047,#1de9b6)!important;
				background: linear-gradient(45deg,#43a047,#1de9b6)!important;
			}

			.gradient-45deg-purple-deep-orange {
				background: -webkit-linear-gradient(45deg,#8e24aa,#ff6e40)!important;
				background: linear-gradient(45deg,#8e24aa,#ff6e40)!important;
			}

			.dropdown-sidenav{
				margin-left: 17px;
			}

			/*Datatables*/
			.dataTables_length{
				display: none;
			}

			.dataTables_filter label{
				font-size: 16px;
				color: #1b1b1b;
			}

			div.dataTables_wrapper div.dataTables_filter{
				text-align: center;
			}
			/*End Datatables*/
			/* Setting for mobile */
			@media only screen and (max-width: 720px) {
				main {
					padding-left: 0;
				}

				.sidenav{
					top: 0px;
				}
			}

		</style>

	</head>

	<body class="grey lighten-2">