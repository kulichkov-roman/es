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
<?if(!empty($arResult["CITY"]["PROPERTY_CITY_ON_MAP_VALUE"])){?>
    <div
        class="objectMap"
        id="objectsmap"
        style="width: 100%; min-height: 400px;"
        data-center="[<?=$arResult["CITY"]["PROPERTY_CITY_ON_MAP_VALUE"][0]?>, <?=$arResult["CITY"]["PROPERTY_CITY_ON_MAP_VALUE"][1]?>]"
        <?if(!empty($arResult["ITEMS"])){?>
            data-markers='[
                <?
                $index = 0;
                $count = sizeof($arResult["ITEMS"]);
                foreach($arResult["ITEMS"] as $arItem){?>
                    {
                        "coords":
                            {
                                "lat" : "<?=$arItem["PROPERTY_YANDEX_LOCATION_VALUE"][0]?>",
                                "lng": "<?=$arItem["PROPERTY_YANDEX_LOCATION_VALUE"][1]?>"
                            },
                            "url": "<?=$arItem["DETAIL_PAGE_URL"]?>",
                            "header": "<?=addslashes($arItem["NAME"])?>",
                            "img": "<?=$arItem["PREVIEW_PICTURE"]?>"
                    }
                    <?if($count - 1 != $index){?>,<?}?>
                    <?$index++;
                }
                ?>
            ]'>
        <?}?>
    </div>
<?}?>