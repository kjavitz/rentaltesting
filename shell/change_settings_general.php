<?php
/**
 * usage eq for:
 * allow_symlinks: change_settings_general?section=dev&group=template&field=allow_symlink&value=1
 * enable logs: change_settings_general?section=dev&group=log&field=active&value=1
 * change template to rwd: change_settings_general?section=design&group=package&field=name&value=rwd
 */

$section = isset($_GET['section']) ? $_GET['section'] : false;
$group = isset($_GET['group']) ? $_GET['group'] : false;
$field = isset($_GET['field']) ? $_GET['field'] : false;
$value = isset($_GET['value']) ? $_GET['value'] : false;

//access with parameter ?MAGE_RUN_CODE=store_name
$workingDir = dirname(__FILE__);
if (strpos($workingDir, '.modman') > 0) {
    require_once $workingDir . '/../../../app/Mage.php';
} else {
    require_once $workingDir . '/../app/Mage.php';
}
Mage::init('admin');

if ($section && $group && $field && $value !== false) {

    $groups_value[$group]['fields'][$field]['value'] = $value;
    Mage::getModel('adminhtml/config_data')
        ->setSection($section)
        ->setWebsite(null)
        ->setStore(null)
        ->setGroups($groups_value)
        ->save();
}

?>