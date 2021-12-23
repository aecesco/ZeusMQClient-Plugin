<?php

class ZeusMQClient_Plugin_i18n
{
  public function load_plugin_textdomain() 
  {
    load_plugin_textdomain('zeusmqclient-plugin', false, dirname(dirname(plugin_basename(__FILE__))) . '/languages/');
  }
}