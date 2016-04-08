<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
function GetCurCityInfo($controlName, $arItems)
{
    global $APPLICATION;
    $curDir = $APPLICATION->GetCurDir();

    foreach($arItems as $arItem)
    {
        if($arItem["CODE"] == "CITY")
        {
            foreach($arItem["VALUES"] as $val => $ar)
            {
                if($ar["CONTROL_NAME"] == $controlName)
                {
                    $arCurObjects = array(
                        "NAME" => $ar["VALUE"],
                        "DEFAULT_URL" => $curDir,
                    );
                    return $arCurObjects;
                }
            }
        }
    }

    return false;
}

$arUrlParam = $_GET;

$arResult["SHOW_ALL_OBJECTS"] = true;

foreach($arUrlParam as $key=>$value)
{
    if(strpos($key, 'arrFilter_') === 0)
    {
        $arResult["SHOW_ALL_OBJECTS"] = false;
        $arResult["CURRENT_OBJECT"] = GetCurCityInfo($key, $arResult["ITEMS"]);
        break;
    }
}

foreach($arResult["ITEMS"] as &$arItem)
{
	if ($arItem["PROPERTY_TYPE"] == "E" && $arItem["CODE"] == "CITY")
	{
		foreach($arItem["VALUES"] as $val => &$ar)
		{
			switch($_GET["view"])
			{
				case "cell":
					$ar['FILTER_LINK'] = '?view=cell&'.$ar["CONTROL_NAME"]."=Y&set_filter=Показать";
					break;
				case "line":
					$ar['FILTER_LINK'] = '?view=line&'.$ar["CONTROL_NAME"]."=Y&set_filter=Показать";
					break;
				default:
					$ar['FILTER_LINK'] = '?'.$ar["CONTROL_NAME"]."=Y&set_filter=Показать";
			}
		}

		//switch($_GET["view"])
		//{
		//	case "cell":
		//		$arItem["VALUES"]['FILTER_LINK'] = '?view=cell&'.$arItem["VALUES"]["CONTROL_NAME"]."=Y&set_filter=Показать";
		//		break;
		//	case "line":
		//		$arItem["VALUES"]['FILTER_LINK'] = '?view=line&'.$arItem["VALUES"]["CONTROL_NAME"]."=Y&set_filter=Показать";
		//		break;
		//	default:
		//		if(!isset($_GET["view"]) || $_GET["view"] == "")
		//		{
		//			$arItem["VALUES"]['FILTER_LINK'] = '?'.$arItem["VALUES"]["CONTROL_NAME"]."=Y&set_filter=Показать";
		//		}
		//}
	}
}
unset($arItem, $ar);
?>