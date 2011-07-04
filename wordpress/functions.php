<?php
function init_cscom() {
    if (!is_admin()) {
		$scripts = array(
			'jsapi' => 'https://www.google.com/jsapi',
			'jquery' => dirname(get_stylesheet_uri()) . '/jquery-init.js',
			'boxmeup' => dirname(get_stylesheet_uri()) . '/boxmeup.js'
		);
		foreach($scripts as $key => $url) {
			wp_deregister_script($key);
			wp_register_script($key, $url);
			wp_enqueue_script($key);
		}
    }
}    
 
add_action('init', 'init_cscom');