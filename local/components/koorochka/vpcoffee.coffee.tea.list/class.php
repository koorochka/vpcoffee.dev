<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

if(class_exists("vpcoffeeShoppingCart"))
    return;

class vpcoffeeShoppingCart extends CBitrixComponent
{


    // <editor-fold defaultstate="collapsed" desc="Execute component">
    public function executeComponent()
    {

        $this->IncludeComponentTemplate();
    }
    // </editor-fold>

}
