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
class PluginLivechatConfigmenu extends CommonGLPI {

    static $rightname = 'plugin_livechat_config';
 
    static function getMenuName() {
       return __("LDAP computers config", "livechat");
    }
 
    static function getMenuContent() {
 
       if (!Session::haveRight('plugin_livechat_config', READ)) {
          return;
       }
 
       $front_livechat = "/plugins/livechat/front";
       $menu = [];
       $menu['title'] = self::getMenuName();
       $menu['page']  = "$front_livechat/config.php";
       $menu['links']['search'] = PluginlivechatConfig::getSearchURL(false);
 
       if (PluginlivechatConfig::canCreate()) {
          $menu['links']['add'] = PluginlivechatConfig::getFormURL(false);
       }
       return $menu;
    }
 }
 