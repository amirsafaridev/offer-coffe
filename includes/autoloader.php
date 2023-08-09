<?php

// Actions
add_action('init', 'arta_offer_coffee_register_script');
add_action('wp_enqueue_scripts', 'arta_offer_coffee_enqueue_style');

// register jquery and style on initialization
function arta_offer_coffee_register_script()
{
    // Css register
    wp_register_style('artaOfferCoffeeCSS', plugin_dir_url(__DIR__).'assets/css/arta_offer_coffee.css');
    wp_register_style('bootstrapCSS', plugin_dir_url(__DIR__).'assets/css/bootstrap.min.css');

    // Javascript Lib
    wp_register_script('jqueryJS', 'https://lib.arvancloud.com/jquery/3.6.0/jquery.js', '', '', true );
    wp_register_script('artaOfferCoffeeJS', plugin_dir_url(__DIR__).'assets/js/arta_offer_coffee.js', '', '', true );
    wp_register_script('bootstrapJS', plugin_dir_url(__DIR__).'assets/js/bootstrap.min.js');
    wp_localize_script('artaOfferCoffeeJS', 'ajax_url', array("url" => admin_url('admin-ajax.php')));

}

// use the registered jquery and style above
function arta_offer_coffee_enqueue_style()
{
    //Css
    wp_enqueue_style('artaOfferCoffeeCSS');
    wp_enqueue_style('bootstrapCSS');

    //js
    wp_enqueue_script('jqueryJS');
    wp_enqueue_script('artaOfferCoffeeJS');
    wp_enqueue_script('bootstrapJS');

}
