<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// получить ткущий url и поместить его в массив
$curDir = $APPLICATION->GetCurDir();

$arParseUrl = array_unique(explode("/", $curDir));
$arParseUrl = array_diff($arParseUrl, array(''));

// получить город по символьному коду, полученному из URL
$arSort = array();
$arSelect = array(
    "ID",
    "NAME",
    "DETAIL_PAGE_URL"
);
$arFilter = array(
    "IBLOCK_ID" => CITIES_IBLOCK_ID,
    "CODE" => $arParseUrl[2]
);

$rsElements = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    false,
    false,
    $arSelect
);

if($arItem = $rsElements->GetNext())
{
    $arResult["CITY"] = $arItem;
}

// получить список разделов, сгруппировыв по IBLOCK_SECTION_ID
$arSort = array();
$arSelect = array(
    "ID",
    "NAME",
    "IBLOCK_SECTION_ID",
    "PROPERTY_CITY"
);
$arFilter = array(
    "ACTIVE" => "Y",
    "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
    "PROPERTY_CITY" => $arResult["CITY"]["ID"],
);
$arGroupBy = array('IBLOCK_SECTION_ID');

$rsElements = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    $arGroupBy,
    false,
    $arSelect
);

while ($arItem = $rsElements->Fetch())
{
    $arElement[] = $arItem;
}

$arSectionIds = array();
foreach($arElement as &$arItem)
{
    $arSectionIds[] = $arItem["IBLOCK_SECTION_ID"];
}
unset($arItem);

// получить корневые разделы текущих разделов
$arPath = array();
$arCurPathIDs = array();
foreach($arSectionIds as $key=>$id)
{
    $rsPath = GetIBlockSectionPath(OBJECTS_IBLOCK_ID, $id);
    while($arItem = $rsPath->GetNext())
    {
        $arPath[] = $arItem["ID"];
    }
    $arSectionIds[$key] = array(
        "ID" => $id,
        "PATH_ID" => $arPath,
    );
    $arCurPathIDs[] = current($arPath);
    unset($arPath);
}

// добавить в тулбар спиоск объектов, разделов 1ого уровня, для текущего города
$arSort = array();
$arFilter = array(
    "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
    "DEPTH_LEVEL" => 1,
    "ID" => $arCurPathIDs,
);
$arSelect = array(
    "ID",
    "NAME",
    "SECTION_PAGE_URL",
    "DEPTH_LEVEL"
);
$rsSection = CIBlockSection::GetList(
    $arSort,
    $arFilter,
    false,
    $arSelect,
    false
);

while ($arItem = $rsSection->GetNext())
{
    switch ($arItem["DEPTH_LEVEL"])
    {
        case "1":
            // объекты
            $arSectionPageUrl = array_unique(explode("/", $arItem["SECTION_PAGE_URL"]));
            $arSectionPageUrl = array_diff($arSectionPageUrl, array(''));

            $strUrl = MAP_RUSSIA_URL.$arParseUrl[2]."/".$arSectionPageUrl[2]."/";
            $arItem["SECTION_PAGE_URL"] = $strUrl;
            if($strUrl === $curDir)
            {
                $arItem["SELECTED"] = true;
            }
            else
            {
                $arItem["SELECTED"] = false;
            }
            $arResult["TOOLBAR"]["OBJECTS"][] = $arItem;
            break;
    }
}
?>