<?php

/**
 * WARNING: This file is part of the core ThemeFuse Framework. It is not recommended to edit this section
 *
 * @package ThemeFuse
 * @since 2.0
 */


require_once(TEMPLATEPATH . '/framework/BootsTrap.php');
require_once(TEMPLATEPATH . '/theme_config/theme_includes/AJAX_CALLBACKS.php');


function hide_notices_dashboard() {
    global $wp_filter;
 
    if (is_network_admin() and isset($wp_filter["network_admin_notices"])) {
        unset($wp_filter['network_admin_notices']);
    } elseif(is_user_admin() and isset($wp_filter["user_admin_notices"])) {
        unset($wp_filter['user_admin_notices']);
    } else {
        if(isset($wp_filter["admin_notices"])) {
            unset($wp_filter['admin_notices']);
        }
    }
 
    if (isset($wp_filter["all_admin_notices"])) {
        unset($wp_filter['all_admin_notices']);
    }
}
add_action( 'admin_init', 'hide_notices_dashboard' );?>


 