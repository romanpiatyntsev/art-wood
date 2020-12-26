  </main>
  <footer>
    <section class="hi-footer order white">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-12">
            <h3 class="section-title center"><?php the_field('forma_footer_title', get_option('page_on_front')); ?></h3>
          </div>
          <div class="col-12 col-md-6 col-lg-6 mt-4">
            <?php echo do_shortcode('[contact-form-7 id="66" title="смс запит"]'); ?>
          </div>
        </div>
      </div>
    </section>
    <div class="low-footer pb-5 pt-5">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-12 col-md-7 col-lg-4 col-xl-4">
            <div class="brand d-flex flex-wrap align-items-center mb-4">
              <div class="brand-logo mr-2">
                <?php the_custom_logo(); ?>
              </div>
              <div class="brand-name w-100 mt-2">
                <?php bloginfo('name'); ?><br><span class="small"><?php bloginfo('description'); ?></span>
              </div>
              <div class="mt-4">
                <?php _e('Наша адреса', 'art'); ?>:<br>
                <?php the_field('address', FP_ID); ?>
              </div>
              <div class="brand-telephone left mt-4">
                <a href="tel:<?php echo str_replace(array('(', ')', ' ', '-'), '', get_field('tel', FP_ID)); ?>">
                  <?php the_field('tel', FP_ID); ?>
                </a>
              </div>
            </div>

          </div>

          <div class="col-12 col-md-7 col-lg-5">
            <?php if (is_active_sidebar('footer-1')) : ?>
              <?php dynamic_sidebar('footer-1'); ?>
            <?php endif; ?>
          </div>

          <div class="col-12 col-md-4 col-lg-2 ml-auto">
            <?php if (is_active_sidebar('footer-2')) : ?>
              <?php dynamic_sidebar('footer-2'); ?>
            <?php endif; ?>
          </div>

        </div>
      </div>
    </div>

    <?php wp_footer(); ?>
    
  </footer>
  </body>

  </html>