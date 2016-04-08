<?
$arItemIds = array();
$arStaticItemIds = array();
foreach($arResult["SEARCH"] as $arItem){
	if($arItem["MODULE_ID"] == 'iblock'){
		$arItemIds[] = $arItem["ITEM_ID"];
	} else {
		$arStaticItemIds[] = $arItem["ITEM_ID"];
	}
}

CModule::IncludeModule('iblock');

$arItemPicts = array();
if($arItemIds){
	$arFilter = array(
	    "ACTIVE"    => "Y",
	    "ID"		=> $arItemIds,
	);
	$rsElements = CIBlockElement::GetList(
	    array(),
	    $arFilter,
	    false,
	    false,
	    array(
	    	"ID",
	    	"PREVIEW_PICTURE"
	    )
	);
	while($arElement = $rsElements->GetNext()) {
		$pictId = $arElement["PREVIEW_PICTURE"];
		if(!$pictId){
			$pictId = NO_PHOTO_ID;
		}

		$arItemPicts[ $arElement["ID"] ] = itc\Resizer::get($pictId, 'search');
	}
}

if($arStaticItemIds){
	$pictId = NO_PHOTO_ID;
	$pict = itc\Resizer::get($pictId, 'search');

	foreach($arStaticItemIds as $staticId){
		$arItemPicts[$staticId] = $pict;
	}
}

$arResult["ITEM_PICTS"] = $arItemPicts;