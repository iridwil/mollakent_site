<?php
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("MyClass", "OnAfterIBlockElementUpdateHandler"));

class MyClass
{
    function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        if(is_object($GLOBALS['CACHE_MANAGER']) && $arFields['IBLOCK_ID'] == 2)
            $GLOBALS['CACHE_MANAGER']->ClearByTag('cache_test_iblock_1');
    }
}

?>