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
<div class="categorySelect">
    <?
    if(sizeof($arResult["TOOLBAR"]["OBJECTS"])){?>
        <div class="categorySelect__select _all_cities">
            <a class="categorySelect__selectActive" href="<?=OBJECTS_MAP_RUSSIA_URL?>"><?=GetMessage("TOOLBAR_OBJECTS_ON_MAP_TITLE")?></a>
        </div>
        <div class="categorySelect__select _cities">
            <span class="categorySelect__selectActive"><?=GetMessage("TOOLBAR_ALL_OBJECTS_ON_MAP_TITLE")?></span>
            <ul class="categorySelect__selectList">
                <?foreach($arResult["TOOLBAR"]["OBJECTS"] as $arObjects){?>
                    <li class="categorySelect__selectListItem">
                        <a href="<?=$arObjects["SECTION_PAGE_URL"]?>" class="categorySelect__selectListItemLink <?if($arObjects["SELECTED"]){?>_active<?}?>"><?=$arObjects["NAME"]?></a>
                    </li>
                <?}?>
            </ul>
        </div>
    <?}?>
</div>