<?php
/*
 -------------------------------------------------------------------------
 Livechat plugin for GLPI
 Copyright (C) 2020 by the livechat Development Team.

 https://github.com/pluginsGLPI/livechat
 -------------------------------------------------------------------------

 LICENSE

 This file is part of Livechat.

 Livechat is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Livechat is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Livechat. If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------------

   @package   Plugin livechat
   @author    Leewan Meneses
   @co-author
   @copyright Copyright (c) 2009-2016 Barcode plugin Development team
   @license   AGPL License 3.0 or (at your option) any later version
              http://www.gnu.org/licenses/agpl-3.0-standalone.html
   @link      https://github.com/akm77/livechat
   @since     2020


 --------------------------------------------------------------------------
 */

define('PLUGIN_LIVECHAT_VERSION', '1.0.4');
// Minimal GLPI version, inclusive
define('PLUGIN_LIVECHAT_MIN_GLPI', '9.2');
// Maximum GLPI version, exclusive
define('PLUGIN_LIVECHAT_MAX_GLPI', '9.5');

/**
 * Init hooks of the plugin.
 * REQUIRED
 *
 * @return void
 */
function plugin_init_livechat() {
   global $PLUGIN_HOOKS;

   $PLUGIN_HOOKS['csrf_compliant']['livechat'] = true;

   $plugin = new Plugin();
   if ($plugin->isInstalled('livechat') && $plugin->isActivated('livechat')) {

      
      $PLUGIN_HOOKS['config_page']['livechat'] = 'config.php';
      $PLUGIN_HOOKS['add_javascript']['livechat'] = 'livechat.js';
      
   }

   
}


/**
 * Get the name and the version of the plugin
 * REQUIRED
 *
 * @return array
 */
function plugin_version_livechat() {
   return [
      'name'           => __('Livechat', 'livechat'),
      'version'        => PLUGIN_LIVECHAT_VERSION,
      'author'         => '<a href="https://github.com/l33one/livechat">Leewan Meneses</a>',
      'license'        => 'AGPLv3+',
      'homepage'       => 'https://github.com/l33one/livechat',
      'requirements'   => [
         'glpi' => [
            'min' => PLUGIN_LIVECHAT_MIN_GLPI,
            //'max' => PLUGIN_LIVECHAT_MAX_GLPI,
         ]
      ]
   ];
}

/**
 * Check pre-requisites before install
 * OPTIONNAL, but recommanded
 *
 * @return boolean
 */
function plugin_livechat_check_prerequisites() {

   return true;
}

/**
 * Check configuration process
 *
 * @param boolean $verbose Whether to display message on failure. Defaults to false
 *
 * @return boolean
 */
function plugin_livechat_check_config($verbose = false) {
   if (true) { // Your configuration check
      return true;
   }

   if ($verbose) {
      echo __('Installed / not configured', 'livechat');
   }
   return false;
}

