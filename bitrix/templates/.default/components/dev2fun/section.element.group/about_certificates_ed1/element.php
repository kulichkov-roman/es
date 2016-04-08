<?
global $arParams, $resItems;
$arResult = $GLOBALS['resItems'];
$this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>

<li class="patents-block__list-item" id="<?=$this->GetEditAreaId($arResult['ID']);?>">
    <a href="<?=$arResult["DETAIL_PAGE_URL"]?>" class="patent-item">
        <div class="patent-item__image image-block">
            <span class="image-block__inner">
                <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>" class="image-block__item image-block__item--fixed" />
            </span>
        </div>
        <div class="patent-item__head">
            <div class="patent-item__head-title patent-item__title patent-item__title--center"><?=$arResult["NAME"]?></div>
        </div>
        <?if($arResult['PREVIEW_TEXT'] <> ''){?>
            <div class="patent-item__cont">
                <?=$arResult['PREVIEW_TEXT'];?>
            </div>
        <?}?>
    </a>
</li>