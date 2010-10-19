<?php
/*
Plugin Name: VuzitWordPress
Plugin URI: http://www.vuzit.com
Description: Vuzit AJAX Document viewer WordPress plugin
Version: 1.0.1
Author: Brent Matzelle
Author URI: http://www.vuzit.com

Vuzit plugin for Wordpress, Copyright 2010 Brent Matzelle, Vuzit LLC

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

include_once "VuzitPHP/lib/vuzit.php";

/*----- BASE FUNCTIONS -----*/

// Returns a Vuzit error message. 
function vuzit_error($message)
{
  return '<div style="background-color:#f99; padding:10px;">' . 
         'Vuzit Error: ' .  $message . '</div>';
}

// Loads the Vuzit head includes.  
function vuzit_head()
{
  ?>
  <link href="http://vuzit.com/stylesheets/Vuzit-2.10.css" rel="Stylesheet" type="text/css" /> 
  <script src="http://vuzit.com/javascripts/Vuzit-2.10.js" type="text/javascript"></script> 
  <script src="<?php echo WP_PLUGIN_URL ?>/vuzitwordpress/core.js" type="text/javascript"></script> 
  <script type="text/javascript">
    var ___vuz = new Array();
  </script>
  <?php
}

/*----- VIEWER FUNCTIONS -----*/

$vuzit_viewer_index = 0;

// Render the body portion of the code. 
function vuzit_viewer_shortcode($atts, $content = null)
{
  $pub_key = $pri_key = $include = $watermark = null;
  $id = $url = null;
  $height = $width = $page = $zoom = -1;

	extract(shortcode_atts(array('pub_key' => null, 
                               'pri_key' => null, 
                               'id' => '', 
                               'url' => '', 
                               'width' => 400, 
                               'height' => 600, 
                               'page' => 0, 
                               'zoom' => 0, 
                               'include' => null, 
                               'watermark' => null), $atts));

  // Provide some simple validation
  if($pub_key == null) {
    return vuzit_error("Required parameter 'pub_key' is missing");
  }
  if(strlen($url) < 1 && strlen($id) < 1) {
    return vuzit_error("You need a 'url' or a 'id' parameter to load a document");
  }

  // Setup the service and create the signature
  Vuzit_Service::setPublicKey($pub_key);
  Vuzit_Service::setPrivateKey($pri_key);
  $timestamp = time();

  // Options for the signature
  $options = array();
  if($include != null) {
    $options["included_pages"] = $include;
  }

  if($watermark != null) {
    $options["watermark"] = $watermark;
  }
  $sig = rawurlencode(Vuzit_Service::signature("show", $id, $timestamp, $options));
  
  // Allows more than one viewer on a page
  global $vuzit_viewer_index;
  $div = "vuzit_viewer_" . $vuzit_viewer_index;

  // NOTE: The div needs to be created BEFORE the Event.observe is added
  $result = "\n";
  $result .= '<div id="' . $div . '" style="width: ' . $width . 
             'px; height: ' . $height . 'px;"></div>' . "\n";
  $result .= "<script type=\"text/javascript\">\n";

  $result .= "___vuz[$vuzit_viewer_index] = " .
             "{div: '$div', id: '$id', url: '$url', pub_key: '$pub_key', " .
             " signature: '$sig', timestamp: '$timestamp', page: $page, zoom: $zoom, " .
             "include: '$include', watermark: '$watermark'};\n";

  // We only want to call the Event.observe one time
  if($vuzit_viewer_index < 1) {
    $result .= "vuzit.Event.observe(window, 'load', vuzitViewer);\n";
  }
  $result .= "</script> \n";
  
  // Increment so you can have more than one viewer on a page
  $vuzit_viewer_index += 1;
  
  return $result;
}

// Register plugin with WordPress
add_shortcode('vuzit_viewer', 'vuzit_viewer_shortcode');
add_action('wp_head', 'vuzit_head');
?>
