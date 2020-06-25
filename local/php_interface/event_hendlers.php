<?
IncludeTemplateLangFile(__FILE__);
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("MyClass", "OnBeforeIBlockElementUpdateHandler"));

class MyClass
{
    // создаем обработчик события "OnBeforeIBlockElementUpdate"
    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        
        $res = CIBlockElement::GetByID($arFields["ID"]);
        $ar_res = $res->GetNext();
    
        if($arFields['IBLOCK_ID'] == 2 && $ar_res["SHOW_COUNTER"] >= 2 && $ar_res['ACTIVE'] == 'Y' && $arFields['ACTIVE'] == 'N')
        {
            global $APPLICATION;
            $APPLICATION->throwException(GetMessage('UPDAT_ELEMENT', array('#COUNT#' => $ar_res["SHOW_COUNTER"])));
            return false;
        }
    }
}

AddEventHandler("main", "OnBeforeEventAdd", "OnBeforeEventAddHandler");
function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
{
    if($event == 'FEEDBACK_FORM'){
        global $USER;
        if($USER->IsAuthorized()){
            $arFields['AUTHOR'] = GetMessage('AUTHOR_AUTORISE', array(
                                                                    '#ID#' => $USER->GetID(),
                                                                    '#LOGIN#' => $USER->GetLogin(),
                                                                    '#NAME#' => $USER->GetFirstName(),
                                                                    '#AUTHOR_IN_FORM#' => $arFields['AUTHOR']
                                                                    )
                                             );
        }else{
            $arFields['AUTHOR'] = GetMessage('AUTHOR_NOT_AUTORISE', array('#AUTHOR_IN_FORM#' => $arFields['AUTHOR']));
        }
        
        CEventLog::Add(array(
         "SEVERITY" => "INFO",
         "AUDIT_TYPE_ID" => "FEEDBACK_FORM",
         "MODULE_ID" => "main",
         "DESCRIPTION" => GetMessage('MESSAGE_LOG', array('#AUTHOR#' => $arFields['AUTHOR']))
         ));
    }
}