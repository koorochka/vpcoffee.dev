<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="catalog-section">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <div class="margin-bottom-15"><?=$arResult["NAV_STRING"]?></div>
<?endif;?>
    <?
    foreach($arResult["ITEMS"] as $cell=>$arElement):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
    ?>
        <div class="row padding-top-20 padding-bottom-20 block-height-210"
             id="<?=$this->GetEditAreaId($arElement['ID']);?>">
            <div class="col-xs-6 col-sm-4 col-md-3 text-center">
                <?if(is_array($arElement["PREVIEW_PICTURE"])):?>
                    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
                        <img src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>"
                             class="img-responsive img-thumbnail"
                             width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>"
                             height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>"
                             alt="<?=$arElement["NAME"]?>"
                             title="<?=$arElement["NAME"]?>" />
                    </a>
                <?elseif(is_array($arElement["DETAIL_PICTURE"])):?>
                    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
                        <img src="<?=$arElement["DETAIL_PICTURE"]["SRC"]?>"
                             class="img-responsive img-thumbnail"
                             width="<?=$arElement["DETAIL_PICTURE"]["WIDTH"]?>"
                             height="<?=$arElement["DETAIL_PICTURE"]["HEIGHT"]?>"
                             alt="<?=$arElement["NAME"]?>"
                             title="<?=$arElement["NAME"]?>" />
                    </a>
                <?endif?>
            </div>
            <div class="col-xs-6 col-sm-8 col-md-9">
                <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a>
                <?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                    <?=$arProperty["NAME"]?>:&nbsp;<?
                    if(is_array($arProperty["DISPLAY_VALUE"]))
                        echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                    else
                        echo $arProperty["DISPLAY_VALUE"];?>
                <?endforeach?>

                <?=$arElement["PREVIEW_TEXT"]?>

            </div>
        </div>

    <?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <div class="margin-top-15"><?=$arResult["NAV_STRING"]?></div>
<?endif;?>
</div>
