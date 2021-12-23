<?php
/**
 * @wordpress-plugin
 * Plugin Name:       ZeusMQClient-Plugin
 * Description:       ZeusMQClient-Plugin
 * Version:           1.0.0
 * Author:            OESIA
 * Text Domain:       ZeusMQClient-Plugin
 */

use Zeusmqclient\Connection;
use Zeusmqclient\Publisher;

require_once plugin_dir_path(__FILE__).'includes/class-zeusmqclient-plugin.php';

// If this file is called directly, abort.
if (!defined('WPINC')) 
{
  die;
}

function activate_zeusmqclient_plugin()
{
  require_once plugin_dir_path(__FILE__).'includes/class-zeusmqclient-plugin-activator.php';
  ZeusMQClient_Plugin_Activator::activate();
}

function deactivate_zeusmqclient_plugin()
{
  require_once plugin_dir_path( __FILE__).'includes/class-zeusmqclient-plugin-deactivator.php';
  ZeusMQClient_Plugin_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_zeusmqclient_plugin');
register_deactivation_hook( __FILE__, 'deactivate_zeusmqclient_plugin');

function run_zeusmqclient_plugin()
{
  $plugin = new zeusmqclient_plugin();
  $plugin->run();
}

run_zeusmqclient_plugin();

function zeusmqclient_on_post_published($id, $post) {
  
  $message = 'Se ha publicado un nuevo post:';
  $message .= $post->post_title;
  $options = get_option('zeusmqclient_plugin_options');
  $connection = new Connection($options['host'], $options['port'], $options['username'] , $options['password'], $options['vhost']);
  $connection->setConnection();
  $publisher = new Publisher($connection);
  $publisher->__invoke($options['queue'], $options['exchange'], '', $message);
  $connection->closeConnection();
}

add_action('publish_post', 'zeusmqclient_on_post_published', 10, 2);