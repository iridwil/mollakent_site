<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    "NAME" => GetMessage("DESC_NAME"),
    "DESCRIPTION" => GetMessage("DESC_DESCRIPTION"),
    "SORT" => 10,
    "CACHE_PATH" => "Y",
    "PATH" => array(
        "ID" => "content",
        "CHILD" => array(
            "ID" => "custom",
            "NAME" => GetMessage("DESC_LIST_NAME"),
            "SORT" => 10,
        ),
    )
);
