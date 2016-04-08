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

//echo "<pre>"; var_dump($arResult); echo "</pre>";

// помогает отладить закрывающиеся теги
$debugMode = false;
?>

<ul class="catalog__list">
    <?
    $previousLevel = 0;

    $strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
    $strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
    $arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

    foreach ($arResult['SECTIONS'] as &$arSection) {
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

        $currentLevel = $arSection["RELATIVE_DEPTH_LEVEL"];

        if ($currentLevel == 1 && $previousLevel == 1) {
            ?>
            </li>
            <?
        } elseif($currentLevel == 1 && $previousLevel == 2) {
            ?>
                </ul>
            </li>
            <?
        } elseif($currentLevel == 2 && $previousLevel == 1) {
            ?>
            <ul class="catalog__listItemLinkslist">
            <?
        }
        switch($arSection["RELATIVE_DEPTH_LEVEL"])
        {
            case 1:
                ?>
<?if($debugMode){?><!------------------------------------------------1---------------------------------------------><?}?>
                <li class="catalog__listItem" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                    <div class="catalog__listItemImage">
                        <a href="<?=$arSection["SECTION_PAGE_URL"];?>">
                            <img src="<?=$arSection["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arSection['NAME']?>">
                        </a>
                    </div>
                    <div class="catalog__listItemTitle">
                        <a href="<?=$arSection["SECTION_PAGE_URL"];?>" class="catalog__listItemTitleLink">
                            <?=$arSection['NAME']?>
                        </a>
                    </div>
<?if($debugMode){?><!------------------------------------------------/1--------------------------------------------><?}?>
                <?
                break;
            case 2:
                ?>
<?if($debugMode){?><!------------------------------------------------2---------------------------------------------><?}?>
                <li class="catalog__listItemLinkslistItem" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                    <a href="<?=$arSection["SECTION_PAGE_URL"];?>" class="catalog__listItemLinkslistItemLink">
                        <?=$arSection['NAME']?>
                    </a>
                </li>
<?if($debugMode){?><!------------------------------------------------/2--------------------------------------------><?}?>
                <?
                break;
        }
        $previousLevel = $arSection["RELATIVE_DEPTH_LEVEL"];
    }
    unset($arSection);
    ?>
</ul>
<div class="catalog__links">
    <div class="links ">
        <ul class="links__list">
            <li class="links__listItem">
                <a href="<?=MAP_RUSSIA_URL?>" class="links__listItemLink _map">
                    <?=GetMessage("MENU_SHOW_OBJECTS_ON_MAP")?>
                </a>
            </li>
            <li class="links__listItem">
                <a href="<?=MAP_OBJECTS_URL?>" class="links__listItemLink _catalog">
                    <?=GetMessage("MENU_DOWNLOAD_FULL_CATALOG_OBJECTS")?>
                </a>
            </li>
        </ul>
    </div>
</div>