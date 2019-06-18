<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

if(class_exists("vpcoffeeShoppingCart"))
    return;

/**
 * Use abstract class from koorochka:iblock.elemnets
 */
CBitrixComponent::includeComponentClass("koorochka:vpcoffee");
CBitrixComponent::includeComponentClass("koorochka:iblock.elemnets");

/**
 * Class vpcoffeeShoppingCart
 */
class vpcoffeeShoppingCart extends Vpcoffee
{

    private $_machines;
    private $_coffee;

    // <editor-fold defaultstate="collapsed" desc="Machines">

    /**
     * @return mixed
     */
    public function getMachines()
    {
        return $this->_machines;
    }

    /**
     * @param mixed $machines
     */
    public function setMachines($machines)
    {
        $this->_machines = $machines;
    }

    public function setIbMachines()
    {
        $machines = array();
        if($this->startResultCache())
        {
            $elements = new koorochkaIblockElemnets();
            $elements->setOrder(array("SORT", "ASC"));
            $elements->setFilter(array(
                "IBLOCK_ID" => $this->getIblock("machine"),
                "ACTIVE" => "Y"
            ));
            $elements->setSelect(array(
                "ID",
                "NAME"
            ));
            $elements->setIbFetch();
            $machines = $elements->getElements();
        }
        $this->setMachines($machines);
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Coffee">

    /**
     * @return mixed
     */
    public function getCoffee()
    {
        return $this->_coffee;
    }

    /**
     * @param mixed $coffee
     */
    public function setCoffee($coffee)
    {
        $this->_coffee = $coffee;
    }

    public function setIbCoffee()
    {
        $coffee = array();
        if($this->startResultCache()){
            $result = new koorochkaIblockElemnets();
            $result->setOrder(array(
                "SORT" => "ASC"
            ));
            $result->setFilter(array(
                "IBLOCK_ID" => $this->getIblock("coffee"),
                "ACTIVE" => "Y"
            ));
            $result->setSelect(array(
                "ID",
                "NAME"
            ));
            $result->setIbFetch();
            $coffee = $result->getElements();
        }
        $this->_coffee = $coffee;
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Execute component">
    public function executeComponent()
    {
        # init
        $this->setIblocks(array(
            "articles" => 1,
            "coffee" => 2,
            "machine" => 3,
            "tea" => 4,
            "additionally" => 5
        ));
        # set
        $this->setIbMachines();
        $this->setIbCoffee();

        # get
        $this->arResult = array(
            "MACHINES" => $this->getMachines(),
            "COFFEE" => $this->getCoffee()
        );

        $this->IncludeComponentTemplate();
    }
    // </editor-fold>

}
