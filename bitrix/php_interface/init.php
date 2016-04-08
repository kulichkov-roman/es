<?
if(LANGUAGE_ID == "ru")
{
    $langId = "RU";
}
else
{
    $langId = "EN";
}

// подключение переризатора
CModule::IncludeModule('itconstruct.resizer');

// некешируемые области
CModule::IncludeModule('itconstruct.uncachedarea');

// пользовательские переменные
\Bitrix\Main\Loader::includeModule('ceteralabs.uservars');

// функция pre() для отладки
if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/pre.php"))
	require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/pre.php";

// пользовательские функции
if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/functions.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/functions.php";

// пользовательские классы
if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/classes.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/classes.php";
	
// пользовательские константы
if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/settings/settings.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/settings/settings.php";
	
// в папке module_events лежат обработчики события
if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/main.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/main.php";

if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/sale.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/sale.php";
    
if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/catalog.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/catalog.php";

if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/search.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/search.php";

if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/iblock.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/iblock.php";
//<--

if(file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/itconstruct/eladdev.php"))
	require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/itconstruct/eladdev.php";
?><?if(file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/itconstruct/eladdev.php"))
			require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/itconstruct/eladdev.php";?>