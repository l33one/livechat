<?php
include ("../../../inc/includes.php");

// Check if plugin is activated...
$plugin = new Plugin();
if (!$plugin->isInstalled('livechat') || !$plugin->isActivated('livechat')) {
   Html::displayNotFoundError();
}

//check for ACLs
if (PluginLivechatConfig::canView()) {
   //View is granted: display the list.
   //Add page header
   Html::header(
//      __('Livechat plugin', 'livechat'),
      PluginLivechatConfig::getTypeName(Session::getPluralNumber()),    
      $_SERVER['PHP_SELF'],
      'config',
      'PluginLivechatConfigmenu',
      'livechatconfig'
   );
   $config = new PluginLivechatConfig();
   Search::show('PluginLivechatConfig');

   Html::footer();
} else {
   //View is not granted.
   Html::displayRightError();
}
