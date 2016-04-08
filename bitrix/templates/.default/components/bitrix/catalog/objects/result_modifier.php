<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// получить ткущий url и поместить его в массив
$curDir = $APPLICATION->GetCurDir();

$arParseUrl = array_unique(explode("/", $curDir));
$arParseUrl = array_diff($arParseUrl, array(''));

// добавить в тулбар спиоск объектов, разделов 1ого уровня
$arSort = array();
$arFilter = array(
    "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
    "DEPTH_LEVEL" => 1
);
$arSelect = array(
    "ID",
    "NAME",
    "SECTION_PAGE_URL",
    "DEPTH_LEVEL"
);
$rsSection = CIBlockSection::GetList(
    $arSort,
    $arFilter,
    false,
    $arSelect,
    false
);

$arResult["TOOLBAR"]["CURRENT_OBJECTS_SELECT"] = "";
while ($arItem = $rsSection->GetNext())
{
    switch ($arItem["DEPTH_LEVEL"])
    {
        case "1":
            // объекты
            // /object/proektirovanie/

			$strUrl = "/".$arParseUrl[1]."/".$arParseUrl[2]."/";
            if($strUrl === $arItem["SECTION_PAGE_URL"])
            {
                $arItem["SELECTED"] = true;
                $arResult["TOOLBAR"]["CURRENT_OBJECTS_SELECT"] = $arItem["NAME"];
            }
            else
            {
                $arItem["SELECTED"] = false;
            }

	        switch($_GET["view"])
	        {
		        case "cell":
			        $arItem["SECTION_PAGE_URL"] .= '?view=cell';
			        break;
		        case "line":
			        $arItem["SECTION_PAGE_URL"] .= '?view=line';
			        break;
	        }

            $arResult["TOOLBAR"]["OBJECTS"][] = $arItem;
            break;
    }
}

// получить ID раздела объекта по символьному коду, полученному из URL
$arSort = array();
$arFilter = array(
    "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
    "CODE" => $arParseUrl[2]
);
$arSelect = array(
    "ID",
    "NAME",
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

// добавить в тулбар c видами работ, разделов 2ого уровня
$arSort = array();
$arFilter = array(
    "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
    "DEPTH_LEVEL" => 2,
    "SECTION_ID" => $arSection["ID"]
);
$arSelect = array(
    "ID",
    "NAME",
    "SECTION_PAGE_URL",
    "DEPTH_LEVEL"
);
$rsSection = CIBlockSection::GetList(
    $arSort,
    $arFilter,
    false,
    $arSelect,
    false
);

$arResult["TOOLBAR"]["CURRENT_JOBS_SELECT"] = "";
while ($arItem = $rsSection->GetNext())
{
    switch ($arItem["DEPTH_LEVEL"])
    {
        case "2":
            // виды работ
            // /objects/proektirovanie/obshchestvennye/
            $strUrl = "/".$arParseUrl[1]."/".$arParseUrl[2]."/".$arParseUrl[3]."/";
            if($strUrl === $arItem["SECTION_PAGE_URL"])
            {
                $arItem["SELECTED"] = true;
                $arResult["TOOLBAR"]["CURRENT_JOBS_SELECT"] = $arItem["NAME"];
            }
            else
            {
                $arItem["SELECTED"] = false;
            }

	        switch($_GET["view"])
	        {
		        case "cell":
			        $arItem["SECTION_PAGE_URL"] .= '?view=cell';
			        break;
		        case "line":
			        $arItem["SECTION_PAGE_URL"] .= '?view=line';
			        break;
	        }

            $arResult["TOOLBAR"]["JOBS"][] = $arItem;
            break;
    }
}

if(sizeof($arResult["TOOLBAR"]["JOBS"]))
{
	switch($_GET["view"])
	{
		case "cell":
			$url = "/".$arParseUrl[1]."/".$arParseUrl[2]."/?view=cell";
			break;
		case "line":
			$url = "/".$arParseUrl[1]."/".$arParseUrl[2]."/?view=line";
			break;
        default:
            $url = "/".$arParseUrl[1]."/".$arParseUrl[2]."/";
	}

	$arResult["TOOLBAR"]["JOBS"][] = array("NAME" => "Все объекты", "SECTION_PAGE_URL" => $url);
}

// получить ID раздела видов работ по символьному коду, полученному из URL
$arSort = array();
$arFilter = array(
    "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
    "CODE" => $arParseUrl[3]
);
$arSelect = array(
    "ID",
    "NAME",
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

// добавить в тулбар c видами конструкций разделов 3ого уровня
$arSort = array();
$arFilter = array(
    "IBLOCK_ID" => OBJECTS_IBLOCK_ID,
    "DEPTH_LEVEL" => 3,
    "SECTION_ID" => $arSection["ID"]
);
$arSelect = array(
    "ID",
    "NAME",
    "SECTION_PAGE_URL",
    "DEPTH_LEVEL"
);
$rsSection = CIBlockSection::GetList(
    $arSort,
    $arFilter,
    false,
    $arSelect,
    false
);

$arResult["TOOLBAR"]["CURRENT_DESIGNS_SELECT"] = "";
while ($arItem = $rsSection->GetNext())
{
    switch ($arItem["DEPTH_LEVEL"])
    {
        case "3":
            // виды конструкций
            // /objects/proektirovanie/obshchestvennye/tsekha_sooruzheniya/
            $strUrl = "/".$arParseUrl[1]."/".$arParseUrl[2]."/".$arParseUrl[3]."/".$arParseUrl[4]."/";
            if($strUrl === $arItem["SECTION_PAGE_URL"])
            {
                $arItem["SELECTED"] = true;
                $arResult["TOOLBAR"]["CURRENT_DESIGNS_SELECT"] = $arItem["NAME"];
            }
            else
            {
                $arItem["SELECTED"] = false;
            }

	        switch($_GET["view"])
	        {
		        case "cell":
			        $arItem["SECTION_PAGE_URL"] .= '?view=cell';
			        break;
		        case "line":
			        $arItem["SECTION_PAGE_URL"] .= '?view=line';
			        break;
	        }

            $arResult["TOOLBAR"]["DESIGNS"][] = $arItem;
            break;
    }
}
if(sizeof($arResult["TOOLBAR"]["DESIGNS"]))
{
	switch($_GET["view"])
	{
		case "cell":
			$url = "/".$arParseUrl[1]."/".$arParseUrl[2]."/?view=cell";
			break;
		case "line":
			$url = "/".$arParseUrl[1]."/".$arParseUrl[2]."/?view=line";
			break;
	}

	$arResult["TOOLBAR"]["DESIGNS"][] = array("NAME" => "Все объекты", "SECTION_PAGE_URL" => "/".$arParseUrl[1]."/".$arParseUrl[2]."/".$arParseUrl[3]."/");
}
?>