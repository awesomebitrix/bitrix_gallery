<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "Галерея",
	"DESCRIPTION" => "Галерея без использования инфоблоков и БД",
	"ICON" => "/images/galery.list.gif",
	"CACHE_PATH" => "Y",
	"SORT" => 20,
	"PATH" => array(
		"ID" => "IT-DELTA",
		"CHILD" => array(
			"ID" => "Галерея",
			"NAME" => "Галерея",
			"SORT" => 10
		),
	),
);

?>