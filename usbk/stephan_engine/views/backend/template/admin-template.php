<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$directory = 'backend/template/_partial/';

$this->load->view($directory.'header');
$this->load->view($directory.'admin-navbar'); 
$this->load->view($directory.'admin-sidenav');

?>

<!-- Start Main Content -->
<main>

	<?php $this->load->view($content);?>

</main>
<!-- End Main Content -->

<?php $this->load->view($directory.'footer') ;?>