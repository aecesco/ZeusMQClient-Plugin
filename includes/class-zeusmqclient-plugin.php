<?php

class ZeusMQClient_Plugin
{

  protected $loader;
  protected $plugin_name;
  protected $version;

  public function __construct()
  {
    $this->plugin_name = 'zeusmqclient-plugin';
    $this->version = '1.0.0';

    $this->load_dependencies();
    $this->set_locale();
    $this->define_admin_hooks();
    $this->define_public_hooks();
  }

  private function load_dependencies()
  {
    require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-zeusmqclient-plugin-i18n.php';
    require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-zeusmqclient-plugin-loader.php';
    require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-zeusmqclient-plugin-admin.php';
    require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-zeusmqclient-plugin-public.php';
    require_once plugin_dir_path(dirname(__FILE__)) . 'vendor/autoload.php';
    $this->loader = new ZeusMQClient_Plugin_Loader();
  }

  private function set_locale()
  {
    $plugin_i18n = new ZeusMQClient_Plugin_i18n();
    $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
  }

  private function define_admin_hooks() 
  {
    $plugin_admin = new ZeusMQClient_Plugin_Admin( $this->get_plugin_name(), $this->get_version() );

    $this->loader->add_action( 'admin_init', $plugin_admin, 'process_form' );
    $this->loader->add_action( 'admin_menu', $plugin_admin, 'added_options_page' );
    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
    $this->loader->add_action( 'admin_enqueue_scrits', $plugin_admin, 'enqueue_scripts' );
  }

  private function define_public_hooks()
  {
    $plugin_public = new ZeusMQClient_Plugin_Public( $this->get_plugin_name(), $this->get_version() );
    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
  }

  public function run()
  {
    $this->loader->run();
  }

  public function get_plugin_name()
  {
    return $this->plugin_name;
  }

  public function get_loader() 
  {
    return $this->loader;
  }

  public function get_version() 
  {
    return $this->version;
  }
}