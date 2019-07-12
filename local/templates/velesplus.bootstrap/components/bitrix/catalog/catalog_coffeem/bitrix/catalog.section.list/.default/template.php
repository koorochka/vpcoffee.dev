<?
/**
 * @var array $arResult
 * @var array $arParams
 */
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(empty($arResult["SECTIONS"]))
    return;
?>

<div id="service-controls" class="table-controls">
    <?
    $count = count($arResult["SECTIONS"]);
    $count--;
    $count--;
    foreach($arResult["SECTIONS"] as $i=>$arSection):
        if($arSection["CODE"] == "dop-tovary")
            continue;
    ?>
        <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="<?
            $class = "service-control table-control";
            if(!$i){
                $class .= " table-control-first";
            }
            if($i == $count){
                $class .= " table-control-last";
            }
            if($arParams["CURRENT_SECTION"]["VARIABLES"]["SECTION_CODE"] == $arSection["CODE"]){
                $class .= " active";
            }
            echo $class;
        ?>"><?=$arSection["NAME"]?></a>
    <?endforeach?>
    <div class="clearfix"></div>
</div>

