<!--? Hero Start -->
<div class="slider-area ">
    <div class="slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center">
                        <h2>All Courses</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->
<!-- all-course Start -->
<section class="all-course section-padding30">
    <div class="container">
        <div class="row">
            <div class="all-course-wrapper">
                <!-- Heading & Nav Button -->
                <!-- Tab content -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- Nav Card -->
                        <div class="tab-content" id="nav-tabContent">
                            <!--  one -->
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="row">
                                    <?php $materi = $this->db->get('kursus')->result_array();
                                    foreach ($materi as $materi) :
                                        $guru=$this->db->get_where('guru',['id_guru'=>$materi['id_guru']])->row_array();
                                    ?>
                                        <div class="col-xl-4 col-lg-4 col-md-6">
                                            <!-- Single course -->
                                            <div class="single-course mb-70">
                                                <div class="course-img">
                                                    <img src="<?= base_url() ?>assets/img/materi.png" alt="">
                                                </div>
                                                <div class="course-caption">
                                                    <div class="course-cap-top">
                                                        <h4><a href="#"><?= $materi['id_mapel'] ?></a></h4>
                                                    </div>
                                                    <div class="course-cap-mid d-flex justify-content-between">
                                                        <!-- <div class="course-ratting">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div> -->
                                                        <ul>
                                                            <li><?= $guru['nama'] ?></li>
                                                        </ul>
                                                    </div>
                                                    <!-- <div class="course-cap-bottom d-flex justify-content-between">
                                                        <ul>
                                                            <li><i class="ti-user"></i> 562</li>
                                                            <li><i class="ti-heart"></i> 562</li>
                                                        </ul>
                                                        <span>Free</span>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                        <!-- End Nav Card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- all-course End -->