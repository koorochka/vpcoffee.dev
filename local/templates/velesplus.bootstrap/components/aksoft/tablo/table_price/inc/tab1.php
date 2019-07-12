<div class="table-responsive">
    <table class="table table-bordered">
        <tr align="center"><td colspan="15"><i>Цены указаны за 1 кг </i></td></tr>
        <tr>
            <td rowspan="3">Марки кофе</td>
            <td colspan="13">за пределами МКАД</td>
        </tr>
        <tr>
            <td colspan="3">
                <a href="/coffeem/kofemashiny-s-mekhanicheskim-kapuchinatorom/">кофемашина с механическим<br>капучинатором</a>
            </td>
            <td colspan="5">
                <a href="/coffeem/kofemashiny-s-avtomaticheskim-kapuchinatorom/">кофемашина с автоматическим<br>капучинатором</a>
            </td>
            <td colspan="6">
                <a href="/coffeem/kofemashiny-superavtomat/">кофемашина<br>суперавтомат</a>
            </td>
        </tr>
        <tr>
            <td width="8%">2кг</td>
            <td width="8%">3кг</td>
            <td width="8%">4кг и<br>более</td>
            <td width="8%">3кг</td>
            <td width="8%">4кг</td>
            <td width="8%">5-6кг</td>
            <td width="8%">7кг</td>
            <td width="8%">8кг и<br>более</td>
            <td width="8%">6кг</td>
            <td width="8%">7кг</td>
            <td width="8%">8кг</td>
            <td width="8%">9кг</td>
            <td width="8%">10кг и<br>более</td>
        </tr>
        <?
        $gray = false;
        $i=0;
        foreach($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $i++;
            if($i%3==1){
                if($gray){
                    $gray = false;
                }else{
                    $gray = true;
                }
            }
            ?>
            <tr id="<?=$this->GetEditAreaId($arItem['ID']);?>" <?=$gray ? 'class="active"' : ''?>>
                <td><nobr><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P12_VALUE"]?></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P13_VALUE"]?></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P14_VALUE"]?></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P15_VALUE"]?></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P16_VALUE"]?></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P17_VALUE"]?></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P18_VALUE"]?></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P19_VALUE"]?></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P25_VALUE"]?></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P26_VALUE"]?></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P27_VALUE"]?></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P28_VALUE"]?></nobr></td>
                <td><nobr><?=$arItem["PROPERTY_P20_VALUE"]?></nobr></td>
            </tr>
        <?endforeach;?>
        <tr align="center"><td colspan="15"><i>Цены указаны за 1 кг </i></td></tr>
        <?
        $description = $_SERVER["DOCUMENT_ROOT"] . "/local/inc/tablo.html";
        $description = \Bitrix\Main\IO\File::getFileContents($description);
        if(strlen($description) > 2):
            ?>
            <tr><td colspan="15" class="text-brown"><i><?=$description?></i></td></tr>
        <?endif;?>
    </table>
</div>