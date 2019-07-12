<?php

use Bitrix\Main\Localization\Loc;

?>
<input type="hidden" name="user-type" value="corporation">
<ul>
    <li class="margin-bottom-5"><?=Loc::getMessage("VP_RESULT_SERVICE", array("SERVICE" => Loc::getMessage("VP_SERVICE_" . $arResult["services"][$arResult["userData"]["SERVICE"]])))?></li>
    <li class="margin-bottom-5"><?=Loc::getMessage("VP_RESULT_LOCATION", array("LOCATION" => Loc::getMessage("VP_LOCATION_" . $arResult["locations"][$arResult["userData"]["LOCATION"]])))?></li>
    <li class="margin-bottom-5"><?=Loc::getMessage("VP_RESULT_WITOUT_MIN_ORDER", array("COUNT" => $arResult["machine"][$arResult["userData"]["MACHINE"]]["PROPERTY_WITOUT_MIN_ORDER_VALUE"]))?></li>
    <li class="margin-bottom-5">
        <?=Loc::getMessage("VP_RESULT_MACHINE")?>:
        <a href="<?=$arResult["machine"][$arResult["userData"]["MACHINE"]]["DETAIL_PAGE_URL"]?>" target="_blank">
            <?=$arResult["machine"][$arResult["userData"]["MACHINE"]]["NAME"]?>
        </a>
    </li>
    <li>
        <i><?=Loc::getMessage("VP_RESULT_COFFEE_PRICE", array("PRICE" => $arResult["machine"][$arResult["userData"]["MACHINE"]]["PROPERTY_WITOUT_PRICE_VALUE"]))?></i>
    </li>
</ul>
<hr />
<h3 class="margin-bottom-10"><?=Loc::getMessage("VP_RESULT_DELIVERY")?></h3>
<ul>
    <li>&mdash;&nbsp;<?=Loc::getMessage("VP_RESULT_DELIVERY_MOSCOW")?></li>
    <li>&mdash;&nbsp;<?=Loc::getMessage("VP_RESULT_DELIVERY_ALL")?></li>
</ul>