<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!empty($arParams['IBLOCK_ID_CANONICAL'])){
    
    $arSelect = Array("ID", "NAME");
    $arFilter = Array("IBLOCK_ID"=>IntVal($arParams['IBLOCK_ID_CANONICAL']), "ACTIVE"=>"Y", "PROPERTY_NEWS"=>$arResult['ID']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNext())
    {
        $arResult['LINK_CANONICAL'] = $ob['NAME'];
    }
    
    $cp = $this->__component;
    $cp->SetResultCacheKeys(array('LINK_CANONICAL'));
}