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

/**
 * Delete all specials
 */
$specials = Mage::getModel('payperrentals/reservationpricesdates')->getCollection();
foreach ($specials as $special) {
    try {
        $special->delete();
    } catch(Exception $e) {
        echo "Special #".$special->getId()." could not be remvoved: ".$e->getMessage();
    }
}

/**
 * Insert special price
 */

    $respricedate = Mage::getModel('payperrentals/reservationpricesdates');
    $data['description'] = 's4';
    $data['disabled_type'] = 'Monthly';
    $data['date_from'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('01/25/2015 00:00:00');
    $data['date_to'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('01/26/2015 00:00:00');
    $respricedate->setData($data);
    $respricedate->save();


/**
 * Add color attribute to attribute set default
 */

$fieldList = array('color');
$applyTo = array('simple', 'reservation');
$setupModel =  Mage::getResourceModel('catalog/setup', 'core_setup');

foreach ($fieldList as $_field) {
    $setupModel->updateAttribute(Mage_Catalog_Model_Product::ENTITY, $_field, 'apply_to', implode(',', $applyTo));
}

$attribute_set_name = 'Default';
$group_name = 'General';
$attribute_code = 'color';

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

//-------------- add attribute to set and group
$attribute_set_id=$setup->getAttributeSetId('catalog_product', $attribute_set_name);
$attribute_group_id=$setup->getAttributeGroupId('catalog_product', $attribute_set_id, $group_name);
$attribute_id=$setup->getAttributeId('catalog_product', $attribute_code);

$setup->addAttributeToSet($entityTypeId='catalog_product',$attribute_set_id, $attribute_group_id, $attribute_id);


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
 * Relation product category
 */

$dataRelation = array();
$dataRelation[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    '_sku' => 'c1',
    'position' => 1

);
$dataRelation[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    '_sku' => 'c2',
    'position' => 2
);
$dataRelation[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    '_sku' => 'simple1',
    'position' => 3
);
$dataRelation[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    '_sku' => 'simple2',
    'position' => 4
);

$dataRelation[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    '_sku' => 'configurable1',
    'position' => 5
);
$dataRelation[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    '_sku' => 'bundle113',
    'position' => 6

);
$dataRelation[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    '_sku' => 's1',
    'position' => 7
);
$dataRelation[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    '_sku' => 's2',
    'position' => 8

);

$dataRelation[] = array(
    '_root' => 'Default Category',
    '_category' => 'Test3',
    '_sku' => 'bundle11',
    'position' => 8

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
