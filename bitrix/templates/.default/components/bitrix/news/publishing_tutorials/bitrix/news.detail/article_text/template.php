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
    //pre($arResult);
}
?>
<div class="page-head">
    <div class="page-head__prev">
        <a class="page-head__prev-link" href="<?=PUBLISHING_TUTORIALS_URL?>">Учебники и рекомендации</a>
    </div>
    <div class="page-head__cont">
        <h1 class="page-head__title"><?=$arResult['NAME']?></h1>
    </div>
</div>
<div class="book-detail">
    <div class="book-detail__body">
        <div class="book-detail__image-block">
            <div class="book-detail__image image-block">
                <span class="image-block__inner">
                    <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult['NAME']?>" class="image-block__item" />
                </span>
            </div>
            <?if(
                $arResult['PROPERTIES']['CITY']['VALUE'] <> "" ||
                $arResult['PROPERTIES']['YEAR']['VALUE'] <> ""
            ){?>
                <div class="book-detail__prop">
                    <table class="table-prop">
                        <tbody>
                        <?if($arResult['PROPERTIES']['CITY']['VALUE'] <> ''){?>
                            <tr>
                                <td class="table-prop__cell table-prop__cell--title">город:</td>
                                <td class="table-prop__cell"><?=$arResult['PROPERTIES']['CITY']['VALUE']?></td>
                            </tr>
                        <?}?>
                        <?if($arResult['PROPERTIES']['YEAR']['VALUE'] <> ''){?>
                            <tr>
                                <td class="table-prop__cell table-prop__cell--title">год:</td>
                                <td class="table-prop__cell"><?=$arResult['PROPERTIES']['YEAR']['VALUE']?></td>
                            </tr>
                        <?}?>
                        </tbody>
                    </table>
                </div>
            <?}?>
        </div>
        <?if($arResult['DETAIL_TEXT'] <> ""){?>
            <div class="book-detail__wrap">
                <?=$arResult['DETAIL_TEXT']?>
            </div>
        <?}?>
    </div>
</div>