<?php
/*
Plugin Name: N8N WP
Description: Gera um token e cria uma API segura para integração com o n8n.
Version: 1.1
Author: rodolfok
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: n8n-wp
*/

if (!defined('ABSPATH')) exit;

define('N8N_WP_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Carrega APIs
require_once N8N_WP_PLUGIN_DIR . 'includes/api.php';

// Adiciona página no admin
add_action('admin_menu', function () {
    add_menu_page('n8n WP', 'n8n WP', 'manage_options', 'n8n-wp', 'n8n_wp_settings_page');
});

function n8n_wp_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( isset( $_SERVER['REQUEST_METHOD'] ) && $_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer( 'n8n_wp_token_action' ) ) {
        $token = bin2hex( random_bytes( 32 ) );
        update_option( 'n8n_wp_token', $token );
        echo '<div class="updated"><p>' . esc_html__( 'Token gerado: ', 'n8n-wp' ) . '<code>' . esc_html( $token ) . '</code></p></div>';
    }

    $token = get_option( 'n8n_wp_token' );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Token para n8n', 'n8n-wp' ); ?></h1>
        <form method="post">
            <?php wp_nonce_field( 'n8n_wp_token_action' ); ?>
            <p><?php esc_html_e( 'Token atual:', 'n8n-wp' ); ?> <code><?php echo esc_html( $token ); ?></code></p>
            <p><input type="submit" class="button button-primary" value="<?php esc_attr_e( 'Gerar novo token', 'n8n-wp' ); ?>"></p>
        </form>
    </div>
    <?php
}