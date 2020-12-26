<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php wp_head(); ?>
</head>

<body <?php body_class();?> >
  <header>
      <div class="header-layout d-flex flex-column justify-content-between" style="background: url(<?php renderHeaderBg(); ?>) no-repeat center center/cover">

        <div class="top-layout pt-3 pb-3">
          <div class="container">
            <div class="row justify-content-center justify-content-sm-start align-items-center">
              <div class="brand-logo mr-2">
								<?php the_custom_logo(); ?>
              </div>
              <div class="brand-name">
                "<?php bloginfo('name'); ?>" - <span class="small"><?php bloginfo('description'); ?></span><br><?php the_field( 'address', FP_ID ); ?>
              </div>
              <div class="brand-telephone ml-sm-auto">
                <a href="tel:<?php echo str_replace( array( '(', ')', ' ', '-'), '', get_field('tel', FP_ID ) ); ?>"><?php the_field('tel', FP_ID ); ?></a>
              </div>
            </div>
          </div>
        </div>

        <div class="middle-layout">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="description"><?php the_field('description'); ?></div>

                <h1 class="page-title mt-1 mb-1">
                  <?php if ( is_singular() ) {
                    the_title();
                  } elseif ( is_tax() ) {
                    the_archive_title();
                  }?>
                </h1>
                <?php if ( is_front_page() && $slogan = get_field('slogan', FP_ID ) ) : ?>
                  <div class="slogan"><?php echo $slogan ?></div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

        <div class="bottom-layout mb-lg-5">
          <div class="container">
            <div class="row justify-content-center justify-content-xl-start">
              <div class="col-12">
                <div class="service">Виїзд майстра для замірів та розрахунку вартості - БЕЗКОШТОВНО</div>
              </div>
              <div class="col-12 col-sm-8 col-lg-6 mt-4">
								<?php echo do_shortcode('[contact-form-7 id="66" title="смс запит"]'); ?>
              </div>
              </div>
            </div>
          </div>
        </div>

      </div>
  </header>
	<?php
		is_tax('type-') && $gallery = getGalleryImgUrl( term_description() );

    if ( $gallery ) :?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 no-gutters">
          <div class="img-slider variable-width" data-termid="<?php echo get_queried_object()->term_id; ?>">

						<?php foreach ( $gallery as $imgUrl) : ?>
              <div class="slider-item">
                <img data-lazy="<?php echo $imgUrl ?>" alt="slider">
              </div>
						<?php endforeach; ?>

          </div>
        </div>
      </div>
    </div>
	<?php endif; ?>

  <?php if ( ! is_front_page() ) : ?>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumb mb-4 mt-4">
						<?php echo do_shortcode('[wpseo_breadcrumb]'); ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <main>