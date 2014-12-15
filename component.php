<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$function = __DIR__ . '/functions.php';

if (file_exists($function))
{
	require $function;

	$galery = new deltaGalery();
	$galery->dir = $arParams["PATH_GALERY"];
	$galery->Init($galery->dir, $arParams["MAX_WIDTH"], $arParams["MAX_HEIGHT"], $quality = 95, $arParams["ORIGINAL_ZIP"], $arParams["THUMB"], $arParams["ORIGINAL_SIZE"]);
	$arResult["ITEMS"] = $galery->structurFile($galery->dir);	

	if ($arParams["JQUERY_SCRIPT"] == "Y")
	{	
		$APPLICATION->AddHeadScript('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
	}
	if ($arParams["FANCY_SCRIPT"] == "Y")
	{	
		$APPLICATION->AddHeadScript("/bitrix/components/it-delta/galery.list/js/fancybox/jquery.fancybox.pack.js" );
		$APPLICATION->SetAdditionalCSS("/bitrix/components/it-delta/galery.list/js/fancybox/jquery.fancybox.css" );
		$APPLICATION->AddHeadScript("/bitrix/components/it-delta/galery.list/js/script.js" );
	}
}
$this->IncludeComponentTemplate();
?>