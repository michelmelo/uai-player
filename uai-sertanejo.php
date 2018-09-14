<?php
/*
   Plugin Name: Uai Sertanejo
   Plugin URI: http://wordpress.org/extend/plugins/uai-sertanejo/
   Version: 0.0.1
   Author: Michel Melo
   Description: tab de player do uaisertanejo.com
   Text Domain: uai-sertanejo
   License: GPLv3
  */



$UaiSertanejo_minimalRequiredPhpVersion = '5.0';

/**
 * Check the PHP version and give a useful error message if the user's version is less than the required version
 * @return boolean true if version check passed. If false, triggers an error which WP will handle, by displaying
 * an error message on the Admin page
 */
function UaiSertanejo_noticePhpVersionWrong() {
    global $UaiSertanejo_minimalRequiredPhpVersion;
    echo '<div class="updated fade">' .
      __('Error: plugin "Uai Sertanejo" requires a newer version of PHP to be running.',  'uai-sertanejo').
            '<br/>' . __('Minimal version of PHP required: ', 'uai-sertanejo') . '<strong>' . $UaiSertanejo_minimalRequiredPhpVersion . '</strong>' .
            '<br/>' . __('Your server\'s PHP version: ', 'uai-sertanejo') . '<strong>' . phpversion() . '</strong>' .
         '</div>';
}


function UaiSertanejo_PhpVersionCheck() {
    global $UaiSertanejo_minimalRequiredPhpVersion;
    if (version_compare(phpversion(), $UaiSertanejo_minimalRequiredPhpVersion) < 0) {
        add_action('admin_notices', 'UaiSertanejo_noticePhpVersionWrong');
        return false;
    }
    return true;
}


/**
 * Initialize internationalization (i18n) for this plugin.
 * References:
 *      http://codex.wordpress.org/I18n_for_WordPress_Developers
 *      http://www.wdmac.com/how-to-create-a-po-language-translation#more-631
 * @return void
 */
function UaiSertanejo_i18n_init() {
    $pluginDir = dirname(plugin_basename(__FILE__));
    load_plugin_textdomain('uai-sertanejo', false, $pluginDir . '/languages/');
}


//////////////////////////////////
// Run initialization
/////////////////////////////////

// Initialize i18n
add_action('plugins_loadedi','UaiSertanejo_i18n_init');

// Run the version check.
// If it is successful, continue with initialization for this plugin
if (UaiSertanejo_PhpVersionCheck()) {
    // Only load and run the init function if we know PHP version can parse it
    include_once('uai-sertanejo_init.php');
    UaiSertanejo_init(__FILE__);
}
