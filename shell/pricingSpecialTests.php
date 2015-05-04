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
    $data['disabled_type'] = 'Yearly';
    $data['date_from'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/04/2015 00:00:00');
    $data['date_to'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/05/2015 00:00:00');
    $respricedate->setData($data);
    $respricedate->save();
    $s4 = $respricedate->getId();
    $respricedate = Mage::getModel('payperrentals/reservationpricesdates');
    $data['description'] = 's5';
    $data['disabled_type'] = 'Monthly';
    $data['date_from'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/01/2015 00:00:00');
    $data['date_to'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/02/2015 00:00:00');
    $respricedate->setData($data);
    $respricedate->save();
    $s5 = $respricedate->getId();
    $respricedate = Mage::getModel('payperrentals/reservationpricesdates');
    $data['description'] = 's6';
    $data['disabled_type'] = 'Weekly';
    $data['date_from'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/09/2015 00:00:00');
    $data['date_to'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/10/2015 00:00:00');
    $respricedate->setData($data);
    $respricedate->save();
    $s6 = $respricedate->getId();
    $respricedate = Mage::getModel('payperrentals/reservationpricesdates');
    $data['description'] = 's7';
    $data['disabled_type'] = 'Weekly';
    $data['date_from'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/08/2015 00:00:00');
    $data['date_to'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/11/2015 00:00:00');
    $respricedate->setData($data);
    $respricedate->save();
    $s7 = $respricedate->getId();
    $respricedate = Mage::getModel('payperrentals/reservationpricesdates');
    $data['description'] = 's8';
    $data['disabled_type'] = 'Monthly';
    $data['date_from'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/05/2015 00:00:00');
    $data['date_to'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/08/2015 00:00:00');
    $respricedate->setData($data);
    $respricedate->save();
    $s8 = $respricedate->getId();
    $respricedate = Mage::getModel('payperrentals/reservationpricesdates');
    $data['description'] = 's9';
    $data['disabled_type'] = 'Monthly';
    $data['date_from'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/09/2015 00:00:00');
    $data['date_to'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/12/2015 00:00:00');
    $respricedate->setData($data);
    $respricedate->save();
    $s9 = $respricedate->getId();
    $respricedate = Mage::getModel('payperrentals/reservationpricesdates');
    $data['description'] = 's10';
    $data['disabled_type'] = 'Monthly';
    $data['date_from'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/13/2015 00:00:00');
    $data['date_to'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/13/2015 00:00:00');
    $respricedate->setData($data);
    $respricedate->save();
    $s10 = $respricedate->getId();
    $respricedate = Mage::getModel('payperrentals/reservationpricesdates');
    $data['description'] = 's11';
    $data['disabled_type'] = 'Monthly';
    $data['date_from'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/16/2015 00:00:00');
    $data['date_to'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/22/2015 00:00:00');
    $respricedate->setData($data);
    $respricedate->save();
    $s11 = $respricedate->getId();
    $respricedate = Mage::getModel('payperrentals/reservationpricesdates');
    $data['description'] = 's12';
    $data['disabled_type'] = 'Daily';
    $data['repeat_days'] = '1,2,3,4,5,6,0';
    $data['date_from'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/19/2015 15:00:00');
    $data['date_to'] = ITwebexperts_Payperrentals_Helper_Date::toMysqlDate('05/19/2015 17:00:00');
    $respricedate->setData($data);
    $respricedate->save();
    $s12 = $respricedate->getId();
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
        'sku' => 'product4',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Product 4',
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
        'res_prices' => '1=Week=20=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=5=Day=-1;1=Week=100=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=20=Day=-1='.$s4,
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
        'sku' => 'product5',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Product 5',
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
        'res_prices' => '1=Day=10=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=5=Day=-1;1=Day=50=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=25=Day=-1='.$s6,
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
        'sku' => 'product6',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Product 6',
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
        'res_prices' => '1=Day=20=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1='.$s5.';1=Day=10=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1',
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
        'sku' => 'product7',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Product 7',
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
        'res_prices' => '1=Day=20=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1='.$s5,
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
        'sku' => 'product8',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Product 8',
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
        'res_prices' => '1=Day=95=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1;3=Day=95=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1='.$s7.';6=Day=285=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1',
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
        'sku' => 'product9',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Product 9',
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
        'res_prices' => '5=Day=30=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=5=Day=-1;3=Day=10=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1='.$s8.';2=Day=15=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=7=Day=-1='.$s9.';1=Day=20=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1='.$s10.';3=Day=25=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=0=Minute=-1='.$s11,
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
        'sku' => 'product10',
        '_type' => 'reservation',
        '_attribute_set' => 'Default',
        '_product_websites' => 'base',
        'name' => 'Product 10',
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
        'res_prices' => '1=Hour=10=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=5=Hour=-1;1=Hour=100=0=0=0000-00-00 00:00:00=0000-00-00 00:00:00=50=Hour=-1='.$s12,
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
        //->setUseNestedArrays(true)
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
