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

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access directly to this file");
}


class PluginLivechatConfig extends CommonDBTM {
	
 	static $rightname = 'plugin_ldapcomputers_view';
	/*
	static function getTypeName($nb = 0) {
      		return _n('View Livechat Config', 'View Livechat Config', $nb, 'livechat');
   	}

	static function canCreate() {
      		return false;
   	}

	static function canPurge() {
      		return static::canUpdate();
	}
	 */

  public function showForm($ID, $options = []) {
      global $CFG_GLPI;

      $this->initForm($ID, $options);
      $this->showFormHeader($options);

      if (!isset($options['display'])) {
         //display per default
         $options['display'] = true;
      }

      $params = $options;
      //do not display called elements per default; they'll be displayed or returned here
      $params['display'] = false;

      $out = '<tr>';
      $out .= '<th>' . __('My label', 'myexampleplugin') . '</th>';

      $objectName = autoName(
         $this->fields["name"],
         "name",
         (isset($options['withtemplate']) && $options['withtemplate']==2),
         $this->getType(),
         $this->fields["entities_id"]
      );

      $out .= '<td>';
      $out .= Html::autocompletionTextField(
         $this,
         'name',
         [
            'value'     => $objectName,
            'display'   => false
         ]
      );
      $out .= '</td>';

      $out .= $this->showFormButtons($params);

      if ($options['display'] == true) {
         echo $out;
      } else {
         return $out;
      }
      
   }	

   function defineTabs($options = []) {
      $ong = [];
      $this->addDefaultFormTab($ong);
      $this->addStandardTab(__CLASS__, $ong, $options);
      $this->addStandardTab('Log', $ong, $options);
      return $ong;
   }

   
	
}
