<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$id = "";
if(is_array($arResult["DETAIL_PICTURE"]))
{
    $id = $arResult["DETAIL_PICTURE"]["ID"];
}
else
{
    $arResult["DETAIL_PICTURE"]["SRC"] = itc\Resizer::get(NO_PHOTO_ID, 'tutorialsDetail');
}
if($id <> "")
{
    $fl = new CFile;

    $arOrder = array();
    $arFilter = array(
        "MODULE_ID" => "iblock",
        "@ID" => $id
    );

    $arDetailPicture = array();

    $rsFile = $fl->GetList($arOrder, $arFilter);

    if($arItem = $rsFile->GetNext())
    {
        $arDetailPicture[$arItem["ID"]] = $arItem;
        $urlDetailPicture = itc\Resizer::get($arItem["ID"], 'tutorialsDetail');

        $arResult["DETAIL_PICTURE"]["SRC"] = $urlDetailPicture;
    }
}
?>