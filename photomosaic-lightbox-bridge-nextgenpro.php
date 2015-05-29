<?php
/*
    Plugin Name: PhotoMosaic : Lightbox Bridge : NextGen Pro Lightbox
    Plugin URI: https://github.com/daylifemike/photomosaic-lightbox-bridge-nextgenpro
    Description: Use NextGen Pro Lightbox as your PhotoMosaic lightbox.  Requires the <strong>NextGen Pro Lightbox</strong> plugin (which can be purchased using the "Lightbox Plugin Details" link to the left).
    Author: Michael Kafka
    Author URI: http://www.codecanyon.net/user/makfak?ref=makfak
    Version: 0.1
    GitHub Plugin URI: daylifemike/photomosaic-lightbox-bridge-nextgenpro
*/

if ( ! defined( 'WPINC' ) ) { die; }

class PhotoMosaic_Lightbox_Bridge_Nextgenpro {

    protected $plugin_name = 'photomosaic-lightbox-bridge-nextgenpro';
    protected $plugin_slug = 'nextgenpro';
    protected $plugin_bridge = 'nextgenpro';
    protected $plugin_ref = 'http://www.nextgen-gallery.com/nextgen-pro/';
    protected $version = '0.1';

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );

        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );
    }

    public function enqueue_scripts () {
        global $photomosaic;

        if ( !class_exists('PhotoMosaic') ) {
            $this->oops();
        } else {
            wp_enqueue_script(
                $this->plugin_name,
                plugins_url('/'. $this->plugin_name .'.js', __FILE__ ),
                array( $photomosaic->get_plugin_name() . '-localize' ),
                $this->version,
                true
            );
        }
    }

    public function action_links ( $links ) {
        $bridge_link = '<a href="' . $this->plugin_ref . '">Lightbox Plugin Details</a>';

        array_push( $links, $bridge_link );

        return $links;
    }

    public function plugins_loaded () {
        global $photomosaic;

        if ( !class_exists('PhotoMosaic') || !is_object( $photomosaic ) ) {
            $this->oops();
        } else {
            $photomosaic->register_lightbox( $this->plugin_slug );
        }
    }

    public function oops () {
        // PhotoMosaic isn't installed or activated
    }
}

$photomosaic_lightbox_bridge_nextgenpro = new PhotoMosaic_Lightbox_Bridge_Nextgenpro;

?>