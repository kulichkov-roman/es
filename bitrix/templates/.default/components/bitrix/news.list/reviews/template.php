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
        <div class="page-head__prev"><a class="page-head__prev-link" href="<?=ABOUT_URL?>">о нас</a></div>
        <div class="page-head__cont"><h1 class="page-head__title">Клиенты и Отзывы</h1></div>
    </div>
    <div class="reviews-block">
        <div class="reviews-block__body">
            <div class="reviews-block__cont">
                <?
                $APPLICATION->IncludeComponent("bitrix:main.include", "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => "/include/site_templates/pg_review_text_top.php",
                        "EDIT_TEMPLATE" => ""
                    ),
                    false
                );
                ?>
            </div>
            <?foreach($arResult["ITEMS"] as $arItems){?>
                <div class="reviews-block__row">
                    <div class="reviews-tabs tabs-block js-tabs" data-collapsible>
                        <div class="reviews-tabs__nav tabs-block__nav tabs-nav">
                            <ul class="reviews-tabs__nav-list tabs-nav__list">
                                <?foreach($arItems as $arItem){?>
                                    <?
                                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                    ?>
                                    <li class="reviews-tabs__nav-item tabs-nav__item <?=$arItem['PROPERTIES']['VISIBILITY']['VALUE'] == 'N' ? 'invisibility' : ''?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                        <a href="#<?=$arItem['CODE']?>" class="reviews-tab tabs-nav__link">
                                            <div class="reviews-tab__title">
                                                <span class="reviews-tab__title-text"><?=TruncateText(htmlspecialcharsBack($arItem['NAME']), 30)?></span>
                                            </div>
                                            <div class="reviews-tab__image image-block">
                                                <span class="image-block__inner">
                                                    <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" class="image-block__item" />
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                <?}?>
                            </ul>
                        </div>
                        <div class="reviews-tabs__cont tabs-block__cont">
                            <?foreach($arItems as $arItem){?>
                                <div class="reviews-tabs__cont-item tabs-block__item" id="<?=$arItem['CODE']?>">
                                    <div class="reviews-item">
                                        <div class="reviews-item__inner">
                                            <div class="reviews-item__images">
                                                <div class="reviews-item__image image-block">
                                                    <span class="image-block__inner">
                                                        <img src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" class="image-block__item" />
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="reviews-item_wrap">
                                                <table class="review-table">
                                                    <thead>
                                                        <tr>
                                                            <th class="review-table__cell review-table__cell--title"></th>
                                                            <th class="review-table__cell">
                                                                <?=$arItem['PROPERTIES']['FULL_NAME']['VALUE'] ? $arItem['PROPERTIES']['FULL_NAME']['VALUE'] : $arItem['PROPERTIES']['NAME']?>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?if($arItem['PREVIEW_TEXT'] <> ""){?>
                                                            <tr>
                                                                <td class="review-table__cell review-table__cell--title">деятельность:</td>
                                                                <td class="review-table__cell">
                                                                    <?=$arItem['PREVIEW_TEXT'];?>
                                                                </td>
                                                            </tr>
                                                        <?}?>
                                                        <?if($arItem['PROPERTIES']['LINK_OBJECT']['VALUE']){?>
                                                            <tr>
                                                                <td class="review-table__cell review-table__cell--title">заказ(ы):</td>
                                                                <td class="review-table__cell">
                                                                    <?foreach($arItem['PROPERTIES']['LINK_OBJECT']['VALUE'] as $arLinkObject){?>
                                                                        <a href="<?=$arLinkObject['DETAIL_PAGE_URL']?>"><?=$arLinkObject['NAME']?></a>
                                                                    <?}?>
                                                                </td>
                                                            </tr>
                                                        <?}?>
                                                        <?if(sizeof($arItem['PROPERTIES']['PHOTO']['SCANS']) >0){?>
                                                            <tr>
                                                                <td class="review-table__cell review-table__cell--title">отзыв(ы):</td>
                                                                <td class="review-table__cell review-table__cell--vtop">
                                                                    <div class="reviews-item__gallery">
                                                                        <?foreach($arItem['PROPERTIES']['PHOTO']['SCANS'] as $arScan){?>
                                                                            <div class="reviews-item__gallery-item">
                                                                                <a href="<?=$arScan['DETAIL_PICTURE']?>" class="link-modal image-block" title="<?=$arItem['NAME']?>" data-subtitle="отзыв о работе" rel="<?=$arItem['ID']?>" data-fancybox_skin="fancybox-black">
                                                                                    <img src="<?=$arScan['PREVIEW_PICTURE']?>" alt="<?=$arItem['NAME']?>" class="image-block__item" />
                                                                                </a>
                                                                            </div>
                                                                        <?}?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?}?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <a href="javascript:;" class="reviews-item__close-link tabs-block__close">свернуть подробности</a>
                                        <a href="javascript:;" class="reviews-item__close-button tabs-block__close"></a>
                                    </div>
                                </div>
                            <?}?>
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
        <script>
            jQuery(document).ready(function($) {
                $(".reviews-block__row .reviews-tabs .reviews-tab").on("click", function(event, data) {
                    $(this).closest(".reviews-block__row").siblings(".reviews-block__row").find(".reviews-tabs").tabs( "option", "active", false );
                });
            });
        </script>
    </div>
</div>
