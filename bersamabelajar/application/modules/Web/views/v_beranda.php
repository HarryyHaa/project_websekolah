 <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container d-flex h-100">
      <div class="row justify-content-center align-self-center">
        <div class="col-md-6 intro-info order-md-first order-last">
          <h2>Selamat Datang<br><span>Peserta Didik</span></h2>
          <div>
            <a href="<?= base_url('Login')?>" class="btn-get-started scrollto">Silakan Login</a>
          </div>
        </div>
  
        <div class="col-md-6 intro-img order-md-last order-first">
          <img src="assets/img/intro-img.svg" alt="" class="img-fluid">
        </div>
      </div>

    </div>
  </section><!-- #intro -->

  <main id="main">
    <!--==========================
      Why Us Section
    ============================-->
    <section id="why-us" class="wow fadeIn">
      <div class="container-fluid">
        
        <div class="row">

          <div class="col-lg-6">
            <div class="why-us-content">
            </div>

          </div>

        </div>

      </div>

      <div class="container">
        <div class="row counters">

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">
              <?php $xguru = $this->db->get('guru')->num_rows();?>
              <?php echo $xguru;?>  
            </span>
            <p>Pengajar</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">
              <?php $xmateri = $this->db->get('materi')->num_rows();?>
              <?php echo $xmateri;?>
            </span>
            <p>Materi</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">
              <?php $xsiswa = $this->db->get('siswa')->num_rows();?>
              <?php echo $xsiswa;?>
            </span>
            <p>Siswa</p>
          </div>

        </div>

      </div>
    </section>

    <!--==========================
      Call To Action Section
    ============================-->
   <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3 class="cta-title">Pengumuman</h3>
            <p class="cta-text">
                <?php $info = $this->db->get('pengumuman')->result_array();
                  foreach ($info as $info) :
                ?>

                  <font color="#7FFF00"><h6><?= tgl_indo($info['date']) ?></h6></font> 

                  <font color="#FFD700"><p><?= $info['judul'] ?></p></font>
                                
                  <font color="#FFFF00"><p><?= $info['text'] ?></p></font>
                <?php endforeach; ?>
            </p>
          </div>
        </div>

      </div>
    </section><!-- #call-to-action -->

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


</script>