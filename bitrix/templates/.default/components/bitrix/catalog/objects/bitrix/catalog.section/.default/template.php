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
<ul class="catList__list">
    <?
    $strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
    $strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
    $arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

    foreach($arResult["ITEMS"] as &$arSection) {
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strElementEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
        $strMainID = $this->GetEditAreaId($arSection['ID']);
        ?>
        <li class="catList__listItem" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
            <div class="catList__listItemSidebar">
                <a href="<?=$arSection["DETAIL_PAGE_URL"]?>" class="catList__listItemSidebarLink">
                    <img
                        src="<?=$arSection["PREVIEW_PICTURE"]["SRC"]?>"
                        alt="<?=$arSection["NAME"]?>"
                        class="catList__listItemSidebarLinkImages"
                        title="<?=$arSection["NAME"]?>"
                    />
                </a>
            </div>
            <div class="catList__listItemInfo">
                <h5 class="catList__listItemInfoHeader"><?=$arSection["NAME"]?></h5>
                <?if(is_array($arSection["PROPERTIES"])){
                    foreach($arSection["PROPERTIES"] as &$arProp){
                        switch($arProp["CODE"]){
                            case "PHOTO":
                            case "YANDEX_LOCATION":
                                continue 2;
                                break;
                        }
                        if($arProp["VALUE"] <> ""){?>
                            <div class="catList__listItemInfoSection">
                                <span class="catList__listItemInfoSectionHeader">
                                    <?=ToLower($arProp["NAME"])?>:
                                </span>
                                <div class="catList__listItemInfoSectionContent">
                                    <?if($arProp["CODE"] == "CITY"){?>
                                        <?if(
                                            $arSection["PROPERTIES"]["CITY"]["PAGE_CITY_MAP"] <> "" &&
                                            $arSection["PROPERTIES"]["CITY"]["VALUE"]
                                        ){?>
                                            <?=$arSection["PROPERTIES"]["CITY"]["VALUE"]?>
                                            <a href="<?=$arSection["PROPERTIES"]["CITY"]["PAGE_CITY_MAP"]?>" class="catList__listItemInfoSectionContentLink _on_map">
                                                <?=GetMessage("OBJECT_SECTION_WATCH_ON_MAP");?>
                                            </a>
                                        <?}?>
                                    <?} else {?>
                                        <?=$arProp["VALUE"]?>
                                    <?}?>
                                </div>
                            </div>
                        <?}
                    }
                }?>
            </div>
        </li>
    <?}?>
</ul>