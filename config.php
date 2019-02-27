<?php
/**
 * 管理目录配置文件 | 
 */
define('WEBADMIN', str_replace("\\", '/', dirname(__FILE__) ) );
require_once(WEBADMIN.'/../include_main.php');

//获得当前脚本名称，如果你的系统被禁用了$_SERVER变量，请自行更改这个选项
$webNowurl = $s_scriptName = '';
$isUrlOpen = @ini_get('allow_url_fopen');
$webNowurl = GetCurUrl();
//$webNowurls = explode('?', $webNowurl);
//$s_scriptName = $webNowurls[0];	
//$cfg_remote_site = empty($cfg_remote_site)? 'N' : $cfg_remote_site;

define('WEB_MOBILE', '橘掌柜');

//检验用户登录状态
$cuserLogin = new userLogin();
if($cuserLogin->getUserID()==-1){
    header("location:login.php?gotopage=".urlencode($webNowurl));
    exit();
}
$userId = $cuserLogin->getUserID();
$userName = $cuserLogin->getUserName();

//用户店铺ID
$shopId = $cuserLogin->getUserShopID();
$shopName = '';

//是否为系统管理员
define('ISADMIN', in_array($userName, array('admin')) ? 1 : 0 );

//定时更新数据
$cacheSys = 'sys_sdb';
$cacheName = 'b2c';
$cacheTime = 903; //15分钟
$fName = 'cachetime';
$fTime = TIMESTAMP;
$DataCache = new DataCache();
$sysUpdTime = $DataCache->setCache($cacheSys,$cacheName,$cacheTime,$fName,$fTime);