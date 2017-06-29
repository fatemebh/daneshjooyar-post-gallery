<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Core class for "daneshjooyar post gallery" plugin
 *
 * @author Hamed Moodi
 * @uses https://github.com/brutaldesign/swipebox
 */
class DYPG_Core {
    
    /**
     * Plugin version
     * @param  String
     */
    private $version;

    /**
     * Pages that gallery should active  on these page
     * @param array
     */
    private $pages;

    /**
     * post meta settings prefix
     * @var string
     */
    private $setting_prefix = '_dypg_';

    /**
     * @param String plugin version
     */
    public function __construct( $version ) {

        //Set plugin version
        $this->version = $version;

        //Add pages that post gallery should show on these page
        $this->pages   = array( 'post', 'page');

    }
    
    /**
     * Run plugin core
     * @return Void
     */
    public function run() {
        
        /**
         * Add translate ability to plugin
         */
        $this->translation();
        
        /**
         * Manage admin/pulbic scripts
         */
        $this->addScripts();
        
        /**
         * Add metaboxes
         */
        if( is_admin() ) {
            $this->addMetaBoxes();
        }

        /**
         * Save post metabox in database
         */
        if( is_admin() ) {
            add_action( 'edit_post', array(&$this, 'save_meta_box') );
            add_action( 'save_post', array(&$this, 'save_meta_box') );
        }

        /**
         * Add [dy-post-gallery] shortcode for use in post anywhere
         */
        add_shortcode( 'dy-post-gallery', array(&$this, 'gallery_shortcode') );
        
    }
    
    /**
     * translate plugin
     * @return Void
     */
    public function translation() {
        add_action('plugins_loaded', function(){
            load_plugin_textdomain('daneshjooyar-post-gallery', false, basename( DYPG_DIR ) . '/languages/');
        });
    }
    
    /**
     * Add admin/public scripts and style
     */
    public function addScripts() {
        /**
         * Add admin scripts and styles
         */
        add_action( 'admin_enqueue_scripts', function( $hook ) {
            /**
             * Check for if is post page or not
             */
            if( $hook == 'post-new.php' || $hook == 'post.php' ) {
                //enqueue media upload core script
                wp_enqueue_media();
                wp_enqueue_script('dy-admin-script', DYPG_JS . 'admin.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), $this->version, true);
                wp_localize_script( 'dy-admin-script', 'daneshjooyar_gallery', array(
                        'video_icon'    => DYPG_IMG . 'play_icon.png',
                    )
                );

                wp_enqueue_style( 'dy-admin-style', DYPG_CSS . 'admin.css', array(), $this->version, 'all' );

            }
        } );

        /**
         * Add public scripts and styles
         */
        add_action( 'wp_enqueue_scripts', function() {
            
            /**
             * Enqueue just for single page/post
             */
            if( ! is_singular() ) {
                return;
            }

            /**
             * Get current post id
             * @var [type]
             */
            $post_id = get_the_ID();

            wp_register_script('swipebox', DYPG_JS . 'jquery.swipebox.min.js', array( 'jquery' ), $this->version, true);
            wp_register_script('slick', DYPG_JS . 'slick.min.js', array( 'jquery' ), $this->version, true);
            

            wp_enqueue_script('dypg-public-script', DYPG_JS . 'public.js', array( 'jquery', 'swipebox', 'slick'), $this->version, 'all');
            
            /**
             * Localize scrip if needed
             */
            $slideToShow = get_post_meta( $post_id, '_dypg_slide_to_show', true );

            wp_localize_script('dypg-public-script', 'dypg_settings', array(
                    'slidesToShow'  => $this->get_setting( 'slideToShow', 6 ),
            ));

            /**
             * Register swipebox style base on selected theme for each post if is single page
             */

            wp_register_style('swipebox', DYPG_CSS . 'swipebox.min.css',array(), $this->version, 'all');
            wp_register_style('slick', DYPG_CSS . 'slick.css',array(), $this->version, 'all');
            wp_register_style('slick-theme', DYPG_CSS . 'slick-theme.css',array('slick'), $this->version, 'all');
            wp_enqueue_style('dy-public-style', DYPG_CSS . 'public.css',array( 'swipebox', 'slick', 'slick-theme' ), $this->version, 'all');
        } );
    }
    
    /**
     * Add post metabox for gallery image select
     */
    public function addMetaBoxes(){
        add_action( 'add_meta_boxes',function() {
            foreach( $this->pages as $page){
                add_meta_box( 'dy-post-gallery-metabox', __('Post gallery', 'daneshjooyar-post-gallery'), array(&$this, 'gallery_metabox_view'), $page);
            }
        } );
    }
    
    /**
     * render metabox view
     * @param  WP_Post  $post  post object
     */
    public function gallery_metabox_view( $post ){

        $dy_post_gallery_images = get_post_meta( $post->ID, '_dy_post_gallery', true );
        $dy_post_gallery_images = $dy_post_gallery_images ? $dy_post_gallery_images : array();

        include_once( DYPG_DIR . 'core/view/metabox-view.php' );

    }

    /**
     * save metabox content in database
     * @param int $post_id post id that save
     */
    public function save_meta_box( $post_id ) {
        if( isset( $_POST['dy_post_gallery_image_url'] ) && current_user_can('edit_post') && wp_verify_nonce( $_POST['dy_post_gallery_nonce'], $post_id . get_current_user_id() )) {
            $filtered = array_map(function( $aid ){
                $attachmentId = absint($aid);
                if( $attachmentId && ( wp_attachment_is_image( $attachmentId ) || wp_attachment_is( 'video', $attachmentId ) || wp_attachment_is( 'audio', $attachmentId) ) ){
                    return $attachmentId;
                }
            }, $_POST['dy_post_gallery_image_url']);
            update_post_meta( $post_id, '_dy_post_gallery', $filtered );

            $this->set_setting( 'slideToShow',  absint( $_POST[ $this->setting_prefix . 'slide_to_show' ] ) );

        }
    }

    /**
     * render shortcode in post
     * @param  array $atts    attributes send by this shortcode tags
     * @param  string $content content between shortcodes tag *Note: in this shortcode we do not use this argument
     * @return string          rendered html code for showing gallery
     */
    public function gallery_shortcode( $atts, $content = null) {
        extract(shortcode_atts( array(

            ), $atts));

        $dy_post_gallery_images = get_post_meta( get_the_ID(), '_dy_post_gallery', true );
        $dy_post_gallery_images = $dy_post_gallery_images ? $dy_post_gallery_images : array();
        ob_start();
        include( DYPG_DIR . 'core/view/gallery-shortcode.php' );   
        return ob_get_clean();
    }

    /**
     * Get Setting in post meta
     * @param  string  $setting_id Setting id
     * @param  integer $default    post ID
     * @return Mix              
     */
    private function get_setting( $setting_id, $default = 0 ) {

        global $post;

        if( ! isset( $post ) ) {
            return false;
        }
        
        $value = get_post_meta( $post->ID, $this->setting_prefix . $setting_id, true );

        return $value ? $value : $default;

    }

    /**
     * Set new setting in post meta
     * @param string $setting_id setting id
     * @param Mix $new_value  new value
     */
    private function set_setting( $setting_id, $new_value ) {

        if( ! get_the_ID() ) {
            return false;
        }

        return update_post_meta( get_the_ID(), $this->setting_prefix . $setting_id, $new_value );

    }

}
