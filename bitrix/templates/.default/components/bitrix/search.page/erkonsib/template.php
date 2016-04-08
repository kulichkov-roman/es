<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<?
if(empty($arResult["SEARCH"])){?>
	<div class="news" style="color: green;">
		<?=GetMessage("SEARCH_NOTHING_IS_FOUND")?>
	</div>
	<?return;
}
?>
<div class="news">
	<div class="news__toolbar">
	    <?=$arResult["NAV_STRING"]?>
	    <div class="news__toolbarCounter">
	        <div class="viewCounter">
	            <span class="viewCounter__title">
	                <?=GetMessage("NEWS_COUNT_NEWS")?>
	            </span>
	            <?
	            global $arPerPageCount;

	            $curPerPage = intval($_REQUEST["PER_PAGE"]);
	            $activePerPageKey = intval(array_search($curPerPage, $arPerPageCount));
	            $newCount = $arPerPageCount[$activePerPageKey];
	            ?>
	            <ul class="viewCounter__list">
	                <?foreach($arPerPageCount as $key => $perPage)
	                {
	                    $activeClass = "";
	                    if($key == $activePerPageKey)
	                    {
	                        $activeClass = "_active";
	                    }
	                    ?>
	                    <li class="viewCounter__listItem">
	                        <a class="viewCounter__listItemLink <?=$activeClass?>" href="<?=$APPLICATION->GetCurPageParam("PER_PAGE=" . $perPage, array("PER_PAGE"))?>"><?=$perPage?></a>
	                    </li>
	                    <?
	                }
	                ?>
	            </ul>
	        </div>
	    </div>
	</div>
	<ul class="news__list">
	    <?
	    foreach($arResult["SEARCH"] as $arItem){
	        ?>
	        <li class="news__listItem">
	            <div class="news__listItemAside">
	            	<?
	            	$pict = $arResult["ITEM_PICTS"][ $arItem["ITEM_ID"] ];
	            	if($pict){?>
		                <div class="news__listItemAsideImage">
		                    <a href="<?=$arItem["URL"]?>" class="news__listItemAsideImageLink">
		                        <img src="<?=$pict?>" class="news__listItemAsideImageLinkImage">
		                    </a>
		                </div>
	                <?}?>
	                <?
	                $date = $arItem["DATE_CHANGE"];
	                if($date){?>
		                <div class="news_listItemAsideDate">
		                    <?=$date?>
		                </div>
	                <?}?>
	            </div>
	            <div class="news__listItemContent">
	                <h4 class="news__listItemContentTitle">
	                        <a href="<?=$arItem["URL"]?>" class="news__listItemContentTitleLink">
	                            <?=$arItem["TITLE"]?>
	                        </a>
	                </h4>
	                <p class="news__listItemContentText">
	                    <?= $arItem["BODY_FORMATED"];?>
	                </p>
	                <a href="<?=$arItem["URL"]?>" class="news_listItemContentLink">
	                    <?=GetMessage("SEARCH_LINK_READ_MORE");?>
	                </a>
	            </div>
	        </li>
	    <?}?>
	</ul>
	<div class="news__toolbar">
	    <?=$arResult["NAV_STRING"]?>
	</div>
</div><!--/news-->