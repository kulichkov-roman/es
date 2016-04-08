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

global $USER;
$bAdmin = $USER -> IsAdmin();
?>
<div class="bigMap <?if($bAdmin){?>bigMapEditable<?}?>">
    <div class="bigMap__map <?if($bAdmin){?>bigMapEditable__map<?}?>">
    	<?if($arResult["ITEMS"]){?>
	        <ul class="bigMap__cities">
	        	<?foreach($arResult["ITEMS"] as $arItem){?>
		            <li class="bigMap__citiesItem" data-x="<?=$arItem["PROPERTIES"]["X_COORD"]["VALUE"]?>" data-y="<?=$arItem["PROPERTIES"]["Y_COORD"]["VALUE"]?>">
		                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="bigMap__citiesItemLink"><?=$arItem["NAME"]?></a>
		            </li>
	        	<?}?>
	        </ul>
    	<?}?>
    </div>
	<?itc\CUncachedArea::show('addCityForm')?>
</div>    