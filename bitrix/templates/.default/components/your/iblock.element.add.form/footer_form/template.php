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
// echo '<pre>';
// print_r($arParams);
// echo '</pre>';?>

<div class="popup" id="feedback">
    <div class="popup__header">
                    <span class="popup__headerTitle">
                    <?=GetMessage("FILL_IN_FORM")?>
                    </span>
                    <span class="popup__headerSubtitle">
                    <?=GetMessage("SPECIALIST")?>
                    </span>
    </div>
    <div class="popup__feedback">
        <div class="feedback">
        	<?
        	$bShowForm = false;
        	$bShowSuccess = false;
        	if (!empty($arResult["ERRORS"])):?>
				<?ShowError(implode("<br />", $arResult["ERRORS"]));
				$bShowForm = true;?>
			<?endif;
			if (strlen($arResult["MESSAGE"]) > 0):?>
				<?
				// ShowNote($arResult["MESSAGE"]);
				$bShowSuccess = true;
				?>
			<?endif?>
            <form class="feedback__form" name="iblock_add" class="feedback__form" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
                <?=bitrix_sessid_post();?>
                <div style="display: none;">
                	<input type="text" value="" size="25" name="NAME_USER_FALSE">
            	</div>
                <div class="feedback__formRow">
                    <input name="PROPERTY[NAME][0]" value="<?=htmlspecialcharsbx($_REQUEST["PROPERTY"]["NAME"][0])?>" type="text" class="feedback__formInput" placeholder="<?=GetMessage("CONTACT_PLACEHOLDER_CORP_NAME")?>"/>
                </div>
                <div class="feedback__formRow">
                    <input name="PROPERTY[9][0]" type="text" class="feedback__formInput" value="<?=htmlspecialcharsbx($_REQUEST["PROPERTY"][9][0])?>" placeholder="<?=GetMessage("CONTACT_PLACEHOLDER_NAME")?>"/>
                </div>
                <div class="feedback__formRow">
                    <input name="PROPERTY[10][0]" type="text" class="feedback__formInput" value="<?=htmlspecialcharsbx($_REQUEST["PROPERTY"][10][0])?>" placeholder="<?=GetMessage("CONTACT_PLACEHOLDER_CONTACT")?>"/>
                </div>
                <div class="feedback__formRow">
	                <select name="PROPERTY[11]" class="feedback__formSelect _js-custom-select_feedback">
		                <?foreach($arResult["PROPERTY_LIST_FULL"][11]["ENUM"] as $optionId => $arOption) {?>
		                    <option <?=$optionId == htmlspecialcharsbx($_REQUEST["PROPERTY"][11]) ? "selected" : "" ?> value="<?=$optionId?>"><?=$arOption["VALUE"]?></option>
		                <?}?>
	                </select>
            	</div>
                <div class="feedback__formRow">
                    <textarea name="PROPERTY[DETAIL_TEXT][0]" class="feedback__formTextArea" placeholder="<?=GetMessage("CONTACT_PLACEHOLDER_DETAIL_TEXT")?>"><?=htmlspecialcharsbx($_REQUEST["PROPERTY"]["DETAIL_TEXT"][0])?></textarea>
                </div>
                <div class="feedback__formRow _submit">
                    <input type="submit" name="<?=$arParams['PREFIX_FORM']?>_iblock_submit" class="feedback__formSubmit" value="<?=GetMessage("CONTACT_SUBMIT")?>"/>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="popup" id="finish">
    <div class="popup__header _centered">
            <span class="popup__headerTitle">
                <?=GetMessage("CONTACT_THANKS")?>
            </span>
            <span class="popup__headerSubtitle">
                <p>
                    <?=GetMessage("CONTACT_TIME")?>
                </p>
                <p>
                	<?=GetMessage("CONTACT_WORK_TIME")?>
                </p>
            </span>
    </div>
    <span class="popup__closeButton"><?=GetMessage("CONTACT_CLOSE")?></span>
</div>
<a href="#finish" class="footer__emailLink"></a>
<
<?
if($bShowSuccess){?>
	<script>
	$(document).ready(function(){
		$('a[href="#finish"]').click();
	})
	</script>
<?}
elseif($bShowForm){?>
	<script>
	$(document).ready(function(){
		$('a[href="#feedback"]').click();
	})
	</script>
<?}
?>