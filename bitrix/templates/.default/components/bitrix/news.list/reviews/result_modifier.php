<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
/**
 * Уменьшить картинку логотипа компании
 */
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
        $urlPreviewPicture = itc\Resizer::get($arItem["ID"], 'reviewsPreviewList');
        $urlDetailPicture = itc\Resizer::get($arItem["ID"], 'reviewsDetailList');

        $arPreviewPicture[$arItem["ID"]]["SRC"] = $urlPreviewPicture;
        $arDetailPicture[$arItem["ID"]]["SRC"] = $urlDetailPicture;
    }

    foreach($arResult["ITEMS"] as &$arItem)
    {
        if(!$arItem["PREVIEW_PICTURE"]["SRC"] == "")
        {
            $arItem["PREVIEW_PICTURE"]["SRC"] = $arPreviewPicture[$arItem["PREVIEW_PICTURE"]["ID"]]["SRC"];
            $arItem["DETAIL_PICTURE"]["SRC"] = $arPreviewPicture[$arItem["PREVIEW_PICTURE"]["ID"]]["SRC"];
        }
        else
        {
            $arItem["PREVIEW_PICTURE"]["SRC"] = itc\Resizer::get(NO_PHOTO_245_245_ID, 'reviewsPreviewList');
            $arItem["DETAIL_PICTURE"]["SRC"] = itc\Resizer::get(NO_PHOTO_245_245_ID, 'reviewsDetailList');
        }
    }
    unset($arItem);
}
else
{
    foreach($arResult["ITEMS"] as &$arItem)
    {
        $arItem["PREVIEW_PICTURE"]["SRC"] = itc\Resizer::get(NO_PHOTO_245_245_ID, 'reviewsPreviewList');
        $arItem["DETAIL_PICTURE"]["SRC"] = itc\Resizer::get(NO_PHOTO_245_245_ID, 'reviewsDetailList');
    }
    unset($arItem);
}

/**
 * Уменьшить изображения для показа сканов отзывов
 */
foreach($arResult["ITEMS"] as &$arItem)
{
    if(sizeof($arItem["PROPERTIES"]["PHOTO"]["VALUE"]) > 0)
    {
        foreach($arItem["PROPERTIES"]["PHOTO"]["VALUE"] as $pictId)
        {
            $arItem['PROPERTIES']['PHOTO']['SCANS'][] = array(
                'PREVIEW_PICTURE' => itc\Resizer::get($pictId, 'reviewsPreviewScanList'),
                'DETAIL_PICTURE' => $arItem["DETAIL_SCANS"][] = itc\Resizer::get($pictId, 'reviewsDetailScanList')
            );
        }
    }
}
unset($arItem);

/**
 * Получить ссылки на объекты
 */

$arIds = array();
foreach($arResult["ITEMS"] as &$arItem)
{
    if(sizeof($arItem["PROPERTIES"]["LINK_OBJECT"]["VALUE"]) > 0)
    {
        foreach($arItem["PROPERTIES"]["LINK_OBJECT"]["VALUE"] as $id)
        {
            $arIds[] = $id;
        }
    }
}

$arIds = array_unique($arIds);

$arSort = array(
    "SORT"=>"ASC"
);
$arSelect = array(
    "ID",
    "NAME",
    "DETAIL_PAGE_URL"
);
$arFilter = array(
    "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
    "ID" => $arIds
);

$rsElements = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    false,
    false,
    $arSelect
);

$arObjects = array();
while ($arItem = $rsElements->GetNext())
{
    $arObjects[$arItem['ID']] = $arItem;
}

foreach($arResult["ITEMS"] as &$arItem)
{
    if(sizeof($arItem["PROPERTIES"]["LINK_OBJECT"]["VALUE"]) > 0)
    {
        foreach($arItem["PROPERTIES"]["LINK_OBJECT"]["VALUE"] as &$id)
        {
            $arObject = array(
                'ID' => $arObjects[$id]['ID'],
                'NAME' => $arObjects[$id]['NAME'],
                'DETAIL_PAGE_URL' => $arObjects[$id]['DETAIL_PAGE_URL'],
            );

            $id = $arObject;
        }
        unset($id);
    }
}
unset($arItem);

//pre($arResult["ITEMS"]);

/**
 * Разделить по 5 элементов
 */
$arResult["ITEMS"] = array_chunk($arResult["ITEMS"], 5);

/*
 * Fix добиваем последний ряд до 5 элементов
 */

/*
 * Взять последний ряд
 */
$arItems = array_pop($arResult["ITEMS"]);

/**
 * Для существующих
 */
foreach ($arItems as &$arItem)
{
    if($arItem == NULL)
    {
        $arItem = array(
            'PROPERTIES' => array(
                'VISIBILITY' => array(
                    'VALUE' => 'N'
                )
            )
        );
    }
    else
    {
        $arItem['PROPERTIES']['VISIBILITY']['VALUE'] = 'Y';
    }
}

/*
 * Сколько добавить
 */
$count = sizeof($arItems);
if($count < 5)
{
    for($offset = 5 - $count; $offset > 0; $offset--)
    {
        $arItems[] = array(
            'PROPERTIES' => array(
                'VISIBILITY' => array(
                    'VALUE' => 'N'
                )
            )
        );
    }
}

/*
 * Заменить последний ряд элементов
 */
array_push($arResult["ITEMS"], $arItems);
?>