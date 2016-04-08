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

//определить, к какому из корневых разделов принадлежит подраздел
function getRootSection($leftMargin, $rightMargin, $arRootSectionsMargins){
	$rootSectionId = false;
	foreach($arRootSectionsMargins as $sectionId => $rootSectionMargin){
		if(
			($leftMargin >= $rootSectionMargin["LEFT_MARGIN"]) &&
			($leftMargin <= $rootSectionMargin["RIGHT_MARGIN"]) &&
			($rightMargin >= $rootSectionMargin["LEFT_MARGIN"]) &&
			($rightMargin <= $rootSectionMargin["RIGHT_MARGIN"])
		){
			$rootSectionId = $sectionId;
			break;
		}
	}
	return $rootSectionId;
}

CModule::IncludeModule('iblock');

$cityCode = $arResult["VARIABLES"]["ELEMENT_CODE"];

//получаем id и имя города
$cityId = false;
$cityName = false;

$arFilter = array(
    "IBLOCK_ID" => CITIES_IBLOCK_ID,
    "ACTIVE"    => "Y",
    "CODE"		=> $cityCode
);
$rsElements = CIBlockElement::GetList(
    array(),
    $arFilter
);
if($arCity = $rsElements->GetNext()) {
	$cityId = $arCity["ID"];
	$cityName = $arCity["NAME"];
}

//получаем данные обо всех разделах "Объектов" и left_, right_margin для корневых разделов
$cacheTime = 86400 * 365;
$cacheId = 'erkonsib_objects_section_info';
$cachePath = '/objects_section_info';

$obCache = new CPHPCache();

if( $obCache->InitCache($cacheTime, $cacheId, $cachePath) )// Если кэш валиден
{
   $vars = $obCache->GetVars();// Извлечение переменных из кэша

   $arRootSectionsMargins = $vars["arRootSectionsMargins"];
   $arSectionsInfo = $vars["arSectionsInfo"];
}
elseif( $obCache->StartDataCache()  )// Если кэш невалиден
{
	$arFilter = array(
	    "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
	    "ACTIVE"    => "Y",
	);
	$rsSections = CIBlockSection::GetList(
	    array(),
	    $arFilter,
	    false,
	    array(
	    	"NAME",
	    	"ID",
	    	"LEFT_MARGIN",
	    	"RIGHT_MARGIN",
	    	"DEPTH_LEVEL"
	    )
	);
	$arSectionsInfo = array();
	$arRootSectionsMargins = array();
	while($arSection = $rsSections->GetNext()) {
	    $arSectionsInfo[ $arSection["ID"] ] = $arSection;

	    //для определения вложенных подразделов
	    if($arSection["DEPTH_LEVEL"] == 1) {
	    	$arRootSectionsMargins[$arSection["ID"]]["LEFT_MARGIN"] = $arSection["LEFT_MARGIN"];
	    	$arRootSectionsMargins[$arSection["ID"]]["RIGHT_MARGIN"] = $arSection["RIGHT_MARGIN"];
	    }
	}
	
	$GLOBALS['CACHE_MANAGER']->StartTagCache($cachePath);
	$GLOBALS['CACHE_MANAGER']->RegisterTag("iblock_id_" . OBJECTS_IBLOCK_ID );
	$GLOBALS['CACHE_MANAGER']->EndTagCache();

	$obCache->EndDataCache(
			array(
				"arRootSectionsMargins" => $arRootSectionsMargins,
				"arSectionsInfo" => $arSectionsInfo
			)
	);// Сохраняем переменные в кэш.
}



//получаем id разделов ("типов работ") для объектов этого города
CModule::IncludeModule('iblock');
$arFilter = array(
    "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
    "ACTIVE"    => "Y",
    "PROPERTY_CITY" => $cityId
);
$rsElements = CIBlockElement::GetList(
    array(),
    $arFilter,
    array("IBLOCK_SECTION_ID")
);

$arCityWorkTypeIds = array();
while($arElement = $rsElements->GetNext()) {
	$workSubtypeId = $arElement["IBLOCK_SECTION_ID"];
	
	$arSection = $arSectionsInfo[$workSubtypeId];
	$arCityWorkTypeIds[] = getRootSection($arSection["LEFT_MARGIN"], $arSection["RIGHT_MARGIN"], $arRootSectionsMargins);
}
$arCityWorkTypeIds = array_unique($arCityWorkTypeIds);

?>
<div class="page__section _object_select">
    <div class="objectSelect">
        <div class="objectSelect__select">
            <div class="categorySelect">
                <div class="categorySelect__select _all_cities">
                    <a class="categorySelect__selectActive" href="<?=OBJECTS_MAP_RUSSIA_URL?>"><?=GetMessage("TOOLBAR_CITIES_ON_MAP_TITLE")?></a>
	                <ul class="categorySelect__selectList"></ul>
                </div>
	            <div class="categorySelect__select _cities">
	                <span class="categorySelect__selectActive"><?=GetMessage("TOOLBAR_ALL_OBJECT_ON_MAP_TITLE")?></span>
	                <?if($arCityWorkTypeIds){?>
			            <ul class="categorySelect__selectList">
			            	<?foreach($arCityWorkTypeIds as $workTypeId){?>
				        		<li class="categorySelect__selectListItem">
									<?
									$typeUrl = $GLOBALS["APPLICATION"]->GetCurPageParam("work_type=" . $workTypeId, array("work_type"));
									?>
									<a href="<?=$typeUrl?>" class="categorySelect__selectListItemLink"><?=$arSectionsInfo[$workTypeId]["NAME"]?></a>
				        		</li>
			        		<?}?>
			            </ul>
	                <?}?>
	            </div>
            </div>
        </div>
    </div>
</div>
<div class="page__section">
    <script type="text/javascript">
        $(function() {
            var cw = document.body.clientHeight - 94 - 58;
            $('#objectsmap').css('height', cw + 'px');

            $(window).on('resize', function() {
                cw = document.body.clientHeight - 94 - 58;
                $('#objectsmap').css('height', cw + 'px');
            });
        });
    </script>
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <?$ElementID = $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "",
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
            "ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
            "WORK_TYPE" => intval($_REQUEST["work_type"])
        ),
        $component
    );?>
</div>