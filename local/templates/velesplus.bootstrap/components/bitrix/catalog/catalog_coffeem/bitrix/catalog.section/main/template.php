<?
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
/**
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arSections = array(
    "9" => array(
        "NAME" => Loc::getMessage("CATALOG_SECTION_MECHANIC"),
        "CODE" => "kofemashiny-s-mekhanicheskim-kapuchinatorom"
    ),
    "10" => array(
        "NAME" => Loc::getMessage("CATALOG_SECTION_AUTO"),
        "CODE" => "kofemashiny-s-avtomaticheskim-kapuchinatorom"
    ),
    "11" => array(
        "NAME" => Loc::getMessage("CATALOG_SECTION_SUPER"),
        "CODE" => "kofemashiny-superavtomat"
    )
);
?>
<div id="machines-list">
    <div class="row">
        <?foreach($arSections as $sectionId=>$section):?>
            <div class="col-xs-12">
                <a href="/coffeem/<?=$section["CODE"]?>/" class="sidebur-title"><?=$section["NAME"]?></a>
            </div>
            <?
            $i = 0;
            $cols = 2;
            foreach($arResult["ITEMS"] as $cell=>$arElement):
                if(in_array($sectionId, $arElement["IBLOCK_SECTION_ID"])):
                    $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
                    $i++;
                    if($i%$cols && $i > 1)
                        echo "</div><div class=\"row\">";
                    ?>
                    <div id="<?=$this->GetEditAreaId($arElement['ID']);?>"
                         class="col-xs-12 col-sm-12 col-md-6">

                        <div class="row margin-top-10">
                            <div class="col-xs-6 col-sm-5">
                                <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"
                                   class="thumbnail">
                                    <img src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>"
                                         class="img-responsive"
                                         width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>"
                                         height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" />
                                </a>
                            </div>
                            <div class="col-xs-6 col-sm-7">
                                <h4><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></h4>
                                <?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                                    <h5><?=$arProperty["NAME"]?>:&nbsp;<?=$arProperty["DISPLAY_VALUE"]?></h5>
                                <?endforeach?>
                                <div class="file">
                                    <?if($arElement["PROPERTIES"]["FILE"]["VALUE"]):?>
                                        <a href="<?=$arElement["PROPERTIES"]["FILE"]["VALUE"]?>"
                                           target="_blank"
                                           class="pdf-link"><?=Loc::getMessage("PDF_FILE")?></a>
                                    <?endif;?>
                                </div>
                            </div>
                        </div>



                    </div>
                    <?
                    unset($arResult["ITEMS"][$cell]);
                endif;
            endforeach;
        endforeach;
        ?>
    </div>
</div>
