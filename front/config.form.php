<?php
include ("../../../inc/includes.php");

// Check if plugin is activated...
$plugin = new Plugin();
if (!$plugin->isInstalled('livechat') || !$plugin->isActivated('livechat')) {
   Html::displayNotFoundError();
}
$object = new PluginLivechatConfig();
//echo "criando form";
if (isset($_POST['add'])) {
   //Check CREATE ACL
   $object->check(-1, CREATE, $_POST);
   //Do object creation
   $newid = $object->add($_POST);
   //Redirect to newly created object form
   Html::redirect("{$CFG_GLPI['root_doc']}/plugins/front/myobject.form.php?id=$newid");
} else if (isset($_POST['update'])) {
   //Check UPDATE ACL
   $object->check($_POST['id'], UPDATE);
   //Do object update
   $object->update($_POST);
   //Redirect to object form
   Html::back();
} else if (isset($_POST['delete'])) {
   //Check DELETE ACL
   $object->check($_POST['id'], DELETE);
   //Put object in dustbin
   $object->delete($_POST);
   //Redirect to objects list
   $object->redirectToList();
} else if (isset($_POST['purge'])) {
   //Check PURGE ACL
   $object->check($_POST['id'], PURGE);
   //Do object purge
   $object->delete($_POST, 1);
   //Redirect to objects list
   Html::redirect("{$CFG_GLPI['root_doc']}/plugins/front/myobject.php");
} else {
   //per default, display object
   $withtemplate = (isset($_GET['withtemplate']) ? $_GET['withtemplate'] : 0);
   $object->display(
      [
         'id'           => $_GET['id'],
         'withtemplate' => $withtemplate
      ]
   );	
}
