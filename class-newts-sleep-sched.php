<?php

if ( !class_exists( 'Newts_Sleep_Sched' ) ) {

class Newts_Sleep_Sched {
    protected $version;
    protected $plugin_slug;

    public function __construct() {
      $this->plugin_slug = 'newts_sl_sch';
      $this->version = '1.9.0';
    }

    public function get_version() {
      return $this->version;
    }

    public function upgrade_check() {
      $current_ver = $this->version;
      $installed_ver = get_option('newts_sleep_sched_ver');

      if ( !$installed_ver || $installed_ver != $current_ver ) {
        //update checks to see if option exists; if not, it will be added w/ add_option
        update_option('newts_sleep_sched_ver', $current_ver);
      }
    }


    public function run() {
      if ( file_exists( NewtSS_DIR . '/admin/page-sleep-sched.php' ) ) {
        require_once NewtSS_DIR . '/admin/page-sleep-sched.php';
      }
      $newts_sleep_sched = new Page_Sleep_Sched();

      add_action( 'admin_init', array($this, 'upgrade_check' ) );
      add_action( 'admin_menu', array($newts_sleep_sched, 'add_menu_page' ) );
      add_action( 'admin_enqueue_scripts', array($newts_sleep_sched, 'enqueue_styles' ) );

      add_action( 'admin_post_nss_hours_hook', array($newts_sleep_sched, 'process_settings' ) );
      add_action('rest_api_init', array($newts_sleep_sched, 'rest_register') );
    }
}

}
