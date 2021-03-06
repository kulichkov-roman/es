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

?>
<div class="news">
	<div class="news__toolbar">
	    <?//$APPLICATION->ShowViewContent("NewsDisplayTopPager");?>
		<div class="news__toolbarTitle">
			<div class="page-head__prev">
				<a class="page-head__prev-link" href="/">главная</a>
			</div>
			<div class="page-head__cont">
				<h1 class="page-head__title">Новости</h1>
			</div>
		</div>
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
	<?
	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"",
		Array(
			"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
			"IBLOCK_ID"	    =>	$arParams["IBLOCK_ID"],
			"NEWS_COUNT"	=>	$newCount,
			"SORT_BY1"	    =>	$arParams["SORT_BY1"],
			"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
			"SORT_BY2"	    =>	$arParams["SORT_BY2"],
			"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
			"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
			"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
			"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
			"SET_TITLE"	    =>	$arParams["SET_TITLE"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
			"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
			"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
			"DISPLAY_NAME"	=>	"Y",
			"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
			"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
		),
		$component
	);
	?>
	<div class="news__toolbar">
	    <?=$APPLICATION->ShowViewContent("NewsDisplayBottomPager");?>
	</div>
</div><!--/news-->