<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"SPECIALDATE" => Array(
		"NAME" => GetMessage("SPECIALDATE"),
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"VALUE" => "Y",
		"DEFAULT" =>"N",
	),
	"IBLOCK_ID_CANONICAL" => Array(
		"NAME" => GetMessage("CANONICAL"),
		"TYPE" => "TEXT",
	),
);
?>