<?php

add_action( 'init', 'register_post_types' );

function register_post_types(){
    register_post_type('prod ', array(
        'label'  => null,
        'labels' => array(
            'name'               => __('Изделие', 'art'),
            'singular_name'      => __('Изделие', 'art'),
            'add_new'            => __('Добавить изделие', 'art'),
            'add_new_item'       => __('Добавть новое изделие', 'art'),
            'edit_item'          => __('Редактировать изделие', 'art'),
            'new_item'           => __('Новое изделие', 'art'),
            'view_item'          => __('Посмотреть', 'art'), 
            'search_items'       => __('Искать изделие', 'art'),
            'not_found'          => __('Не найдено', 'art'), 
            'not_found_in_trash' => __('Не найдено в кошику', 'art'),
            'menu_name'          => __('Изделие', 'art'),
        ),
        'description'         => __('Двери, кровати, шкафы...', 'art'),
        'public'              => true,
        'publicly_queryable'  => false, 
        'exclude_from_search' => null, 
        'show_in_menu'        => null, 
        'show_in_admin_bar'   => null, 
        'show_in_nav_menus'   => null, 
        'show_in_rest'        => null, 
        'rest_base'           => null, 
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-layout',
        'hierarchical'        => false,
        'supports'            => array('title','editor', 'thumbnail'), 
        'taxonomies'          => array(),
        'has_archive'         => false,
        'rewrite'             => ['slug' => 'product'],
        'query_var'           => true,
    ) );
}

add_action( 'init', 'create_taxonomy' );

function create_taxonomy(){

    register_taxonomy('type', array('prod'), array(
        'labels'                => array(
            'name'              => __('Тип изделия', 'art'),
            'singular_name'     => __('Категорія', 'art'),
            'search_items'      => __('Поиск', 'art'),
            'all_items'         => __('Все типы изделий', 'art'),
            'view_item '        => __('Смотреть', 'art'),
            'parent_item'       => __('Родительский тип', 'art'),
            'parent_item_colon' => __('Родительский тип:', 'art'),
            'edit_item'         => __('Редактировать тип изделия', 'art'),
            'update_item'       => __('Обновить', 'art'),
            'add_new_item'      => __('Добавить новый тип изделия', 'art'),
            'new_item_name'     => __('Название типа изделия', 'art'),
            'menu_name'         => __('Тип изделия', 'art'),
        ),
        'description'           => '', 
        'public'                => true,
        'show_in_rest'          => null, 
        'rest_base'             => null,
        'hierarchical'          => true,
        'rewrite'               => true,
        'capabilities'          => array(),
        'meta_box_cb'           => null, 
        'show_admin_column'     => true, 
        '_builtin'              => false,
    ) );
}