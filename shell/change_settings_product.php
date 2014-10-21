<?php
$sku = isset($_GET['sku'])?$_GET['sku']:false;
$attribute = isset($_GET['sku'])?$_GET['sku']:false;
$value = isset($_GET['value'])?$_GET['value']:false;

//access with parameter ?MAGE_RUN_CODE=store_name
$workingDir = dirname(__FILE__);
if(strpos($workingDir,'.modman') > 0) {
    require_once $workingDir . '/../../../app/Mage.php';
}else{
    require_once $workingDir . '/../app/Mage.php';
}
Mage::init('admin');

if($sku && $attribute && $value) {

    $product = Mage::getModel('catalog/product')->loadByAttribute('sku', $sku);
    Mage::getSingleton('catalog/product_action')
    ->updateAttributes(array($product->getId()), array($attribute => $value), 0);

}
?>