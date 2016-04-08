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
    <div class="page-head">
        <div class="page-head__prev">
            <a class="page-head__prev-link" href="<?=ABOUT_URL?>">о нас</a>
        </div>
        <div class="page-head__cont">
            <h1 class="page-head__title">Допуски и дипломы</h1>
        </div>
    </div>
    <?$APPLICATION->IncludeComponent(
        "dev2fun:section.element.group",
        "about_certificates_ed1",
        array(
            "ACTIVE_DATE_FORMAT" => "",
            "ADD_SECTIONS_CHAIN" => "Y",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "COMPONENT_TEMPLATE" => "about_certificates_ed1",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_SECTION_PICTURE" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "18",
            "IBLOCK_TYPE" => "dynamic_content",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "INCLUDE_SUBSECTIONS" => "Y",
            "NEWS_COUNT" => "40",
            "NEWS_SHOW_SECTION" => "Y",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => array(
            ),
            "PARENT_SECTION_CODE" => array(
            ),
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "ALL",
                1 => "",
            ),
            "SECTION_CHECK_EMPTY" => "Y",
            "SECTION_CHILD" => "Y",
            "SECTION_CNT_ELEMENTS" => "Y",
            "SECTION_COUNT" => "30",
            "SECTION_DEPTH" => "1",
            "SECTION_DETAIL_URL" => "",
            "SECTION_FILTER_NAME" => "",
            "SECTION_PREVIEW_TRUNCATE_LEN" => "",
            "SECTION_PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "SECTION_SORT_BY1" => "ID",
            "SECTION_SORT_BY2" => "ID",
            "SECTION_SORT_ORDER1" => "ASC",
            "SECTION_SORT_ORDER2" => "ASC",
            "SET_BROWSER_TITLE" => "Y",
            "SET_META_DESCRIPTION" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "SORT_BY1" => "ID",
            "SORT_BY2" => "ID",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "ASC",
            "TEMP_OUTPUT_ELEMETS" => "element.php",
            "TEMP_OUTPUT_SECTIONS" => "subSection.php"
        ),
        false
    );?>
</div>