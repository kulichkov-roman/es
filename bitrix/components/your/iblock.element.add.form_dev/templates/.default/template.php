<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($_SERVER['REMOTE_ADDR'] === "212.164.215.44"){?>
    <?
    //echo "<pre>"; var_dump($_REQUEST); echo "</pre>";
    //die();
    ?>
<?}?>

<?$this->SetViewTarget('showDev');?>
    <?if (isset($_GET['strIMessage_dev']) && $_GET['strIMessage_dev'] <> '') {?> 
        <script>
            $(function() {
                $('.n-sidebar__item_dev').trigger('click');
            })
        </script>
    <?}?>
<?$this->EndViewTarget();?>

<div class="n-dialog n-dev-dialog" style="display:none;" title="ЗАПИСАТЬСЯ НА СЕРВИС">
	<div class="n-dialog__wrapper">
        <form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
            <?if (count($arResult["ERRORS"])>0) {?>
                <div class="form_message2" style="margin-bottom: 20px;">
                    <h5 class="message_title">Необходимо исправить следующие ошибки:</h5>
                    <div class="message_item">
                        <?foreach ($arResult["ERRORS"] as $v) {
                            $res = mb_strrichr($v, "<br>", true);
                            echo $res === false ? $v : $res;
                        }?>
                    </div>
                </div>
            <?} elseif (strlen($arResult["MESSAGE"]) > 0) {?>
                <div class="form_message3" style="margin-bottom: 20px;">
                    <div class="message_item">
                        <?
                        $res = mb_strrichr($arResult["MESSAGE"], "<br>", true);
                        echo $res === false ? $arResult["MESSAGE"] : $res;
                        ?>
                    </div>
                </div>
            <?}?>
            <div style="display: none;">
                <input type="text" value="" size="25" name="NAME_USER_FALSE">
            </div>
            <?=bitrix_sessid_post();?>
            <?if ($arParams["MAX_FILE_SIZE"] > 0){?>
                <input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" />
            <?}?>
			<?if (strlen($arResult["MESSAGE"]) == 0){?>
                <div class="n-dialog__input-wrapper">
                    <input name="PROPERTY[NAME][0]" class="n-dialog__input n-dialog__input-name" type="text" placeholder="ФИО" />
                    <span class="n-dialog__icon n-dialog__icon_wrong"></span>
                </div>
                <div class="n-dialog__input-wrapper">
                    <input name="PROPERTY[310][0]" class="n-dialog__input n-dialog__input-name" type="text" placeholder="E-Mail" />
                </div>
                <div class="n-dialog__input-wrapper">
                    <input name="PROPERTY[309][0]" class="n-dialog__input n-dialog__input-model" type="text" placeholder="Ваш номер телефона" />
                    <span class="n-dialog__icon n-dialog__icon_wrong"></span>
                </div>
                <div class="n-dialog__input-wrapper">
                    <select name="PROPERTY[301]" class="n-dialog__model-select">
                        <?
                        $sKey = "ELEMENT_PROPERTIES";
        
                        foreach ($arResult["PROPERTY_LIST_FULL"][301]["ENUM"] as $key => $arEnum)
                        {
                            $checked = false;
                            if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                            {
                                foreach ($arResult[$sKey][301] as $elKey => $arElEnum)
                                {
                                    if ($key == $arElEnum["VALUE"])
                                    {
                                        $checked = true;
                                        break;
                                    }
                                }
                            }
                            else
                            {
                                if ($arEnum["DEF"] == "Y") $checked = true;
                            }
                            ?>
                            <option value="<?=$key?>"><?=$arEnum["VALUE"]?></option>
                            <?
                        }
                        ?>
                        <option value="0">Другая модель</option>
                    </select>
                    <span class="n-dialog__icon n-dialog__icon_right"></span>
                </div>
                <div class="n-dialog__input-wrapper n-dialog__model-wrapper">
					<input name="PROPERTY[311][0]" class="n-dialog__input n-dialog__input-model" type="text" placeholder="Другая модель" />
					<span class="n-dialog__icon n-dialog__icon_wrong"></span>
				</div>
                <div class="n-dialog__input-wrapper">
					<select name="PROPERTY[316]" class="n-dialog__model-select">
                        <?
                        $sKey = "ELEMENT_PROPERTIES";
    
                        foreach ($arResult["PROPERTY_LIST_FULL"][316]["ENUM"] as $key => $arEnum)
                        {
                            $checked = false;
                            if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                            {
                                foreach ($arResult[$sKey][316] as $elKey => $arElEnum)
                                {
                                    if ($key == $arElEnum["VALUE"])
                                    {
                                        $checked = true;
                                        break;
                                    }
                                }
                            }
                            else
                            {
                                if ($arEnum["DEF"] == "Y") $checked = true;
                            }
                            ?>
                            <option value="<?=$key?>"><?=$arEnum["VALUE"]?></option>
                            <?
                        }
                        ?>
                    </select>
					<span class="n-dialog__icon n-dialog__icon_right"></span>
				</div>
                <div class="n-dialog__input-wrapper">
                    <input name="PROPERTY[302][0]" class="n-dialog__input n-dialog__input_double n-dialog__date" type="text" placeholder="Желаемая дата"/>
                    <span class="n-dialog__icon n-dialog__icon_wrong"></span>
                </div>
                <div class="n-dialog__input-wrapper">
                    <input name="PROPERTY[303][0]" class="n-dialog__input n-dialog__input_double n-dialog__time-input" type="text" placeholder="Желаемое время"/>
                    <span class="n-dialog__icon n-dialog__icon_wrong"></span>
                    <div class="n-dialog__time">
                        <span class="n-dialog__time-arrow"></span>
                        <span class="n-dialog__time-close"></span>
                        <div><!-- Обертка для функционирования :first-child -->
                            <span class="n-dialog__time-header">УТРО</span><!-- 
                            --><span class="n-dialog__time-header">ДЕНЬ</span><!-- 
                            --><span class="n-dialog__time-header">ВЕЧЕР</span>
                        </div>
                        <div> <!-- Обертка, чтобы "перевести строку" -->
                            <div class="n-dialog__time-block">
                                    <span class="n-dialog__time-item">9:00</span><!-- 
                                --><span class="n-dialog__time-item">9:30</span><!-- 
                                --><span class="n-dialog__time-item">10:00</span><!-- 
                                --><span class="n-dialog__time-item">10:30</span><!-- 
                                --><span class="n-dialog__time-item">11:00</span><!-- 
                                --><span class="n-dialog__time-item">11:30</span><!-- 
                                --><span class="n-dialog__time-item">12:00</span><!-- 
                                --><span class="n-dialog__time-item">12:30</span>
                            </div><!-- 
                            --><div class="n-dialog__time-block">
                                <span class="n-dialog__time-item">13:00</span><!-- 
                                --><span class="n-dialog__time-item">13:30</span><!-- 
                                --><span class="n-dialog__time-item">14:00</span><!-- 
                                --><span class="n-dialog__time-item">14:30</span><!-- 
                                --><span class="n-dialog__time-item">15:00</span><!-- 
                                --><span class="n-dialog__time-item">15:30</span><!-- 
                                --><span class="n-dialog__time-item">16:00</span><!-- 
                                --><span class="n-dialog__time-item">16:30</span>
                            </div><!-- 
                            --><div class="n-dialog__time-block">
                                <span class="n-dialog__time-item">17:00</span><!-- 
                                --><span class="n-dialog__time-item">17:30</span><!-- 
                                --><span class="n-dialog__time-item">18:00</span><!-- 
                                --><span class="n-dialog__time-item">18:30</span><!-- 
                                --><span class="n-dialog__time-item">19:00</span><!-- 
                                --><span class="n-dialog__time-item">19:30</span><!-- 
                                --><span class="n-dialog__time-item">20:00</span><!-- 
                                --><span class="n-dialog__time-item">20:30</span>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="n-dialog__send-button" name="iblock_submit_dev" value="Отправить">
            <?}?>
        </form>
	</div>
</div>

<?/*
<?if (strlen($arResult["MESSAGE"]) == 0) {?>
    <h5 class="rl-fancybox__title">
        Есть вопросы? Спрашивайте
    </h5>
<?}?>
<form id="back" class="_js-form" name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
    <?=bitrix_sessid_post()?>
    <fieldset>
        <div class="rl-fancybox__row <?if(count($arResult["ERRORS"])){?>_errors<?}?>" <?if(strlen($arResult["MESSAGE"])>0){ ?>style="margin-top: 15px;"<?}?>>
            <?if (count($arResult["ERRORS"])>0) {?>
                <div class="form_message2 pie-fix" style="margin-bottom: 20px;">
                    <h5 class="message_title">Необходимо исправить следующие ошибки:</h5>
                    <div class="message_item">
                        <?foreach ($arResult["ERRORS"] as $v) {
                            $res = mb_strrichr($v, "<br>", true);
                            echo $res === false ? $v : $res;
                        }?>
                    </div>
                </div>
            <?} elseif (strlen($arResult["MESSAGE"]) > 0) {?>
                <h5 class="rl-fancybox__title">
                    <?
                    $res = mb_strrichr($arResult["MESSAGE"], "<br>", true);
                    echo $res === false ? $arResult["MESSAGE"] : $res;
                    ?>
                </h5>
            <?}?>
        </div>
        <?if (strlen($arResult["MESSAGE"]) == 0) {?>
            <div class="rl-fancybox__row">
                <input class="rl-fancybox__row-input" type="text" name="PROPERTY[NAME][0]" placeholder="ИМЯ*" size="25" value="">
            </div>
            <div class="rl-fancybox__row">
                <input class="rl-fancybox__row-input" type="text" name="PROPERTY[37][0]" placeholder="ТЕЛЕФОН*" size="25" value="">
            </div>
            <div class="rl-fancybox__row">
                <textarea class="rl-fancybox__row-textarea" cols="30" rows="5" name="PROPERTY[PREVIEW_TEXT][0]" placeholder="ВОПРОС"></textarea>
            </div>
            <!--!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
            <div class="rl-fancybox__row">
                <input class="rl-fancybox__row-submit _small" type="submit" name="iblock_submit_dev" value="Отправить">
            </div>
            
            
            
        <?}?>
    </fieldset>
</form>

*/?>

<?/*?>
<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>

		<?if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])):?>
		<tbody>
			<?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
				<tr>
					<td><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?><?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><span class="starrequired">*</span><?endif?></td>
					<td>
						<?
						if (intval($propertyID) > 0)
						{
							if (
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
							elseif (
								(
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
									||
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
								)
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
						}
						elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
							$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

						if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
						{
							$inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
							$inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
						}
						else
						{
							$inputNum = 1;
						}

						if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
							$INPUT_TYPE = "USER_TYPE";
						else
							$INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];

						switch ($INPUT_TYPE):
							case "USER_TYPE":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
										$description = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
										$description = "";
									}
									else
									{
										$value = "";
										$description = "";
									}
									echo call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
										array(
											$arResult["PROPERTY_LIST_FULL"][$propertyID],
											array(
												"VALUE" => $value,
												"DESCRIPTION" => $description,
											),
											array(
												"VALUE" => "PROPERTY[".$propertyID."][".$i."][VALUE]",
												"DESCRIPTION" => "PROPERTY[".$propertyID."][".$i."][DESCRIPTION]",
												"FORM_NAME"=>"iblock_add",
											),
										));
								?><br /><?
								}
							break;
							case "TAGS":
								$APPLICATION->IncludeComponent(
									"bitrix:search.tags.input",
									"",
									array(
										"VALUE" => $arResult["ELEMENT"][$propertyID],
										"NAME" => "PROPERTY[".$propertyID."][0]",
										"TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'"',
									), null, array("HIDE_ICONS"=>"Y")
								);
								break;
							case "HTML":
								$LHE = new CLightHTMLEditor;
								$LHE->Show(array(
									'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[".$propertyID."][0]"),
									'width' => '100%',
									'height' => '200px',
									'inputName' => "PROPERTY[".$propertyID."][0]",
									'content' => $arResult["ELEMENT"][$propertyID],
									'bUseFileDialogs' => false,
									'bFloatingToolbar' => false,
									'bArisingToolbar' => false,
									'toolbarConfig' => array(
										'Bold', 'Italic', 'Underline', 'RemoveFormat',
										'CreateLink', 'DeleteLink', 'Image', 'Video',
										'BackColor', 'ForeColor',
										'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull',
										'InsertOrderedList', 'InsertUnorderedList', 'Outdent', 'Indent',
										'StyleList', 'HeaderList',
										'FontList', 'FontSizeList',
									),
								));
								break;
							case "T":
								for ($i = 0; $i<$inputNum; $i++)
								{

									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
									}
									else
									{
										$value = "";
									}
								?>
						<textarea cols="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>" rows="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]"><?=$value?></textarea>
								<?
								}
							break;

							case "S":
							case "N":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

									}
									else
									{
										$value = "";
									}
								?>
								<input type="text" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="25" value="<?=$value?>" /><br /><?
								if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
									$APPLICATION->IncludeComponent(
										'bitrix:main.calendar',
										'',
										array(
											'FORM_NAME' => 'iblock_add',
											'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
											'INPUT_VALUE' => $value,
										),
										null,
										array('HIDE_ICONS' => 'Y')
									);
									?><br /><small><?=GetMessage("IBLOCK_FORM_DATE_FORMAT")?><?=FORMAT_DATETIME?></small><?
								endif
								?><br /><?
								}
							break;

							case "F":
								for ($i = 0; $i<$inputNum; $i++)
								{
									$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									?>
						<input type="hidden" name="PROPERTY[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" value="<?=$value?>" />
						<input type="file" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"  name="PROPERTY_FILE_<?=$propertyID?>_<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>" /><br />
									<?

									if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
									{
										?>
					<input type="checkbox" name="DELETE_FILE[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" id="file_delete_<?=$propertyID?>_<?=$i?>" value="Y" /><label for="file_delete_<?=$propertyID?>_<?=$i?>"><?=GetMessage("IBLOCK_FORM_FILE_DELETE")?></label><br />
										<?

										if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
										{
											?>
					<img src="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>" height="<?=$arResult["ELEMENT_FILES"][$value]["HEIGHT"]?>" width="<?=$arResult["ELEMENT_FILES"][$value]["WIDTH"]?>" border="0" /><br />
											<?
										}
										else
										{
											?>
					<?=GetMessage("IBLOCK_FORM_FILE_NAME")?>: <?=$arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"]?><br />
					<?=GetMessage("IBLOCK_FORM_FILE_SIZE")?>: <?=$arResult["ELEMENT_FILES"][$value]["FILE_SIZE"]?> b<br />
					[<a href="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>"><?=GetMessage("IBLOCK_FORM_FILE_DOWNLOAD")?></a>]<br />
											<?
										}
									}
								}

							break;
							case "L":

								if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
								else
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

								switch ($type):
									case "checkbox":
									case "radio":
										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
							<input type="<?=$type?>" name="PROPERTY[<?=$propertyID?>]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label><br />
											<?
										}
									break;

									case "dropdown":
									case "multiselect":
									?>
							<select name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""?>">
								<option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
									<?
										if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
										else $sKey = "ELEMENT";

										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
												{
													if ($key == $arElEnum["VALUE"])
													{
														$checked = true;
														break;
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}
											?>
								<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
											<?
										}
									?>
							</select>
									<?
									break;

								endswitch;
							break;
						endswitch;?>
					</td>
				</tr>
			<?endforeach;?>
			<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
				<tr>
					<td><?=GetMessage("IBLOCK_FORM_CAPTCHA_TITLE")?></td>
					<td>
						<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
					</td>
				</tr>
				<tr>
					<td><?=GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT")?><span class="starrequired">*</span>:</td>
					<td><input type="text" name="captcha_word" maxlength="50" value=""></td>
				</tr>
			<?endif?>
		</tbody>
		<?endif?>
		<tfoot>
			<tr>
				<td colspan="2">
					<input type="submit" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
					<?if (strlen($arParams["LIST_URL"]) > 0):?>
						<input type="submit" name="iblock_apply" value="<?=GetMessage("IBLOCK_FORM_APPLY")?>" />
						<input
							type="button"
							name="iblock_cancel"
							value="<? echo GetMessage('IBLOCK_FORM_CANCEL'); ?>"
							onclick="location.href='<? echo CUtil::JSEscape($arParams["LIST_URL"])?>';"
						>
					<?endif?>
				</td>
			</tr>
		</tfoot>
	</table>
</form>
<?*/?>