<?
/**
 * @var array $arResult
 * @var array $arParams
 */
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div id="coffeem-element">
    <div class="row">
        <div class="col-xs-12 col-sm-6 text-center margin-bottom-10">
            <?if(is_array($arResult["PREVIEW_PICTURE"]) && is_array($arResult["DETAIL_PICTURE"])):?>
                <img class="img-thumbnail img-responsive"
                     src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                     width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
                     height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
                     alt="<?=$arResult["NAME"]?>"
                     title="<?=$arResult["NAME"]?>" />
            <?elseif(is_array($arResult["PREVIEW_PICTURE"])):?>
                <img class="img-thumbnail img-responsive"
                     src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
                     width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>"
                     height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>"
                     alt="<?=$arResult["NAME"]?>"
                     title="<?=$arResult["NAME"]?>" />
            <?endif?>
        </div>
        <div class="col-xs-12 col-sm-6 margin-bottom-10">
            <?
            foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):
                if(empty($arParams["INFO_TYPE"])){
                    if(
                        $pid == "WITOUT_MIN_ORDER" ||
                        $pid == "WITOUT_FILE"
                    ){
                        continue;
                    }
                }else{
                    if(
                        $pid == "VOLUME"
                    ){
                        continue;
                    }
                }
                if($pid == "WITOUT_FILE"){
                    continue;
                }
            ?>
                <?=$arProperty["NAME"]?>:<b>&nbsp;<?
                    if(is_array($arProperty["DISPLAY_VALUE"])):
                        echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                    elseif($pid=="MANUAL"):
                        ?><a href="<?=$arProperty["VALUE"]?>"><?=Loc::getMessage("CATALOG_DOWNLOAD")?></a><?
                    else:
                        echo $arProperty["DISPLAY_VALUE"];?>
                    <?endif?></b><br />
            <?endforeach?>
            <div class="file">
                <?if(empty($arParams["INFO_TYPE"])):?>
                    <?if($arResult["PROPERTIES"]["FILE"]["VALUE"]):?>
                        <a href="<?=$arResult["PROPERTIES"]["FILE"]["VALUE"]?>" target="_blank" class="pdf-link"><?=Loc::getMessage("PDF_FILE")?></a>
                    <?endif;?>
                <?else:?>
                    <?if(is_array($arResult["DISPLAY_PROPERTIES"]["WITOUT_FILE"]["FILE_VALUE"])):?>
                        <a href="<?=$arResult["DISPLAY_PROPERTIES"]["WITOUT_FILE"]["FILE_VALUE"]["SRC"]?>" target="_blank" class="pdf-link"><?=Loc::getMessage("PDF_FILE")?></a>
                    <?endif;?>
                <?endif;?>
            </div>
        </div>
    </div>
</div>



<div class="catalog-element">

    <?if(is_array($arResult["SECTION"])):?>
        <br />
        <a href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>"><?=Loc::getMessage("CATALOG_BACK")?></a>
        <h3><a href="/order/" ><?=Loc::getMessage("CATALOG_ORDER")?></a></h3>
    <?endif?>

    <div class="margin-bottom-10 margin-top-10">
        <?if($arResult["DETAIL_TEXT"]){
            echo $arResult["DETAIL_TEXT"];
        }elseif($arResult["PREVIEW_TEXT"]){
            echo $arResult["PREVIEW_TEXT"];
        }?>
    </div>

    <?
    /**
     * additional photos
     */
    $LINE_ELEMENT_COUNT = 2; // number of elements in a row
    if(count($arResult["MORE_PHOTO"])>0):?>
        <?foreach($arResult["MORE_PHOTO"] as $PHOTO):?>
            <img src="<?=$PHOTO["SRC"]?>"
                 width="<?=$PHOTO["WIDTH"]?>"
                 height="<?=$PHOTO["HEIGHT"]?>"
                 alt="<?=$arResult["NAME"]?>"
                 title="<?=$arResult["NAME"]?>" /><br />
        <?endforeach?>
    <?endif?>
    <?if(is_array($arResult["SECTION"])):?>
        <br />
        <a href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>"><?=Loc::getMessage("CATALOG_BACK")?></a>
        <h3><a href="/order/" ><?=Loc::getMessage("CATALOG_ORDER")?></a></h3>
    <?endif?>
</div>