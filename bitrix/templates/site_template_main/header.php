<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// для русской и английской локализации
require_once $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_DEFAULT_PATH.'lang/'.LANGUAGE_ID.'/site_template.php';

?>
<!doctype html>
<!--[if IE 7]><html class="ie7 lt-ie10 lt-ie9 lt-ie8 no-js" lang="ru"><![endif]-->
<!--[if IE 8]><html class="ie8 lt-ie10 lt-ie9 no-js" lang="ru"><![endif]-->
<!--[if IE 9 ]><html class="ie9 lt-ie10 no-js" lang="ru"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js" lang="ru"><!--<![endif]-->
<head>
    <?$APPLICATION->ShowHead()?>
    <title>
        <?/*
        if (inMainPage()) {
            echo GetMessage('MN_HD_TILE');
        } else {
            $APPLICATION->ShowTitle(); //echo ' — '. GetMessage('MN_HD_TITLE_NAME_COMPANY');
        }*/
	    $APPLICATION->ShowTitle();
        ?>
    </title>
    <?
    $APPLICATION->AddHeadString('
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
        <meta content="telephone=no" name="format-detection">
        <meta name="robots" content="noodp, noydir">
        <!-- This make sence for mobile browsers. It means, that content has been optimized for mobile browsers -->
        <meta name="HandheldFriendly" content="true">
        <meta name="viewport" content="width=1040px">
        <!--[if lt IE 9 ]><meta content="IE=edge" http-equiv="X-UA-Compatible"><meta content="no" http-equiv="imagetoolbar"><![endif]-->
        <!--[if IE 8 ]><link href="static/css/main_ie8.css" rel="stylesheet" type="text/css"><![endif]-->
        <!--[if IE 9 ]><link href="static/css/main_ie9.css" rel="stylesheet" type="text/css"><![endif]-->
        <!--[if (gt IE 9)|!(IE)]><!-->
    ');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_DEFAULT_PATH."static/css/main.min.css");

    /**
     * Доработки от 24.02.2016
     */
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_DEFAULT_PATH."static/css/jquery.fancybox.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_DEFAULT_PATH."static/css/screen.css");

    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_DEFAULT_PATH."static/css/developers.css");
    $APPLICATION->AddHeadString('
        <!--<![endif]-->
        <script>
            (function(H){H.className=H.className.replace(/\bno-js\b/,"js")})(document.documentElement)
        </script>
        <!--[if lt IE 9 ]>
    ');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_DEFAULT_PATH.'static/js/separateJs/html5shiv-3.7.2.min.js');
    $APPLICATION->AddHeadString('
        <meta content="no" http-equiv="imagetoolbar"><![endif]-->
    ');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_DEFAULT_PATH."static/js/separateJs/jquery-1.11.1.min.js");

    /**
     * Доработки от 24.02.2016
     */
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_DEFAULT_PATH."static/js/jquery/jquery-2.0.3.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_DEFAULT_PATH."static/js/jquery/jquery-ui-1.10.2.custom.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_DEFAULT_PATH.'static/js/modernizr-2.0.6.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_DEFAULT_PATH."static/js/jquery/jquery.browser.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_DEFAULT_PATH."static/js/app.js");

    $APPLICATION->AddHeadScript(SITE_TEMPLATE_DEFAULT_PATH."static/js/developers.js");
    $APPLICATION->AddHeadString('<link rel="icon" type="image/png" href="/favicon.ico">');
    ?>
</head>
<body class="page _main">
    <div id="panel">
        <?$APPLICATION->ShowPanel();?>
    </div>
    <div class="template">
        <div class="template__middle">
            <div class="template__cell template__middle-cell">
                <section class="page__wrapper">
                    <div class="page__section _header _main">
                        <div class="header">
                            <div class="header__inside">
                                <div class="header__logo">
                                    <div class="logo">
                                        <a href="/" class="logo__link">
                                            <?
                                            $APPLICATION->IncludeComponent("bitrix:main.include", "",
                                                Array(
                                                    "AREA_FILE_SHOW" => "file",
                                                    "PATH" => "/include/site_templates/hd_logo.php",
                                                    "EDIT_TEMPLATE" => ""
                                                ),
                                                false
                                            );
                                            $APPLICATION->IncludeComponent("bitrix:main.include", "",
                                                Array(
                                                    "AREA_FILE_SHOW" => "file",
                                                    "PATH" => "/include/site_templates/".LANGUAGE_ID."/hd_slogan.php",
                                                    "EDIT_TEMPLATE" => ""
                                                ),
                                                false
                                            );
                                            ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="header__menu">
                                    <?$APPLICATION->IncludeComponent(
                                    	"bitrix:menu",
                                    	"main_menu",
                                    	array(
                                    		"ROOT_MENU_TYPE" => "top",
                                    		"MENU_CACHE_TYPE" => "N",
                                    		"MENU_CACHE_TIME" => "3600",
                                    		"MENU_CACHE_USE_GROUPS" => "Y",
                                    		"MENU_CACHE_GET_VARS" => array(
                                    		),
                                    		"MAX_LEVEL" => "3",
                                    		"CHILD_MENU_TYPE" => "left",
                                    		"USE_EXT" => "Y",
                                    		"DELAY" => "N",
                                    		"ALLOW_MULTI_SELECT" => "N"
                                    	),
                                    	false
                                    );?>
                                </div>
	                            <div class="header__contact">
	            	                <div class="header__contact-phone">
	            		                <?
	            		                $APPLICATION->IncludeComponent("bitrix:main.include", "",
	            			                Array(
	            				                "AREA_FILE_SHOW" => "file",
	            				                "PATH" => "/include/site_templates/ft_phone.php",
	            				                "EDIT_TEMPLATE" => ""
	            			                ),
	            			                false
	            		                );
	            		                ?>
	            	                </div>
	            	                <div class="header__contact-email">
	            		                <a href="#feedback" class="header__emailLink"><?=GetMessage('MN_FT_WRITE_TO_US');?></a>
	            	                </div>
	                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="page__section">
                        <?$APPLICATION->IncludeComponent(
	            			"bitrix:catalog.top",
	            			"main_slider",
	            			array(
	            				"IBLOCK_TYPE" => "dynamic_content",
	            				"IBLOCK_ID" => "6",
	            				"ELEMENT_SORT_FIELD" => "sort",
	            				"ELEMENT_SORT_ORDER" => "asc",
	            				"ELEMENT_SORT_FIELD2" => "id",
	            				"ELEMENT_SORT_ORDER2" => "desc",
	            				"FILTER_NAME" => "",
	            				"ELEMENT_COUNT" => "9",
	            				"LINE_ELEMENT_COUNT" => "3",
	            				"PROPERTY_CODE" => array(
	            					0 => "LINK",
	            					1 => "",
	            				),
	            				"OFFERS_LIMIT" => "5",
	            				"VIEW_MODE" => "SECTION",
	            				"MESS_BTN_BUY" => "Купить",
	            				"MESS_BTN_ADD_TO_BASKET" => "В корзину",
	            				"MESS_BTN_DETAIL" => "Подробнее",
	            				"MESS_NOT_AVAILABLE" => "Нет в наличии",
	            				"SECTION_URL" => "",
	            				"DETAIL_URL" => "",
	            				"SECTION_ID_VARIABLE" => "SECTION_ID",
	            				"CACHE_TYPE" => "A",
	            				"CACHE_TIME" => "36000000",
	            				"CACHE_GROUPS" => "Y",
	            				"CACHE_FILTER" => "N",
	            				"ACTION_VARIABLE" => "action",
	            				"PRODUCT_ID_VARIABLE" => "id",
	            				"PRICE_CODE" => array(
	            				),
	            				"USE_PRICE_COUNT" => "N",
	            				"SHOW_PRICE_COUNT" => "1",
	            				"PRICE_VAT_INCLUDE" => "Y",
	            				"BASKET_URL" => "/personal/basket.php",
	            				"USE_PRODUCT_QUANTITY" => "N",
	            				"ADD_PROPERTIES_TO_BASKET" => "Y",
	            				"PRODUCT_PROPS_VARIABLE" => "prop",
	            				"PARTIAL_PRODUCT_PROPERTIES" => "N",
	            				"PRODUCT_PROPERTIES" => array(
	            				),
	            				"DISPLAY_COMPARE" => "N",
	            				"TEMPLATE_THEME" => "e",
	            				"ADD_PICT_PROP" => "-",
	            				"LABEL_PROP" => "-",
	            				"MESS_BTN_COMPARE" => "Сравнить",
	            				"PRODUCT_QUANTITY_VARIABLE" => "quantity"
	            			),
	            			false
	            		);?>
                    </div>
                    <?$APPLICATION->IncludeComponent("bitrix:news.list", "lower_slider_on_main", Array(
                       "AJAX_MODE" => "N",    // Включить режим AJAX
                       "IBLOCK_TYPE" => "dynamic_content",    // Тип информационного блока (используется только для проверки)
                       "IBLOCK_ID" => 7,    // Код информационного блока
                       "NEWS_COUNT" => "99",    // Количество новостей на странице
                       "SORT_BY1" => "SORT",    // Поле для первой сортировки новостей
                       "SORT_ORDER1" => "ASC",    // Направление для первой сортировки новостей
                       "SORT_BY2" => "ID",    // Поле для второй сортировки новостей
                       "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
                       "FILTER_NAME" => "",    // Фильтр
                       "FIELD_CODE" => "",    // Поля
                       "PROPERTY_CODE" => array("LINK"),    // Свойства
                       "CHECK_DATES" => "N",    // Показывать только активные на данный момент элементы
                       "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                       "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
                       "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
                       "SET_TITLE" => "N",    // Устанавливать заголовок страницы
                       "SET_STATUS_404" => "N",    // Устанавливать статус 404, если не найдены элемент или раздел
                       "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
                       "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                       "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
                       "PARENT_SECTION" => "",    // ID раздела
                       "PARENT_SECTION_CODE" => "",    // Код раздела
                       "CACHE_TYPE" => "A",    // Тип кеширования
                       "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                       "CACHE_NOTES" => "",    //
                       "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
                       "CACHE_GROUPS" => "Y",    // Учитывать права доступа
                       "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
                       "DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
                       "PAGER_TITLE" => "Новости",    // Название категорий
                       "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
                       "PAGER_TEMPLATE" => "",    // Название шаблона
                       "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
                       "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
                       "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
                       "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                       "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
                       "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
                       "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
                       ),
                      false
                    );?>
                    <div class="page__buffer"></div>
                </section>
            </div><!--template__cell template__middle-cell-->
        </div><!--template__middle-->