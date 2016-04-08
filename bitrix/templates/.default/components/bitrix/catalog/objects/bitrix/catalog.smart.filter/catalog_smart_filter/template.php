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

//if($USER->isAdmin())
//{
//	echo "<pre>"; var_dump($arResult["ITEMS"]); echo "</pre>";
//}
?>
<span class="catToolbar__citiesTitle"><?=GetMessage("OBJECT_SECTION_FILTER")?></span>
<?if($arResult["SHOW_ALL_OBJECTS"]){?>
    <span class="catToolbar__citiesActive"><?=GetMessage("OBJECT_SECTION_FILTER_ALL_CITIES")?></span>
<?} else {?>
    <span class="catToolbar__citiesActive"><?=$arResult["CURRENT_OBJECT"]["NAME"]?></span>
<?}?>
<ul class="catToolbar__citiesList">
    <?foreach($arResult["ITEMS"] as $arItem){?>
        <?if($arItem["PROPERTY_TYPE"] == "E" && $arItem["CODE"] == "CITY"){?>
            <?foreach($arItem["VALUES"] as $val => $ar){?>
                <li class="catToolbar__citiesListItem">
                    <?/*<a href="<?//=$APPLICATION->GetCurPageParam($ar["CONTROL_NAME"].'=Y&set_filter=Показать', array($ar["CONTROL_NAME"], 'set_filter'))?><?='?'.$ar["CONTROL_NAME"]."=Y&set_filter=Показать"?>" class="catToolbar__citiesListItemLink">*/?>
                    <a href="<?=$ar['FILTER_LINK']?>" class="catToolbar__citiesListItemLink">
                        <?=$ar["VALUE"];?>
                    </a>
                </li>
            <?}?>
            <?if(!$arResult["SHOW_ALL_OBJECTS"]){?>
                <li class="catToolbar__citiesListItem">
                    <a href="<?=$arResult["CURRENT_OBJECT"]["DEFAULT_URL"]?>" class="catToolbar__citiesListItemLink">
                        <?=GetMessage("OBJECT_SECTION_FILTER_ALL_CITIES")?>
                    </a>
                </li>
            <?}?>
        <?}?>
    <?}?>
</ul>