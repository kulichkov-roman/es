<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);
$bShowForm = (strlen($arResult["MESSAGE"]) > 0) || !empty($arResult["ERRORS"]);
?>
<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data" class="bigMapEditable__form <?if(!$bShowForm){?>_hidden<?}?>">
	<?if (!empty($arResult["ERRORS"])):?>
		<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
	<?endif;
	if (strlen($arResult["MESSAGE"]) > 0):?>
		<?ShowNote($arResult["MESSAGE"])?>
	<?endif?>
	<?=bitrix_sessid_post()?>
	<input type="text" class="bigMapEditable__formX" name="PROPERTY[1][0]" value="<?=htmlSafe($_REQUEST["PROPERTY"][1][0])?>"/>
	<input type="text" class="bigMapEditable__formY" name="PROPERTY[2][0]" value="<?=htmlSafe($_REQUEST["PROPERTY"][2][0])?>"/>
	<input type="text" class="bigMapEditable__formCityname" id="CITY_NAME" name="PROPERTY[NAME][0]" value="<?=htmlSafe($_REQUEST["PROPERTY"][NAME][0])?>" placeholder="<?=GetMessage("ADD_CITY_NAME")?>"/>
	<input type="hidden" name="PROPERTY[CODE][0]" id="CITY_CODE" value="" />
	<input type="submit"  name="iblock_submit" value="<?=GetMessage("ADD_CITY_SUBMIT")?>"/>
</form>