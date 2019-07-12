<?
use Bitrix\Main\Loader;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

if(class_exists("koorochkaClientType"))
    return;

class koorochkaClientType extends CBitrixComponent
{

    // <editor-fold defaultstate="collapsed" desc="Execute component">
    public function executeComponent()
    {
        $this->IncludeComponentTemplate();
    }
    // </editor-fold>
}