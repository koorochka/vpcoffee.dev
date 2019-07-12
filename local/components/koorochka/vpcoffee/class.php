<?
if(class_exists("Vpcoffee"))
    return;

/**
 * Class Vpcoffee
 * Методы, объявленные абстрактными, несут, по существу, лишь описательный смысл и не могут включать реализацию.
 * При наследовании от абстрактного класса, все методы, помеченные абстрактными в родительском классе, должны быть определены в дочернем классе; кроме того, область видимости этих методов должна совпадать (или быть менее строгой).
 */
abstract class Vpcoffee extends CBitrixComponent
{
    private $_iblocks;
    private $_locations;
    private $_services;
    private $_client;

    // <editor-fold defaultstate="collapsed" desc="Request">

    /**
     * @param mixed $iblocks
     */
    public function setIblocks($iblocks)
    {
        if(empty($iblocks))
            $this->emptyIblocks();
        $this->_iblocks = $iblocks;
    }

    /**
     * default iblocks
     */
    public function emptyIblocks(){
        if(empty($this->_iblocks))
            $this->setIblocks(array(
                "articles" => 1,
                "coffee" => "2",
                "machine" => "3",
                "tea" => "4",
                "additionally" => "5"
            ));
    }

    /**
     * @return mixed
     */
    public function getIblocks()
    {
        if(empty($this->_iblocks))
            $this->emptyIblocks();
        return $this->_iblocks;
    }

    public function getIblock($code){
        if(empty($this->_iblocks))
            $this->emptyIblocks();
        return $this->_iblocks[$code];
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Locations">

    /**
     * @return mixed
     */
    public function getLocations()
    {
        if(empty($this->_locations))
            $this->addLocations();
        return $this->_locations;
    }

    /**
     * @param mixed $locations
     */
    public function setLocations($locations)
    {
        $this->_locations = $locations;
    }
    public function addLocations()
    {
        $locations = array(
            "moscow" => "MOSCOW",
            "all" => "ALL"
        );
        $this->setLocations($locations);
    }
    public function getLocation($code){
        return $this->_locations[$code];
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Services">

    /**
     * @return mixed
     */
    public function getServices()
    {
        return $this->_services;
    }

    /**
     * @param mixed $services
     */
    public function setServices($services)
    {
        $this->_services = $services;
    }
    public function addServices()
    {
        $services = array(
            "with_coffee" => "WITH_COFFEE",
            "without_coffee" => "WITHOUT_COFFEE"
        );
        $this->setServices($services);
    }
    public function setService($code)
    {
        return $this->_services[$code];
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Client type">

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->_client = $client;
    }

    public function addClient()
    {
        $client = array(
            "client" => "CLIENT",
            "guest" => "GUEST"
        );
        $this->setClient($client);
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Price matrix functions">


    public function getPriceCode($arParams){
        
        $p = 0;

        if($arParams["LOCATION"] == "moscow")
        {

            if($arParams["TYPE"] == 1)  # Механика
            {
                if($arParams["COFFEE_COUNT"] == 1)
                {
                    $p=1;
                }
                elseif($arParams["COFFEE_COUNT"] == 2)
                {
                    $p=2;
                }
                elseif($arParams["COFFEE_COUNT"] == 3)
                {
                    $p=3;
                }
                elseif($arParams["COFFEE_COUNT"] >= 4)
                {
                    $p=4;
                }
            }
            elseif($arParams["TYPE"] == 10)  # Суперавтомат
            {
                if($arParams["COFFEE_COUNT"] == 6)
                {
                    $p=21;
                }
                elseif($arParams["COFFEE_COUNT"] == 7)
                {
                    $p=22;
                }
                elseif($arParams["COFFEE_COUNT"] == 8)
                {
                    $p=23;
                }
                elseif($arParams["COFFEE_COUNT"] == 9)
                {
                    $p=24;
                }
                elseif($arParams["COFFEE_COUNT"] > 9)
                {
                    $p=10;
                }
            }
            else # Автомат
            {
                if($arParams["COFFEE_COUNT"] == 3)
                {
                    $p=5;
                }
                elseif($arParams["COFFEE_COUNT"] == 4)
                {
                    $p=6;
                }
                elseif($arParams["COFFEE_COUNT"] == 5 || $arParams["COFFEE_COUNT"] == 6)
                {
                    $p=7;
                }
                elseif($arParams["COFFEE_COUNT"] == 7)
                {
                    $p=8;
                }
                elseif($arParams["COFFEE_COUNT"] >= 8 && $arParams["COFFEE_COUNT"] < 12)
                {
                    $p=9;
                }
                elseif($arParams["COFFEE_COUNT"] >= 12)
                {
                    $p=10;
                }
            }
        }
        elseif($arParams["LOCATION"] == "all")
        {
            if($arParams["TYPE"] == 1)  # Механика
            {
                if($arParams["COFFEE_COUNT"] == 1)
                {
                    $p=11;
                }
                elseif($arParams["COFFEE_COUNT"] == 2)
                {
                    $p=12;
                }
                elseif($arParams["COFFEE_COUNT"] == 3)
                {
                    $p=13;
                }
                elseif($arParams["COFFEE_COUNT"] >= 4)
                {
                    $p=14;
                }
            }
            elseif($arParams["TYPE"] == 10)  # Суперавтомат
            {
                if($arParams["COFFEE_COUNT"] == 6)
                {
                    $p=25;
                }
                elseif($arParams["COFFEE_COUNT"] == 7)
                {
                    $p=26;
                }
                elseif($arParams["COFFEE_COUNT"] == 8)
                {
                    $p=27;
                }
                elseif($arParams["COFFEE_COUNT"] == 9)
                {
                    $p=28;
                }
                elseif($arParams["COFFEE_COUNT"] > 9)
                {
                    $p=20;
                }
            }
            else # Автомат
            {
                if($arParams["COFFEE_COUNT"] == 3)
                {
                    $p=15;
                }
                elseif($arParams["COFFEE_COUNT"] == 4)
                {
                    $p=16;
                }
                elseif($arParams["COFFEE_COUNT"] == 5 || $arParams["COFFEE_COUNT"] == 6)
                {
                    $p=17;
                }
                elseif($arParams["COFFEE_COUNT"] == 7)
                {
                    $p=18;
                }
                elseif($arParams["COFFEE_COUNT"] >= 8 && $arParams["COFFEE_COUNT"] < 12)
                {
                    $p=19;
                }
                elseif($arParams["COFFEE_COUNT"] >= 12)
                {
                    $p=20;
                }
            }
        }

        return $p;        
    }


    public function calculatePrice($arParams){
        $p = $this->getPriceCode($arParams);
        $p = "PROPERTY_P".$p;
        $result = CIBlockElement::GetList(
            false,
            array(
                "IBLOCK_ID" => $arParams["COFFEE"]["IBLOCK_ID"],
                "ID" => $arParams["COFFEE"]["ID"]
            ),
            false,
            false,
            array("ID", $p)
        );
        if($result = $result->Fetch())
            $result = $result[$p . "_VALUE"];

        $result = str_replace(" ","", $result);
        $result = $result * $arParams["COUNT"];

        return $result;
    }
    // </editor-fold>

}