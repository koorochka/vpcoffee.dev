<?

use Bitrix\Main\Loader;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

if(class_exists("iblockElemnets"))
    return;

class iblockElemnets extends CBitrixComponent
{
    private $_order;
    private $_filter;
    private $_select;
    private $_elements;

    // <editor-fold defaultstate="collapsed" desc="Order">
    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->_order = $order;
    }
    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->_order;
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Filter">
    /**
     * @param mixed $filter
     */
    public function setFilter($filter)
    {
        $this->_filter = $filter;
    }

    /**
     * @return mixed
     */
    public function getFilter()
    {
        return $this->_filter;
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Select">
    /**
     * @return mixed
     */
    public function getSelect()
    {
        return $this->_select;
    }

    /**
     * @param mixed $select
     */
    public function setSelect($select)
    {
        $this->_select = $select;
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Elements">

    /**
     * @return mixed
     */
    public function getElements()
    {
        return $this->_elements;
    }

    /**
     * @param mixed $elements
     */
    public function setElements($elements)
    {
        $this->_elements = $elements;
    }

    public function setIbFetch()
    {
        $elements = array();
        if(Loader::includeModule("iblock")){
            $result = CIBlockElements::GetList(
                $this->getOrder(),
                $this->getFilter(),
                false,
                false,
                $this->getSelect()
            );
            while ($element = $result->Fetch()){
                $elements[] = $element;
            }
        }
        $this->_elements = $elements;
    }
    // </editor-fold>




}
