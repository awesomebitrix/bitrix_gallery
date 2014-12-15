<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!\Bitrix\Main\Loader::includeModule("iblock"))
	return;
function convUtf ($name)
{
	return iconv("windows-1251", "UTF-8" ,$name);
}
function structurDir ($dir)
{
	$get_dirs = array_diff(scandir($_SERVER["DOCUMENT_ROOT"]."/".$dir), array('..', '.'));
	sort($get_dirs);
	foreach ($get_dirs as $get_dir)
	{	
		if (is_dir($_SERVER["DOCUMENT_ROOT"]."/".$dir."/".$get_dir))
		{	
			$get_dir = convUtf ($get_dir);
			$list_dir[$dir."/".$get_dir."/"] = $get_dir;	
		}
	}
	return $list_dir;
}

$arProperty_Dir = structurDir ("upload");


$arComponentParameters = array(
	"PARAMETERS" => array(
		"PATH_GALERY" => array(
		"PARENT" => "DATA_SOURCE",
		"NAME" => "Папка галереи",
		"ADDITIONAL_VALUES" => "Y",
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"VALUES" => $arProperty_Dir,
		"HIDDEN" => "",
		),	
		"THUMB" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" =>"Создавать миниатюры",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'Y',
		),		
		"MAX_WIDTH" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "Максимальная ширина миниатюры",
			"TYPE" => "STRING",
			"DEFAULT" => '300',
		),		
		"MAX_HEIGHT" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "Максимальная высота миниатюры",
			"TYPE" => "STRING",
			"DEFAULT" => '200',
		),
		"ORIGINAL_ZIP" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "Сжимать оригинал",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'Y',
		),
		"ORIGINAL_SIZE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "Максималный размер оригинала, ширины и высоты",
			"TYPE" => "STRING",
			"DEFAULT" => '1920',
		),
		"FANCY_SCRIPT" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "Подключить fansybox",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'N',
		),
		"JQUERY_SCRIPT" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "Подключить Jquery",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'N',
		),

	),
);
?>