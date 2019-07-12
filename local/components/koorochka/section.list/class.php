<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
use Bitrix\Main\Localization\Loc,
    Bitrix\Main\Loader,
    Bitrix\Iblock\SectionTable;
Loc::loadLanguageFile(__FILE__);
if(class_exists("KoorochakSectionList"))
    return;
class KoorochakSectionList extends CBitrixComponent
{
    /**
     * @var array
     */
    private $_sections;

    /**
     * @return array
     */
    public function getSections()
    {
        return $this->_sections;
    }

    /**
     * from db
     */
    public function setSections()
    {
        $sections = array();
        if(Loader::includeModule("iblock")){
            $request = SectionTable::getList(array(
                "filter" => array(
                    "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
                    "IBLOCK_SECTION_ID" => $this->arParams["SECTION_ID"],
                    "ACTIVE" => "Y"
                ),
                "select" => array(
                    "ID",
                    "NAME",
                    "CODE",
                    "PICTURE"
                )
            ));
            while ($section = $request->fetch()){
                if($section["PICTURE"] > 0){
                    $section["PICTURE"] = CFile::GetFileArray($section["PICTURE"]);
                }
                $sections[] = $section;
            }
        }
        $this->_sections = $sections;
    }

    /**
     * Execute component
     */
    function executeComponent()
    {
        if($this->startResultCache()){
            $this->setSections();
        }
        $this->arResult = $this->getSections();
        $this->IncludeComponentTemplate();
    }
}
