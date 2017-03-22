<?php
session_start();
require_once("common.php");
require_once("database-table.php");
require_once("classes/class.DB.php");
require_once("classes/class.Sitemap.php");
require_once("functions/general.php");

$dbObj = new DB();
$dbObj->fun_db_connect();

$sitemapObj 	= new sitemap();
$map 			= array();
$country_arr	= array();
$state_arr		= array();
$city_arr		= array();

//for restaurant pages
$lastmod 		= date('Y-m-d');
$changefreq 	= "daily";
$priority 		= "1.0";

$sql 	= "SELECT rest_id, rest_country_id, rest_state_id, rest_city_id, friendly_link FROM  " . TABLE_RESTAURANT . " WHERE active='1' AND status='2' ORDER BY updated_on";
$rs 	= $dbObj->createRecordset($sql);
if($dbObj->getRecordCount($rs) > 0){
	$arr = $dbObj->fetchAssoc($rs);
	//restaurant page : with friendly url
	for($j = 1; $j < count($arr); $j++) {
		array_push($country_arr, $arr[$j]['rest_country_id']);
		array_push($state_arr, $arr[$j]['rest_state_id']);
		array_push($city_arr, $arr[$j]['rest_city_id']);
		if(isset($arr[$j]['friendly_link']) && $arr[$j]['friendly_link'] !="") {
			array_push($map, array("loc"=>SITE_URL."restaurant/".$arr[$j]['friendly_link'], "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
		} else {
		
		}
	}
	//result page : find total number of restaurants
	for($i = 1; $i < (count($arr)/10); $i++) {
		//$contentProperty 	.= SITE_URL."vacation-rentals/page_".($i+1)."/txtavailabilityids_1\n";
		array_push($map, array("loc"=>SITE_URL."restaurants/page_".($i+1), "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
	}

	//result page : with location name
	array_unique($country_arr);
	array_unique($state_arr);
	array_unique($city_arr);

	$sqlCountry = "SELECT country_name FROM  " . TABLE_COUNTRY . " WHERE country_id IN ('".implode("','", $country_arr)."')";
	$rsCountry 	= $dbObj->createRecordset($sqlCountry);
	if($dbObj->getRecordCount($rsCountry) > 0){
		$arrCountry = $dbObj->fetchAssoc($rsCountry);
		for($cnt1 = 1; $cnt1 < count($arrCountry); $cnt1++) {
			$country_name = $arrCountry[$cnt1]['country_name'];
			array_push($map, array("loc"=>SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($country_name))), "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
		}
	}

	$sqlState 	= "SELECT state_name FROM  " . TABLE_STATE . " WHERE state_id IN ('".implode("','", $state_arr)."')";
	$rsState 	= $dbObj->createRecordset($sqlState);
	if($dbObj->getRecordCount($rsState) > 0){
		$arrState = $dbObj->fetchAssoc($rsState);
		for($cnt2 = 1; $cnt2 < count($arrState); $cnt2++) {
			$state_name = $arrState[$cnt2]['state_name'];
			array_push($map, array("loc"=>SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($state_name))), "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
		}
	}

	$sqlCity = "SELECT city_name FROM  " . TABLE_CITY . " WHERE city_id IN ('".implode("','", $city_arr)."')";
	$rsCity 	= $dbObj->createRecordset($sqlCity);
	if($dbObj->getRecordCount($rsCity) > 0){
		$arrCity = $dbObj->fetchAssoc($rsCity);
		for($cnt3 = 1; $cnt3 < count($arrCity); $cnt3++) {
			$city_name = $arrCity[$cnt3]['city_name'];
			array_push($map, array("loc"=>SITE_URL."restaurants/".str_replace("/", "_", str_replace(" ", "-", strtolower($city_name))), "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
		}
	}
}

/*
if(!file_exists(SITE_DOC_ROOT.$pageProperty)){
	$handle = fopen(SITE_DOC_ROOT.$pageProperty,'w');
	fwrite($handle,$contentProperty);
} else {
	@unlink(SITE_DOC_ROOT.$pageProperty);
	$handle = fopen(SITE_DOC_ROOT.$pageProperty,'w');
	fwrite($handle,$contentProperty);
}
fclose($handle);
*/
//array_push($map, array("loc"=>SITE_URL.$pageProperty, "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));

// for static pages
//$pageStatic 	= "sitemapStatic.txt";

$lastmod 		= date('Y-m-d');
$changefreq 	= "daily";
$priority 		= "1.0";
array_push($map, array("loc"=>SITE_URL."about-us", "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
array_push($map, array("loc"=>SITE_URL."contact-us", "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
array_push($map, array("loc"=>SITE_URL."show-terms", "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
array_push($map, array("loc"=>SITE_URL."privacy-policy", "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
array_push($map, array("loc"=>SITE_URL."help", "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
array_push($map, array("loc"=>SITE_URL."testimonials", "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
array_push($map, array("loc"=>SITE_URL."resources", "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
array_push($map, array("loc"=>SITE_URL."restaurants", "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
// for dynamic pages
array_push($map, array("loc"=>SITE_URL."pages/restaurant-owners", "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));
array_push($map, array("loc"=>SITE_URL."pages/careers", "lastmod"=>$lastmod, "changefreq"=>$changefreq, "priority"=>$priority));

$sitemapObj->prepare();
$sitemapObj->siteUrl = SITE_URL;
$sitemapObj->siteDir = SITE_DOC_ROOT;
//$sitemapObj->proxy='proxy.isp.net'; // use if the proxy is enabled in your ISP , use NULL in your site
//$sitemapObj->proxy_port='3311'; // use if the proxy is enabled in your ISP , use NULL in your site
$sitemapObj->proxy = ''; // use if the proxy is enabled in your ISP , use NULL in your site
$sitemapObj->proxy_port = ''; // use if the proxy is enabled in your ISP , use NULL in your site
if(!$sitemapObj->addElements($map)) {
	die('error');
} else {
	echo "DONE!!";
}
?>
