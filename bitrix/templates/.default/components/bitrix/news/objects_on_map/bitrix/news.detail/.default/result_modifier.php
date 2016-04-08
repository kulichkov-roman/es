<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
// получить ткущий url и поместить его в массив
$curDir = $APPLICATION->GetCurDir();

$arParseUrl = array_unique(explode("/", $curDir));
$arParseUrl = array_diff($arParseUrl, array(''));

// получить список городов по символьному коду, полученному из URL
$arSort = array();
$arSelect = array(
    "ID",
    "NAME",
    "PROPERTY_X_COORD",
    "PROPERTY_Y_COORD",
    "PROPERTY_CITY_ON_MAP"
);
$arFilter = array(
    "IBLOCK_ID" => CITIES_IBLOCK_ID,
    "CODE" => $arParseUrl[2],
);

$rsElements = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    false,
    false,
    $arSelect
);

$arSectionIDs = array();
if($arItem = $rsElements->Fetch())
{
    if($arItem["PROPERTY_CITY_ON_MAP_VALUE"] <> "")
    {
        $arItem["PROPERTY_CITY_ON_MAP_VALUE"] = explode(",", $arItem["PROPERTY_CITY_ON_MAP_VALUE"]);
    }
    $arResult["CITY"] = $arItem;

    // получить список всех объектов, привязанных к этому городу
    $arSort = array();
    $arSelect = array(
        "ID",
        "NAME",
        "CODE",
        "IBLOCK_SECTION_ID",
        "DETAIL_PAGE_URL",
        "PREVIEW_PICTURE",
        "PROPERTY_YANDEX_LOCATION"
    );
    $arFilter = array(
        "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
        "PROPERTY_CITY" => $arResult["CITY"]["ID"],
    );

    $workType = $arParams["WORK_TYPE"];
    if($workType){
        $arFilter["SECTION_ID"] = $workType;
        $arFilter["INCLUDE_SUBSECTIONS"] = "Y";
    }
    
    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        false,
        false,
        $arSelect
    );

    while($arItem = $rsElements->Fetch())
    {
        if($arItem["PROPERTY_YANDEX_LOCATION_VALUE"] <> "")
        {
            $arItem["PROPERTY_YANDEX_LOCATION_VALUE"] = explode(",", $arItem["PROPERTY_YANDEX_LOCATION_VALUE"]);
        }

        // получить DETAIL_PAGE_URL по IBLOCK_SECTION_ID
        $arSectionPath = array();
        $rsSectionPath = GetIBlockSectionPath(OBJECTS_IBLOCK_ID, $arItem["IBLOCK_SECTION_ID"]);
        while($arSection = $rsSectionPath->GetNext())
        {
            $arSectionPath[] = $arSection["CODE"];
        }
        $detailPageUrl = OBJECTS_URL.implode("/", $arSectionPath)."/".$arItem["CODE"]."/";
        unset($arSectionPath);

        $arItem["DETAIL_PAGE_URL"] = $detailPageUrl;

        $arResult["ITEMS"][] = $arItem;
    }

    // получить детальные картинки
    $arIds = array();
    foreach($arResult["ITEMS"] as &$arItem)
    {
        if($arItem["PREVIEW_PICTURE"])
        {
            $arIds[] = $arItem["PREVIEW_PICTURE"];
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
            $urlPreviewPicture = itc\Resizer::get($arItem["ID"], 'auto', 79, 59, $extension);

            $arPreviewPicture[$arItem["ID"]]["SRC"] = $urlPreviewPicture;
        }

        foreach($arResult["ITEMS"] as &$arItem)
        {
            $arItem["PREVIEW_PICTURE"] = $arPreviewPicture[$arItem["PREVIEW_PICTURE"]]["SRC"];
        }
        unset($arItem);
    }
}
?>