<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
    <div class="text-center">
        <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
             width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
             height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
             alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
             title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>" />
    </div>
<?endif?>
<div><?=$arResult["DETAIL_TEXT"];?></div>

<?
foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

    <?=$arProperty["NAME"]?>:&nbsp;
    <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
        <?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
    <?else:?>
        <?=$arProperty["DISPLAY_VALUE"];?>
    <?endif?>
    <br />
<?endforeach;
if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
{
    ?>
    <div class="news-detail-share">
        <noindex>
            <?
            $APPLICATION->IncludeComponent("bitrix:main.share", "", array(
                "HANDLERS" => $arParams["SHARE_HANDLERS"],
                "PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
                "PAGE_TITLE" => $arResult["~NAME"],
                "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                "HIDE" => $arParams["SHARE_HIDE"],
            ),
                $component,
                array("HIDE_ICONS" => "Y")
            );
            ?>
        </noindex>
    </div>
    <?
}
?>