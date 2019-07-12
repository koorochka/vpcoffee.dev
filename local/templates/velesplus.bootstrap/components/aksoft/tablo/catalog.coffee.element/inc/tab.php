<table class="table table-bordered">

    <?foreach($arResult["ITEMS"] as $arItem):?>
        <tr class="active">
            <td rowspan="2">Тип кофемашины</td>
            <td><nobr>Марки кофе</nobr></td>
            <td><nobr><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></nobr></td>
        </tr>
        <tr class="active">
            <td colspan="2">Цены указаны за 1 кг</td>
        </tr>

        <tr>
            <td rowspan="3">
                <a href="/coffeem/kofemashiny-s-mekhanicheskim-kapuchinatorom/">кофемашина с механическим капучинатором</a>
            </td>
            <td>2кг</td>
            <td><nobr><?=$arItem["PROPERTY_P2_VALUE"]?></nobr></td>
        </tr>
        <tr>
            <td>3кг</td>
            <td><nobr><?=$arItem["PROPERTY_P3_VALUE"]?></nobr></td>
        </tr>
        <tr>
            <td>4кг и более</td>
            <td><nobr><?=$arItem["PROPERTY_P4_VALUE"]?></nobr></td>
        </tr>

        <tr class="active">
            <td rowspan="5">
                <a href="/coffeem/kofemashiny-s-avtomaticheskim-kapuchinatorom/">кофемашина с автоматическим капучинатором</a>
            </td>
            <td>3кг</td>
            <td><nobr><?=$arItem["PROPERTY_P5_VALUE"]?></nobr></td>
        </tr>
        <tr class="active">
            <td>4кг</td>
            <td><nobr><?=$arItem["PROPERTY_P6_VALUE"]?></nobr></td>
        </tr>
        <tr class="active">
            <td>5-6кг</td>
            <td><nobr><?=$arItem["PROPERTY_P7_VALUE"]?></nobr></td>
        </tr>
        <tr class="active">
            <td>7кг</td>
            <td><nobr><?=$arItem["PROPERTY_P8_VALUE"]?></nobr></td>
        </tr>
        <tr class="active">
            <td>8кг и более</td>
            <td><nobr><?=$arItem["PROPERTY_P9_VALUE"]?></nobr></td>
        </tr>

        <tr>
            <td rowspan="5">
                <a href="/coffeem/kofemashiny-superavtomat/">кофемашина суперавтомат</a>
            </td>
            <td>6кг</td>
            <td><nobr><?=$arItem["PROPERTY_P21_VALUE"]?></nobr></td>
        </tr>
        <tr>
            <td>7кг</td>
            <td><nobr><?=$arItem["PROPERTY_P22_VALUE"]?></nobr></td>
        </tr>
        <tr>
            <td>8кг</td>
            <td><nobr><?=$arItem["PROPERTY_P23_VALUE"]?></nobr></td>
        </tr>
        <tr>
            <td>9кг</td>
            <td><nobr><?=$arItem["PROPERTY_P24_VALUE"]?></nobr></td>
        </tr>
        <tr>
            <td>10кг и более</td>
            <td><nobr><?=$arItem["PROPERTY_P10_VALUE"]?></nobr></td>
        </tr>
        <tr><td colspan="3"><i>Цены указаны за 1 кг </i></td></tr>
        <?
        $description = $_SERVER["DOCUMENT_ROOT"] . "/local/inc/tablo.html";
        $description = \Bitrix\Main\IO\File::getFileContents($description);
        if(strlen($description) > 2):
            ?>
            <tr><td colspan="3" class="text-brown"><i><?=$description?></i></td></tr>
        <?endif;?>
    <?endforeach;?>
</table>