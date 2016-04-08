<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<div class="contacts">
    <div class="contacts__info">
    	<div class="contacts__infoSection">
    		<div class="contacts__infoSectionHeader">
    			 <?=$contactTitleAddress["DESCRIPTION"]?>
    		</div>
    		<div class="contacts__infoSectionContent">
    			<div class="contacts__infoSectionContentRow">
    				 <?=$contactAddressFull["DESCRIPTION"]?>
    			</div>
    			<div class="contacts__infoSectionContentRow">
    				 <?=$contactAddressEnter["DESCRIPTION"]?>
    			</div>
    		</div>
    	</div>
    	<div class="contacts__infoSection">
    		<div class="contacts__infoSectionHeader">
    			 <?=$contactTitlePhone["DESCRIPTION"]?>
    		</div>
    		<div class="contacts__infoSectionContent">
    			<div class="contacts__infoSectionContentRow">
    				 <?=$contactPhone["DESCRIPTION"]?>
    			</div>
    			<div class="contacts__infoSectionContentRow">
    				 <?=$contactEmail["DESCRIPTION"]?>
    			</div>
    		</div>
    	</div>
    	<div class="contacts__infoSection">
    		<div class="contacts__infoSectionHeader">
    			 <?=$contactTitleWorkTime["DESCRIPTION"]?>
    		</div>
    		<div class="contacts__infoSectionContent">
    			<div class="contacts__infoSectionContentRow">
    				 <?=$contactWorkTime["DESCRIPTION"]?>
    			</div>
    			<div class="contacts__infoSectionContentRow">
    				 <?=$contactWorkTimeComment["DESCRIPTION"]?>
    			</div>
    		</div>
    	</div>
	    <div class="contacts__infoSection">
		    <div class="contacts__infoSectionHeader">
			    <?=$contactTitleManagers["DESCRIPTION"]?>
		    </div>
		    <div class="contacts__infoSectionContent">
			    <div class="contacts__infoSectionContentRow">
				    <?=$contactCEO["DESCRIPTION"]?>
			    </div>
			    <div class="contacts__infoSectionContentRow">
				    <?=$contactExecDirector["DESCRIPTION"]?>
			    </div>
		    </div>
	    </div>
    	<div class="contacts__infoSection">
    		<div class="contacts__infoSectionHeader">
    			 <?=$contactTitleReq["DESCRIPTION"]?>
    		</div>
    		<div class="contacts__infoSectionContent">
    			<div class="contacts__infoSectionContentRow">
    				 <?=$contactReqNameCompany["DESCRIPTION"]?>
    			</div>
    			<div class="contacts__infoSectionContentRow">
    				 <?=$contactReqRS["DESCRIPTION"]?>
    			</div>
			    <div class="contacts__infoSectionContentRow">
				    <?=$contactReqOGRN["DESCRIPTION"]?>
			    </div>
			    <div class="contacts__infoSectionContentRow">
				    <?=$contactReqBIK["DESCRIPTION"]?>
			    </div>
			    <div class="contacts__infoSectionContentRow">
				    <?=$contactReqIIN["DESCRIPTION"]?>
			    </div>
			    <div class="contacts__infoSectionContentRow">
				    <?=$contactReqKPP["DESCRIPTION"]?>
			    </div>
    		</div>
    	</div>
    </div>
    <?$APPLICATION->IncludeComponent(
    	"your:iblock.element.add.form.contact",
    	".default",
    	array(
    		"IBLOCK_TYPE" => "dynamic_content",
    		"IBLOCK_ID" => "5",
    		"STATUS_NEW" => "NEW",
    		"LIST_URL" => "",
    		"USE_CAPTCHA" => "N",
    		"USER_MESSAGE_EDIT" => "",
    		"USER_MESSAGE_ADD" => "Спасибо за обращение! В ближайшее время с Вами свяжется наш менеджер.",
    		"DEFAULT_INPUT_SIZE" => "30",
    		"RESIZE_IMAGES" => "N",
    		"PROPERTY_CODES" => array(
    			0 => "NAME",
    			1 => "DETAIL_TEXT",
    			2 => "9",
    			3 => "10",
    			4 => "11",
    		),
    		"PROPERTY_CODES_REQUIRED" => array(
    			0 => "NAME",
    		),
    		"GROUPS" => array(
    			0 => "2",
    		),
    		"STATUS" => "ANY",
    		"ELEMENT_ASSOC" => "CREATED_BY",
    		"MAX_USER_ENTRIES" => "100",
    		"MAX_LEVELS" => "100",
    		"LEVEL_LAST" => "Y",
    		"MAX_FILE_SIZE" => "0",
    		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
    		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
    		"SEF_MODE" => "N",
    		"CUSTOM_TITLE_NAME" => "",
    		"CUSTOM_TITLE_TAGS" => "",
    		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
    		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
    		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
    		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
    		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
    		"CUSTOM_TITLE_DETAIL_TEXT" => "",
    		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
    		"SEF_FOLDER" => "/about/contact/"
    	),
    	false
    );?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>