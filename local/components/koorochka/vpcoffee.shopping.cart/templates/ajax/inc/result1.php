<?php
use Bitrix\Main\Localization\Loc;

foreach ($arResult["userData"]["DOP"] as $tea=>$count){
    if(!$count){
        unset($arResult["userData"]["DOP"][$tea]);
    }
}
?>
<ul>
    <li class="margin-bottom-5"><?=Loc::getMessage("VP_RESULT_SERVICE", array("SERVICE" => Loc::getMessage("VP_SERVICE_" . $arResult["services"][$arResult["userData"]["SERVICE"]])))?></li>
    <li class="margin-bottom-5"><?=Loc::getMessage("VP_RESULT_LOCATION", array("LOCATION" => Loc::getMessage("VP_LOCATION_" . $arResult["locations"][$arResult["userData"]["LOCATION"]])))?></li>
    <li class="margin-bottom-5"><?=Loc::getMessage("VP_RESULT_COFFEE_COUNT", array("COUNT" => $arResult["userData"]["COFFEE_COUNT"]))?></li>
    <li class="margin-bottom-5">
        <?=Loc::getMessage("VP_RESULT_MACHINE")?>:
        <a href="<?=$arResult["machine"][$arResult["userData"]["MACHINE"]]["DETAIL_PAGE_URL"]?>" target="_blank">
            <?=$arResult["machine"][$arResult["userData"]["MACHINE"]]["NAME"]?>
        </a>
    </li>
    <li class="margin-bottom-15">
        <?=Loc::getMessage("VP_RESULT_COFFEE")?>:

        <?
        foreach ($arResult["userData"]["COFFEE_MARKA"] as $coffee=>$count):
            if($count > 0):
                ?>
                <a href="<?=$arResult["coffee"][$coffee]["DETAIL_PAGE_URL"]?>" target="_blank">
                    <?=Loc::getMessage("VP_RESULT_COFFEE_VALUE", array(
                        "NAME" => $arResult["coffee"][$coffee]["NAME"],
                        "COUNT" => $count
                    ))?></a>
            <?
            endif;
        endforeach;
        ?>

    </li>
    <li>
        <i><?=Loc::getMessage("VP_RESULT_COFFEE_PRICE", array("PRICE" => $arResult["SCORE"]["COFEE"]))?></i>
    </li>
</ul>
<hr>

<?if(!empty($arResult["userData"]["DOP"])):?>
    <h3><?=Loc::getMessage("VP_RESULT_DOP")?></h3>
    <ul>
        <?
        $priceTea = 0;
        $p = 0;
        foreach ($arResult["userData"]["DOP"] as $tea=>$count):
            if($count > 0):
                $p = $arResult["additionally"][$tea]["PROPERTY_PRICE_VALUE"] * $count;
                $priceTea += $p;
                ?>

                <li>
                    <a href="<?=$arResult["additionally"][$tea]["DETAIL_PAGE_URL"]?>" target="_blank">
                        <?=Loc::getMessage("VP_RESULT_DOP_NAME", array(
                            "NAME" => $arResult["additionally"][$tea]["NAME"],
                            "COUNT" => $count,
                            "PRICE" => $arResult["additionally"][$tea]["PROPERTY_PRICE_VALUE"],
                            "SUM" => $p
                        ))?>
                    </a>
                </li>

            <?
            endif;
        endforeach;
        ?>
    </ul>
    <div class="margin-top-15">
        <?=Loc::getMessage("VP_RESULT_DOP_SUM", array("SUM" => $priceTea))?>
    </div>
    <hr />
<?endif;?>

<h3 class="margin-bottom-10">
    <?
    if($priceTea > 0){
        echo Loc::getMessage("VP_RESULT_SUM_DOP", array(
            "COFFEE" => $arResult["SCORE"]["COFEE"],
            "DOP" => $priceTea,
            "SUM" => ($arResult["SCORE"]["COFEE"] + $priceTea)
        ));
    }else{
        echo Loc::getMessage("VP_RESULT_SUM", array("COFFEE" => $arResult["SCORE"]["COFEE"]));
    }
    ?>
</h3>
<hr />
<h3 class="margin-bottom-10"><?=Loc::getMessage("VP_RESULT_DELIVERY")?></h3>
<ul>
    <li>&mdash;&nbsp;<?=Loc::getMessage("VP_RESULT_DELIVERY_MOSCOW")?></li>
    <li>&mdash;&nbsp;<?=Loc::getMessage("VP_RESULT_DELIVERY_ALL")?></li>
</ul>