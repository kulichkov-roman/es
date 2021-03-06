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

<div class="newsItem__header">
    <a href="<?=NEWS_URL?>" class="newsItem__headerPrev">
        <?=GetMessage("NEWS_DETAIL_NEWS");?>
    </a>
    <h1 class="newsItem__headerTitle">
        <?=$arResult["NAME"]?>
    </h1>
</div>
<div class="newsItem__content">
    <?if($arResult["DETAIL_PICTURE"]){?>
        <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>" class="left_floated"/>
    <?}?>
    <?if(strlen($arResult["DETAIL_TEXT"])>0){?>
        <?=$arResult["DETAIL_TEXT"];?>
    <?} else {?>
		<?=$arResult["PREVIEW_TEXT"];?>
	<?}?>
</div>
<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]){?>
    <div class="newsItem__date">
        <?=$arResult["DISPLAY_ACTIVE_FROM"]?>
    </div>
<?};?>