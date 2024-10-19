<?php

/**
 * Plugin Name: Member Directory Portal
 * Plugin URI: https://facebook.com
 * Description: Member Directory Portal connector for GHL App
 * Version: 1.0.0
 * Author: Jundell
 * Author URI: mailto:jundell@ad-ios.com
 * License: GPL-2.0+
 * Text Domain: memberdirectoryportal
 * Domain Path: /languages
 */

define("MDP_PLUGIN_URI", plugin_dir_url( __FILE__ ));

define("MDP_PLUGIN_DIR", __DIR__ );


 require_once MDP_PLUGIN_DIR . '/post_types.php';

 require_once MDP_PLUGIN_DIR . '/menubar.php';


  /**
   * 
   * Channels
   * 
   */

require_once MDP_PLUGIN_DIR . '/hooks/channel_delete.php';

require_once MDP_PLUGIN_DIR . '/hooks/channel_upsert.php';


require_once MDP_PLUGIN_DIR . '/hooks/channel_upsert_category.php';

require_once MDP_PLUGIN_DIR . '/hooks/channel_delete_category.php';


require_once MDP_PLUGIN_DIR . '/hooks/channel_upsert_tag.php';

require_once MDP_PLUGIN_DIR . '/hooks/channel_delete_tag.php';



/**
 * 
 * Members
 * 
 */


 require_once MDP_PLUGIN_DIR . '/hooks/member_delete.php';

 require_once MDP_PLUGIN_DIR . '/hooks/member_upsert.php';
 
 
 require_once MDP_PLUGIN_DIR . '/hooks/member_upsert_category.php';
 
 require_once MDP_PLUGIN_DIR . '/hooks/member_delete_category.php';
 
 
 require_once MDP_PLUGIN_DIR . '/hooks/member_upsert_tag.php';
 
 require_once MDP_PLUGIN_DIR . '/hooks/member_delete_tag.php';


 /**
  *
  * Posts 
  *
  */

require_once MDP_PLUGIN_DIR . '/hooks/post_upsert.php';

require_once MDP_PLUGIN_DIR . '/hooks/post_delete.php';
  

require_once MDP_PLUGIN_DIR . '/webhook.php';

require_once MDP_PLUGIN_DIR . '/shortcode.php';

require_once MDP_PLUGIN_DIR . '/template.php';

require_once MDP_PLUGIN_DIR . '/assets.php';