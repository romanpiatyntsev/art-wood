<?php
/**
 * Enqueue scripts and styles.
 */
function add_scripts() {
    wp_enqueue_style( 'main-style',  ART_URL . '/assets/css/main.min.css', [], ART_VERSION );

    wp_enqueue_style( 'google-fonts-roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,700&amp;subset=cyrillic', [] );

    wp_enqueue_style( 'google-fonts-pt-sans', 'https://fonts.googleapis.com/css?family=PT+Sans+Narrow&amp;subset=cyrillic', [] );

    wp_enqueue_script( 'main-scripts',  ART_URL . '/assets/js/main.js', [], ART_VERSION, true );


    if ( is_tax('type') ) {
        wp_enqueue_script( 'slick-script',  '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery'], '1', true );
        wp_enqueue_script( 'slick-init',  ART_URL . '/assets/js/slick-init.js', ['slick-script'], ART_VERSION, true );
        wp_enqueue_style( 'slick-style', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', [] );
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

}
add_action( 'wp_enqueue_scripts', 'add_scripts' );