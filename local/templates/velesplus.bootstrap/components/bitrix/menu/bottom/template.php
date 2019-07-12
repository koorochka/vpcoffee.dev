<?
/**
 * @var array $arResult
 * @var array $arParams
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="bottom-menu">
    <?foreach($arResult as $item):?>
        <div class="padding-10 padding-top-0 padding-bottom-15<?=$item["SELECTED"] ? ' active' : ""?>"><a href="<?=$item["LINK"]?>"><?=$item["TEXT"]?></a></div>
    <?endforeach;?>
</div>