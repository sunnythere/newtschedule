<?php
/*
*
Plugin Name: Newt's Sleep Schedule
Description: Princess Newton needs her beauty sleep. Set the cafe business hours so that people can see her official visiting hours.
Version: 1.9
Author: Y.Alice
*
*/
if ( !defined('WPINC') ) die;


if ( !defined( 'NewtSS_NAME' ) ) {
  define( 'NewtSS_NAME', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) );
}

if ( !defined( 'NewtSS_DIR' ) ) {
  define( 'NewtSS_DIR', WP_PLUGIN_DIR . '/' . NewtSS_NAME );
}

if ( file_exists( NewtSS_DIR . '/class-newts-sleep-sched.php' ) ) {
  require_once NewtSS_DIR . '/class-newts-sleep-sched.php';
}

function run_newts_sleep_sched() {
  $ccbk_hours = new Newts_Sleep_Sched();
  $ccbk_hours->run();
}

run_newts_sleep_sched();
