<?php get_header(); ?>

<div id="primary" class="content-area">

  <section class="tax-menu">
    <div class="container">
      <h2 class="section-title"><?php _e('Оберіть Категорію', 'art'); ?></h2>
      <div class="row">
        <?php renderTaxMenu('type', '<div class="col-12 col-sm-6 col-lg-4 p-lg-4">', '</div>'); ?>
      </div>
    </div>
  </section>

  <section class="warranty">
    <div class="container">
      <h2 class="section-title"><?php the_field('warranty_title'); ?></h2>
      <div class="row justify-content-center">
        <div class="col-10">
          <p style="text-align: center"><?php the_field('warranty_content'); ?></p>
        </div>
      </div>
    </div>
  </section>

  <section class="quality">
    <div class="container">
      <h2 class="section-title section-title__quality"><?php the_field('qty_title'); ?></h2>
      <div class="row justify-content-center justify-content-lg-around">
        <div class="col-12 col-sm-6 col-lg-5 col-xl-3">
          <div class="stage">
            <h3 class="stage-title"><span class="stage-number">1</span><?php the_field('title'); ?></h3>
            <div class="stage-thumb">
              <img src="<?php echo get_template_directory_uri()?>/assets/images/lesovoz.jpg" alt="1-й етап">
            </div>
            <ul class="stage-group">
              <li class="stage-group-item"><?php the_field('item_one'); ?></li>
              <li class="stage-group-item"><?php the_field('item_two'); ?></li>
              <li class="stage-group-item"><?php the_field('item_three'); ?></li>
            </ul>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-5 col-xl-3">
          <div class="stage">
            <h3 class="stage-title"><span class="stage-number">2</span><?php the_field('title'); ?></h3>
            <div class="stage-thumb">
              <img src="<?php echo get_template_directory_uri()?>/assets/images/sklad.jpg" alt="2-й етап">
            </div>
            <ul class="stage-group">
              <li class="stage-group-item"><?php the_field('item_one'); ?></li>
              <li class="stage-group-item"><?php the_field('item_two'); ?></li>
              <li class="stage-group-item"><?php the_field('item_three'); ?></li>
            </ul>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-5 col-xl-3">
          <div class="stage">
            <h3 class="stage-title"><span class="stage-number">3</span><?php the_field('title'); ?></h3>
            <div class="stage-thumb">
              <img src="<?php echo get_template_directory_uri()?>/assets/images/process.jpg" alt="3-й етап">
            </div>
            <ul class="stage-group">
              <li class="stage-group-item"><?php the_field('item_one'); ?></li>
              <li class="stage-group-item"><?php the_field('item_two'); ?></li>
              <li class="stage-group-item"><?php the_field('item_three'); ?></li>
            </ul>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-5 col-xl-3">
          <div class="stage">
            <h3 class="stage-title after-clear"><span class="stage-number">4</span><?php the_field('title'); ?></h3>
            <div class="stage-thumb">
              <img src="<?php echo get_template_directory_uri()?>/assets/images/montage.jpg" alt="4-й етап">
            </div>
            <ul class="stage-group">
              <li class="stage-group-item"><?php the_field('item_one'); ?></li>
              <li class="stage-group-item"><?php the_field('item_two'); ?></li>
              <li class="stage-group-item"><?php the_field('item_three'); ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="eco">
    <div class="container-fluid">
      <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-xl-5 mb-3 mb-xl-0">
          <h2 class="section-title"><?php the_field('ecology_title'); ?></h2>
					<?php the_field('ecology_content'); ?>
        </div>
        <div class="col-12 col-md-8 col-xl-6">
          <div class="map pl-4">
            <img src="<?php echo get_template_directory_uri()?>/assets/images/poltava_regions.svg" alt="map">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="wood">
    <div class="container">
      <h2 class="section-title"><?php the_field('type_title'); ?></h2>

      <?php for($i=1; $i<=4; $i++) :
      
        $types = get_field( 'types_' . $i);
        $odd = $i % 2;
        if ( $types ) : ?>
          <div class="row justify-content-center justify-content-lg-between align-items-center mb-2 mb-lg-5">
            <div class="col-12 col-lg-5 mb-4 mb-lg-0 order-0 <?php echo !$odd ? 'order-lg-' . (1 - $odd) : ''; ?>">
              <h3 class="type-title center"><?php echo $types['type_name']; ?></h3>
              <img src="<?php echo $types['type_photo'];?>" alt="<?php echo $types['type_name']; ?>">
            </div>
            <div class="col-12 col-sm-8 col-lg-5 order-1 <?php echo !$odd ? 'order-lg-' . $odd : ''; ?>">
              <p><?php echo $types['type_description']; ?></p>
            </div>
          </div>
        <?php endif; ?>

      <?php endfor; ?>

    </div>
  </section>
</div><!-- #primary -->

<?php get_footer();