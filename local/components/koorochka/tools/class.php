<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

if(class_exists("koorochkaTools"))
    return;

//Необходимо для корректного поиска класса CDemoSqr
CBitrixComponent::includeComponentClass("koorochka:vpcoffee.coffee.machine.list");
CBitrixComponent::includeComponentClass("koorochka:vpcoffee.additionally.list");
//Наследник расширяющий функциональность:


class koorochkaTools extends vpcoffeeCoffeeMachineList
{
    // <editor-fold defaultstate="collapsed" desc=" Derictories tools">
    /**
     * @param $from
     * @param $to
     * @param bool $rewrite
     * @param bool $recursive
     */
    public function CopyDirFiles($from, $to, $rewrite=true, $recursive=true){
        CopyDirFiles($from, $to, $rewrite, $recursive);
    }

    /**
     * Working by full path
     * @param $from
     * @param $to
     * @param array $exept
     */
    public function DeleteDirFiles($from, $to, $exept=array()){
        DeleteDirFiles($from, $to, $exept);
    }

    /**
     * Work for relative by home folder
     * @param $path
     */
    public function clearDir($path){
        DeleteDirFilesEx($path);
    }
    // </editor-fold>

    public function getElements()
    {
        return parent::getElements();
    }


    // <editor-fold defaultstate="collapsed" desc=" Execute component">
    public function executeComponent()
    {

        $test = new vpcoffeeAdditionallyList();
        $test->setTest("Additionaly");
        d($test->getTest());


    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc=" Dev tools">
    public function d7(){
        // https://academy.1c-bitrix.ru/training/course/7252/
        // https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=2028&LESSON_PATH=3913.4565.2028

    }

    public function test(){
        // copy sample
        $this->CopyDirFiles(
            "/home/b/buycoffee/vpcoffee.dev/public_html/local/components/koorochka/vpcoffee.shopping.cart/",
            "/home/b/buycoffee/vpcoffee.dev/public_html/local/components/koorochka/vpcoffee.coffee.additionally.list/"
        );

        // ORM search
        // https://dev.1c-bitrix.ru/community/webdev/user/203730/blog/11835/?sphrase_id=33112515
        /**
        use Bitrix\Main\Web\HttpClient;

        $httpClient = new HttpClient();
        $httpClient->setHeader('Content-Type', 'application/json', true);
        $response = $httpClient->post('http://www.example.com', json_encode(array('x' => 1)));
         *
         * и вот так

        use Bitrix\Main\Web\HttpClient;

        $httpClient = new HttpClient();
        $httpClient->download('http://www.example.com/robots.txt', $_SERVER['DOCUMENT_ROOT'].'/upload/my.txt');
         *
         */
    }

    public function oop(){
        // polimorfizm incapsulation extends
        // interfaces for multiple extends
    }

    /**
     * @param $value
     */
    public function d($value)
    {
        if ( is_array( $value ) || is_object( $value ) )
        {
            echo "<pre style=\"background:#363636; color:#fff\">".htmlspecialcharsbx( print_r($value, true) )."</pre>";
        }
        else
        {
            echo "<pre style=\"background:#363636; color:#fff\">".htmlspecialcharsbx($value)."</pre>";
        }
    }
    // </editor-fold>


}