<?php

$options = get_option('zeusmqclient_plugin_options');

?>

<div class="wrap">
  <h2>
    <?php echo esc_html( get_admin_page_title() ); ?>
  </h2>

  <?php if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'success' ) : ?>
    <div class="notice notice-success">
      <p><?php _e( 'Settings successfully updated!', 'zeusmqclient-plugin' ); ?></p>
    </div>
  <?php endif; ?>

  <form action="?save-settings=true" method="post" id="zeusmqclient-plugin-settings" class="zeusmqclient-plugin-form">
    <fieldset class="zeusmqclient-plugin-fieldset">
      <h3>RabbitMQ Server Settings</h3>
      <label for="zeusmqclient_plugin_options[host]"><?php echo __('Host') ?>:
        <input type="text" name="zeusmqclient_plugin_options[host]" id="zeusmqclient_plugin_options[host]" autocomplete="off" placeholder="amqp://" class="zeusmqclient-plugin-textfield" value="<?php echo isset( $options['host'] ) ? esc_attr( $options['host'] ) : "" ?>">
      </label>
      <label for="zeusmqclient_plugin_options[port]"><?php echo __('Port') ?>:
        <input type="number" min=0 name="zeusmqclient_plugin_options[port]" id="zeusmqclient_plugin_options[port]" autocomplete="off" placeholder="5672" class="zeusmqclient-plugin-textfield" value="<?php echo isset( $options['port'] ) ? esc_attr( $options['port'] ) : 5672 ?>">
      </label>
      <label for="zeusmqclient_plugin_options[username]"><?php echo __('Username') ?>:
        <input type="text" name="zeusmqclient_plugin_options[username]" id="zeusmqclient_plugin_options[username]" autocomplete="off" placeholder="rabbitmq" class="zeusmqclient-plugin-textfield" value="<?php echo isset( $options['username'] ) ? esc_attr( $options['username'] ) : "" ?>">
      </label>
      <label for="zeusmqclient_plugin_options[password]"><?php echo __('Password') ?>
        <input type="password" name="zeusmqclient_plugin_options[password]" id="zeusmqclient_plugin_options[password]" autocomplete="off" placeholder="Password" class="zeusmqclient-plugin-textfield" value="<?php echo isset( $options['password'] ) ? esc_attr( $options['password'] ) : "" ?>">
      </label>
      <label for="zeusmqclient_plugin_options[connection_timeout]"><?php echo __('Connection Timeout') ?>:
        <input type="number" min=0 name="zeusmqclient_plugin_options[connection_timeout]" id="zeusmqclient_plugin_options[connection_timeout]" autocomplete="off" placeholder="10000" class="zeusmqclient-plugin-textfield" value="<?php echo isset( $options['connection_timeout'] ) ? esc_attr( $options['connection_timeout'] ) : 10000 ?>">
      </label>
      <label for="zeusmqclient_plugin_options[vhost]"><?php echo __('Virtual Host') ?>
        <input type="text" name="zeusmqclient_plugin_options[vhost]" id="zeusmqclient_plugin_options[vhost]" autocomplete="off" placeholder="/" class="zeusmqclient-plugin-textfield" value="<?php echo isset( $options['vhost'] ) ? esc_attr( $options['vhost'] ) : "" ?>">
      </label>
      <label for="zeusmqclient_plugin_options[exchange]"><?php echo __('Exchange') ?>
        <input type="text" name="zeusmqclient_plugin_options[exchange]" id="zeusmqclient_plugin_options[exchange]" autocomplete="off" placeholder="Exchange" class="zeusmqclient-plugin-textfield" value="<?php echo isset( $options['exchange'] ) ? esc_attr( $options['exchange'] ) : "" ?>">
      </label>
      <label for="zeusmqclient_plugin_options[queue]"><?php echo __('Queue') ?>
        <input type="text" name="zeusmqclient_plugin_options[queue]" id="zeusmqclient_plugin_options[queue]" autocomplete="off" placeholder="queue" class="zeusmqclient-plugin-textfield" value="<?php echo isset( $options['queue'] ) ? esc_attr( $options['queue'] ) : "" ?>">
      </label>
    </fieldset>
    <?php wp_nonce_field( 'zeusmqclient_plugin_nonce', 'zeusmqclient_plugin_nonce' ); ?>
      <input type="button" name="reset" id="reset" class="button button-secondary" value="Reset Fields">
    <?php submit_button(); ?>
  </form>
</div>