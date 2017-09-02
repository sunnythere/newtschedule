<?php

if ( !class_exists( 'Page_Sleep_Sched' ) ) {

class Page_Sleep_Sched {
    private $days_keys;
    private $newts_sched;
    private $newts_sched_ad;

    public function __construct() {
      $this->days_keys = array( 'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat' );
      $this->newts_sched = get_option('newts_sleep_sched_hrs', array());
      $this->newts_sched_ad = get_option('newts_sleep_sched_ad_hrs', array());
    }

    public function enqueue_styles() {
      wp_register_style( 'newts-styles', plugins_url('newts-sleep-sched/admin/css/newts-styles.css') );
      wp_enqueue_style( 'newts-styles' );
    }

    public function enqueue_scripts() {

    }

    public function add_menu_page() {
      $nss_menu_icon_base64 = "data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48dGl0bGU+c2NoZWQtaWNvbjwvdGl0bGU+PHBhdGggZD0iTTIwIDE2LjA3NXYtLjA1YzAtLjAwNy0uMjM0LS4wMTMtLjcwMy0uMDE4LS40NjktLjAwNS0xLjA2OC0uMDA3LTEuNzk3LS4wMDdoLTE1Yy0uNzMgMC0xLjMyOC4wMDItMS43OTcuMDA3LS40NjkuMDA1LS43MDMuMDEtLjcwMy4wMTh2LjA1YzAgLjAwNy4yMzQuMDEzLjcwMy4wMTguNDY5LjAwNSAxLjA2OC4wMDcgMS43OTcuMDA3aDE1Yy43MyAwIDEuMzI4LS4wMDIgMS43OTctLjAwNy40NjktLjAwNS43MDMtLjAxLjcwMy0uMDE4em0wLTEzLjA1di4wNWMwIC4wMDctLjIzNC4wMTMtLjcwMy4wMTgtLjQ2OS4wMDUtMS4wNjguMDA3LTEuNzk3LjAwN2gtMTVjLS43MyAwLTEuMzI4LS4wMDItMS43OTctLjAwN0MuMjM0IDMuMDg4IDAgMy4wODMgMCAzLjA3NXYtLjA1YzAtLjAwNy4yMzQtLjAxMy43MDMtLjAxOEMxLjE3MiAzLjAwMiAxLjc3MSAzIDIuNSAzaDE1Yy43MyAwIDEuMzI4LjAwMiAxLjc5Ny4wMDcuNDY5LjAwNS43MDMuMDEuNzAzLjAxOHpNMTguNSAxMVY3YzAtLjU4My0uMDIzLTEuMDYyLS4wNy0xLjQzOC0uMDQ3LS4zNzUtLjEwNy0uNTYyLS4xOC0uNTYyaC0xLjVjLS4wNzMgMC0uMTMzLjE4Ny0uMTguNTYzLS4wNDcuMzc1LS4wNy44NTQtLjA3IDEuNDM3djRjMCAuNTgzLjAyMyAxLjA2Mi4wNyAxLjQzOC4wNDcuMzc1LjEwNy41NjIuMTguNTYyaDEuNWMuMDczIDAgLjEzMy0uMTg3LjE4LS41NjMuMDQ3LS4zNzUuMDctLjg1NC4wNy0xLjQzN3ptLTIuNS41di0zYzAtLjQzOC0uMDIzLS43OTctLjA3LTEuMDc4LS4wNDctLjI4MS0uMTA3LS40MjItLjE4LS40MjJoLTEuNWMtLjA3MyAwLS4xMzMuMTQtLjE4LjQyMi0uMDQ3LjI4MS0uMDcuNjQtLjA3IDEuMDc4djNjMCAuNDM4LjAyMy43OTcuMDcgMS4wNzguMDQ3LjI4MS4xMDcuNDIyLjE4LjQyMmgxLjVjLjA3MyAwIC4xMzMtLjE0LjE4LS40MjIuMDQ3LS4yODEuMDctLjY0LjA3LTEuMDc4em0tMi41Ljc1di0zLjVjMC0uNTEtLjAyMy0uOTMtLjA3LTEuMjU4LS4wNDctLjMyOC0uMTA3LS40OTItLjE4LS40OTJoLTEuNWMtLjA3MyAwLS4xMzMuMTY0LS4xOC40OTJhOS4xOSA5LjE5IDAgMCAwLS4wNyAxLjI1OHYzLjVjMCAuNTEuMDIzLjkzLjA3IDEuMjU4LjA0Ny4zMjguMTA3LjQ5Mi4xOC40OTJoMS41Yy4wNzMgMCAuMTMzLS4xNjQuMTgtLjQ5MmE5LjE5IDkuMTkgMCAwIDAgLjA3LTEuMjU4ek0xMSA5Ljk3NXYtLjA1YzAtLjAwNy0uMDIzLS4wMTMtLjA3LS4wMThhMS44NyAxLjg3IDAgMCAwLS4xOC0uMDA3aC0xLjVhMS44NyAxLjg3IDAgMCAwLS4xOC4wMDdjLS4wNDcuMDA1LS4wNy4wMS0uMDcuMDE4di4wNWMwIC4wMDcuMDIzLjAxMy4wNy4wMTguMDQ3LjAwNS4xMDcuMDA3LjE4LjAwN2gxLjVjLjA3MyAwIC4xMzMtLjAwMi4xOC0uMDA3LjA0Ny0uMDA1LjA3LS4wMS4wNy0uMDE4em0tMi41LjF2LS4wNWMwLS4wMDctLjAyMy0uMDEzLS4wNy0uMDE4QTEuODcgMS44NyAwIDAgMCA4LjI1IDEwaC0xLjVhMS44NyAxLjg3IDAgMCAwLS4xOC4wMDdjLS4wNDcuMDA1LS4wNy4wMS0uMDcuMDE4di4wNWMwIC4wMDcuMDIzLjAxMy4wNy4wMTguMDQ3LjAwNS4xMDcuMDA3LjE4LjAwN2gxLjVjLjA3MyAwIC4xMzMtLjAwMi4xOC0uMDA3LjA0Ny0uMDA1LjA3LS4wMS4wNy0uMDE4ek02IDEyLjI1di0zLjVjMC0uNTEtLjAyMy0uOTMtLjA3LTEuMjU4QzUuODgzIDcuMTY0IDUuODIzIDcgNS43NSA3aC0xLjVjLS4wNzMgMC0uMTMzLjE2NC0uMTguNDkyQTkuMTkgOS4xOSAwIDAgMCA0IDguNzV2My41YzAgLjUxLjAyMy45My4wNyAxLjI1OC4wNDcuMzI4LjEwNy40OTIuMTguNDkyaDEuNWMuMDczIDAgLjEzMy0uMTY0LjE4LS40OTJBOS4xOSA5LjE5IDAgMCAwIDYgMTIuMjV6TTMuNSAxMVY3YzAtLjU4My0uMDIzLTEuMDYyLS4wNy0xLjQzOEMzLjM4MyA1LjE4OCAzLjMyMyA1IDMuMjUgNWgtMS41Yy0uMDczIDAtLjEzMy4xODctLjE4LjU2My0uMDQ3LjM3NS0uMDcuODU0LS4wNyAxLjQzN3Y0YzAgLjU4My4wMjMgMS4wNjIuMDcgMS40MzguMDQ3LjM3NS4xMDcuNTYyLjE4LjU2MmgxLjVjLjA3MyAwIC4xMzMtLjE4Ny4xOC0uNTYzLjA0Ny0uMzc1LjA3LS44NTQuMDctMS40Mzd6TTIwIDMuNTYydjExLjg3NmMwIC40My0uMTUzLjc5Ny0uNDU5IDEuMTAzYTEuNTA1IDEuNTA1IDAgMCAxLTEuMTA0LjQ1OUgxLjU2M2MtLjQzIDAtLjc5Ny0uMTUzLTEuMTAzLS40NTlBMS41MDUgMS41MDUgMCAwIDEgMCAxNS40MzdWMy41NjNjMC0uNDMuMTUzLS43OTguNDU5LTEuMTA0QTEuNTA1IDEuNTA1IDAgMCAxIDEuNTYyIDJoMTYuODc1Yy40MyAwIC43OTguMTUzIDEuMTA0LjQ1OS4zMDYuMzA2LjQ1OS42NzQuNDU5IDEuMTAzeiIgZmlsbD0iYmxhY2siIGZpbGwtcnVsZT0iZXZlbm9kZCIvPjwvc3ZnPg==";

      add_menu_page(
        "Bk Cat Cafe Hours",   //page_title
        "Cafe Hours",   //menu_title
        "manage_options",         //capability
        "newts-sleep-sched-menu",   //menu_slug
        array( $this, 'render' ),   //function
        $nss_menu_icon_base64,   //icon_url
        4         //position
      );
    }

    public function get_days() {
      return $this->days_keys;
    }

    public function get_sched() {
      return $this->newts_sched;
    }

    public function get_sched_ad() {
      return $this->newts_sched_ad;
    }

    public function rest_register() {
      register_rest_route(
        'newts_sleep_sched/v1',
        '/time_hrs/',
        array(
          'methods' => WP_REST_Server::READABLE,
          'callback' => array($this, 'rest_register_cb')
        )
      );
    }

    public function rest_register_cb() {
      $nap_time = get_transient( 'nss_nap_time' );
      $nap_time_ad = get_transiet( 'nss_nap_time_ad' );
      if ( !$nap_time ) {
        $nap_time = $this->get_sched();
        set_transient( 'nss_nap_time', $nap_time, 60*60*2 );
      }
      if ( !$nap_time_ad ) {
        $nap_time_ad = $this->get_sched_ad();
        set_transient( 'nss_nap_time_ad', $nap_time_ad, 60*60*2 );
      }
      return [$nap_time, $nap_time_ad];
    }

    public function render() {
        if ( !current_user_can('manage_options') ) {
        wp_die( __('Sorry, you do not have sufficient permissions to access this page.') );
        }

        $newts_days = $this->get_days();
        $newts_sched_arr = $this->get_sched();
        $newts_sched_ad_arr = $this->get_sched_ad();

        // print_r($newts_days);
        // print_r($newts_sched_arr);
        // print_r($newts_sched_ad_arr);

       require_once NewtSS_DIR . '/admin/newts-sleep-sched-admin-page.php';
    }


    public function check_ad_only() {

    }

    private function is_nonce_valid() {
      return check_admin_referer( 'nss_hours_save', 'nss_hours_nonce' );
    }

    private function is_user_auth() {
      return current_user_can( 'manage_options' );
    }

    private function redirect() {
      if ( ! isset( $_POST['_wp_http_referer'] ) ) {
        $_POST['_wp_http_referer'] = wp_login_url();
      }

      $url = sanitize_text_field( wp_unslash( $_POST['_wp_http_referer'] ) );
      wp_safe_redirect( urldecode( $url ) );
      exit;
    }

    public function process_settings() {
        if ( !$this->is_user_auth() ) {
            wp_die( __('Sorry, you do not have sufficient permissions to update these settings.') );
        } elseif ( $this->is_nonce_valid() ) {

            $days = $this->get_days();
            $updated_schedule = array();
            $updated_schedule_ad = array();

            foreach( $days as $idx => $key ) {
                if ( isset ( $_POST[ $key . '_' . $idx . '_0' ] ) && isset ( $_POST[ $key . '_' . $idx . '_1' ] ) ) {
                    $updated_schedule['nss_' . $key . '_' . $idx] = array(
                        sanitize_text_field( $_POST[ $key . '_' . $idx . '_0' ] ),
                        sanitize_text_field( $_POST[ $key . '_' . $idx . '_1' ] )
                    );
                }

                if ( isset ( $_POST[ $key . '_' . $idx . '_ad' ] ) ) {
                    $updated_schedule_ad['nss_' .$key . '_' . $idx][0] = sanitize_text_field( $_POST[ $key . '_' . $idx . '_ad' ] );
                }
                if ( isset ( $_POST[ $key . '_' . $idx . '_2' ] ) && isset ( $_POST[ $key . '_' . $idx . '_3' ] ) ) {
                    $updated_schedule_ad['nss_' . $key . '_' . $idx][1] = sanitize_text_field( $_POST[ $key . '_' . $idx . '_2' ] );
                    $updated_schedule_ad['nss_' . $key . '_' . $idx][2] = sanitize_text_field( $_POST[ $key . '_' . $idx . '_3' ] );
                }
            }

            update_option( 'newts_sleep_sched_hrs', $updated_schedule);
            set_transient( 'nss_nap_time', $updated_schedule, 60*60*2 );

            update_option( 'newts_sleep_sched_ad_hrs', $updated_schedule_ad );
            set_transient( 'nss_nap_time_ad', $updated_schedule_ad , 60*60*2 );

            $this->redirect();

        }
  }

}

}
