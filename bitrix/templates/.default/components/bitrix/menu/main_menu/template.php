<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//echo "<pre>"; var_dump($arResult); echo "</pre>";?>

<?
// помогает отладить закрывающиеся теги
$debugMode = false;
?>

<?if (!empty($arResult)){?>
    <div class="menu">
        <ul class="menu__list">
            <?
            $previousLevel = 0;
            $previousLink = "";
            foreach ($arResult as $arItem) {
                $currentLevel = $arItem["DEPTH_LEVEL"];
                $currentLink = $arItem["LINK"];
                if ($currentLevel == 1 && $previousLevel == 1) {
                    ?>
                    </li>
                    <?
                } elseif($currentLevel == 2 && $previousLevel == 2) {
                    ?>
                    </li>
                    <?
                } elseif ($currentLevel == 1 && $previousLevel == 2) {
                    ?>
                                </li>
                            </ul>
                            <?
                            if(strpos($previousLink, '/objects/') !== false){?>
                                <div class="menu__submenuAdditional">
                                    <div class="links ">
                                        <ul class="links__list">
                                            <li class="links__listItem">
                                                <a href="<?=OBJECTS_MAP_RUSSIA_URL?>" class="links__listItemLink _map">
                                                    <?=GetMessage("MENU_SHOW_OBJECTS_ON_MAP")?>
                                                </a>
                                            </li>
                                            <li class="links__listItem">
                                                <a href="<?=OBJECT_FILE_PDF_URL?>" target="_blank" class="links__listItemLink _catalog">
                                                    <?=GetMessage("MENU_DOWNLOAD_FULL_CATALOG_OBJECTS")?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?}?>
                        </div>
                    </li>
                <?
                } elseif ($currentLevel == 1 && $previousLevel == 3) {
                    ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <?if(strpos($previousLink, '/objects/') !== false){?>
                            <div class="menu__submenuAdditional">
                                <div class="links ">
                                    <ul class="links__list">
                                        <li class="links__listItem">
                                            <a href="<?=MAP_RUSSIA_URL?>" class="links__listItemLink _map">
                                                <?=GetMessage("MENU_SHOW_OBJECTS_ON_MAP")?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?}?>
                    </div>
                    <?
                } elseif ($currentLevel == 2 && $previousLevel == 3) {
                    ?>
                            </ul>
                        </li>
                    <?
                } elseif ($currentLevel == 3 && $previousLevel == 1) {
                    ?>
                            </ul>
                        </li>
                    </ul>
                    <?
                }
                switch($arItem["DEPTH_LEVEL"])
                {
                    case 1:
                        ?>

                        <li class="menu__listItem">
	                        <?
	                        if ($arItem["IS_PARENT"]) {
	                            $class = "menu__listItemLink";
                            } else {
	                            $class = "menu__listItemLinker";
                            }
	                        ?>
                            <a href="<?=$arItem["LINK"]?>" class="<?=$class?> <?if($arItem["SELECTED"]){?>_active<?}?>">
                                <?=$arItem["TEXT"]?>
                            </a>
                            <?if ($arItem["IS_PARENT"]) {?>
                                <div class="menu__submenu _big">
                                    <ul class="menu__submenuList">
                            <?}?>
<?if($debugMode){?><!------------------------------------------------/1-------------------------------------------><?}?>
                        <?
                        break;
                    case 2:
                        ?>
<?if($debugMode){?><!------------------------------------------------2--------------------------------------------><?}?>
                        <li class="menu__submenuListItem <?if($arItem["IS_PARENT"]) {?>_has_items<?}?>">
                            <?if(!$arItem["IS_PARENT"]){?>
                                <a href="<?=$arItem["LINK"]?>" class="menu__submenuListItemLink"><?=$arItem["TEXT"]?></a>
                            <?} else {?>
                                <span class="menu__submenuListItemLink"><?=$arItem["TEXT"]?></span>
                            <?}?>
                            <?if ($arItem["IS_PARENT"]) {?>
                                <ul class="menu__submenuListItemSublist">
                            <?}?>
<?if($debugMode){?><!------------------------------------------------/2-------------------------------------------><?}?>
                        <?
                        break;
                    case 3:
                        ?>
<?if($debugMode){?><!------------------------------------------------3--------------------------------------------><?}?>
                        <li class="menu__submenuListItemSublistItem">
                            <a href="<?=$arItem["LINK"]?>" class="menu__submenuListItemSublistItemLink">
                                <?=$arItem["TEXT"]?>
                            </a>
                        </li>
<?if($debugMode){?><!------------------------------------------------/3-------------------------------------------><?}?>
                        <?
                        break;
                }
                $previousLevel = $arItem["DEPTH_LEVEL"];
                $previousLink = $arItem["LINK"];
                ?>
            <?}?>
            <?if ($previousLevel == 1) {?>
                </li>
            <?} elseif($previousLevel == 2){?>
                </li>
            <?}?>
                </ul>
            </div>
        </li>
    </ul>
</div>
<?}?>