<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?//echo "<pre>"; var_dump($arResult); echo "</pre>";?>

<div class="contacts__form">
    <div class="contacts__formHeader">
        <?=GetMessage("CONTACT_TITLE");?>
    </div>
    <div class="feedback">
        <form name="iblock_add" class="feedback__form" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
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
            <div class="feedback__formRow">
                <input type="text" name="PROPERTY[NAME][0]" class="feedback__formInput" placeholder="<?=GetMessage("CONTACT_PLACEHOLDER_CORP_NAME");?>"/>
            </div>
            <div class="feedback__formRow">
                <input type="text" name="PROPERTY[9][0]" class="feedback__formInput" placeholder="<?=GetMessage("CONTACT_PLACEHOLDER_NAME");?>"/>
            </div>
            <div class="feedback__formRow">
                <input type="text" name="PROPERTY[10][0]" class="feedback__formInput" placeholder="<?=GetMessage("CONTACT_PLACEHOLDER_CONTACT");?>"/>
            </div>
            <div class="feedback__formRow">
                <select name="PROPERTY[11]" class="feedback__formSelect _js-custom-select_feedback">
                    <?
                    $sKey = "ELEMENT_PROPERTIES";

                    foreach ($arResult["PROPERTY_LIST_FULL"][11]["ENUM"] as $key => $arEnum)
                    {
                        $checked = false;
                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                        {
                            foreach ($arResult[$sKey][11] as $elKey => $arElEnum)
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
            </div>
            <div class="feedback__formRow">
                <textarea name="PROPERTY[DETAIL_TEXT][0]" class="feedback__formTextArea" placeholder="<?=GetMessage("CONTACT_PLACEHOLDER_DETAIL_TEXT");?>"></textarea>
            </div>
            <div class="feedback__formRow _submit">
                <input type="submit" name="iblock_submit_contact"  class="feedback__formSubmit" value="<?=GetMessage("CONTACT_SUBMIT");?>"/>
            </div>
        </form>
    </div>
</div>

<?/*?>
<div class="n-closed" style="display:none;">
    <div class="n-closed__wrapper">
        <div class="n-closed__content">
            <div class="n-closed__type1">
                <div class="n-closed__text">
                    Благодарим за посещение нашего сайта.<br>
                    Вы провели на сайте <span class="n-closed__spent-time">01 минут 35 секунд</span>.<br>
                    Пожалуйста, укажите причину вашего ухода.
                </div>
            </div>
            <div class="n-closed__type2">
                <div class="n-closed__text">
                    Оставьте свой номер телефона. <br>
                    Наш менеджер перезвонит и ответит<br>
                    на все интересующие Вас вопросы.
                </div>
            </div>
            <form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
                <div style="display: none;">
                    <input type="text" value="" size="25" name="NAME_USER_FALSE">
                </div>
                <?=bitrix_sessid_post();?>
                <?if ($arParams["MAX_FILE_SIZE"] > 0){?>
                    <input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" />
                <?}?>
                <?if (strlen($arResult["MESSAGE"]) == 0) {?>
                    <div class="n-closed__type1">
                        <div class="n-closed__choose">
                            <label>
                                <div class="n-clossed__choose-item">
                                    <input type="radio" name="found" value="found" id="reachGoalExit" onclick="yaCounter1754383.reachGoal('EXIT'); return true;"> Информация на сайте оказалась полной и полезной.
                                </div>
                            </label>
                            <label>
                                <div class="n-clossed__choose-item">
                                    <input type="radio" name="found" value="not-found" id="reachGoalGo2step" onclick="yaCounter1754383.reachGoal('GO2STEP'); return true;"> Не получил(а) необходимой информации.
                                </div>
                            </label>
                        </div>
                        <button type="submit" class="n-closed__send-button">ОТПРАВИТЬ</button>
                    </div>
                    <div class="n-closed__type2">
                        <div class="n-closed__input-wrapper">
                            <input name="PROPERTY[NAME][0]" class="n-closed__input n-closed__input-phone" type="text" placeholder="Номер Вашего телефона" />
                            <span class="n-closed__icon n-closed__icon_wrong"></span>
                        </div>
                        <input type="submit" id="reachGoalClose" onclick="yaCounter1754383.reachGoal('CLOSE'); return true;" class="n-closed__send-button" name="iblock_submit_closed" value="ОТПРАВИТЬ">
                    </div>
                <?}?>
            </form>
        </div>
    </div>
</div>
<?*/?>