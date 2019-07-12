<?
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
/**
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div id="machines_list">
    <?
    foreach($arResult["ITEMS"] as $cell=>$arElement):
    $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
    ?>
        <table id="<?=$this->GetEditAreaId($arElement['ID']);?>">
            <tr>
                <td width="110">
                    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
                        <img src="<?=$arElement["PREVIEW_PICTURE"]["src"]?>"
                             width="100"
                             height="100" />
                    </a>
                </td>
                <td>
                    <h4><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></h4>
                    <?
                    if(!empty($arElement["IBLOCK_SECTION_ID"])):
                        foreach ($arElement["IBLOCK_SECTION_ID"] as $section):
                    ?>
                        <a href="<?=$arResult["SECTIONS"][$section]["SECTION_URL"]?>"><?=$arResult["SECTIONS"][$section]["NAME"]?></a><hr />
                    <?
                        endforeach;
                    endif;
                    ?>
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
                </td>
            </tr>
        </table>
    <?endforeach;?>
</div>
<div class="clear"></div>