<?php
/*
 -------------------------------------------------------------------------
 livechat plugin for GLPI
 Copyright (C) 2019 by the livechat Development Team.

 https://github.com/pluginsGLPI/livechat
 -------------------------------------------------------------------------

 LICENSE

 This file is part of livechat.

 livechat is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 livechat is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with livechat. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

 /**
 * Plugin install process
 *
 * @return boolean
 */
function plugin_livechat_install() {
	global $DB;

   //instanciate migration with version
   $migration = new Migration(100);

   //Create table only if it does not exists yet!
   if (!$DB->tableExists('glpi_plugin_livechat_configs')) {
      //table creation query
      $query = "CREATE TABLE `glpi_plugin_livechat_configs` (
                  `id` INT(11) NOT NULL auto_increment,
                  `name` VARCHAR(255) NOT NULL,
                  PRIMARY KEY  (`id`)
               ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
      $DB->queryOrDie($query, $DB->error());
   }

    if ($DB->tableExists('glpi_plugin_livechat_configs')) {
      //missed value for configuration
      $migration->addField(
         'glpi_plugin_livechat_configs',
         'value',
         'string'
      );

      $migration->addKey(
         'glpi_plugin_livechat_configs',
         'name'
      );
   }


   //execute the whole migration
   $migration->executeMigration();
   return true;
}

function plugin_livechat_uninstall() {
	global $DB;	
   $tables = [
      'configs'
   ];

   foreach ($tables as $table) {
      $tablename = 'glpi_plugin_livechat_' . $table;
      //Create table only if it does not exists yet!
      if ($DB->tableExists($tablename)) {
         $DB->queryOrDie(
            "DROP TABLE `$tablename`",
            $DB->error()
         );
      }
   }
     
	return true;
}
