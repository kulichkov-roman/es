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

if($USER->isAdmin())
{
    //pre($arResult['ITEMS']);
}
?>

<div class="books-other__body">
    <div class="scroll-conteiner js-scrollbar" data-scrollstep="190" data-showarrows>
        <div class="books-other__scrollx scroll-element scroll-x">
            <div class="scroll-element_corner"></div>
            <div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_inner-wrapper"><div class="scroll-element_inner scroll-element_track"></div></div><div class="scroll-bar"></div></div>
            <div class="scroll-arrow scroll-arrow_less"></div>
            <div class="scroll-arrow scroll-arrow_more"></div>
        </div>
        <div class="scroll-block">
            <div class="scroll-inner">
                <div class="books-other__list-outer">
                    <ul class="books-other__list">
                        <?foreach($arResult["ITEMS"] as $arItem){
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <li class="books-other__list-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <div class="book-other-item">
                                    <div class="book-other-item__head">
                                        <div class="book-other-item__head-title book-other-item__title">
                                            <?=TruncateText($arItem['NAME'], 35);?>
                                        </div>
                                    </div>
                                    <div class="book-other-item__image">
                                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="image-block__inner">
                                            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" class="image-block__image" />
                                        </a>
                                    </div>
                                    <?if(
                                        $arItem['PROPERTIES']['CITY']['VALUE'] <> "" ||
                                        $arItem['PROPERTIES']['YEAR']['VALUE'] <> ""
                                    ){?>
                                        <div class="book-other-item__cont">
                                            <table class="table-prop">
                                                <tbody>
                                                <?if($arItem['PROPERTIES']['CITY']['VALUE'] <> ''){?>
                                                    <tr>
                                                        <td class="table-prop__cell table-prop__cell--title">город:</td>
                                                        <td class="table-prop__cell"><?=$arItem['PROPERTIES']['CITY']['VALUE']?></td>
                                                    </tr>
                                                <?}?>
                                                <?if($arItem['PROPERTIES']['YEAR']['VALUE'] <> ''){?>
                                                    <tr>
                                                        <td class="table-prop__cell table-prop__cell--title">год:</td>
                                                        <td class="table-prop__cell"><?=$arItem['PROPERTIES']['YEAR']['VALUE']?></td>
                                                    </tr>
                                                <?}?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?}?>
                                </div>
                            </li>
                        <?}?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>