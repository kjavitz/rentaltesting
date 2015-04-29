<?php

$workingDir = dirname(__FILE__);
if(strpos($workingDir,'.modman') > 0) {
    require_once $workingDir . '/../../../app/Mage.php';
}else{
    require_once $workingDir . '/../app/Mage.php';
}
Mage::init('admin');

/**
 * Delete all products
 */
$products = Mage::getModel('catalog/product')->getCollection();
foreach ($products as $product) {
    try {
        $product->delete();
    } catch(Exception $e) {
        echo "Product #".$product->getId()." could not be remvoved: ".$e->getMessage();
    }
}


/** @var $import AvS_FastSimpleImport_Model_Import */
$import = Mage::getModel('fastsimpleimport/import');
/**
 * Create Category
 */

$dataCat = array();
$dataCat[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    'name' => 'Test3',
    'description' => 'Test3',
    'is_active' => 'yes',
    'include_in_menu' => 'yes',
    'meta_description' => 'Meta Test',
    'available_sort_by' => 'position',
    'default_sort_by' => 'position',
);

try {
    $import->processCategoryImport($dataCat);
} catch (Exception $e) {
    print_r($import->getErrorMessages());
}

/**
 * Create Res Products
 */

$data = array(
    array(
        'sku' => 'product1',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Product 1',
        'description' => 'Default',
        'short_description' => 'Default',
        'manage_stock' => 0,
        'use_config_manage_stock' => 0,
        'is_in_stock' => 1,
        'status' => 1,
        'weight' => 1,
        'visibility' => 4,
        'tax_class_id' => 2,
        'is_reservation' => 'Reservation',
        /*Reservation variable*/
        'res_prices' => '1=Day=5=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=2=Day=-1',
        'payperrentals_quantity' => 3,
        'global_min_period' => 'Yes',
        'global_max_period' => 'Yes',
        'global_turnover_after' => 'Yes',
        'global_turnover_before' => 'Yes',
        'disabled_with_message' => 'Disabled',
        'global_excludedays' => 'Yes',
        'allow_overbooking' => 'Disabled',
        'use_global_dates' => 'Yes',
        'use_global_padding_days' => 'Yes',
        /*End Reservation Variables*/
    ),
    array(
        'sku' => 'product2',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Product 2',
        'description' => 'Default',
        'short_description' => 'Default',
        'manage_stock' => 0,
        'use_config_manage_stock' => 0,
        'is_in_stock' => 1,
        'status' => 1,
        'weight' => 1,
        'visibility' => 4,
        'tax_class_id' => 2,
        'is_reservation' => 'Reservation',
        /*Reservation variable*/
        'res_prices' => '1=Day=5=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1;1=Week=20=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1;1=Month=40=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1',
        'payperrentals_quantity' => 3,
        'global_min_period' => 'Yes',
        'global_max_period' => 'Yes',
        'global_turnover_after' => 'Yes',
        'global_turnover_before' => 'Yes',
        'disabled_with_message' => 'Disabled',
        'global_excludedays' => 'Yes',
        'allow_overbooking' => 'Disabled',
        'use_global_dates' => 'Yes',
        'use_global_padding_days' => 'Yes',
        /*End Reservation Variables*/
    ),
    array(
        'sku' => 'product3',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Product 3',
        'description' => 'Default',
        'short_description' => 'Default',
        'manage_stock' => 0,
        'use_config_manage_stock' => 0,
        'is_in_stock' => 1,
        'status' => 1,
        'weight' => 1,
        'visibility' => 4,
        'tax_class_id' => 2,
        'is_reservation' => 'Reservation',
        /*Reservation variable*/
        'res_prices' => '1=Week=20=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=3=Day=-1;1=Month=40=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=5=Day=-1;3=Month=100=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1',
        'payperrentals_quantity' => 3,
        'global_min_period' => 'Yes',
        'global_max_period' => 'Yes',
        'global_turnover_after' => 'Yes',
        'global_turnover_before' => 'Yes',
        'disabled_with_message' => 'Disabled',
        'global_excludedays' => 'Yes',
        'allow_overbooking' => 'Disabled',
        'use_global_dates' => 'Yes',
        'use_global_padding_days' => 'Yes',
        /*End Reservation Variables*/
    )
);
try {
    $import
        ->setUseNestedArrays(true)
        ->processProductImport($data);
} catch (Exception $e) {
    print_r($import->getErrorMessages());
}



/**
 * Relation product category
 */

$dataRelation = array();
$dataRelation[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    '_sku' => 'product1',
    'position' => 1

);
$dataRelation[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    '_sku' => 'product2',
    'position' => 2
);
$dataRelation[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    '_sku' => 'product3',
    'position' => 3
);
try {
    $import->processCategoryProductImport($dataRelation);
} catch (Exception $e) {
    print_r($import->getErrorMessages());
}

$indexingProcesses = Mage::getSingleton('index/indexer')->getProcessesCollection();
foreach ($indexingProcesses as $process) {
    $process->reindexEverything();
}

echo 'Products are imported.Reindex is done';






/*
function updateCategories($id, $categoryIds)
{
    $dbw = Mage::getSingleton('core/resource')->getConnection('core_write');
    $productCategoryTable = Mage::getSingleton('core/resource')->getTableName('catalog/category_product');

    $oldCategoryIds = array();

    $insert = array_diff($categoryIds, $oldCategoryIds);
    $delete = array_diff($oldCategoryIds, $categoryIds);

    if (!empty($insert)) {
        $data = array();
        foreach ($insert as $categoryId) {
            if (empty($categoryId)) {
                continue;
            }
            $data[] = array(
                'category_id' => (int)$categoryId,
                'product_id'  => (int)$id,
                'position'    => 1
            );
        }
        if ($data) {
            $ris = $dbw->insertMultiple($productCategoryTable, $data);
        }
    }
    if (!empty($delete)) {
        foreach ($delete as $categoryId) {
            $where = array(
                'product_id = ?'  => (int)$id,
                'category_id = ?' => (int)$categoryId,
            );
            $ris = $dbw->delete($productCategoryTable, $where);
        }
    }
}
*/

/*$category = Mage::getResourceModel('catalog/category_collection')
        ->addFieldToFilter('name', 'Test3')
        ->getFirstItem();
$category_id = $category->getId();
*/
//$allProducts = Mage::getModel('catalog/product')->getCollection();

/*foreach($allProducts as $product){
    $product->setWeight(2);
    $product->save();
}*/
/*
$ids = Mage::getModel('catalog/product')->getCollection()->getAllIds();
foreach($ids as $id) {
    $product = Mage::getModel('catalog/product')->load($id);
    $product->setWeight(3);
    //Mage::getModel('catalog/product_url')->formatUrlKey( $product->getName() );
    $product->setDataChanges(true);
    $product->save();
}
*/
/*
 $read = Mage::getSingleton('core/resource')->getConnection('core_read');
$urlKey = Mage::getModel('catalog/product_url')->formatUrlKey($productName);
$sql = 'SELECT * FROM catalog_product_entity_varchar WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'url_key' AND entity_type_id = 4) AND value = ? and store_id = 0';
$row = $read->fetchRow($sql, array($urlKey));
$idx = 1;
while ($row != false) {
    $urlKey = Mage::getModel('catalog/product_url')->formatUrlKey($productName) . '-' . $idx;
    $idx++;
    $row = $read->fetchRow($sql, array($urlKey));
}
 */



/*Mage::getSingleton('catalog/product_action')
    ->updateAttributes($ids, array('name'=>2), 0);
*/
/*
//$resource = Mage::getSingleton('core/resource');
//$write = $resource->getConnection('core_write');
try
{
    foreach($ids as $id) {
        //$write->query("replace into`".$resource->getTableName('catalog/category_product')."` (category_id,product_id,position) VALUES (?,?,0)", array($category_id, $id));
        //Mage::getSingleton('catalog/category_api')->assignProduct($category_id, $id);
        updateCategories($id, $category_id);
    }


}
catch(Exception $e) {
    Mage::log(print_r($e,true), null, 'exception.log');
}
*/
