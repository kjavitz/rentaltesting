<?php

$workingDir = dirname(__FILE__);
if(strpos($workingDir,'.modman') > 0) {
    require_once $workingDir . '/../../../app/Mage.php';
}else{
    require_once $workingDir . '/../app/Mage.php';
}
Mage::init('admin');

$groups_value['template']['fields']['allow_symlink']['value'] = 1;
Mage::getModel('adminhtml/config_data')
    ->setSection('dev')
    ->setWebsite(null)
    ->setStore(null)
    ->setGroups($groups_value)
    ->save();
$groups_value['log']['fields']['active']['value'] = 1;
Mage::getModel('adminhtml/config_data')
    ->setSection('dev')
    ->setWebsite(null)
    ->setStore(null)
    ->setGroups($groups_value)
    ->save();

echo "<br/>Symlinks and logs activated";

?>