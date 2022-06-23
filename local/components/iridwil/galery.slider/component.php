<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!CModule::IncludeModule("iblock"))
    return;
//объект
$obCache = new CPHPCache();

//время обновления кеша
$cacheLifetime = $arParams['CACHE_TIME'];

//Идентификатор. Включаются целые числа, параметры от которых зависит кеш
$cacheID = $arParams['IBLOCK_ID'];

//Директория кеша
$cachePath = "/galery_slider/";

if($obCache->InitCache($cacheLifetime, $cacheID, $cachePath)){ //проверка сущ-я кеша
    $arVars = $obCache->GetVars();//получим PHP переменные из кеша
    $arResult = $arVars['arResult'];
    $this->SetTemplateCachedData(arVars['templateCacheData']);//добавим стили в шаблон
    $obCache->Output(); //получим html из кеша
}
elseif($obCache->StartDataCache())//открываем буфер для записи нового кеша
{
    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_TEXT", "PREVIEW_PICTURE", "PROPERTY_YOUTUBE");
    $arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $rsElement = CIBlockElement::GetList(Array("id"=>"desc"), $arFilter, false, false, $arSelect);

    //тегированный кеш. Нужен только для нетиповых компонентов. Сбрасывается в init.php
    global $CACHE_MANAGER;
    $CACHE_MANAGER->StartTagCache($cachePath);

    while($arElement = $rsElement->GetNext())
    {
        $CACHE_MANAGER->RegisterTag('cache_test_iblock_' . $arParams['IBLOCK_ID']);
        $arResult[$arElement['ID']] = $arElement;
        $arResult[$arElement['ID']]['PREVIEW_PICTURE'] = CFile::GetByID($arElement['PREVIEW_PICTURE'])->GetNext();
        $arResult[$arElement['ID']]['PREVIEW_PICTURE']['SRC'] = CFile::GetPath($arElement['PREVIEW_PICTURE']);
    }
    $CACHE_MANAGER->EndTagCache();

    $this->IncludeComponentTemplate();
    $temlateCacheData = $this->GetTemplateCachedData();//получаем стили шаблона
    $obCache->EndDataCache(
        array(
            'arResult' => $arResult,
            'templateCacheData' => $templateCacheData, //кешируем стили шаблона
        )
    );
}
