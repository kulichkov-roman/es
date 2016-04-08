<?
/**
 * Генерация превьюшек для больших изображений
 *
 * @param string $src путь от корня сайта к исходной картинке
 * @param int $size размер изображения (сторона квадрата в пикселях)
 * @param int $lifeTime время жизни превьюшки в секундах (по дефолту месяц)
 * @return string
 */
function GetResizeImage ($src, $size=200, $lifeTime = 2592000, $params = "") {

    $arSrc = parse_url($src);
    $src = $arSrc['path'];

    if (!$lifeTime) $lifeTime = 2592000;
    if (!$size) $size = 200;
    if (is_numeric($src)) if ($src > 0) $src = CFile::GetPath($src);
    if (file_exists($_SERVER['DOCUMENT_ROOT'].$src)) {
        require_once($_SERVER['DOCUMENT_ROOT']
            . "/bitrix/php_interface/include/phpThumb/phpthumb.class.php");
        $phpThumb = new phpThumb();
        $phpThumb->src = $src;
        $ext = end(explode(".", $src)); // Расширение файла картинки
        switch ($ext) {
            case "jpg": $phpThumb->f = "jpeg"; break;
            case "gif": $phpThumb->f = "gif"; break;
            case "png": $phpThumb->f = "png"; break;
            default: $phpThumb->f = "jpeg"; break;
        }
        $base_name = basename($src, ".".$ext); // Основное имя файла
        $phpThumb->w = $size;
        $phpThumb->h = $size;
        $phpThumb->q = 90;
        $phpThumb->bg = "#ffffff";
        $phpThumb->far = true;
        $phpThumb->aoe = false;
        if (is_array($params)) {
            foreach ($params as $param=>$value) {
                $phpThumb->$param = $value;
            }
            $code = substr(md5(serialize($params)), 8, 16); // сократим суффикс с параметрами до 16 символов
        } else {
            $code = $phpThumb->w;
        }

        $target_file = $_SERVER['DOCUMENT_ROOT'].dirname($src)."/".$base_name."_thumb_".$code.".".$ext;
        if (file_exists($target_file) AND filesize($target_file)>0) {
            if (filemtime($target_file)+$lifeTime < time()) { // Файл есть, но старый
                $phpThumb->GenerateThumbnail();
                $success = $phpThumb->RenderToFile($target_file);
            } else { // Файл есть, новый, не генерируем
                $success = true;
            }
        } else { // Файла нет, генерируем
            if (file_exists($target_file) AND filesize($target_file)==0) @unlink($target_file); // удаление файла нулевой длины
            $phpThumb->GenerateThumbnail();
            $success = $phpThumb->RenderToFile($target_file);
        }
        if ($success) return substr($target_file, strlen($_SERVER['DOCUMENT_ROOT'])); else return false;
    } else {
        return false;
    }
}

/**
 * Правила редиректов из файла
 */
function redirectByFile()
{

    $file = $_SERVER["DOCUMENT_ROOT"].'/redirect-rules.txt';

    if(file_exists($file))
    {
        $str = file_get_contents($file);
        if(strlen($str) > 10)
        {
            $arrRedirect = array();
            $strArr = explode("\n",$str);

            if(count($strArr)>0)
            {
                foreach($strArr as $oneStr)
                {
                    $oneStr = trim($oneStr);
                    $redirecRules = explode(' ', $oneStr);
                    if(count($redirecRules) == 2)
                    {
                        if(empty($redirecRules[0]) || empty($redirecRules[0]))
                            continue;

                        $str = trim($redirecRules[0]);

                        $arrRedirect[strlen($str)][$str] =  trim($redirecRules[1]);
                    }
                }

                if(count($arrRedirect) > 1)
                {
                    krsort($arrRedirect);

                    foreach($arrRedirect as $rules)
                    {
                        foreach($rules as $URI_IN => $URI_REDIRECT)
                        {
                            //     echo '<pre>'.print_r(array($URI_IN,$URI_REDIRECT),1).'</pre>'.__FILE__.' # '.__LINE__;
                            $good = false;
                            $str = $URI_IN;

                            if(substr($_SERVER["REQUEST_URI"],0,strlen($str))==$str )
                            {
                                $good = true;
                            }
                            else
                            {
                                $str = str_replace('?','/?',$str);
                                if(substr($_SERVER["REQUEST_URI"],0,strlen($str))==$str )
                                    $good = true;
                            }

                            if($good)
                                LocalRedirect($URI_REDIRECT, true, "301 Moved permanently");
                        }
                    }
                }
            }
        }

    }
}


function toggleSortOrder($sortOrder)
{
    if( strtolower($sortOrder) == "asc")
    {
        return "DESC";
    }
    return "ASC";
}

function getPrintPrice($price, $currency = ' руб.')
{
   return number_format($price, 0, '.', ' ') . $currency; 
}

function getCityName($cityName)
{
    if($cityName <> "")
    {
        return "г. ".$cityName;
    }
    return "";
}

function getDataBalances()
{
    if(!CModule::IncludeModule('iblock'))
    {
        return false;
    }
    else
    {
        $arSort = array("timestamp_x" => "desc");
        $arSelect = array(
            "ID",
            "NAME",
            "TIMESTAMP_X"
        );
        $arFilter = array(
            "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
            "ACTIVE" => "Y",
            ">CATALOG_QUANTITY" => 0,
        );
        $arNavStartParams = array(
            "nTopCount" => 1
        );
        $rsElements = CIBlockElement::GetList(
            $arSort,
            $arFilter,
            false,
            $arNavStartParams,
            $arSelect
        );
        while ($arItem = $rsElements->GetNext())
        {
            $arElement = $arItem;
        }

        return ConvertDateTime($arElement["TIMESTAMP_X"], "DD.MM.YYYY", "ru");
    }
    //echo "<pre>"; var_dump($arElement); echo "</pre>";
}

function addPropertyToIndex($iblockID, $itemID, $propertyName, &$body)
{
    CModule::IncludeModule('iblock');

    $resProps = CIBlockElement::GetProperty(
        $iblockID,
        $itemID,
        array("sort" => "asc"),
        Array("CODE"=> $propertyName)
    );
    if($arProp = $resProps->GetNext())
    {
        $body .= ' '.$arProp['VALUE'];
    }
}

function recursiveArraySearch($needle,$haystack)
{
    foreach($haystack as $key=>$value)
    {
        $current_key=$key;
        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false))
        {
            return $current_key;
        }
    }
    return false;
}

function getFileSrc($arItem)
{
    return '/upload/'.$arItem["SUBDIR"].'/'.$arItem["FILE_NAME"];
}

function getDetilTextWithOutTable($detailText)
{
    $arDetailText = explode("<p>#TABLE_PROP#</p>", $detailText);
    
    return implode('', $arDetailText);
}

function getUrlCompareSec($arUrl)
{
    return '/'.$arUrl[1].'/'.$arUrl[2].'/';
}

function getExtensionImage($src)
{
    return end(explode('.', $src));
}

function outputPrice($strPrice)
{
	if($strPrice <> "")
	{
		$result = IntVal($strPrice).' руб.';
	}
	else 
	{
		$result = '';
	}
	return $result;
}

function truncateStr($strText, $intLen, $endStr = "", $type = "text", $option = "")
{
    switch($type)
    {
        case "html":
            switch($option)
            {
                case 'fp':
                    $obParser = new CTextParser;
                    
                    $symbols = strip_tags($strText);
                    $symbols_len = strlen($symbols);
                    
                    if($symbols_len < strlen($strText))
                    {
                        $strip_text = $obParser->strip_words($strText, $intLen);
                    
                        if($symbols_len > $intLen)
                            $strip_text = $strip_text.$endStr;
                    
                        $final_text = $obParser->closetags($strip_text);
                        
                        preg_match('|<p>(.*)</p>|Uis', $final_text, $arFinalText);
                        
                        $final_text = current($arFinalText);
                    }
                    elseif($symbols_len > $strText)
                    {
                        $final_text = substr($strText, 0, $intLen).$endStr;
                        preg_match('|<p>(.*)</p>|Uis', $final_text, $arFinalText);
                        
                        $final_text = current($arFinalText);
                    }  
                    else
                    {
                        $final_text = $strText;
                    }
                break;
                default:
                    $obParser = new CTextParser;
                    
                    $symbols = strip_tags($strText);
                    $symbols_len = strlen($symbols);
                    
                    if($symbols_len < strlen($strText))
                    {
                        $strip_text = $obParser->strip_words($strText, $intLen);
                    
                        if($symbols_len > $intLen)
                            $strip_text = $strip_text.$endStr;
                    
                        $final_text = $obParser->closetags($strip_text);
                    }
                    elseif($symbols_len > $strText)
                        $final_text = substr($strText, 0, $intLen).$endStr;
                    else
                        $final_text = $strText;
                break;
            }
            return $final_text; 
        break;
        case "text":
            if(strlen($strText) > $intLen)
                return rtrim(substr($strText, 0, $intLen), ".").$endStr;
            else
                return $strText;
        break;
    }    
}

function plural($number, $word1, $word4, $word5) 
{
    if ($number % 100 == 11 || $number % 100 == 12 || $number % 100 == 13 || $number % 100 == 14) 
        return $word5;
    if ($number % 10 == 1)
        return $word1;
    if ($number % 10 == 2 || $number % 10 == 3 || $number % 10 == 4)
        return $word4;
    return $word5;
}

//htmlentities для кириллицы
function htmlSafe($string)
{
    return htmlentities($string, ENT_COMPAT | ENT_HTML401, "UTF-8");
}

function inMainPage()
{
	global $APPLICATION;
    $curDir = $APPLICATION -> GetCurPage();

	if($curDir == '/')
	{
		return true;
	}
	else
	{
		return false;
	}
	return false;
}

function inCatalogDetail()
{
    global $APPLICATION;
    $curDir = $APPLICATION -> GetCurPage();
    
    // /catalog/dresses/42_52/19/
    $catalogDetailPattern = '#^/catalog/[^/]+/[0-9_-]+/[^/]+$#Us';
    
    return preg_match($catalogDetailPattern, $curDir);
}

function inAboutContact(){
    if(strpos($_SERVER["REQUEST_URI"], '/about/contact/') === 0) {
        return true;
    }
    
    return false;
}

function inBalances(){
    if(strpos($_SERVER["REQUEST_URI"], '/catalog/balances/') === 0) {
        return true;
    }

    return false;
}

function inRegistration(){
    if(strpos($_SERVER["REQUEST_URI"], '/registration/') === 0) {
        return true;
    }
    
    return false;
}

function inDevelopment(){
    if(strpos($_SERVER["REQUEST_URI"], '/development/') === 0) {
        return true;
    }
    
    return false;
}

function inService(){
    if(strpos($_SERVER["REQUEST_URI"], '/service/') === 0) {
        return true;
    }
    
    return false;
}

function inDealers(){
    if(strpos($_SERVER["REQUEST_URI"], '/dealers/') === 0) {
        return true;
    }
    
    return false;
}

function inObjectsMap(){
	if(strpos($_SERVER["REQUEST_URI"], '/objects_map/') === 0) {
		return true;
	}

	return false;
}

function inObjectsMapList()
{
    global $APPLICATION;
    $curDir = $APPLICATION->GetCurDir();

    // /objects_map/город_1/
    if(strpos($curDir, '/objects_map/') === 0)
    {
        $arParseUrl = array_unique(explode("/", $curDir));
        $arParseUrl = array_diff($arParseUrl, array(''));

        if(sizeof($arParseUrl)>1)
        {
            return true;
        }
    }
    return false;
}

function inContacts(){
    if(strpos($_SERVER["REQUEST_URI"], '/contacts/') === 0) {
        return true;
    }
    
    return false;
}

// получить классы для body
function getBodyClassesString()
{
    global $APPLICATION;
    $curDir = $APPLICATION -> GetCurDir();

    // /objects/раздел_1/
    if(strpos($curDir, '/objects/') === 0)
    {
        $arParseUrl = array_unique(explode("/", $curDir));
        $arParseUrl = array_diff($arParseUrl, array(''));

        if(sizeof($arParseUrl)>1)
        {
            return 'catList';
        }
    }

    // /objects/
    if(strpos($curDir, '/objects/') === 0)
    {
        return 'catalog';
    }

    // /services/
    if(strpos($curDir, '/services/') === 0)
    {
        return 'services';
    }

    // /news/
    if(strpos($curDir, '/news/') === 0)
    {
        return 'news';
    }

    // /about/contact/
    if(strpos($curDir, '/about/contact/') === 0)
    {
        return 'contacts';
    }

    // /science/
    if(strpos($curDir, '/science/') === 0)
    {
        return 'contacts';
    }
    
    // /
    if(strpos($curDir, '/') === 0)
    {
        return '';
    }
    
    return 'page';
}

function getBodyIDsString()
{

    global $APPLICATION;
    $curDir = $APPLICATION -> GetCurDir();
    
    // /catalog/
    if(strpos($curDir, '/catalog/') === 0) 
    {
        return 'inner';
    }
    // / 
    if(strpos($curDir, '/') === 0) 
    {
        return 'index';
    }
    
    return 'inner';
}

function cmp($a, $b)
{
    if ($a == $b)
        return 0;
    
    return ($a < $b) ? -1 : 1;
}
?>