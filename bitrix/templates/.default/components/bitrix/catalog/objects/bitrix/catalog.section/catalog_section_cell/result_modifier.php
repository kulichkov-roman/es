<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if (!empty($arResult['ITEMS']))
{
    $arIds = array();
    $arViewTypes = array();
    foreach($arResult["ITEMS"] as &$arItem)
    {
        if(is_array($arItem['PREVIEW_PICTURE']))
        {
            $arIds[] = $arItem["PREVIEW_PICTURE"]["ID"];

            if($arItem['PROPERTIES']['VIEW_PREVIEW_PICTURE']['VALUE'] <> '')
            {
                /**
                 * @todo на текущий момент параметр не учитывается.
                 */
                $arViewTypes[$arItem['PREVIEW_PICTURE']['ID']] = $arItem['PROPERTIES']['VIEW_PREVIEW_PICTURE']['VALUE_ENUM_ID'];
            }
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

        $urlPreviewPicture = '';

        $rsFile = $fl->GetList($arOrder, $arFilter);
        while($arItem = $rsFile->GetNext())
        {
            $arPreviewPicture[$arItem["ID"]] = $arItem;

            $arImages = CFile::GetImageSize($_SERVER['DOCUMENT_ROOT']."/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"]);
            $extension = GetFileExtension("/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"]);

            if(array_key_exists($arItem["ID"], $arViewTypes))
            {
                $urlPreviewPicture = itc\Resizer::get($arItem["ID"], 'width', 353, null, $extension);

                $arThumbParams = array(
                    'bg' => '#ffffff',
                    'far' => 'C'
                );

                $urlPreviewPicture = GetResizeImage($urlPreviewPicture, '353', '', $arThumbParams);
            }
            else
            {
                $urlPreviewPicture = itc\Resizer::get($arItem["ID"], 'crop', 353, 353, $extension);
            }

            $arPreviewPicture[$arItem["ID"]]["SRC"] = $urlPreviewPicture;
        }

        $arResult["CAT_WIDTH_TILE__LIST"] = 353;

        foreach($arResult["ITEMS"] as &$arItem)
        {
            $arItem["PREVIEW_PICTURE"]["SRC"] = $arPreviewPicture[$arItem["PREVIEW_PICTURE"]["ID"]]["SRC"];

            //$arFilePreviewPicture = CFile::GetImageSize($_SERVER['DOCUMENT_ROOT'].stristr($arItem["PREVIEW_PICTURE"]["SRC"],'?',true));

            //$arItem["PREVIEW_PICTURE"]["WIDTH"] = $arFilePreviewPicture[0];
            //$arItem["PREVIEW_PICTURE"]["HEIGHT"] = $arFilePreviewPicture[1];

            $arItem["PREVIEW_PICTURE"]["WIDTH"] = '353';
            $arItem["PREVIEW_PICTURE"]["HEIGHT"] = '353';
        }
        unset($arItem);
    }

    // добавить заглушки
    $urlNoDetailPicture = itc\Resizer::get(NO_PHOTO_353_353_ID, 'crop', 353, 353, NO_PHOTO_EXTENSION);

    foreach($arResult["ITEMS"] as &$arItem)
    {
        if($arItem["PREVIEW_PICTURE"]["SRC"] == "")
        {
            $arItem["PREVIEW_PICTURE"] = array(
                "SRC" => $urlNoDetailPicture,
                "WIDTH" => '353',
                "HEIGHT" => '353'
            );
        }
    }
    unset($arItem);

    // получить список ID городов
    $arCitiesIDs = array();
    foreach($arResult["ITEMS"] as &$arItem)
    {
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
        $arItem["PROPERTIES"]["CITY"]["VALUE"] = getCityName($arCities[$arItem["PROPERTIES"]["CITY"]["VALUE"]]["NAME"]);
    }
    unset($arItem, $arCities);
}
?>