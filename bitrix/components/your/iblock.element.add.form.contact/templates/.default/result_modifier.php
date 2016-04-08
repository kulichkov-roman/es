<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//echo "<pre>"; var_dump($arResult); echo "</pre>";

$arSort = array("SORT"=>"ASC");
$arSelect = array("ID", "NAME");
$arFilter = array("IBLOCK_ID" => 23);

$rsElements = CIBlockElement::GetList(
    $arSort, 
    $arFilter, 
    false, 
    false, 
    $arSelect
);

while ($arItem = $rsElements->GetNext())
{
    $arElement[] = $arItem;
}

$arResult["TEST_DRIVE_CAR_LIST"] = $arElement;

//echo "<pre>"; var_dump($arElement); echo "</pre>";
?>