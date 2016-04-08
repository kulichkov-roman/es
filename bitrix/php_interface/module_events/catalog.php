<?
//AddEventHandler("catalog", "OnSuccessCatalogImport1C", "setPropertyNames");
AddEventHandler("catalog", "OnSuccessCatalogImport1C", "setBrandProperty", 100);
AddEventHandler("catalog", "OnSuccessCatalogImport1C", "resetUserFieldsShowLeftMenu", 200);
AddEventHandler("catalog", "OnSuccessCatalogImport1C", "setUserFieldsShowLeftMenu", 300);
AddEventHandler("catalog", "OnSuccessCatalogImport1C", "setUserFieldsQuantityLeftMenu", 400);
AddEventHandler("catalog", "OnSuccessCatalogImport1C", "deleteProductBalances", 500);
AddEventHandler("catalog", "OnSuccessCatalogImport1C", "createProductBalances", 600);

function setPropertyNames(){
    CModule::IncludeModule("iblock");

    $arFilter = array(
        "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
        "ACTIVE"    => "Y"
    );

    $rsProps = CIBlockProperty::GetList(array(), $arFilter);

    $obUpdateProp = new CIBlockProperty;
    while( $arProp = $rsProps->GetNext() ) {
        if(strpos($arProp["CODE"], "CML2") === false){
            $propId = $arProp["ID"];
            $propCode = "PROP_" . $propId;
            $arUpdateFields = array(
                "CODE" => $propCode
            );
            
            $obUpdateProp -> Update(
                $propId,
                $arUpdateFields
            );    
        }
    }
}

function setBrandProperty(){
    $importIblockId = $_SESSION["BX_CML2_IMPORT"]["NS"]["IBLOCK_ID"];

    //закончили импорт каталога
    if( ($importIblockId != CATALOG_IBLOCK_ID_KS)){
        return;
    }

    $output = date('d.m.Y H:i:s') . ' setBrandProperty' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);

    if(!CModule::IncludeModule('iblock')){
        return;
    }

    /*получим актуальные имена брендов из свойства-списка*/
    $arFilter = array(
        "IBLOCK_ID"     => CATALOG_IBLOCK_ID_KS,
        "ACTIVE"        => "Y",
        "!PROPERTY_CML2_MANUFACTURER" => false,
    );

    $arBrands = array();
    $rsElements = CIBlockElement::GetList(array(), $arFilter, array("PROPERTY_CML2_MANUFACTURER"));
    while( $arElement = $rsElements->GetNext() ) {
        $arBrands[] = $arElement['PROPERTY_CML2_MANUFACTURER_VALUE'];
    }

    /*получим имена и id существующих брендов*/
    $arBrandToId = array();
    $arFilter = array(
        "IBLOCK_ID" => BRANDS_IBLOCK_ID,
        "ACTIVE"    => "Y"
    );
    $rsElements = CIBlockElement::GetList(array(), $arFilter);
    while( $arElement = $rsElements->GetNext() ) {
        $arBrandToId[ $arElement["NAME"] ] = $arElement["ID"];
    }
    $arBrandExistingNames = array_keys($arBrandToId);

    /*с такими брендами нет товаров - удалим их*/
    $arBrandOldNames = array_diff($arBrandExistingNames, $arBrands);
    /*это новые бренды - добавим их*/
    $arBrandNewNames = array_diff($arBrands, $arBrandExistingNames);

    /*добавляем новые бренды*/
    $arBrandFields = array(
        "IBLOCK_ID"     => BRANDS_IBLOCK_ID,
        "ACTIVE"        => "Y",
    );

    $obBrand = new CIBlockElement;

    $arTranslitParams = Array(
        "max_len" => "50", // обрезает символьный код до 50 символов
        "change_case" => "L", // буквы преобразуются к нижнему регистру
        "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
        "replace_other" => "", // меняем левые символы на нижнее подчеркивание
        "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
    );

    foreach($arBrandNewNames as $Brand){
        $arBrandFields["NAME"] = $Brand;
        $arBrandFields["CODE"] = substr(CUtil::translit($Brand, "ru", $arTranslitParams), 0, 50);
        $NEW_Brand_ID = $obBrand -> Add(
            $arBrandFields
        );

        if($NEW_Brand_ID) {
            $arBrandToId[ $Brand ] = $NEW_Brand_ID;
        }
    }

    /*удалим старые бренды*/
    $arBrandOldIds = array();
    foreach($arBrandOldNames as $Brand){
        $arBrandOldIds[] = $arBrandToId[ $Brand ];
    }

    foreach($arBrandOldIds as $BrandId) {
        CIBlockElement::Delete($BrandId);
    }

    /*проставить привязку*/
    $arFilter = array(
        "IBLOCK_ID"     => CATALOG_IBLOCK_ID_KS,
        "ACTIVE"        => "Y",
        "!PROPERTY_CML2_MANUFACTURER" => false
    );

    $BrandS_ID_PROP_NAME = "BRAND";
    $rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "PROPERTY_CML2_MANUFACTURER"));
    while( $arFields = $rsElements->GetNext() ) {

        $brandProp = $arFields["PROPERTY_CML2_MANUFACTURER_VALUE"];
        // $arBrandIds = array();

        $brandId = $arBrandToId[ $brandProp ];

        $ELEMENT_ID = $arFields["ID"];

        if($ELEMENT_ID && $brandId){
            CIBlockElement::SetPropertyValuesEx(
                $ELEMENT_ID,
                CATALOG_IBLOCK_ID_KS,
                array(
                    $BrandS_ID_PROP_NAME => $brandId
                )
            );
        }
    }

    $output .= date('d.m.Y H:i:s') . ' setBrandProperty end' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);
}

function resetUserFieldsShowLeftMenu()
{
    $importIblockId = $_SESSION["BX_CML2_IMPORT"]["NS"]["IBLOCK_ID"];

    //закончили импорт каталога
    if(($importIblockId != CATALOG_IBLOCK_ID_KS)){
        return;
    }

    $output = date('d.m.Y H:i:s') . ' resetUserFieldsShowLeftMenu' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);

    if(!CModule::IncludeModule('iblock')){
        return;
    }

    $arSort = array();
    $arFilter = array(
        "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
    );
    $arSelect = array("ID", "NAME");

    $rsSection = CIBlockSection::GetList(
        $arSort,
        $arFilter,
        false,
        $arSelect,
        false
    );

    $arSectionIDs = array();
    while ($arItem = $rsSection->GetNext())
    {
        $arSectionIDs[] = $arItem["ID"];
    }
    unset($arItem, $arElement);

    $bs = new CIBlockSection;

    $arFields = Array(
        "UF_SHOW_LEFT_MENU" => false,
        "UF_POSITIVE_BALANCES" => false,
    );
    // проставить всм разделам в UF_SHOW_MENU_LEFT значение false
    // проставить всм разделам в UF_POSITIVE_BALANCES значение false
    foreach($arSectionIDs as $id)
    {
        if($id > 0)
        {
            $rsCurBs = $bs->Update($id, $arFields);
        }
    }
    unset($arId);

    $output .= date('d.m.Y H:i:s') . ' resetUserFieldsShowLeftMenu end' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);
}

function setUserFieldsShowLeftMenu()
{
    $importIblockId = $_SESSION["BX_CML2_IMPORT"]["NS"]["IBLOCK_ID"];

    //закончили импорт каталога
    if( ($importIblockId != CATALOG_IBLOCK_ID_KS)){
        return;
    }

    $output = date('d.m.Y H:i:s') . ' setUserFieldsShowLeftMenu' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);

    if(!CModule::IncludeModule('iblock')){
        return;
    }

    // получить все товары основные
    $arSort = array();
    $arSelect = array(
        "ID",
        "NAME",
        "IBLOCK_SECTION_ID"
    );
    $arFilter = array(
        "ACTIVE" => "Y",
        "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
        "PROPERTY_AKSESSUAR_V_GRUPPE" => "true",
    );
    $arGroupBy = array('IBLOCK_SECTION_ID');

    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        $arGroupBy,
        false,
        $arSelect
    );

    while ($arItem = $rsElements->GetNext())
    {
        $arElement[] = $arItem;
    }

    // создать массива идентификаторов разделов
    $arIds = array();
    foreach($arElement as &$arItem)
    {
        $arIds[] = $arItem["IBLOCK_SECTION_ID"];
    }
    unset($arItem, $arElement);

    // получить массив всех корневых разделов для текущего
    $arPath = array();
    foreach($arIds as $key=>$id)
    {
        $rsPath= GetIBlockSectionPath(CATALOG_IBLOCK_ID_KS, $id);
        while($arItem = $rsPath->GetNext())
        {
            $arPath[] = $arItem["ID"];
        }
        $arIds[$key] = array(
            "ID" => $id,
            "PATH_ID" => $arPath,
        );
        unset($arPath);
    }

    $bs = new CIBlockSection;

    // "включить" свойство
    $arFields = Array(
        "UF_SHOW_LEFT_MENU" => true,
    );

    // установить свойство, обновив разделы
    foreach($arIds as $arId)
    {
        if($arId["ID"] > 0)
        {
            $rsCurBs = $bs->Update($arId["ID"], $arFields);

            foreach($arId["PATH_ID"] as $id)
            {
                $rsPathBs = $bs->Update($id, $arFields);
            }
        }
    }
    unset($arId);

    $output .= date('d.m.Y H:i:s') . ' setUserFieldsShowLeftMenu end' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);
}

function setUserFieldsQuantityLeftMenu()
{
    $importIblockId = $_SESSION["BX_CML2_IMPORT"]["NS"]["IBLOCK_ID"];

    //закончили импорт каталога
    if( ($importIblockId != CATALOG_IBLOCK_ID_KS)){
        return;
    }

    $output = date('d.m.Y H:i:s') . ' setUserFieldsQuantityLeftMenu' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);

    if(!CModule::IncludeModule('iblock')){
        return;
    }

    // получить все товары основные и баланс положительный
    $arSort = array();
    $arSelect = array(
        "ID",
        "NAME",
        "IBLOCK_SECTION_ID"
    );
    $arFilter = array(
        "ACTIVE" => "Y",
        "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
        "PROPERTY_AKSESSUAR_V_GRUPPE" => "true",
        ">CATALOG_QUANTITY" => 0,
    );
    $arGroupBy = array('IBLOCK_SECTION_ID');

    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        $arGroupBy,
        false,
        $arSelect
    );

    while ($arItem = $rsElements->GetNext())
    {
        $arElement[] = $arItem;
    }

    // создать список идентификаторв разделов
    $arIds = array();
    foreach($arElement as &$arItem)
    {
        $arIds[] = $arItem["IBLOCK_SECTION_ID"];
    }
    unset($arItem, $arElement);

    foreach($arIds as $key=>$id)
    {
        // получить массив всех родительских идентификатов до корневого раздела
        $rsPath= GetIBlockSectionPath(CATALOG_IBLOCK_ID_KS, $id);
        while($arItem = $rsPath->GetNext())
        {
            $arPath[] = $arItem["ID"];
        }
        $arIds[$key] = array(
            "ID" => $id,
            "PATH_ID" => $arPath,
        );
        unset($arPath);
    }

    $bs = new CIBlockSection;

    // "включить" свойство
    $arFields = Array(
        "UF_POSITIVE_BALANCES" => true,
    );

    // установить свойство, обновив разделы
    foreach($arIds as $arId)
    {
        if($arId["ID"] > 0)
        {
            $rsCurBs = $bs->Update($arId["ID"], $arFields);

            foreach($arId["PATH_ID"] as $id)
            {
                $rsPathBs = $bs->Update($id, $arFields);
            }
        }
    }
    unset($arId);

    $output .= date('d.m.Y H:i:s') . ' setUserFieldsQuantityLeftMenu end' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);
}

function deleteProductBalances()
{
    $importIblockId = $_SESSION["BX_CML2_IMPORT"]["NS"]["IBLOCK_ID"];

    //закончили импорт каталога
    if (($importIblockId != CATALOG_IBLOCK_ID_KS))
    {
        return;
    }

    $output = date('d.m.Y H:i:s') . ' deleteProductBalances' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);

    if (!CModule::IncludeModule('iblock'))
    {
        return;
    }

    // получить список все элеметов из Иб товаров на складе
    $arSort = array();
    $arSelect = array(
        "ID",
        "NAME"
    );

    $arFilter = array(
        "IBLOCK_ID" => BALANCES_PRODUCT_ID
    );

    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        false,
        false,
        $arSelect
    );
    while ($arItem = $rsElements->GetNext())
    {
        $arElements[] = $arItem;
    }

    // удалить все элементы и ИБ товаров на складе
    $bl = new CIBlock;
    if ($bl->GetPermission(BALANCES_PRODUCT_ID) >= 'W')
    {
        $el = new CIBlockElement;
        if (is_array($arElements))
        {
            global $DB;
            foreach ($arElements as &$arItem)
            {
                $DB->StartTransaction();
                if (!$el->Delete($arItem['ID']))
                {
                    $output .= date('d.m.Y H:i:s') . ' error element ID=' . $arItem['ID'] . ' not delete' . "\n";
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);

                    $DB->Rollback();
                    return false;
                }
                else
                {
                    $DB->Commit();
                }
            }
            unset($arItem, $arElement);
        }
    }

    $output .= date('d.m.Y H:i:s') . ' deleteProductBalances end' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);
}

function createProductBalances()
{
    $importIblockId = $_SESSION["BX_CML2_IMPORT"]["NS"]["IBLOCK_ID"];

    //закончили импорт каталога
    if (($importIblockId != CATALOG_IBLOCK_ID_KS))
    {
        return;
    }

    $output = date('d.m.Y H:i:s') . ' createProductBalances' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);

    if (!CModule::IncludeModule('iblock'))
    {
        return;
    }
    // сортируем по дате обновления элементов
    $arSort = array(
        "timestamp_x" => "desc",
    );
    $arSelect = array(
        "ID",
        "NAME",
        "DETAIL_PICTURE",
        "PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE"
    );
    $arFilter = array(
        "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
    );
    $arNavStartParams = array(
        "nTopCount" => 100,
    );
    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        false,
        $arNavStartParams,
        $arSelect
    );

    // создать массив идентификаторов элементов
    $arIds = array();
    while ($arItem = $rsElements->GetNext())
    {
        $arElements[$arItem["ID"]] = $arItem;
        $arIds[] = $arItem["ID"];
    }

    // получить 20 случайных ключей массива идентификатовр
    $arKeyIds = array_rand($arIds, 20);
    foreach($arKeyIds as $key)
    {
        $arIdsTrunc[] = $arIds[$key];
    }

    // собрать 20 элементов из 100 выбранных
    $arElementsTrunc = array();
    foreach($arIdsTrunc as $id)
    {
        $arElementsTrunc[$id] = $arElements[$id];
    }

    // создать массив идентификаторв картинки
    $arDetailPictures = array();
    foreach($arElementsTrunc as &$arItem)
    {
        $arDetailPictures[$arItem["ID"]] = $arItem["DETAIL_PICTURE"];
    }
    unset($arItem, $arElements, $arIdsTrunc);

    // одним запросом получить массив свойст файла по строке идентификаторв картинок
    $strDetailPictures = implode(",", $arDetailPictures);

    $fl = new CFile;

    $arOrder = array();
    $arFilter = array(
        "MODULE_ID" => "iblock",
        "@ID" => $strDetailPictures
    );

    $rsFile = $fl->GetList(
        $arOrder,
        $arFilter
    );
    $arFile = array();
    while($arItem = $rsFile->GetNext())
    {
        $arFile[$arItem["ID"]] = $arItem;
        $arFile[$arItem["ID"]]["SRC"] = "/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"];
    }

    // добавить массив свойств детальных картинок к 20ти элементам
    foreach($arElementsTrunc as &$arItem)
    {
        $arItem["DETAIL_PICTURE"] = $arFile[$arItem["DETAIL_PICTURE"]];
    }
    unset($arItem);

    $arProp = array();
    $el = new CIBlockElement;
    global $USER;

    // создать 20 элементов по данным полученным выше
    foreach($arElementsTrunc as &$arItem)
    {
        $arProp[1115] = $arItem["ID"];

        $arLoadProductArray = Array(
            "MODIFIED_BY"    => $USER->GetID(),
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"      => BALANCES_PRODUCT_ID,
            "PROPERTY_VALUES"=> $arProp,
            "NAME"           => $arItem["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"],
            "ACTIVE"         => "Y",
            "DETAIL_PICTURE" => $fl->MakeFileArray($arItem["DETAIL_PICTURE"]["SRC"]),
        );

        if(!($productId = $el->Add($arLoadProductArray)))
        {
            $output .= date('d.m.Y H:i:s') . ' error element ID='.$arItem["ID"].' '.$el->LAST_ERROR."\n";
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);
        }
    }
    unset($arItem);

    $output .= date('d.m.Y H:i:s') . ' createProductBalances end' . "\n";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/success_1c_import.log', $output, FILE_APPEND);
}
?>