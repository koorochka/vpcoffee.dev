<?
/**
 * @var array $arResult
 * @var array $arParams
 */
use Bitrix\Iblock\SectionTable,
    Bitrix\Iblock\SectionElementTable;

/**
 * Get all relations with sections
 */
$relationSections = array();
$sections = SectionElementTable::getList(array(
    "filter" => array(
        "IBLOCK_ELEMENT_ID" => $arResult["ELEMENTS"]
    )
));
while ($section = $sections->fetch())
{
    $relationSections[$section["IBLOCK_ELEMENT_ID"]][] = $section["IBLOCK_SECTION_ID"];
}

/**
 * Modicato all items
 */
foreach($arResult["ITEMS"] as $key=>$arElement){

    /**
     * Prepare picture
    /*
    if(!empty($arElement["PREVIEW_PICTURE"])){
        $arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
            $arElement["PREVIEW_PICTURE"]["ID"],
            array(
                "width" => $arParams["WIDTH"],
                "height" => $arParams["HEIGHT"]
            ),
            BX_RESIZE_IMAGE_EXACT,
            false
        );
    }
    */

    /**
     * Prepare display properties
     */
    foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty){
        if(is_array($arProperty["DISPLAY_VALUE"])){
            $arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"][$pid]["DISPLAY_VALUE"] = implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
        }
    }

    /**
     * Set related sections to element
     */
    $arResult["ITEMS"][$key]["IBLOCK_SECTION_ID"] = $relationSections[$arElement["ID"]];

}

?>