<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<table class="content_table" style="border-collapse: collapse;">
<tr>
<td width="158">���� ���������������</td>
<td colspan="7"><p>� �������� ����</p></td><td colspan="7"><p>�� ��������� ����</p></td>
</tr>
<tr>
<td>��� ����������</td>
<td colspan="4">���������� � ������������ �������������</td>
<td colspan="3">���������� � �������������� �������������</td>
<td colspan="4">���������� � ������������ �������������</td>
<td colspan="3">���������� � �������������� �������������</td>
</tr>
<tr>
<td>������������ ����� ���� � �����</td>
<td width="46">1��</td>
<td width="46">2��</td>
<td width="46">3��</td>
<td width="46">4 �� � �����</td>
<td width="46">3��</td>
<td width="46">4��</td>
<td width="46">5�� � �����</td>
<td width="46">1��</td>
<td width="46">2��</td>
<td width="46">3��</td>
<td width="46">4 �� � �����</td>
<td width="46">3��</td>
<td width="46">4��</td>
<td width="46">5�� � �����</td>
</tr>
<?
foreach($arResult["ITEMS"] as $arItem):
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">
<td><u>���� �� 1��</u></td>
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