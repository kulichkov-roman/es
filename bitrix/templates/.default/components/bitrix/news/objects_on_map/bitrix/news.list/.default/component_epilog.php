<?php 
if($GLOBALS["USER"] -> IsAdmin()){?>
	<?itc\CUncachedArea::startCapture();?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:iblock.element.add.form", 
			"add_city", 
			array(
				"SEF_MODE" => "N",
				"IBLOCK_TYPE" => "dynamic_content",
				"IBLOCK_ID" => "1",
				"PROPERTY_CODES" => array(
					0 => "NAME",
					1 => "1",
					2 => "2",
					3 => "CODE"
				),
				"PROPERTY_CODES_REQUIRED" => array(
					0 => "NAME",
					1 => "1",
					2 => "2",
					3 => "CODE"
				),
				"GROUPS" => array(
					0 => "1",
				),
				"STATUS_NEW" => "N",
				"STATUS" => "ANY",
				"LIST_URL" => "",
				"ELEMENT_ASSOC" => "CREATED_BY",
				"MAX_USER_ENTRIES" => "100000",
				"MAX_LEVELS" => "100000",
				"LEVEL_LAST" => "Y",
				"USE_CAPTCHA" => "N",
				"USER_MESSAGE_EDIT" => "Город успешно добавлен",
				"USER_MESSAGE_ADD" => "Город успешно добавлен",
				"DEFAULT_INPUT_SIZE" => "30",
				"RESIZE_IMAGES" => "N",
				"MAX_FILE_SIZE" => "0",
				"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
				"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
				"CUSTOM_TITLE_NAME" => "",
				"CUSTOM_TITLE_TAGS" => "",
				"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
				"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
				"CUSTOM_TITLE_IBLOCK_SECTION" => "",
				"CUSTOM_TITLE_PREVIEW_TEXT" => "",
				"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
				"CUSTOM_TITLE_DETAIL_TEXT" => "",
				"CUSTOM_TITLE_DETAIL_PICTURE" => "",
				"SEF_FOLDER" => ""
			),
			false
		);?>
	<?$addCityForm = itc\CUncachedArea::endCapture();
	itc\CUncachedArea::setContent('addCityForm', $addCityForm);
	?>
	<?CJSCore::Init(array('translit'));?>
<?}
?>