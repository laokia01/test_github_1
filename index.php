<?php
require_once(dirname(__FILE__).'/config.php');

$tpl_dir = '/mobile/template/';
$tplName='index_tpl.php';

//管理员查看其他店铺
$sidUrl = '';
if(ISADMIN){
	$sid = NumA($_REQUEST['sid'],0);
	if($sid > 0){
		$shopId = $sid;
		$sidUrl = '?sid='.$sid;
		$ShopType = new ShopType();
		$arrShop = $ShopType->open('id='.$sid);
		$shopName = $arrShop['name'];
	}
}


$tpl = new Template($tpl_dir);
$tpl->assign('webName',WEB_MOBILE);
$tpl->assign('sidUrl',$sidUrl);
$tpl->assign('shopId',$shopId);
$tpl->assign('userName',$userName);
$tpl->assign('shopName',$shopName);
$tpl->display($tplName);
?>