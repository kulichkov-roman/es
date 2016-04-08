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
        <?
        if (inMainPage()) {
            echo GetMessage('MN_HD_TILE');
        } else {
            $APPLICATION->ShowTitle(); //echo ' — '. GetMessage('MN_HD_TITLE_NAME_COMPANY');
        }
        ?>
    </title>
    <?
    $APPLICATION->AddHeadString('
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
        <meta content="telephone=no" name="format-detection">
        <meta name="robots" content="noodp, noydir">
        <!-- This make sence for mobile browsers. It means, that content has been optimized for mobile browsers -->
        <meta name="HandheldFriendly" content="true">
        <!--[if lt IE 9 ]><meta content="IE=edge" http-equiv="X-UA-Compatible"><meta content="no" http-equiv="imagetoolbar"><![endif]-->
        <!--[if IE 8 ]><link href="static/css/main_ie8.css" rel="stylesheet" type="text/css"><![endif]-->
        <!--[if IE 9 ]><link href="static/css/main_ie9.css" rel="stylesheet" type="text/css"><![endif]-->
        <!--[if (gt IE 9)|!(IE)]><!-->
    ');
	if(inObjectsMap())
	{
		$APPLICATION->AddHeadString('<meta name="viewport" content="width=1250px">');
	}
	elseif(inObjectsMapList())
	{
	    $APPLICATION->AddHeadString('<meta name="viewport" content="width=1040px">');
	}
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_DEFAULT_PATH."static/css/main.min.css");

    /**
     * Доработки от 24.02.2016
     */
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_DEFAULT_PATH."static/css/jquery.fancybox.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_DEFAULT_PATH."static/css/jquery.scrollbar.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_DEFAULT_PATH."static/css/screen.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_DEFAULT_PATH."static/css/layout.css");

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
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_DEFAULT_PATH."static/js/jquery/jquery.scrollbar.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_DEFAULT_PATH."static/js/app.js");

    $APPLICATION->AddHeadScript(SITE_TEMPLATE_DEFAULT_PATH."static/js/developers.js");
    $APPLICATION->AddHeadString('<link rel="icon" type="image/png" href="/favicon.ico">');
    ?>
</head>
<body class="page">
    <div id="panel">
        <?$APPLICATION->ShowPanel();?>
    </div>
    <div class="template">
        <div class="template__middle">
            <div class="template__cell template__middle-cell">
                <section class="page__wrapper">
                    <div class="page__section _header">
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
                    <?
                    if(inAboutContact()){
                        ?>
                        <div class="wrapper">
                            <div class="page-head">
                                <div class="page-head__prev">
                                    <a class="page-head__prev-link" href="/"><?=GetMessage('MN_HD_BREADCRUMBS_MAIN');?></a>
                                </div>
                                <div class="page-head__cont">
                                    <h1 class="page-head__title"><?=GetMessage('MN_HD_BREADCRUMBS_CONTACTS');?></h1>
                                </div>
                            </div>
                        </div>
                        <?
                        $APPLICATION->IncludeComponent("bitrix:main.include", "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "/include/site_templates/".LANGUAGE_ID."/ps_contact_yandex_map.php",
                                "EDIT_TEMPLATE" => ""
                            ),
                            false
                        );
                    }
                    if(!inObjectsMapList()){?>
                        <div class="page__section">
                    <?}?>