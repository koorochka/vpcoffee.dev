<?
/**
 * @var array $arResult
 * @var array $arParams
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="row">
    <?
    $i = 0;
    $cols = 2;
    foreach($arResult["ITEMS"] as $arItem):
        $i++;
        if($i%$cols && $i > 1)
            echo "</div><div class=\"row\">";
        ?>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="row padding-top-20 padding-bottom-20">
                <div class="col-xs-6 col-sm-5">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                        <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                             class="img-responsive img-thumbnail"
                             width="370"
                             height="370" />
                    </a>
                </div>
                <div class="col-xs-6 col-sm-7">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="title"><?=$arItem["NAME"]?></a>
                    <p><?=$arItem["PREVIEW_TEXT"]?></p>
                </div>
            </div>
        </div>
        <?endforeach;?>
</div>