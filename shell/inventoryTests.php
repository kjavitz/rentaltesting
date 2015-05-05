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


$data = array(
    array(
        'sku' => 's1',
        '_type' => 'simple',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Just Simple 1',
        'options_container' => 'product info column',
        'description' => 'Default',
        'short_description' => 'Default',
        'weight' => 1,
        'status' => 1,
        'price' => 10,
        'qty' => 2,
        'visibility' => 4,
        'tax_class_id' => 2,
        'manage_stock' => 1,
        'is_in_stock' => 1,
        'color' => 'red',
    ),
    array(
        'sku' => 's2',
        '_type' => 'simple',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Just simple 2',
        'description' => 'Default',
        'short_description' => 'Default',
        'manage_stock' => 1,
        'is_in_stock' => 1,
        'weight' => 1,
        'price' => 20,
        'qty' => 10,
        'status' => 1,
        'visibility' => 4,
        'tax_class_id' => 2,
        'color' => 'green'
    )
);

try {
    $import
        ->processProductImport($data);
} catch (Exception $e) {
    print_r($import->getErrorMessages());
}

/**
 * Create configurable products
 */

$data = array(
    array(
        'sku' => 'c1',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Res config 1',
        'options_container' => 'product info column',
        'description' => 'Default',
        'short_description' => 'Default',
        'weight' => 1,
        'status' => 1,
        'visibility' => 4,
        'tax_class_id' => 2,
        'manage_stock' => 0,
        'use_config_manage_stock' => 0,
        'is_in_stock' => 1,
        'is_reservation' => 'Reservation',
        'color' => 'red',
        /*Reservation variable*/
        'res_prices' => '1=Day=1=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1;1=Day=5=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1=1',
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
        'sku' => 'c2',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Res config 2',
        'description' => 'Default',
        'short_description' => 'Default',
        'manage_stock' => 0,
        'use_config_manage_stock' => 0,
        'is_in_stock' => 1,
        'weight' => 1,
        'status' => 1,
        'visibility' => 4,
        'tax_class_id' => 2,
        'is_reservation' => 'Reservation',
        'color' => 'green',

        /*Reservation variable*/
        'res_prices' => '1=Day=1=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1;1=Week=5=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1;1=Month=10=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1;1=Week=15=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1=1',
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
        'sku' => 'configurable1',
        '_type' => 'configurable',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Res Configurable Product',
        'description' => 'Default',
        'short_description' => 'Default',
        'manage_stock' => 0,
        'use_config_manage_stock' => 0,
        'is_in_stock' => 1,
        'status' => 1,
        'price' => 10,
        'visibility' => 4,
        'tax_class_id' => 2,
        'is_reservation' => 'Reservation',
        '_super_attribute_code' => 'color',
        '_super_products_sku' => array('c1', 'c2'),
    ),
);

try {
    $import
        ->setDropdownAttributes('color')
        ->setUseNestedArrays(true)
        ->processProductImport($data);
} catch (Exception $e) {
    print_r($import->getErrorMessages());
}

/**
 * Create bundle Products
 */

$data = array(
    array(
        'sku' => 'simple113',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Res bundle 1',
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
        'res_prices' => '1=Day=1=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1;1=Day=5=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1=1',
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
        'sku' => 'simple231',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Res bundle 2',
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
        'res_prices' => '1=Hour=1=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1;1=Day=8=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1',
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
        'sku' => 'bundle113',
        '_type' => 'bundle',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Res Bundle Product1',
        'description' => 'Default',
        'short_description' => 'Default',
        'manage_stock' => 0,
        'use_config_manage_stock' => 0,
        'is_in_stock' => 1,
        'status' => 1,
        'visibility' => 4,
        'tax_class_id' => 2,
        'price_view' => 'as low as',
        'price_type' => 1,
        'price' => 100,
        'is_reservation' => 'Reservation',
        '_bundle_option_title' => array('Option 1', 'Option 1'),
        '_bundle_option_type' => 'select',
        '_bundle_option_position' => 1,
        '_bundle_option_required' => 1,
        '_bundle_product_sku' => array('simple113', 'simple231'),
        '_bundle_product_position' => array(1, 2),
        '_bundle_product_is_default' => array(true, false),
        '_bundle_product_qty' => array(1, 2),
        '_bundle_product_price_value' => array(10, 20),
        '_bundle_product_can_change_qty' => array(1, 0),
    )
);
try {
    $import
        ->setUseNestedArrays(true)
        ->processProductImport($data);
} catch (Exception $e) {
    print_r($import->getErrorMessages());
}

$data = array(
    array(
        'sku' => 'simple11',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Res bundle 3',
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
        'sku' => 'simple21',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Res bundle 4',
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
        'sku' => 'bundle11',
        '_type' => 'bundle',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Res Bundle Product2',
        'description' => 'Default',
        'short_description' => 'Default',
        'manage_stock' => 0,
        'use_config_manage_stock' => 0,
        'is_in_stock' => 1,
        'status' => 1,
        'visibility' => 4,
        'tax_class_id' => 2,
        'price_view' => 'as low as',
        'price_type' => 1,
        'price' => 100,
        'is_reservation' => 'Reservation',
        'res_prices' => '1=Day=1=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1;1=Day=5=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1=1;1=Week=15=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1',
        'bundle_pricingtype' => 'For all',
        '_bundle_option_title' => array('Option 1', 'Option 1'),
        '_bundle_option_type' => 'checkbox',
        '_bundle_option_position' => 1,
        '_bundle_option_required' => 1,
        '_bundle_product_sku' => array('simple11', 'simple21'),
        '_bundle_product_position' => array(1, 2),
        '_bundle_product_is_default' => array(true, false),
        '_bundle_product_qty' => array(1, 2),
        '_bundle_product_price_value' => array(10, 20),
        '_bundle_product_can_change_qty' => array(1, 1),
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
