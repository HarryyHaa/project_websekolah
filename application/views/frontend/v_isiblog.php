    <div id="overviews" class="section wb">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-9 blog-post-single">

                <?php foreach($artikel as $a){ ?>

                    <div class="blog-item">
                        <div class="image-blog">
                           <!-- <img src="assets_frontend/images/belajar1.jpg" alt="" class="img-fluid">-->
                            <?php if($a->artikel_sampul != ""){ ?>
                                <img src="<?php echo base_url(); ?>gambar/artikel/<?php echo $a->artikel_sampul ?>" alt="<?php echo $a->artikel_judul ?>" class="img-fluid">
                            <?php } ?>

                        </div>
                        <div class="post-content">
                            
                            <div class="meta-info-blog">
                                <h1 class="article-title"><a href="<?php echo base_url().$a->artikel_slug ?>"><?php echo $a->artikel_judul ?></a></h1>
                            </div>

                            <div class="meta-info-blog">
                                <span><i class="fa fa-calendar"></i> <a href="#"><?php echo $a->pengguna_nama ?></a> </span>
                                <span><i class="fa fa-tag"></i>  <a href="#"><?php echo $a->kategori_nama ?></a> </span>
                            </div>
                                                 
                        </div>
                    </div>
                
                <?php } ?>

                </div><!-- end col -->
                <div class="col-lg-3 col-12 right-single">
                    <div class="widget-search">
                        <div class="site-search-area">
                            <form method="get" id="site-searchform" action="#">
                                <div>
                                    <?php echo form_open(base_url().'search'); ?>
                                    <input class="input-text form-control" name="search-k" id="search-k" placeholder="Search keywords..." type="text">
                                    <input id="searchsubmit" value="Search" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="widget-categories">
                        <h3 class="widget-title">Artikel Terbaru</h3>
                        <ul>
                            <?php 
                                $artikel = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE artikel_status='publish' AND artikel_author=pengguna_id AND artikel_kategori=kategori_id ORDER BY artikel_id DESC LIMIT 3")->result();
                                foreach($artikel as $a){
                            ?>
                        <li>
                            <a href="<?php echo base_url().$a->artikel_slug; ?>"><?php echo $a->artikel_judul; ?></a>
                        </li>
                        <?php } ?>
                        </ul>
                    </div>

                    <div class="widget-categories">
                        <h3 class="widget-title">Halaman</h3>
                        <ul>
                            <?php $halaman = $this->m_data->get_data('halaman')->result();
                            foreach($halaman as $h){ ?>
                        <li>
                            <a href="<?php echo base_url().'page/'.$h->halaman_slug; ?>"><?php echo $h->halaman_judul; ?></a>
                        </li>
                        <?php } ?>
                        </ul>
                    </div>

                    <div class="widget-tags">
                        <h3 class="widget-title">Kategori</h3>
                        <ul class="tags">
                        <?php $kategori = $this->m_data->get_data('kategori')->result();
                            foreach($kategori as $k){ ?>
                        <li>
                            <a href="<?php echo base_url().'kategori/'.$k->kategori_slug; ?>"><?php echo $k->kategori_nama; ?></a>
                        </li> <?php } ?>
                        </ul>
                    </div>
    
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->
