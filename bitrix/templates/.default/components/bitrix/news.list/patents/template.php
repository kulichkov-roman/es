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
<div class="wrapper">
    <div class="page-head">
        <div class="page-head__prev">
            <a class="page-head__prev-link" href="<?=SCIENCE_URL?>">наука</a>
        </div>
        <div class="page-head__cont">
            <h1 class="page-head__title">Патенты</h1>
        </div>
    </div>
    <div class="patents-block">
        <div class="patents-block__body">
            <div class="patents-block__list-outer">
                <ul class="patents-block__list">
                    <?foreach($arResult["ITEMS"] as $arItem){?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <li class="patents-block__list-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="patent-item">
                                <div class="patent-item__image image-block">
                                    <span class="image-block__inner">
                                        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" class="image-block__item image-block__item--fixed" />
                                    </span>
                                </div>
                                <div class="patent-item__head">
                                    <div class="patent-item__head-title patent-item__title patent-item__title--center"><?=$arItem['NAME']?></div>
                                </div>
                                <?if($arItem['PREVIEW_TEXT'] <> ''){?>
                                    <div class="patent-item__cont">
                                        <?=$arItem['PREVIEW_TEXT'];?>
                                    </div>
                                <?}?>
                            </a>
                        </li>
                    <?}?>
                </ul>
            </div>
        </div>
    </div>
</div>