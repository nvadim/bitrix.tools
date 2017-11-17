<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

//$arComponentVariables = array('section_id', 'section_code', 'element_id',
//    'element_code', 'load', 'favorite', 'search');
//$arDefaultUrlTemplates404 = array('element' => 'w#element_id#/',
//    'section' => '#section_id#/',
//    'load' => 'load',
//    'favorite' => 'favorite',
//    'search' => 'search');
$arDefaultVariableAliases = array();
$arDefaultUrlTemplates404 = array(
    "sections" => "",
    "section" => "#SECTION_ID#/",
    "element" => "#SECTION_ID#/#ELEMENT_ID#/",
    "compare" => "compare.php?action=COMPARE",
    "smart_filter" => "filter/#SMART_FILTER_PATH#/apply/"
);

$arDefaultVariableAliases404 = array();

$arComponentVariables = array(
    "SECTION_ID",
    "SECTION_CODE",
    "ELEMENT_ID",
    "ELEMENT_CODE",
    "action",
);

if ($arParams['SEF_MODE'] == 'Y')
{
    $arVariables = array();

    $engine = new CComponentEngine($this);
    $arUrlTemplates = CComponentEngine::makeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
    $arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);

    $componentPage = $engine->guessComponentPath(
        $arParams["SEF_FOLDER"],
        $arUrlTemplates,
        $arVariables
    );

    if(!$componentPage)
    {
        $componentPage = "index";
    }


    CComponentEngine::initComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);
    $arResult = array(
        "FOLDER" => $arParams["SEF_FOLDER"],
        "URL_TEMPLATES" => $arUrlTemplates,
        "VARIABLES" => $arVariables,
        "ALIASES" => $arVariableAliases
    );
}
else
{
    $arVariables = array();

    $arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases, $arParams["VARIABLE_ALIASES"]);
    CComponentEngine::initComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

    $componentPage = "";

    if ($arVariables['element_id'].$arVariables['element_code'] != '')
        $componentPage = 'element';
    elseif ($arVariables['section_id'].$arVariables['section_code'] != '')
        $componentPage = 'section';
    elseif (isset($arVariables['load']))
        $componentPage = 'load';
    elseif (isset($arVariables['favorite']))
        $componentPage = 'favorite';
    elseif (isset($arVariables['search']))
        $componentPage = 'search';
    else
        $componentPage = 'index';

    $currentPage = htmlspecialcharsbx($APPLICATION->GetCurPage())."?";
    $arResult = array(
        "FOLDER" => "",
        "URL_TEMPLATES" => array(
            "intermediate" => $currentPage.$arVariableAliases["intermediate_num"]."=#intermediate_num#",
            "page" => $currentPage.$arVariableAliases["page"] . '=#page#',
        ),
        "VARIABLES" => $arVariables,
        "ALIASES" => $arVariableAliases
    );
}

$this->IncludeComponentTemplate($componentPage);