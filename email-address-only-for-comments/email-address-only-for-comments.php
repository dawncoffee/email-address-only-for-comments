<?php
/**
 * Plugin Name: Dawncoffee - Email Address Only for Comments
 * Description: 
 * Plugin URI:  http://dawncoffee.com
 * Author:      Dawncoffee @ Ignacio Trujillo
 * Author URI:  http://dawncoffee.com/ignacio
 */
add_filter( 'pre_option_moderation_notify', array ( 'WPSE_Mail_Filter', 'init' ) );

class WPSE_Mail_Filter {

    protected static $new_mail = NULL;
    protected static $new_name = NULL;

    public static function init( $input = NULL ) {

        if ( 'pre_option_moderation_notify' === current_filter() ) {
            self::$new_mail = ''; // example@domain.tld
            self::$new_name = ''; // example name
        }

        if ( ! empty ( self::$new_mail ) ) add_filter( 'wp_mail_from', array ( __CLASS__, 'filter_email' ) );

        if ( ! empty ( self::$new_name ) ) add_filter( 'wp_mail_from_name', array ( __CLASS__, 'filter_name' ) );

        return $input;
    }

    public static function filter_name( $name ) {
        remove_filter( current_filter(), array ( __CLASS__, __FUNCTION__ ) );
        return self::$new_name;
    }

    public static function filter_email( $email ) {
        remove_filter( current_filter(), array ( __CLASS__, __FUNCTION__ ) );
        return self::$new_mail;
    }
}

?>