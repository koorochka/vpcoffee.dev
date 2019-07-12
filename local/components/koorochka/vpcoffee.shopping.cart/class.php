<?
use Bitrix\Main\Application,
    Bitrix\Main\Web\HttpClient,
    Bitrix\Main\Localization\Loc;
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
class   vpcoffeeShoppingCart extends Vpcoffee
{
    private $_machines;
    private $_coffee;
    private $_coffee_sections;
    private $_additionally;
    private $_request;
    private $_userData;

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
            $elements->setOrder(array(
                "propertysort_VOLUME" => "ASC",
                "NAME" => "ASC"
            ));

            if($this->_userData["SERVICE"] == "without_coffee"){
                $elements->setFilter(array(
                    "IBLOCK_ID" => $this->getIblock("machine"),
                    "ACTIVE" => "Y",
                    "PROPERTY_CONDITION" => 10
                ));
            }else{
                $elements->setFilter(array(
                    "IBLOCK_ID" => $this->getIblock("machine"),
                    "ACTIVE" => "Y"
                ));
            }

            $elements->setSelect(array(
                "ID",
                "NAME",
                "CODE",
                "DETAIL_PAGE_URL",
                "PREVIEW_PICTURE",
                "PROPERTY_TYPE",
                "PROPERTY_VOLUME",
                "PROPERTY_CONDITION",
                "PROPERTY_WITOUT_PRICE",
                "PROPERTY_WITOUT_FILE",
                "PROPERTY_WITOUT_MIN_ORDER",
            ));
            $elements->setIbGetNext();
            $machines = $elements->getElements();

            // resize pictures
            foreach ($machines as $key=>$machine){
                $machine["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
                    $machine["PREVIEW_PICTURE"],
                    array(
                        "width" => 100,
                        "height" => 100
                    ),
                    BX_RESIZE_IMAGE_EXACT
                );
                if($machine["PROPERTY_WITOUT_FILE_VALUE"] > 0)
                    $machines[$key]["PROPERTY_WITOUT_FILE_VALUE"] = CFile::GetFileArray($machine["PROPERTY_WITOUT_FILE_VALUE"]);
                $machines[$key]["PREVIEW_PICTURE"] = $machine["PREVIEW_PICTURE"]["src"];
            }

        }



        $this->setMachines($machines);
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Coffee sections">

    /**
     * @return mixed
     */
    public function getCoffeeSections()
    {
        return $this->_coffee_sections;
    }

    /**
     * @param mixed $coffee_sections
     */
    public function setCoffeeSections($coffee_sections)
    {
        $this->_coffee_sections = $coffee_sections;
    }

    public function setIbSectionsCoffee()
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
                "NAME",
                "CODE"
            ));
            $result->setIbSectionsFetch();
            $coffee = $result->getSections();
        }
        $this->setCoffeeSections($coffee);
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
                "IBLOCK_ID",
                "NAME",
                "CODE",
                "DETAIL_PAGE_URL",
                "PREVIEW_PICTURE",
                "IBLOCK_SECTION_ID"
            ));

            $result->setIbGetNext();
            $coffees = $result->getElements();

            // resize pictures
            foreach ($coffees as $key=>$coffee){
                $coffee["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
                    $coffee["PREVIEW_PICTURE"],
                    array(
                        "width" => 100,
                        "height" => 100
                    ),
                    BX_RESIZE_IMAGE_EXACT
                );

                $coffees[$key]["PREVIEW_PICTURE"] = $coffee["PREVIEW_PICTURE"]["src"];
            }
        }
        $this->setCoffee($coffees);
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Additionally & tea">

    /**
     * @return mixed
     */
    public function getAdditionally()
    {
        return $this->_additionally;
    }

    /**
     * @param mixed $additionally
     */
    public function setAdditionally($additionally)
    {
        $this->_additionally = $additionally;
    }

    public function setIbAdditionally()
    {
        if($this->startResultCache()){
            $result = new koorochkaIblockElemnets();
            $result->setOrder(array(
                "SORT" => "ASC"
            ));
            $result->setFilter(array(
                "IBLOCK_ID" => array(
                    $this->getIblock("additionally"),
                    $this->getIblock("tea")
                ),
                "ACTIVE" => "Y"
            ));
            $result->setSelect(array(
                "ID",
                "NAME",
                "PREVIEW_TEXT",
                "PREVIEW_PICTURE",
                "DETAIL_PAGE_URL",
                "PROPERTY_PRICE"
            ));
            $result->setIbGetNext();
            $additionallies = $result->getElements();

            // resize pictures
            foreach ($additionallies as $key=>$additionally){
                $additionally["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
                    $additionally["PREVIEW_PICTURE"],
                    array(
                        "width" => 100,
                        "height" => 100
                    ),
                    BX_RESIZE_IMAGE_EXACT
                );

                $additionallies[$key]["PREVIEW_PICTURE"] = $additionally["PREVIEW_PICTURE"]["src"];
            }

        }
        $this->_additionally = $additionallies;
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Request">

    /**
     * @return \Bitrix\Main\HttpRequest
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * Http request
     */
    public function setRequest()
    {
        $request = Application::getInstance()->getContext()->getRequest();
        $this->_request = $request;
    }

    public function httpClient()
    {
        global $APPLICATION;
        $httpClient = new HttpClient();
        $httpClient->post(
            ($this->_request->isHttps() ? "https://" : "http://") . $this->_request->getHttpHost() . $this->arParams["USER_REDIRECT"],
            $this->_request->toArray()
        );
        $APPLICATION->RestartBuffer();
        echo $httpClient->getResult();
        die;
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="User data">

    /**
     * @return mixed
     */
    public function getUserData()
    {
        return $this->_userData;
    }

    /**
     * @param mixed $userData
     */
    public function setUserData($userData)
    {
        $this->_userData = $userData;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addUserData($key, $value)
    {
        $this->_userData[$key] = $value;
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Calculate Result methods group">
    public function calculatePrice()
    {
        $coffeePrice = 0;

        foreach ($this->_userData["COFFEE_MARKA"] as $coffee=>$count){
            $this->_coffee[$coffee]["PRICE"] = parent::calculatePrice(array(
                "TYPE" => $this->_machines[$this->_userData["MACHINE"]]["PROPERTY_TYPE_ENUM_ID"],
                "LOCATION" => $this->_userData["LOCATION"],
                "COUNT" => $count,
                "COFFEE" => $this->_coffee[$coffee],
                "COFFEE_COUNT" => $this->_userData["COFFEE_COUNT"]
            ));
            $coffeePrice += $this->_coffee[$coffee]["PRICE"];
        }

        // calculator result
        $this->arResult["SCORE"] = array(
            "COFEE" => $coffeePrice,
            "ADDITIONAL" => "sdsdsdsd"
        );

    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Execute component">
    public function executeComponent()
    {
        Loc::loadLanguageFile(__FILE__);
        # init
        $this->arResult = array(
            "nextBtn" => Loc::getMessage("VP_SUBMIT_NEXT"),
            "prevBtn" => Loc::getMessage("VP_SUBMIT_BACK")
        );
        $this->setIblocks(array(
            "coffee" => 2,
            "machine" => 3,
            "tea" => 4,
            "additionally" => 5
        ));
        $this->setUserData(array(
            "ACTION" => null,
            "STEP" => 1
        ));
        $this->addServices();
        $this->addLocations();
        $this->addClient();

        # request
        $this->setRequest();
        if($this->_request->isPost()){ // && check_bitrix_sessid()

            $this->addUserData("ACTION", $this->_request["action"]);
            $this->addUserData("STEP", $this->_request["step"]);
            $this->addUserData("CLIENT", $this->_request["client"]);
            $this->addUserData("SERVICE", $this->_request["service"]);
            $this->addUserData("LOCATION", $this->_request["location"]);
            $this->addUserData("MACHINE", $this->_request["machina"]);
            $this->addUserData("COFFEE_COUNT", ($this->_request["costom_coffe_count"] > 0 ? $this->_request["costom_coffe_count"] : $this->_request["coffe_count"]));
            $this->addUserData("COFFEE_MARKA", $this->_request["marka"]);
            $this->addUserData("DOP", $this->_request["dop_count"]);



            // rediret to feddback form
            if($this->_userData["STEP"] == 8 && $this->_userData["ACTION"] == $this->arResult["nextBtn"]){
                $this->httpClient();
            }

            // step navigation
            switch ($this->_userData["ACTION"]){
                case $this->arResult["nextBtn"]:
                    $this->_userData["STEP"]++;
                    // CLIENT_REDIRECT
                    if($this->_userData["STEP"] == 3 && $this->_userData["CLIENT"] == "client"){
                        LocalRedirect($this->arParams["CLIENT_REDIRECT"]);
                    }
                    // service condition
                    if($this->_userData["SERVICE"] == "without_coffee"){
                        if($this->_userData["STEP"] == 2)
                            $this->_userData["STEP"]++;
                        if($this->_userData["STEP"] > 4)
                            $this->_userData["STEP"] = 8;
                    }
                    // max step condition
                    if($this->_userData["STEP"] > 8)
                        $this->_userData["STEP"] = 8;

                    $this->addUserData("STEP", $this->_userData["STEP"]);
                    break;
                case $this->arResult["prevBtn"]:
                    $this->_userData["STEP"]--;
                    // service condition
                    if($this->_userData["SERVICE"] == "without_coffee"){
                        if($this->_userData["STEP"] == 2)
                            $this->_userData["STEP"]--;
                        if($this->_userData["STEP"] > 4)
                            $this->_userData["STEP"] = 4;
                    }

                    $this->addUserData("STEP", $this->_userData["STEP"]);
                    // clear array coffe marka on step 6
                    if($this->_userData["STEP"] == 6)
                        unset($this->_userData["COFFEE_MARKA"]);
                    // clear array additionaly on step 7
                    if($this->_userData["STEP"] == 7)
                        unset($this->_userData["DOP"]);
                    break;

            }



        }

        # set
        switch ($this->_userData["STEP"]){
            case 4:
                $this->setIbMachines();
                break;
            case 5:
                $this->setIbMachines();
                $this->setIbCoffee();
                break;
            case 6:
                $this->setIbSectionsCoffee();
                $this->setIbCoffee();
                break;
            case 7:
                $this->setIbAdditionally();
                break;
            case 8:
                $this->setIbMachines();
                $this->setIbSectionsCoffee();
                $this->setIbCoffee();
                $this->setIbAdditionally();
                $this->calculatePrice();
                break;
        }

        # get
        $this->arResult = array_merge($this->arResult, array(
            "client" => $this->getClient(),
            "services" => $this->getServices(),
            "locations" => $this->getLocations(),
            "machine" => $this->getMachines(),
            "coffeeSections" => $this->getCoffeeSections(),
            "coffee" => $this->getCoffee(),
            "additionally" => $this->getAdditionally(),
            "userData" => $this->getUserData()
        ));

        $this->IncludeComponentTemplate();
    }
    // </editor-fold>

}
