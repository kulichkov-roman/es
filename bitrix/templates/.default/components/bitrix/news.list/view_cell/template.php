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

//echo "<pre>"; var_dump($arResult['ITEMS']); echo "</pre>";

?>
<div class="catList">
    <ul class="catTile__list">
        <?
        $strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
        $strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
        $arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

        foreach($arResult["ITEMS"] as &$arSection) {
            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strElementEdit);
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);

            $strMainID = $this->GetEditAreaId($arSection['ID']);
            ?>
            <li class="catTile__listItem"> id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                <a href="<?=$arSection["DETAIL_PICTURE"]["SRC"]?>" class="catTile__listItemLink">
                    <img
                        src="<?=$arSection["PREVIEW_PICTURE"]["SRC"]?>"
                        width="<?=$arSection["PREVIEW_PICTURE"]["WIDTH"]?>"
                        height="<?=$arSection["PREVIEW_PICTURE"]["HEIGHT"]?>"
                        class="catTile__listItemImg"
                        alt="<?=$arSection["NAME"]?>"
                        title="<?=$arSection["NAME"]?>"
                    >
                    <div class="catTile__listItemInfo">
                        <div class="catTile__listItemInfoHeader">
                            <?=$arSection["NAME"]?>
                        </div>
                        <?if(is_array($arSection["PROPERTIES"])){
                            foreach($arSection["PROPERTIES"] as &$arProp){
                                switch($arProp["CODE"]){
                                    case "CITY":
                                        ?>
                                        <div class="catTile__listItemInfoCity">
                                            <?=$arProp["VALUE"]?>
                                        </div>
                                        <?
                                        break 2;
                                }
                            }
                        }?>
                    </div>
                </a>
            </li>
        <?}?>
    </ul>
</div><!--/catList-->
