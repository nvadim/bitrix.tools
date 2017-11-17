<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "VARIABLE_ALIASES" => array(
            "route" => array("NAME" => GetMessage("NC_PARAMETERS_ROUTE")),
            "depart" => array("NAME" => GetMessage("NC_PARAMETERS_DEPART")),
            "intermediate" => array("NAME" => GetMessage("NC_PARAMETERS_INTER")),
            "dest" => array("NAME" => GetMessage("NC_PARAMETERS_DEST")),
            "transport" => array("NAME" => GetMessage("NC_PARAMETERS_TRANSPORT")),
            "loaders" => array("NAME" => GetMessage("NC_PARAMETERS_LOADERS")),
        ),
        "SEF_MODE" => Array(
            "route" => Array(
                "NAME" => GetMessage("NC_PARAMETERS_SEF_ROUTE"),
                "DEFAULT" => "route/",
                "VARIABLES" => array()
            ),
            "intermediate" => Array(
                "NAME" => GetMessage("NC_PARAMETERS_SEF_INTERMEDIATE"),
                "DEFAULT" => "i#intermediate_num#/",
                "VARIABLES" => array("intermediate_num")
            ),
            "depart" => Array(
                "NAME" => GetMessage("NC_PARAMETERS_SEF_DEPART"),
                "DEFAULT" => "depart/",
                "VARIABLES" => array()
            ),
            "dest" => Array(
                "NAME" => GetMessage("NC_PARAMETERS_SEF_DEST"),
                "DEFAULT" => "dest/",
                "VARIABLES" => array()
            ),
            "transport" => Array(
                "NAME" => GetMessage("NC_PARAMETERS_SEF_TR"),
                "DEFAULT" => "transport/",
                "VARIABLES" => array()
            ),
            "loaders" => Array(
                "NAME" => GetMessage("NC_PARAMETERS_SEF_LOAD"),
                "DEFAULT" => "loaders/",
                "VARIABLES" => array()
            ),
        ),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),

    )
);
?>
