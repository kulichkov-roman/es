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

<div class="wrapper">
    <?
    $arSort = array(
        'SORT'=>'ASC'
    );
    $arSelect = array(
        'ID',
        'NAME',
        'DETAIL_TEXT'
    );
    $arFilter = array(
        'IBLOCK_ID' => ACTICLE_IBLOCK_ID,
        'ID' => $arResult['VARIABLES']['ELEMENT_ID']
    );
    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        false,
        false,
        $arSelect
    );
    $template = 'article_text';
    if ($arItem = $rsElements->Fetch())
    {
        if($arItem['DETAIL_TEXT'])
        {
            $template = 'article_text';
        }
        else
        {
            $template = 'article_slider';
        }
    }

    $ElementID = $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        $template,
        Array(
            "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
            "DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
            "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
            "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
            "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
            "DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
            "SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
            "META_KEYWORDS" => $arParams["META_KEYWORDS"],
            "META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
            "BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
            "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
            "SET_TITLE" => $arParams["SET_TITLE"],
            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
            "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
            "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
            "ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
            "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
            "DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
            "DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
            "PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
            "PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
            "CHECK_DATES" => $arParams["CHECK_DATES"],
            "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
            "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
            "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
            "USE_SHARE" 			=> $arParams["USE_SHARE"],
            "SHARE_HIDE" 			=> $arParams["SHARE_HIDE"],
            "SHARE_TEMPLATE" 		=> $arParams["SHARE_TEMPLATE"],
            "SHARE_HANDLERS" 		=> $arParams["SHARE_HANDLERS"],
            "SHARE_SHORTEN_URL_LOGIN"	=> $arParams["SHARE_SHORTEN_URL_LOGIN"],
            "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
            "ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : '')
        ),
        $component
    );?>
    <div class="books-other">
        <header class="books-other__head">
            <div class="books-other__title">Похожие учебники и рекомендации:</div>
        </header>
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "books_other",
            Array(
                "IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
                "IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
                "NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
                "SORT_BY1"	=>	$arParams["SORT_BY1"],
                "SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
                "SORT_BY2"	=>	$arParams["SORT_BY2"],
                "SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
                "FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
                "PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
                "DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                "SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                "IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                "DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
                "SET_TITLE"	=>	$arParams["SET_TITLE"],
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
        );?>
    </div>
</div>