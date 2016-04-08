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
        <div class="categorySelect__select _object">
            <span class="categorySelect__selectActive"><?=$arResult["TOOLBAR"]["CURRENT_OBJECTS_SELECT"] == "" ? GetMessage("TOOLBAR_OBJECTS_TITLE") : $arResult["TOOLBAR"]["CURRENT_OBJECTS_SELECT"]?></span>
            <ul class="categorySelect__selectList">
                <?foreach($arResult["TOOLBAR"]["OBJECTS"] as $arObjects){?>
                    <li class="categorySelect__selectListItem">
                        <a href="<?=$arObjects["SECTION_PAGE_URL"]?>" class="categorySelect__selectListItemLink <?if($arObjects["SELECTED"]){?>_active<?}?>"><?=$arObjects["NAME"]?></a>
                    </li>
                <?}?>
            </ul>
        </div>
    <?}?>
    <?if(sizeof($arResult["TOOLBAR"]["JOBS"])){?>
        <div class="categorySelect__select _job">
            <span class="categorySelect__selectActive"><?=$arResult["TOOLBAR"]["CURRENT_JOBS_SELECT"] == "" ? GetMessage("TOOLBAR_JOBS_TITLE") : $arResult["TOOLBAR"]["CURRENT_JOBS_SELECT"]?></span>
            <ul class="categorySelect__selectList">
                <?foreach($arResult["TOOLBAR"]["JOBS"] as $arJobs){?>
                    <li class="categorySelect__selectListItem">
                        <a href="<?=$arJobs["SECTION_PAGE_URL"]?>" class="categorySelect__selectListItemLink <?if($arJobs["SELECTED"]){?>_active<?}?>"><?=$arJobs["NAME"]?></a>
                    </li>
                <?}?>
            </ul>
        </div>
    <?}?>
    <?if(sizeof($arResult["TOOLBAR"]["DESIGNS"])){?>
        <div class="categorySelect__select _constructors">
            <span class="categorySelect__selectActive"><?=$arResult["TOOLBAR"]["CURRENT_DESIGNS_SELECT"] == "" ? GetMessage("TOOLBAR_DESIGNS_TITLE") : $arResult["TOOLBAR"]["CURRENT_DESIGNS_SELECT"]?></span>
            <ul class="categorySelect__selectList">
                <?foreach($arResult["TOOLBAR"]["DESIGNS"] as $arDesigns){?>
                    <li class="categorySelect__selectListItem">
                        <a href="<?=$arDesigns["SECTION_PAGE_URL"]?>" class="categorySelect__selectListItemLink <?if($arDesigns["SELECTED"]){?>_active<?}?>"><?=$arDesigns["NAME"]?></a>
                    </li>
                <?}?>
            </ul>
        </div>
    <?}?>
</div>

<?
if($USER->isAdmin())
{
    //echo "<pre>"; var_dump($arResult["TOOLBAR"]); echo "</pre>";
}
?>