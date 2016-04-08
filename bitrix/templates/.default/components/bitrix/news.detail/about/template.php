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

//echo "<pre>"; var_dump($arResult["DETAIL_PICTURE"]); echo "</pre>";
?>

<div class="wrapper">
    <div class="page-head">
        <div class="page-head__prev">
            <a class="page-head__prev-link" href="/">главная</a>
        </div>
        <div class="page-head__cont">
            <h1 class="page-head__title">Наука</h1>
        </div>
    </div>
    <ul class="services__list">
        <li class="services__listItem">
            <?if(is_array($arResult["DETAIL_PICTURE"])){?>
                <div class="services__listItemSidebar">
                    <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="services__listItemSidebarLinkImg">
                </div>
            <?}?>
            <div class="services__listItemContent">
                <h4 class="services__listItemContentHeader">
                    <span class="services__listItemContentHeaderLink">
                        <?=$arResult["NAME"]?>
                    </span>
                </h4>
                <div class="services__listItemContentExpander">
                    <?
                    if($arResult["DETAIL_TEXT"]){
                        ?>
                        <div class="services__listItemContentExpanderPreview">
                            <?=htmlspecialcharsBack($arResult["DETAIL_TEXT"]);?>
                        </div>
                    <?
                    }
                    ?>
                </div>
            </div>
        </li>
    </ul>
</div><!--/services-->