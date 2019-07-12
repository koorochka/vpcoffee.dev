<?
/**
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <div class="margin-bottom-15"><?=$arResult["NAV_STRING"]?></div>
<?endif;?>

<div class="row">
    <?
    $i = 0;
    $cols = 2;
    foreach($arResult["ITEMS"] as $arElement):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
        $i++;
        if($i%$cols && $i > 1)
            echo "</div><div class=\"row\">";
        ?>
        <div class="col-xs-12 col-sm-6 col-md-6"
             id="<?=$this->GetEditAreaId($arElement['ID']);?>">

            <div class="row padding-top-20 padding-bottom-20">
                <div class="col-xs-6 col-sm-6 col-md-5">
                    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
                        <?if(is_array($arElement["PREVIEW_PICTURE"])):?>
                            <img src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>"
                                 class="img-responsive img-thumbnail"
                                 width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>"
                                 height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>"
                                 alt="<?=$arElement["NAME"]?>"
                                 title="<?=$arElement["NAME"]?>" />
                        <?elseif(is_array($arElement["DETAIL_PICTURE"])):?>
                            <img src="<?=$arElement["DETAIL_PICTURE"]["SRC"]?>"
                                 class="img-responsive img-thumbnail"
                                 width="<?=$arElement["DETAIL_PICTURE"]["WIDTH"]?>"
                                 height="<?=$arElement["DETAIL_PICTURE"]["HEIGHT"]?>"
                                 alt="<?=$arElement["NAME"]?>"
                                 title="<?=$arElement["NAME"]?>" />
                        <?endif?>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-5">
                    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a><br />
                    <?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                        <?=$arProperty["NAME"]?>:&nbsp;<?
                        if(is_array($arProperty["DISPLAY_VALUE"]))
                            echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                        else
                            echo $arProperty["DISPLAY_VALUE"];?><br />
                    <?endforeach?>
                    <div class="file">
                        <?if($arElement["PROPERTIES"]["FILE"]["VALUE"]):?>
                            <a href="<?=$arElement["PROPERTIES"]["FILE"]["VALUE"]?>" target="_blank" class="pdf-link"><?=GetMessage("PDF_FILE")?></a>
                        <?endif;?>
                    </div>
                    <br />
                    <?=$arElement["PREVIEW_TEXT"]?>
                </div>
            </div>

        </div>
    <?endforeach;?>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <div class="margin-top-15"><?=$arResult["NAV_STRING"]?></div>
<?endif;?>

<a href="<?=SITE_DIR?>coffeem/"><?=GetMessage("CATALOG_BACK")?></a>