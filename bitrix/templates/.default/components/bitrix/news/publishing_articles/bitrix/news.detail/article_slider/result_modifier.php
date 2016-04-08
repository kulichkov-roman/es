<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

// получить дополнительные фотографии объекта
$arIds = array();
if(is_array($arResult["PROPERTIES"]["PHOTO"]["VALUE"]))
{
    foreach($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as &$arItem)
    {
        $arIds[] = $arItem;
    }
    unset($arItem);
}

if(sizeof($arIds) > 0)
{
    $strIds = implode(",", $arIds);

    $fl = new CFile;

    $arOrder = array();
    $arFilter = array(
        "MODULE_ID" => "iblock",
        "@ID" => $strIds
    );

    $arPicture = array();
    $arSliderPicture = array();

    $rsFile = $fl->GetList($arOrder, $arFilter);
    while($arItem = $rsFile->GetNext())
    {
        $arPicture[$arItem["ID"]] = $arItem;
        // фотография для слайдера малого
        $extension = GetFileExtension("/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"]);
        $urlPicture = itc\Resizer::get($arItem["ID"], 'width', 480, null, $extension);
        $arPicture[$arItem["ID"]]["SRC"] = $urlPicture;
        // фотография для слайдера большего
        $urlSliderPicture = itc\Resizer::get($arItem["ID"], 'width', 480, null, $extension);
        $arSliderPicture[$arItem["ID"]]["SRC"] = $urlSliderPicture;
    }

    foreach($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as &$value)
    {
        // сохраняем url для слайдера большего
        $arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE"][] = $arSliderPicture[$value]["SRC"];
        // сохраняем url для слайдера малого
        $value = $arPicture[$value]["SRC"];
    }
    unset($arItem);

    $arResult["PROPERTIES"]["SLIDER_PHOTO"]["CODE"] = "SLIDER_PHOTO";
}
else
{
    $arResult["PROPERTIES"]["NO_PHOTO"] = array(
        "SRC" => itc\Resizer::get(NO_PHOTO_ID, 'width', 480, null, NO_PHOTO_EXTENSION)
    );
}
?>