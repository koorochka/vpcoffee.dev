<?

class vpcoffeeCoffeeMachineList extends CBitrixComponent
{

    private $_elements;

    /**
     * @return mixed
     */
    public function getElements()
    {
        if(empty($this->_elements))
            $this->setElements();
        return $this->_elements;
    }

    /**
     * @param mixed $elements
     */
    public function setElements()
    {
        $elements = array();

        for($i = 0; $i < 5; $i++){
            $elements[] = "Coffee Machine " . $i;
        }

        $this->_elements = $elements;
    }


    // <editor-fold defaultstate="collapsed" desc="Execute component">
    public function executeComponent()
    {

        $this->IncludeComponentTemplate();
    }
    // </editor-fold>

}
