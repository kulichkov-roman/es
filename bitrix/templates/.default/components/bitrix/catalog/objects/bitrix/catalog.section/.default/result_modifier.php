<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if (!empty($arResult['ITEMS']))
{
    // получить картинки анонсные
    $arIds = array();
    foreach($arResult["ITEMS"] as &$arItem)
    {
        if(is_array($arItem["PREVIEW_PICTURE"]))
        {
            $arIds[] = $arItem["PREVIEW_PICTURE"]["ID"];
        }
    }
    unset($arItem);

    if(sizeof($arIds) > 0)
    {
        $strIds = implode(",", $arIds);

        $fl = new CFile;

        $arOrder = array();
        $arFilter = array(
            "MODULE_ID" => "iblock",
            "@ID" => $strIds
        );

        $arPreviewPicture = array();

        $rsFile = $fl->GetList($arOrder, $arFilter);
        while($arItem = $rsFile->GetNext())
        {
            $arPreviewPicture[$arItem["ID"]] = $arItem;

            $extension = GetFileExtension("/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"]);
            $urlPreviewPicture = itc\Resizer::get($arItem["ID"], 'auto', 245, 245, $extension);

            $arPreviewPicture[$arItem["ID"]]["SRC"] = $urlPreviewPicture;
        }

        foreach($arResult["ITEMS"] as &$arItem)
        {
            $arItem["PREVIEW_PICTURE"]["SRC"] = $arPreviewPicture[$arItem["PREVIEW_PICTURE"]["ID"]]["SRC"];
        }
        unset($arItem);
    }

    // добавить заглушки
    $urlNoDetailPicture = itc\Resizer::get(NO_PHOTO_245_245_ID, 'auto', 245, 245, NO_PHOTO_EXTENSION);
    $arCitiesIDs = array();

    foreach($arResult["ITEMS"] as &$arItem)
    {
        // заглушки
        if(!is_array($arItem["PREVIEW_PICTURE"]) || $arItem["PREVIEW_PICTURE"]["SRC"] == "")
        {
            $arItem["PREVIEW_PICTURE"] = array(
                "SRC" => $urlNoDetailPicture,
            );
        }

        // список id городов
        $arCitiesIDs[] = $arItem["PROPERTIES"]["CITY"]["VALUE"];
    }
    unset($arItem);

    // получить список городов из $arCitiesIDs по ID
    $arSort = array();
    $arSelect = array(
        "ID",
        "NAME",
        "CODE"
    );
    $arFilter = array(
        "IBLOCK_ID" => CITIES_IBLOCK_ID,
        "ID" => $arCitiesIDs,
    );

    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        false,
        false,
        $arSelect
    );

    $arCities = array();
    while($arItem = $rsElements->GetNext())
    {
        $arCities[$arItem["ID"]] = $arItem;
    }
    unset($arCitiesIDs);

    foreach($arResult["ITEMS"] as &$arItem)
    {
        // название города
        $arItem["PROPERTIES"]["CITY"]["PAGE_CITY_MAP"] = OBJECTS_MAP_RUSSIA_URL.$arCities[$arItem["PROPERTIES"]["CITY"]["VALUE"]]["CODE"]."/";
        $arItem["PROPERTIES"]["CITY"]["VALUE"] = getCityName($arCities[$arItem["PROPERTIES"]["CITY"]["VALUE"]]["NAME"]);
    }
    unset($arItem, $arCities);
}
?>