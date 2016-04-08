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
$this->setFrameMode(true);?>

<div class="object">
    <div class="object__header">
        <a href="<?=PATENTS_URL?>" class="object__headerPrev">
            патенты
        </a>
        <h1 class="object__headerTitle">
            <?=$arResult["NAME"]?>
        </h1>
    </div>
    <div class="object__slider _narrow">
        <div class="objectSlider <?=sizeof($arResult["PROPERTIES"]["PHOTO"]["VALUE"]) == 1 ? "no-slider" : "";?>">
            <ul class="objectSlider__slider <?=sizeof($arResult["PROPERTIES"]["PHOTO"]["VALUE"]) == 1 ? "no-slider" : "";?>">
                <?if(sizeof($arResult["PROPERTIES"]["PHOTO"]["VALUE"]) > 0){
                    foreach($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as $key => $src){?>
                        <li class="objectSlider__sliderItem">
                            <img src="<?=$src?>" title="<?=$arResult["PROPERTIES"]["PHOTO"]["DESCRIPTION"][$key]?>"/>
                        </li>
                    <?}?>
                <?} else {?>
                    <?$src = $arResult["PROPERTIES"]["NO_PHOTO"]["SRC"]?>
                    <li class="objectSlider__sliderItem">
                        <img src="<?=$src?>"/>
                    </li>
                <?}?>
            </ul>
            <span class="objectSlider__author"><?=GetMessage("OBJECT_ELEMENT_PHOTO")?>: </span>
            <span class="objectSlider__zoom"></span>
        </div>
    </div>
    <?if(is_array($arResult["PROPERTIES"])  ||  $arResult["DETAIL_TEXT"] <> ""){?>
        <div class="object__info _narrow">
            <?foreach($arResult["PROPERTIES"] as &$arProp){
                switch($arProp["CODE"]){
                    case "PHOTO":
                    case "SLIDER_PHOTO":
                    case "YANDEX_LOCATION":
                        continue 2;
                        break;
                }
                if($arProp["VALUE"] <> ""){?>
                    <div class="object__infoSection">
                        <span class="object__infoSectionHeader">
                            <?=ToLower($arProp["NAME"])?>:
                        </span>
                        <div class="object__infoSectionContent">
                            <?=$arProp["VALUE"]?>
                        </div>
                    </div>
                <?}
            }?>
            <?if($arResult["DETAIL_TEXT"] <> ""){?>
                <div class="object__infoSection">
                        <span class="object__infoSectionHeader">
                            <?=GetMessage("PATENTS_DETAIL_TEXT_TITLE");?>
                        </span>
                    <div class="object__infoSectionContent">
                        <?=$arResult["DETAIL_TEXT"]?>
                    </div>
                </div>
            <?}?>
        </div>
    <?}?>
</div>
<?$this->SetViewTarget("objectSlider");?>
    <?if(sizeof($arResult["PROPERTIES"]["PHOTO"]["VALUE"]) > 0){?>
        <div class="page__section _slider">
            <div class="fullscreenSlider">
                <div class="fullscreenSlider__wrapper">
                    <ul class="fullscreenSlider__list">
                        <?foreach($arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE"] as $key => $src){?>
                            <li class="fullscreenSlider__listItem">
                                <a href="#" class="fullscreenSlider__listItemLink">
                                    <img src="<?=$src?>" title="<?=$arResult["PROPERTIES"]["PHOTO"]["DESCRIPTION"][$key]?>" class="fullscreenSlider__listItemImg"/>
                                </a>
                            </li>
                        <?}?>
                    </ul>
                </div>
                <?if(sizeof($arResult["PROPERTIES"]["PHOTO"]["VALUE"]) > 1){?>
                    <a href="javascript:void(0);" class="fullscreenSlider__control _prev"></a>
                    <a href="javascript:void(0);" class="fullscreenSlider__control _next"></a>
                <?}?>
                <div class="fullscreenSlider__footer">
                    <div class="fullscreenSlider__footerPagination"></div>
                    <div class="fullscreenSlider__footerAuthor">
                        <span class="fullscreenSlider__footerAuthorLable"><?=GetMessage("OBJECT_ELEMENT_PHOTO")?>:</span>
                        <span class="fullscreenSlider__footerAuthorName"></span>
                    </div>
                </div>
                <div class="fullscreenSlider__zoom"></div>
            </div>
        </div>
    <?}?>
<?$this->EndViewTarget();?>