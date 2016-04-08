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

<ul class="books-block__list">
    <?foreach($arResult["ITEMS"] as $arItem){
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li class="books-block__list-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="book-item">
                <div class="book-item__inner">
                    <div class="book-item__image-block">
                        <div class="book-item__image image-block">
                            <span class="image-block__inner">
                                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" class="image-block__item">
                            </span>
                        </div>
                    </div>
                    <div class="book-item__head">
                        <div class="book-item__head-title book-item__title"><?=$arItem['NAME']?></div>
                    </div>
                    <?if(
                        $arItem['PROPERTIES']['CITY']['VALUE'] <> "" ||
                        $arItem['PROPERTIES']['YEAR']['VALUE'] <> ""
                    ){?>
                        <div class="book-item__prop">
                            <table class="book-item__prop-table table-prop">
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
                    <?if($arItem['PREVIEW_TEXT'] <> ''){?>
                        <div class="book-item__cont">
                            <?=$arItem['PREVIEW_TEXT']?>
                        </div>
                    <?}?>
                </div>
            </a>
        </li>
    <?}?>
</ul>