<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?
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
        $arDetailPicture = array();

        $rsFile = $fl->GetList($arOrder, $arFilter);
        while($arItem = $rsFile->GetNext())
        {
            $arPreviewPicture[$arItem["ID"]] = $arItem;

            $extension = GetFileExtension("/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"]);
            $urlPreviewPicture = itc\Resizer::get($arItem["ID"], 'width', 220, null, $extension);
            $urlDetailPicture = itc\Resizer::get($arItem["ID"], 'auto', 640, 480, $extension);

            $arPreviewPicture[$arItem["ID"]]["SRC"] = $urlPreviewPicture;
            $arDetailPicture[$arItem["ID"]]["SRC"] = $urlDetailPicture;
        }

        foreach($arResult["ITEMS"] as &$arItem)
        {
            $arItem["PREVIEW_PICTURE"]["SRC"] = $arPreviewPicture[$arItem["PREVIEW_PICTURE"]["ID"]]["SRC"];

            $arFilePreviewPicture = CFile::GetImageSize($_SERVER['DOCUMENT_ROOT'].stristr($arItem["PREVIEW_PICTURE"]["SRC"],'?',true));

            $arItem["PREVIEW_PICTURE"]["WIDTH"] = $arFilePreviewPicture[0];
            $arItem["PREVIEW_PICTURE"]["HEIGHT"] = $arFilePreviewPicture[1];

            $arItem["DETAIL_PICTURE"]["SRC"] = $arDetailPicture[$arItem["PREVIEW_PICTURE"]["ID"]]["SRC"];
        }
        unset($arItem);
    }

    // добавить заглушки
    $urlNoDetailPicture = itc\Resizer::get(NO_PHOTO_ID, 'crop', 245, 245, NO_PHOTO_EXTENSION);

    foreach($arResult["ITEMS"] as &$arItem)
    {
        if(!$arItem["PREVIEW_PICTURE"]["SRC"])
        {
            pre('1');
            $arItem["PREVIEW_PICTURE"] = array(
                "SRC" => $urlNoDetailPicture,
            );
            $arItem["DETAIL_PICTURE"] = array(
                "SRC" => "javascript:void(0)",
            );
        }
    }
    unset($arItem);
}
?>