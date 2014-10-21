<?php
//access with parameter ?MAGE_RUN_CODE=store_name
$workingDir = dirname(__FILE__);
if(strpos($workingDir,'.modman') > 0) {
    require_once $workingDir . '/../../../app/Mage.php';
}else{
    require_once $workingDir . '/../app/Mage.php';
}
Mage::init('admin');

#addWebsite
$storeName = 'shoes';
/** @var $website Mage_Core_Model_Website */
$website = Mage::getModel('core/website');
$website->setCode($storeName.'website')
    ->setName($storeName)
    ->save();
$category = Mage::getResourceModel('catalog/category_collection')
    ->addFieldToFilter('name', 'Default Category')
    ->getFirstItem();
$category_id = $category->getId();
//#addStoreGroup
/** @var $storeGroup Mage_Core_Model_Store_Group */
$storeGroup = Mage::getModel('core/store_group');
$storeGroup->setWebsiteId($website->getId())
    ->setName($storeName)
    ->setRootCategoryId($category_id)
    ->save();

//#addStore
/** @var $store Mage_Core_Model_Store */
$store = Mage::getModel('core/store');
$store->setCode($storeName)
    ->setWebsiteId($storeGroup->getWebsiteId())
    ->setGroupId($storeGroup->getId())
    ->setName($storeName)
    ->setIsActive(1)
    ->save();

echo 'Store '.$storeName. ' created!';