<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
        "IS_SEF" => "Y",
        "SEF_BASE_URL" => OBJECTS_URL,
        "SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
        "DETAIL_PAGE_URL" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
        "IBLOCK_TYPE" => IBLOCK_TYPE_RU,
        "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
        "DEPTH_LEVEL" => "3",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000"
    ),
    false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>