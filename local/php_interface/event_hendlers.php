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