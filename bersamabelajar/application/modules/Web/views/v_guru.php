<!--? Hero Start -->
<div class="slider-area ">
    <div class="slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center">
                        <h2>Instruktur</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->
<!--? Team Ara Start -->
<div class="team-area pt-160 pb-160">
    <div class="container">
        <div class="row">
            <?php $guru = $this->db->get('guru')->result_array();
            foreach ($guru as $guru) :
            ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team mb-30">
                        <div class="team-img">
                            <img src="<?= base_url('assets/img/profil/') . $guru['foto'] ?>" alt="">
                            <!-- Blog Social -->
                            <ul class="team-social">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fas fa-globe"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-caption">
                            <h3><a href="instructor.html"><?= $guru['nama'] ?></a></h3>
                            <p><?= $guru['nip'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Team Ara End -->