<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

// получить доплнительные фотографии объекта
$arIds = array();
if(is_array($arResult["PROPERTIES"]["PHOTO"]["VALUE"]))
{
    foreach($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as &$arItem)
    {
        $arIds[] = $arItem;
    }
    unset($arItem);
}

if(sizeof($arIds) > 0)
{
    $strIds = implode(",", $arIds);

    $fl = new CFile;

    $arOrder = array();
    $arFilter = array(
        "MODULE_ID" => "iblock",
        "@ID" => $strIds
    );

    $arPicture = array();
    $arSliderPicture = array();

    $rsFile = $fl->GetList($arOrder, $arFilter);
    while($arItem = $rsFile->GetNext())
    {
        $arPicture[$arItem["ID"]] = $arItem;
        // фотография для слайдера малого
        $extension = GetFileExtension("/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"]);
        $urlPicture = itc\Resizer::get($arItem["ID"], 'crop', 700, 457, $extension);
        $arPicture[$arItem["ID"]]["SRC"] = $urlPicture;
        // фотография для слайдера большего
        $urlSliderPicture = itc\Resizer::get($arItem["ID"], 'width', 1920, null, $extension);
        $arSliderPicture[$arItem["ID"]]["SRC"] = $urlSliderPicture;
    }

    foreach($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as &$value)
    {
        // сохраняем url для слайдера большего
        $arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE"][] = $arSliderPicture[$value]["SRC"];
        // сохраняем url для слайдера малого
        $value = $arPicture[$value]["SRC"];
    }
    unset($arItem);

    $arResult["PROPERTIES"]["SLIDER_PHOTO"]["CODE"] = "SLIDER_PHOTO";
}
else
{
    $arResult["PROPERTIES"]["NO_PHOTO"] = array(
        "SRC" => itc\Resizer::get(NO_PHOTO_700_457_ID, 'auto', 700, 457, NO_PHOTO_EXTENSION)
    );
}

// получить параметры раздела, в котором находится элемент
$arSort = array(
    "ID"=>"DESC"
);
$arFilter = array(
    "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
    "ID" => $arResult["IBLOCK_SECTION_ID"],
);
$arSelect = array(
    "ID",
    "NAME",
    "SECTION_PAGE_URL"
);

$rsSection = CIBlockSection::GetList(
    $arSort,
    $arFilter,
    false,
    $arSelect,
    false
);

$arSection = array();
if($arItem = $rsSection->GetNext())
{
    $arSection = $arItem;
}

$arResult["SECTION"] = $arSection;

// получить code секции
$arParseBackUrl = parse_url(getenv("HTTP_REFERER"));

// текущий раздел
$curUrl = $APPLICATION->GetCurPage();

// только для внутренних переходов по сайту
if($arParseBackUrl['host'] == SITE_URL_BUILD || $arParseBackUrl['host'] == SITE_URL_DEV)
{
	// только, если не по иерархии разделов переход
	if($arParseBackUrl["path"] != $curUrl)
	{
		$query = '';
		if($arParseBackUrl["query"])
		{
			$query = '?'.$arParseBackUrl["query"];
		}
		$arResult["SECTION"]["SECTION_PAGE_URL"] = $arParseBackUrl["path"].$query;

		$arParsePath = array_unique(explode("/", $arParseBackUrl["path"]));
		$arParsePath = array_diff($arParsePath, array(''));

		// сравнить последний раздел в url с разделам, в котором лежит текущий элемент
		// для случая если зашли не по иерархии каталога, а вернуться нужно на то места, с которого перешли.
		if(end($arParsePath) != $arResult["SECTION"]["CODE"])
		{
			$arResult["SECTION"]["NAME"] = 'Назад';
		}
	}
}

// поместить в кеш, нужно для back_url
$this->__component->arResult["SECTION"] = $arResult['SECTION'];
$this->__component->SetResultCacheKeys(array('SECTION'));

// получить ссылку на карту с объектами города и название города по ID
if($arResult["PROPERTIES"]["CITY"]["VALUE"] <> "")
{
    // получить город по ID
    $arSort = array();
    $arSelect = array(
        "ID",
        "NAME",
        "CODE"
    );
    $arFilter = array(
        "IBLOCK_ID" => CITIES_IBLOCK_ID,
        "ID" => $arResult["PROPERTIES"]["CITY"]["VALUE"],
    );

    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        false,
        false,
        $arSelect
    );

    $arCities = array();
    if($arItem = $rsElements->GetNext())
    {
        $arResult["PROPERTIES"]["CITY"]["PAGE_CITY_MAP"] = OBJECTS_MAP_RUSSIA_URL.$arItem["CODE"]."/";
        $arResult["PROPERTIES"]["CITY"]["VALUE"] = getCityName($arItem["NAME"]);
    }
    unset($arCitiesIDs);
}
?>