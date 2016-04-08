<? 
//-->
AddEventHandler("main", "OnBeforeUserUpdate", Array("KMSMainClass", "OnBeforeUserUpdateHandler"));
AddEventHandler("main", "OnBeforeUserAdd", Array("KMSMainClass", "OnBeforeUserAddHandler"));
AddEventHandler("main", "OnBeforeEventSend", Array("KMSMainClass", "OnBeforeEventSendHandler"));


AddEventHandler("main", "OnBeforeUserRegister", array("KMSMainClass", "emailToLogin"));
AddEventHandler("main", "OnBeforeUserUpdate", array("KMSMainClass", "emailToLogin"));

class KMSMainClass 
{
    function OnBeforeUserUpdateHandler(&$arFields)
    {
        // Запретить редактировать логин пользователям
        global $USER;

        if (!$USER->isAdmin()) {
            unset ($arFields["LOGIN"]);
        }

        return $arFields;
    }

    function OnBeforeUserAddHandler(&$arFields)
    {
        // Если пользователь зарегистрировался через социальные сети
        if ( strlen($arFields['EXTERNAL_AUTH_ID']) > 0)
        {
            if ($arFields['EMAIL'] == '' && $arFields["LOGIN"] != '')
                $arFields['EMAIL'] = $arFields['LOGIN'] . '.not@real.email';
        }

        return $arFields;
    }
    public function OnBeforeEventSendHandler(&$arFields, &$arTemplate){
        CModule::IncludeModule("iblock");
      $res = CIBlockElement::GetList(
       array(),
       array(
        'ID' => $arFields['Person']
       ),
       FALSE,
       FALSE,
       array(
        'ID',
        'NAME',
        'PROPERTY_email'
       )
      );
      $ar_res = $res->GetNext();
      
      if (!empty($ar_res['PROPERTY_EMAIL_VALUE'])){
        $FileLocalPath = parse_url($arFields['File'], PHP_URL_PATH);
        if (!in_array($FileLocalPath, array('', '/'))){
          $arFields['FileHTML'] = '<a href="'.$arFields['File'].'">'.$arFields['File'].'</a>';
        }else{
          $arFields['FileHTML'] = 'нет файла';
        }
        $arTemplate['EMAIL_TO'] = $ar_res['PROPERTY_EMAIL_VALUE'];
      }
    }
    
    function emailToLogin(&$arFields)
    {
        //не админ
        if(!in_array(1, CUser::GetUserGroup($arFields["ID"]))){
            $arFields["LOGIN"] = $arFields["EMAIL"];
        }    
        return $arFields;
    }
}
//<--
?>
