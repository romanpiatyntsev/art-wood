<?php
get_header();
?>
<div id="primary" class="content-area">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php echo strip_shortcodes(term_description()); ?>
      </div>
      <?php if (have_posts()) :
        while (have_posts()) : the_post(); ?>
          <div class="col-12 col-lg-4 center">
            <img class="product-archive-item" src="<?php the_post_thumbnail_url('product-archive'); ?>" alt="">
            <div class="code mb-5"><?php the_ID(); ?></div>
          </div>
      <?php endwhile;
        the_posts_pagination([
          'prev_text' => _x('<', 'previous set of posts'),
          'next_text' => _x('>', 'next set of posts'),
        ]);
      endif;
      ?>
    </div>
  </div>
</div><!-- #primary -->

<?php get_footer();
