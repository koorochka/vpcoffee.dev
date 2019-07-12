<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<table class="content_table" style="border-collapse: collapse;">
<tr>
<td width="158">ваше местонахождение</td>
<td colspan="7"><p>в пределах МКАД</p></td><td colspan="7"><p>за пределами МКАД</p></td>
</tr>
<tr>
<td>Вид кофемашины</td>
<td colspan="4">кофемашина с механическим капучинатором</td>
<td colspan="3">кофемашина с автоматическим капучинатором</td>
<td colspan="4">кофемашина с механическим капучинатором</td>
<td colspan="3">кофемашина с автоматическим капучинатором</td>
</tr>
<tr>
<td>Потребляемый объем кофе в месяц</td>
<td width="46">1кг</td>
<td width="46">2кг</td>
<td width="46">3кг</td>
<td width="46">4 кг и более</td>
<td width="46">3кг</td>
<td width="46">4кг</td>
<td width="46">5кг и более</td>
<td width="46">1кг</td>
<td width="46">2кг</td>
<td width="46">3кг</td>
<td width="46">4 кг и более</td>
<td width="46">3кг</td>
<td width="46">4кг</td>
<td width="46">5кг и более</td>
</tr>
<?
foreach($arResult["ITEMS"] as $arItem):
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">
<td><u>цена за 1кг</u></td>
<td><nobr><?=$arItem["PROPERTY_P1_VALUE"]?></nobr></td>
<td><nobr><?=$arItem["PROPERTY_P5_VALUE"]?></nobr></td>
<td><nobr><?=$arItem["PROPERTY_P6_VALUE"]?></nobr></td>
<td><nobr><?=$arItem["PROPERTY_P32_VALUE"]?></nobr></td>
<td><nobr><?=$arItem["PROPERTY_P4_VALUE"]?></nobr></td>
<td><nobr><?=$arItem["PROPERTY_P2_VALUE"]?></nobr></td>
<td><nobr><?=$arItem["PROPERTY_P3_VALUE"]?></nobr></td>

<td><nobr><?=$arItem["PROPERTY_P7_VALUE"]?></nobr></td>
<td><nobr><?=$arItem["PROPERTY_P8_VALUE"]?></nobr></td>
<td><nobr><?=$arItem["PROPERTY_P9_VALUE"]?></nobr></td>
<td><nobr><?=$arItem["PROPERTY_P92_VALUE"]?></nobr></td>
<td><nobr><?=$arItem["PROPERTY_P10_VALUE"]?></nobr></td>
<td><nobr><?=$arItem["PROPERTY_P11_VALUE"]?></nobr></td>
<td><nobr><?=$arItem["PROPERTY_P12_VALUE"]?></nobr></td>

</tr>
<?endforeach;?>

</table>