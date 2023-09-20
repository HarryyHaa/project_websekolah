

<!-- Footer -->
<footer class="inverse white-text center">
  <p>Ujian Online Copyright <?=date('Y');?></p>
</footer>
<!-- End Footer -->

<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="<?php echo base_url(''); ?>aila_cbt/js/materialize.min.js"></script>

<script>
  const sideNav = document.querySelectorAll('.sidenav');
  M.Sidenav.init(sideNav);  


  const slider = document.querySelectorAll('.slider');
  M.Slider.init(slider, {
    indicators : false,
    height : 500,
    transition : 600,
    interval : 3000
  });


  const parallax = document.querySelectorAll('.parallax');
  M.Parallax.init(parallax);


  const materialbox = document.querySelectorAll('.materialboxed');
  M.Materialbox.init(materialbox);


  const scroll = document.querySelectorAll('.scrollspy');
  M.ScrollSpy.init(scroll,{
    scrollOffset : 50
  });
</script>

</body>
</html>
