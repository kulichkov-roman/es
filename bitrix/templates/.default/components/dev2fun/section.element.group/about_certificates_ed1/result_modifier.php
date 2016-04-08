<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if($USER->isAdmin())
{
    //echo "<pre>"; var_dump($arResult); echo "</pre>";
}

/**
 * Уменьшить изображение
 */
$arIds = array();
foreach($arResult["RUBITEMS"] as &$arItems)
{
    foreach($arItems["ITEMS"] as &$arItem)
    {
        $arIds[] = $arItem['PREVIEW_PICTURE']['ID'];
    }
    unset($arItem);
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

        $urlPreviewPicture = itc\Resizer::get($arItem["ID"], 'certificateDetail');

        $arPreviewPicture[$arItem["ID"]]["SRC"] = $urlPreviewPicture;
    }

    foreach($arResult["RUBITEMS"] as &$arItems)
    {
        foreach($arItems["ITEMS"] as &$arItem)
        {
            if(!$arItem["PREVIEW_PICTURE"]["SRC"] == "")
            {
                $arItem["PREVIEW_PICTURE"]["SRC"] = $arPreviewPicture[$arItem["PREVIEW_PICTURE"]["ID"]]["SRC"];

            }
            else
            {
                $arItem["PREVIEW_PICTURE"]["SRC"] = itc\Resizer::get(NO_PHOTO_ID, 'certificateDetail');
            }
        }
        unset($arItem);
    }
    unset($arItems);
}
else
{
    foreach($arResult["RUBITEMS"] as &$arItems)
    {
        foreach($arItems["ITEMS"] as &$arItem)
        {
            $arItem["PREVIEW_PICTURE"]["SRC"] = itc\Resizer::get(NO_PHOTO_ID, 'certificateDetail');
        }
        unset($arItem);
    }
    unset($arItems);
}
?>
