<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//echo "<pre>"; var_dump($arResult["ITEMS"]); echo "</pre>";
?>

<ul class="services__list">
    <?foreach($arResult["ITEMS"] as $arItem){
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li class="services__listItem" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="services__listItemSidebar">
                <?/*?><a href="javascript:void(0);" class="services__listItemSidebarLink"><?*/?>
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="services__listItemSidebarLink">
                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="services__listItemSidebarLinkImg">
                </a>
            </div>
            <div class="services__listItemContent">
                <div class="services__listItemContentHeader">
                    <?/*?><a href="javascript:void(0);" class="services__listItemContentHeaderLink"><?*/?>
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="services__listItemContentHeaderLink">
                        <?=$arItem["NAME"]?>
                    </a>
                </div>
                <div class="services__listItemContentExpander">
                    <?
                    if($arItem["PREVIEW_TEXT"]){
                        ?>
                        <div class="services__listItemContentExpanderPreview">
                            <?=htmlspecialcharsBack($arItem["PREVIEW_TEXT"]);?>
                        </div>
                        <?
                    }
                    /**
                     * По требованияю SEO
                     * Убрать ссылку подробнее и скрыть детальный текст
                     */
                    /*if($arItem["DETAIL_TEXT"]){
                        ?>
                        <div class="services__listItemContentExpanderFull">
                            <?=htmlspecialcharsBack($arItem["DETAIL_TEXT"]);?>
                        </div>
                        <?
                    }*/?>
                    <div class="services__listItemContentExpanderOpener">
                        <?/*?><a href="javascript:void(0);" class="services__listItemContentExpanderOpenerLink" data-opened-text="<?=GetMessage("SERVICE_TURN")?>" data-closed-text="<?=GetMessage("SERVICE_MORE")?>"><?*/?>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="services__listItemContentLink">
                            <?=GetMessage("SERVICE_MORE")?>
                        </a>
                    </div>
                </div>
            </div>
        </li>
    <?}?>
</ul>