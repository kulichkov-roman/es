<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// для русской и английской локализации
require_once $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_DEFAULT_PATH.'lang/'.LANGUAGE_ID.'/site_template.php';

?>
                <?/*</div><!--end <?=getBodyClassesString()?>-->*/?>
                <?if(!inObjectsMapList()){?>
                    </div><!--end page__section-->
                <?}?>
                <?$APPLICATION->ShowViewContent("objectSlider");?>
                <div class="page__buffer"></div>
            </section>
        </div><!--template__cell template__middle-cell-->
    </div><!--template__middle-->
    <div class="template__bottom">
        <div class="template__cell template__bottom-cell">
            <div class="wrapper">
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => "/include/site_templates/ft_seo_descriptions.php",
                        "EDIT_TEMPLATE" => ""
                    ),
                    false
                );?>
            </div>
            <footer class="page__footer">
                <div class="footer">
                    <div class="footer__inside">
                        <?/*
	                    <div class="footer__lang">
                            <a href="<?=LANGAUGE_EN_URL?>" class="footer__langTitle _eng">
                                <?=GetMessage('MN_FT_LANGAUGE_MODE');?>
                            </a>
                        </div>
	        			*/?>
                        <div class="footer__search">
                            <div class="search">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:search.form",
                                    "search_form",
                                    Array(
                                        "PAGE" => "#SITE_DIR#search/index.php",
                                        "USE_SUGGEST" => "N"
                                    )
                                );?>
                            </div>
                        </div>
                        <div class="footer__map">
                            <a href="<?=MAP_RUSSIA_URL?>" class="footer__mapLink"><?=GetMessage('MN_FT_VIEW_ON_MAP');?></a>
                        </div>
                        <div class="footer__copyright">
                            <?
                            $APPLICATION->IncludeComponent("bitrix:main.include", "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => "/include/site_templates/".LANGUAGE_ID."/ft_company_name.php",
                                    "EDIT_TEMPLATE" => ""
                                ),
                                false
                            );
                            ?>
	                        <span class="footer__copyright_developer">
                                Разработка сайта: <a target="_blank" href="http://kulichkov.pro">kulichkov.pro</a>
                            </span>
                        </div>
                    </div>
                    <!-- Main scripts. You can replace it, but I recommend you to leave it here     -->
                    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_DEFAULT_PATH."static/js/main.min.js");?>
                </div>
            </footer>
            <div class="page__section _popup">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR."include/site_templates/footer_feedback_form.php"
                ));?>
             </div>
	        <?
	        $APPLICATION->IncludeComponent("bitrix:main.include", "",
	        	Array(
	        		"AREA_FILE_SHOW" => "file",
	        		"PATH" => "/include/site_templates/counters.php",
	        		"EDIT_TEMPLATE" => ""
	        	),
	        	false
	        );
	        ?>
        </div><!--template__cell template__bottom-cell-->
    </div><!--template__bottom-->
</body>