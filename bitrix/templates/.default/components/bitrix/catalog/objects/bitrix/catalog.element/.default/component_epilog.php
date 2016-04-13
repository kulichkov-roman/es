<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;

$arSort = array(
	'SORT'=>'ASC'
);
$arSelect = array(
	'ID',
	'NAME',
	'CODE'
);
$arFilter = array(
	'IBLOCK_ID' => OBJECTS_IBLOCK_ID,
	'ID' => $arResult['ID']
);

$rsElements = CIBlockElement::GetList(
	$arSort,
	$arFilter,
	false,
	false,
	$arSelect
);

if ($arItem = $rsElements->Fetch())
{
	$arElement = $arItem;

	$fullPath = $arResult['SECTION']['SECTION_PAGE_URL'].$arItem['CODE'].'/';

	if($fullPath != $APPLICATION->GetCurDir())
	{
		LocalRedirect($fullPath, false, '301 Moved permanently');
	}
}

itc\CUncachedArea::startCapture();
?>
	<a href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>" class="object__headerPrev">
		<?=ToLower($arResult["SECTION"]["NAME"])?>
	</a>
<?
$showBackUrl = itc\CUncachedArea::endCapture();
itc\CUncachedArea::setContent("BACK_URL", $showBackUrl);
?>
