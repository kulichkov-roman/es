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

?>
<?$this->SetViewTarget("NewsDisplayTopPager");?>
    <?if($arParams["DISPLAY_TOP_PAGER"]){?>
        <?=$arResult["NAV_STRING"]?>
    <?}?>
<?$this->EndViewTarget();?>
<ul class="news__list">
    <?foreach($arResult["ITEMS"] as $arItem){
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li class="news__listItem" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="news__listItemAside">
                <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])){?>
                    <div class="news__listItemAsideImage">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__listItemAsideImageLink">
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="news__listItemAsideImageLinkImage">
                        </a>
                    </div>
                <?}?>
                <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]){?>
                    <div class="news_listItemAsideDate">
                        <?=$arItem["DISPLAY_ACTIVE_FROM"]?>
                    </div>
                <?}?>
            </div>
            <div class="news__listItemContent">
                <h4 class="news__listItemContentTitle">
                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])){?>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__listItemContentTitleLink">
                            <?=$arItem["NAME"]?>
                        </a>
                    <?} else {?>
                        <span class="news__listItemContentTitleLink">
                            <?=$arItem["NAME"]?>
                        </span>
                    <?}?>
                </h4>
                <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]){?>
                    <p class="news__listItemContentText">
                        <?= $arItem["PREVIEW_TEXT"];?>
                    </p>
                <?}?>
                <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])){?>
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news_listItemContentLink">
                        <?=GetMessage("NEWS_LINK_READ_MORE");?>
                    </a>
                <?}?>
            </div>
        </li>
    <?}?>
</ul>
<?$this->SetViewTarget("NewsDisplayBottomPager");?>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
        <?=$arResult["NAV_STRING"]?>
    <?}?>
<?$this->EndViewTarget();?>