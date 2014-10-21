<?php
$workingDir = dirname(__FILE__);
if(strpos($workingDir,'.modman') > 0) {
    require_once $workingDir . '/../../../app/Mage.php';
}else{
    require_once $workingDir . '/../app/Mage.php';
}
Mage::init('admin');

$firstname = 'Test';
$lastname = 'Salesigniter';
$username = 'salesigniter';
$password = 'salesigniter123!';
$salt = 'TN';
$hash = md5($salt.$password).':'.$salt;

$resource = Mage::getSingleton('core/resource');
$read = $resource->getConnection('core_read');

try{

$sql = "select extra from ".$resource->getTableName('admin/user')." where extra is not NULL limit 1";
$result = $read->query($sql);
$result = $result->fetch();
$extra = '';
if(isset($result['extra'])){
$extra = $result['extra'];
}

$sql = "insert into ".$resource->getTableName('admin/user')." values('','{$firstname}','{$lastname}','{$email}','{$username}','{$hash}',now(),NULL,NULL,0,0,1,'{$extra}',NULL,NULL)";
$result = $read->exec($sql);


/*
* Table:: admin_role
* Fields: role_id,parent_id,tree_level,sort_order,role_type,user_id,
*         role_name,gws_is_all,gws_websites,gws_store_groups
*/
$sql = "select role_id from ".$resource->getTableName('admin/role')." where role_name = 'Administrators' limit 1";
$result = $read->query($sql);
$result = $result->fetch();
$parent_id = '';
if(isset($result['role_id'])){
$parent_id = $result['role_id'];
}

$sql = "insert into ".$resource->getTableName('admin/role')." values ('','{$parent_id}',2,0,'U',(select user_id from ".$resource->getTableName('admin/user')." where username = '$username'),'$username')";
$result = $read->exec($sql);
$msg = '<h4 class="alert alert-success">Successfully added new admin user!</h4>';
} catch (Exception $e) {
$msg = '<h4 class="alert alert-error">'.$e->getMessage().'</h4>';
}

echo $msg;