<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$directory = 'backend/template/_partial/';

$this->load->view($directory.'header');
$this->load->view($directory.'student-navbar'); 
$this->load->view($directory.'student-sidenav');

?>

<!-- Start Main Content -->
<main>

	<?php $this->load->view($content);?>

</main>
<!-- End Main Content -->

<!-- 
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


</script> -->

<?php $this->load->view($directory.'footer') ;?>