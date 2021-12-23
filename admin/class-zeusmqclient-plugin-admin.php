<?php

class ZeusMQClient_Plugin_Admin 
{
  private $plugin_name;
  private $version;

  public function __construct($plugin_name, $version)
  {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  public function enqueue_styles()
  {
    wp_enqueue_style( $this->plugin_name, plugin_dir_url(__FILE__) . 'css/zeusmqclient-plugin-admin.css', array(), $this->version, 'all');
  }

  public function enqueue_scripts()
  {
    wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/zeusmqclient-plugin-admin.js', array('jquery'), $this->version, false);
  }

  public function added_options_page() 
  {
    add_management_page(__('ZeusMQClient Plugin'), __('ZeusMQClient Plugin'), 'activate_plugins', $this->plugin_name , array( $this, 'display_options_partial'));
  }

  public function process_form()
  {
    if (!isset($_GET['save-settings']) || $_GET['save-settings'] !== 'true') 
    {
      return;
    }

    if (!current_user_can('activate_plugins')) 
    {
      return;
    }

    if (!isset($_POST['zeusmqclient_plugin_nonce']) || !wp_verify_nonce($_POST['zeusmqclient_plugin_nonce'], 'zeusmqclient_plugin_nonce'))
    {
      wp_die( 'Permission denied', 'zeusmqclient-plugin');
    }

    $updated = isset( $_POST['zeusmqclient_plugin_options']) ? $_POST['zeusmqclient_plugin_options'] : array();

    if (! $updated) 
    {
      return;
    }

    $sanitized = $this->sanitize($updated);

    update_option('zeusmqclient_plugin_options', $sanitized);
    wp_redirect(add_query_arg(array('page' => 'zeusmqclient-plugin', 'settings-updated' => 'success'), admin_url('admin.php')));
  }

  private function sanitize($data)
  {
    $sanitized = array();

    if ( isset( $data['host'])) 
    {
      $sanitized['host'] = sanitize_text_field( $data['host']);
    }

    if ( isset( $data['port'])) 
    {
      $sanitized['port'] = intval( $data['port']);
    }

    if ( isset( $data['username'])) 
    {
      $sanitized['username'] = sanitize_text_field( $data['username']);
    }
    
    if ( isset( $data['password'])) 
    {
      $sanitized['password'] = sanitize_text_field( $data['password']);
    }

    if ( isset( $data['connection_timeout'])) 
    {
      $sanitized['connection_timeout'] = sanitize_text_field( $data['connection_timeout']);
    }

    if ( isset( $data['vhost'])) 
    {
      $sanitized['vhost'] = sanitize_text_field( $data['vhost']);
    }
    
    if ( isset( $data['exchange'])) 
    {
      $sanitized['exchange'] = sanitize_text_field( $data['exchange']);
    }
    
    if ( isset( $data['queue'])) 
    {
      $sanitized['queue'] = sanitize_text_field( $data['queue']);
    }

    return $sanitized;
  }

  public function validate_bool($input) 
  {
    if ($input === "true" || $input === "false")
    {
      return $input;
    }

    return;
  }

  public function display_options_partial() 
  {
    require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/zeusmqclient-plugin-admin-display.php';
  }
}