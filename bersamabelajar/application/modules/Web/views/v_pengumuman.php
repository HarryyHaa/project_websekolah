<!--? Hero Start -->
<div class="slider-area ">
    <div class="slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center">
                        <h2>Pengumuman</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->
<!--================Blog Area =================-->
<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    <?php $info = $this->db->get('pengumuman')->result_array();
                    foreach ($info as $info) :
                    ?>
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="assets/img/blog/single_blog_1.png" alt="">
                                <a href="#" class="blog_item_date">
                                    <h3><?= tgl_indo($info['date']) ?></h3>
                                </a>
                            </div>
                            <div class="blog_details">
                                <a class="d-inline-block" href="blog_details.html">
                                    <h2 class="blog-head" style="color: #2d2d2d;"><?= $info['judul'] ?></h2>
                                </a>
                                <p><?= $info['text'] ?></p>

                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>
<!--================Blog Area =================-->