<?
$curDir = $APPLICATION->GetCurDir();
$arParseUrl = array_unique(explode("/", $curDir));
$arParseUrl = array_diff($arParseUrl, array(''));

array_push($arParseUrl, "");
array_unshift($arParseUrl, "");

$arParseUrl = implode('/', $arParseUrl);

$arSort = array(
    "SORT"=>"ASC"
);
$arSelect = array(
    "ID",
    "NAME",
    "PREVIEW_TEXT"
);
$arFilter = array(
    "IBLOCK_ID" => SEO_SEC_DESCRIPTIONS_IBLOCK_ID,
    "NAME" => $arParseUrl
);
$rsElements = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    false,
    false,
    $arSelect
);
$arSeoSecDescription = '';
if($arItem = $rsElements->GetNext())
{
    $arSeoSecDescription = $arItem;
}
if($arSeoSecDescription <> "")
{
    ?>
    <div class="seo-block collapse-block typo">
        <div class="seo-block__body collapse-block__cont collapse">
            <div class="seo-block__cont">
                <?=$arSeoSecDescription['PREVIEW_TEXT']?>
            </div>
        </div>
        <div class="seo-block__head collapse-block__head">
            <span class="seo-block__button collapse-block__button">
                <span class="collapse-block__button-text collapse-block__open-hide">Развернуть</span>
                <span class="collapse-block__button-text collapse-block__open-show">Свернуть</span>
            </span>
        </div>
    </div>
    <?
}
?>