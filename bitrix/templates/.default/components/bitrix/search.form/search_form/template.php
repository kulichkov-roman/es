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

<form action="<?=$arResult["FORM_ACTION"]?>" class="search__form">
    <fieldset>
        <input type="text" placeholder="Поиск" name="q" value="<?=htmlspecialcharsbx($_REQUEST["q"])?>" class="search__formInput search__formInput--darck"/>
        <input type="submit" name="s" class="search__formIcon search__formIcon--darck" value=""/>
        <input type="hidden" name="s" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>"/>
    </fieldset>
</form>