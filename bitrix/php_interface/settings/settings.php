<?
//-------------------------------------------Картинка заглушка---------------------------------------------------
define("NO_PHOTO_ID", 364);
define("NO_PHOTO_245_245_ID", 2041);
define("NO_PHOTO_353_353_ID", 2042);
define("NO_PHOTO_700_457_ID", 2043);
define("NO_PHOTO_EXTENSION", 'jpg');
define("NO_PHOTO_DEFAULT_EXTENSION", 'jpg');
//-------------------------------------------Идентификаторы сайтов-----------------------------------------------
define("SITE_ID", "s1");
define("SITE_TEMPLATE_DEFAULT_PATH", "/bitrix/templates/.default/");
define("LANGAUGE_EN_URL", "/en/");
//-------------------------------------------Идентификаторы инфоблоков-------------------------------------------
define("OBJECTS_IBLOCK_ID", 2);
define("CITIES_IBLOCK_ID", 1);
define("PUBLISHING_IBLOCK_ID", 9);
define("ACTICLE_IBLOCK_ID", 10);
define("SERVICES_ID", 4);
define("SEO_SEC_DESCRIPTIONS_IBLOCK_ID", 21);
//--------------------------------------------------Пути по сайту------------------------------------------------
define("SITE_URL_BUILD", "www.eronsib.ru");	// Домен сайта
define("SITE_URL_DEV", "ci51605.tmweb.ru");	// Домен сайта

define("OBJECTS_URL", "/objects/");
define("NEWS_URL", "/news/");
define("INVESTIGATIONS_URL", "/science/investigations/");
define("DOCTRINE_URL", "/science/doctrine/");
define("PUBLISHING_TUTORIALS_URL", "/science/publishing/tutorials/");
define("PUBLISHING_ARTICLES_URL", "/science/publishing/articles/");
define("SCIENCE_REVIEWS_URL", "/science/reviews/");
define("PATENTS_URL", "/science/patents/");
define("SCIENCE_URL", "/science/doctrine/");
define("ABOUT_REVIEWS_URL", "/about/reviews/");
define("ABOUT_URL", "/about/");
define("ABOUT_CERTIFICATES_URL", "/about/certificates/");
define("MAP_RUSSIA_URL", "/about/contact/");
define("OBJECTS_MAP_RUSSIA_URL", "/objects_map/");
define("OBJECT_FILE_PDF_URL", "/files/ercs_objects.pdf");
define("MAP_OBJECTS_URL", "javascript:void(0);");
define("SERVICES_URL", "/services/");
//-------------------------------------------------------Типы ИБ-------------------------------------------------
define("IBLOCK_TYPE_RU", "dynamic_content");
define("IBLOCK_TYPE_EN", "dynamic_content_en");

//-------------------------------------------------------Переменные сайта----------------------------------------
global $langId;

// раздел контакты заголовки
$contactTitleAddress = \Ceteralabs\UserVars::GetVar('CONTACT_TITLE_ADDRESS_'.$langId);
$contactTitlePhone = \Ceteralabs\UserVars::GetVar('CONTACT_TITLE_PHONE_'.$langId);
$contactTitleWorkTime = \Ceteralabs\UserVars::GetVar('CONTACT_TITLE_WORK_TIME_'.$langId);
$contactTitleManagers = \Ceteralabs\UserVars::GetVar('CONTACT_TITLE_MANAGERIAL_PERSONNEL_'.$langId);

// раздел котнакты значения
$contactAddressFull = \Ceteralabs\UserVars::GetVar('CONTACT_ADDRESS_FULL_'.$langId);
$contactAddressEnter = \Ceteralabs\UserVars::GetVar('CONTACT_ADDRESS_ENTER_'.$langId);

// раздел реквизиты значения
$contactTitleReq = \Ceteralabs\UserVars::GetVar('CONTACT_TITLE_REQ_'.$langId);
$contactReqNameCompany = \Ceteralabs\UserVars::GetVar('CONTACT_REQ_NAME_COMPANY_'.$langId);
$contactReqRS  = \Ceteralabs\UserVars::GetVar('CONTACT_REQ_RS_'.$langId);
$contactReqKS  = \Ceteralabs\UserVars::GetVar('CONTACT_REQ_KS_'.$langId);
$contactReqBIK = \Ceteralabs\UserVars::GetVar('CONTACT_REQ_BIK_'.$langId);
$contactReqIIN = \Ceteralabs\UserVars::GetVar('CONTACT_REQ_IIN_'.$langId);
$contactReqKPP = \Ceteralabs\UserVars::GetVar('CONTACT_REQ_KPP_'.$langId);
$contactReqOGRN = \Ceteralabs\UserVars::GetVar('CONTACT_REQ_OGRN_'.$langId);

$contactPhone = \Ceteralabs\UserVars::GetVar('CONTACT_PHONE');
$contactEmail = \Ceteralabs\UserVars::GetVar('CONTACT_EMAIL');

$contactWorkTime = \Ceteralabs\UserVars::GetVar('CONTACT_WORK_TIME_'.$langId);
$contactWorkTimeComment = \Ceteralabs\UserVars::GetVar('CONTACT_WORK_TIME_COMMENT_'.$langId);

$contactCEO = \Ceteralabs\UserVars::GetVar('CONTACT_CEO_'.$langId);
$contactExecDirector = \Ceteralabs\UserVars::GetVar('CONTACT_EXECUTIVE_DIRECTOR_'.$langId);

//-------------------------------------------------------ID почтовых шаблонов------------------------------------
//define("_TEMPLATE", 38);   // Шаблон отправки документов

//-------------------------------------------------------Типы валюты---------------------------------------------
//define("MY_IP", " 212.164.215.44");       // IP ул. Некрасова, д. 51

//-------------------------------------------------------Типы валюты---------------------------------------------
//define("_TYPE_1", 1);    // Тип базовой валюты

//-------------------------------------------------------Параметры для шаблона-----------------------------------
/*global $arBrandsSubSections;
$arBrandsSubSections = array("brands", "brand_technologies", "brand_history", "brand_reviews", "brand_video");

global $arShopSubSections;
$arShopSubSections = array("shops", "shop_info");

global $arPersonalSubSections;
$arPersonalSubSections = array("personal", "profile", "favorites");*/
//-------------------------------------------------------Параметры для каталога----------------------------------

$arPerPageCount = array(8, 24, 64, 104);

$arCatalogSortBy = array("NAME", "PROPERTY_YEARS_START");
$arCatalogSortNames = array("по алфавиту", "по дате");
// default sort order
$arCatalogSortOrder = array("DESC", "ASC", "DESC");

itc\Resizer::addPreset('search', array(
		'mode' => 'auto',
		'width' => 100,
		'height' => 100,
		'type' => 'png'
	)
);

itc\Resizer::addPreset('reviewsPreviewList', array(
        'mode' => 'auto',
        'width' => 126,
        'height' => 82,
        'type' => 'png'
    )
);
itc\Resizer::addPreset('reviewsDetailList', array(
        'mode' => 'crop',
        'width' => 170,
        'height' => 158,
        'type' => 'png'
    )
);
itc\Resizer::addPreset('reviewsPreviewScanList', array(
        'mode' => 'crop',
        'width' => 160,
        'height' => 226,
        'type' => 'jpg'
    )
);
itc\Resizer::addPreset('reviewsDetailScanList', array(
        'mode' => 'width',
        'width' => 640,
        'height' => null,
        'type' => 'jpg'
    )
);
itc\Resizer::addPreset('tutorialsDetail', array(
        'mode' => 'auto',
        'width' => 164,
        'height' => 232,
        'type' => 'jpg'
    )
);
itc\Resizer::addPreset('certificateDetail', array(
        'mode' => 'auto',
        'width' => 252,
        'height' => 232,
        'type' => 'jpg'
    )
);
?>