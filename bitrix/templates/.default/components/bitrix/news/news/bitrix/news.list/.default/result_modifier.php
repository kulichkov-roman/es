<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arIds = array();
foreach($arResult["ITEMS"] as &$arItem)
{
    $arIds[] = $arItem["PREVIEW_PICTURE"]["ID"];
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
        $urlPreviewPicture = itc\Resizer::get($arItem["ID"], 'crop', 100, 100, $extension);

        $arPreviewPicture[$arItem["ID"]]["SRC"] = $urlPreviewPicture;
    }

    foreach($arResult["ITEMS"] as &$arItem)
    {
        $arItem["PREVIEW_PICTURE"]["SRC"] = $arPreviewPicture[$arItem["PREVIEW_PICTURE"]["ID"]]["SRC"];
    }
    unset($arItem);
}

// добавить заглушки
$urlNoDetailPicture = itc\Resizer::get(NO_PHOTO_ID, 'auto', 100, 100, NO_PHOTO_EXTENSION);

foreach($arResult["ITEMS"] as &$arItem)
{
    // заглушки
    if(!is_array($arItem["PREVIEW_PICTURE"]) || $arItem["PREVIEW_PICTURE"]["SRC"] == "")
    {
        $arItem["PREVIEW_PICTURE"] = array(
            "SRC" => $urlNoDetailPicture,
        );
    }
}
unset($arItem);
?>