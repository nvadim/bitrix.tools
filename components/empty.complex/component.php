<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arComponentVariables = array('section_id', 'section_code', 'element_id',
    'element_code', 'load', 'favorite', 'search');
$arDefaultUrlTemplates404 = array('element' => 'w#element_id#/',
    'section' => '#section_id#/',
    'load' => 'load',
    'favorite' => 'favorite',
    'search' => 'search');

if ($arParams['SEF_MODE'] == 'Y')
{
    $arVariables = array();
    $arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams['SEF_URL_TEMPLATES']);
    $componentPage = CComponentEngine::ParseComponentPath($arParams['SEF_FOLDER'], $arUrlTemplates, $arVariables);

    $arResult = array('VARIABLES' => $arVariables, 'ALIASES' => $arVariableAliases);
    $arResult['PATH_TO_SECTION'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['section'];
    $arResult['PATH_TO_DETAIL'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['element'];
    $arResult['PATH_TO_LOAD'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['load'];
    $arResult['PATH_TO_FAVORITE'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['favorite'];
    $arResult['PATH_TO_SEARCH'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['search'];
}
else
{
    $arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases, $arParams['VARIABLE_ALIASES']);
    CComponentEngine::InitComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

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

    $arResult = array('VARIABLES' => $arVariables, 'ALIASES' => $arVariableAliases);
    $arVarAliaces = $arParams['VARIABLE_ALIASES'];

    $arResult['PATH_TO_SECTION'] = $APPLICATION->GetCurPageParam($arParams['VARIABLE_ALIASES']['section_id'].'=#section_id#', $arForDel);
    $arResult['PATH_TO_DETAIL'] = $APPLICATION->GetCurPageParam($arParams['VARIABLE_ALIASES']['element_id'].'=#element_id#', $arForDel);
    $arResult['PATH_TO_LOAD'] = $APPLICATION->GetCurPageParam($arParams['VARIABLE_ALIASES']['load'], $arForDel);
    $arResult['PATH_TO_FAVORITE'] = $APPLICATION->GetCurPageParam($arParams['VARIABLE_ALIASES']['favorite'], $arForDel);
    $arResult['PATH_TO_SEARCH'] = $APPLICATION->GetCurPageParam($arParams['VARIABLE_ALIASES']['search'], $arForDel);
}

$this->IncludeComponentTemplate($componentPage);