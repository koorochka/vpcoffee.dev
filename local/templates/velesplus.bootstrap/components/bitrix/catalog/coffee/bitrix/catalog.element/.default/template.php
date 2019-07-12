<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<div class="row margin-bottom-15">
    <div class="col-xs-6 col-sm-4 col-md-3">
        <?if(is_array($arResult["PREVIEW_PICTURE"]) || is_array($arResult["DETAIL_PICTURE"])):?>
            <?if(is_array($arResult["PREVIEW_PICTURE"]) && is_array($arResult["DETAIL_PICTURE"])):?>
                <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
                     class="img-thumbnail img-responsive"
                     width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>"
                     height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>"
                     alt="<?=$arResult["NAME"]?>"
                     title="<?=$arResult["NAME"]?>" />
            <?elseif(is_array($arResult["PREVIEW_PICTURE"])):?>
                <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
                     width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>"
                     height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>"
                     alt="<?=$arResult["NAME"]?>"
                     title="<?=$arResult["NAME"]?>" />
            <?endif?>
        <?endif;?>
    </div>
    <div class="col-xs-6 col-sm-8 col-md-9">
        <?=$arResult["PREVIEW_TEXT"]?>
    </div>
</div>