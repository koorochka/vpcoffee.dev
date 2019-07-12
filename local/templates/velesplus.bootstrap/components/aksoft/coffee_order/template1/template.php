<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$coffe_count = IntVal($_POST["coffe_count"]);
$machina = IntVal($_POST["machina"]);
$machina_id = IntVal($_POST["machina_id"]);
$costom_coffe_count = IntVal($_POST["costom_coffe_count"]);
$location = htmlspecialcharsbx($_POST["location"]);
?>
<div class="steps">
<?
if($arResult["STEP"] == 5):
require_once "price.php";
$price = calculate_price($arResult["MACHINE"][$_POST["machina_id"]]["PROPERTY_TYPE_ENUM_ID"], $_POST["location"], $_POST["coffe_count"], $arResult["COFFEE"][$_POST["marka"]]); 
?>
<h3>��� <?=$arResult["STEP"]?>: �������� ��������� ������.</h3>
<h3>��������� ���������:</h3>
<ul>
	<li>���������������: <?=$location == "���������� �������" ? "�� ����" : $location?></li>
    <li>����������: <?=$coffe_count?> ��</li>
    <li>
    ����������:
    <a href="/coffeem/kofemashiny-v-arendu-ot-<?=$arResult["VOLUME"][$arResult["MACHINE"][$_POST["machina_id"]]["PROPERTY_VOLUME_ENUM_ID"]]["VALUE"]?>-kg/<?=$arResult["MACHINE"][$_POST["machina_id"]]["CODE"]?>/" target="_blank">
    <?=$arResult["MACHINE"][$_POST["machina_id"]]["NAME"]?>
    </a>
    </li>
    <li>����: 
    <a href="/coffee/<?=$arResult["SECTIONS"][$arResult["COFFEE"][$_POST["marka"]]["IBLOCK_SECTION_ID"]]["CODE"]?>/<?=$arResult["COFFEE"][$_POST["marka"]]["CODE"]?>/" target="_blank">
	<?=$arResult["COFFEE"][$_POST["marka"]]["NAME"]?>
    </a>
    </li>
    <li><i>��������� ����: <?=$price?> ���. � ����� �� 1 ��</i>
    </li>
</ul>
<h3>��������� ��������:</h3>
<ul>
<li>� �������� ����  �������������� ���������.</li>
<li>�� ������� ���� �������������� �� ��������������</li>
</ul>

<table>
<tr>
<td>
<form action="<?=$arParams["PAGE_URL"]?>" method="post">
    <input type="hidden" name="coffe_count" value="<?=$coffe_count?>" />
    <input type="hidden" name="machina" value="<?=$machina?>" />
   	<input type="hidden" name="machina_id" value="<?=$machina_id?>" />
    <input type="hidden" name="location" value="<?=$location?>" />
    <input type="submit" value="&larr;&nbsp;�����" name="back" />
</form>
</td>
<td>
<form action="<?=$arResult["RESULT"]["FURM_URL"]?>" method="post">
<input type="hidden" name="marka" value="<?=$arResult["COFFEE"][$_POST["marka"]]["NAME"]?>" />
<input type="hidden" name="coffe_count" value="<?=$coffe_count?>" />
<input type="hidden" name="machina" value="<?=$arResult["MACHINE"][$_POST["machina_id"]]["NAME"]?>" />
<input type="hidden" name="machina_id" value="<?=$machina_id?>" />
<input type="hidden" name="location" value="<?=$location?>" />
<input type="hidden" name="price" value="<?=$price?>" />
<input type="submit" value="�������� �����" />
</form>

</td>
</tr>
</table>
<?elseif($arResult["STEP"] == 4):?>
<h3>��� <?=$arResult["STEP"]?>: �������� ����. </h3>
<form action="<?=$arResult["RESULT"]["FURM_URL"]?>" method="post">

<?foreach($arResult["SECTIONS"] as $section):?>
<h1><?=$section["NAME"]?></h1>
<?
foreach($arResult["COFFEE"] as $coffee):
if($coffee["IBLOCK_SECTION_ID"] == $section["ID"]):
?>
 <table width="350" border="0" style="margin: 10px 10px 10px 0; float: left;">
    <tr>
    <td width="110">
    <img style="border: 3px solid #717171; float: left;" src="<?=$coffee["PREVIEW_PICTURE"]?>" /> 
</td>
<td>
    <a href="/coffee/<?=$arResult["SECTIONS"][$coffee["IBLOCK_SECTION_ID"]]["CODE"]?>/<?=$coffee["CODE"]?>/" target="_blank">
       
        </a>
        <h4><input type="radio" name="marka" value="<?=$coffee["ID"]?>" onchange="order_step()" /> 
<a href="/coffee/<?=$arResult["SECTIONS"][$coffee["IBLOCK_SECTION_ID"]]["CODE"]?>/<?=$coffee["CODE"]?>/" target="_blank">
		<?=$coffee["NAME"]?>
        </a>
        </h4>
</td>
</tr>
</table>
<?
    endif;
	endforeach;
	?>
<div style="float: none; clear: both;"> </div>
<br>
<?endforeach;?> 

	<input type="hidden" name="step" value="<?=$arResult["STEP"]?>" />
    <input type="hidden" name="coffe_count" value="<?=$coffe_count ? $coffe_count: $costom_coffe_count?>" />
    <input type="hidden" name="machina" value="<?=$machina?>" />
   	<input type="hidden" name="machina_id" value="<?=$machina_id?>" />
    <input type="hidden" name="location" value="<?=$location?>" />
	<input type="submit" value="&larr;&nbsp;�����" name="back" />&nbsp;
	<input type="submit" value="����������&nbsp;&rarr;" id="next_step" disabled="disabled" />
</form>
<?elseif($arResult["STEP"] == 3):?>
<h3>��� <?=$arResult["STEP"]?>: �������� ���������� ���� � �����. </h3>
<form action="<?=$arResult["RESULT"]["FURM_URL"]?>" method="post">
	<?
    require_once $_SERVER["DOCUMENT_ROOT"] . "/local/inc/steps.php";
    step3($_POST["machina"]);
	?>
	<input type="hidden" name="step" value="<?=$arResult["STEP"]?>" />
    <input type="hidden" name="machina" value="<?=$machina?>" />
   	<input type="hidden" name="machina_id" value="<?=$machina_id?>" />
    <input type="hidden" name="location" value="<?=$location?>" />
	<input type="submit" value="&larr;&nbsp;�����" name="back" />&nbsp;
	<input type="submit" value="����������&nbsp;&rarr;" id="next_step" disabled="disabled" />
</form>
<?elseif($arResult["STEP"] == 2):?>
<h3>��� <?=$arResult["STEP"]?>: �������� ����������</h3>
<form action="<?=$arResult["RESULT"]["FURM_URL"]?>" method="post">
	<?foreach($arResult["MACHINE"] as $machine):?>
    <table width="350" border="0" style="margin: 10px 10px 10px 0; float: left;">
    <tr>
    <td width="110">
    	<img style="border: 3px solid #717171; float: left;" src="<?=$machine["PREVIEW_PICTURE"]?>" />
    </td>
    <td>
        <h4>
<input type="radio" name="machina" value="<?=$machine["PROPERTY_VOLUME_VALUE"]?>" onchange="check_machine(<?=$machine["ID"]?>)" />
        <a href="/coffeem/kofemashiny-v-arendu-ot-<?=$arResult["VOLUME"][$arResult["MACHINE"][$machine["ID"]]["PROPERTY_VOLUME_ENUM_ID"]]["VALUE"]?>-kg/<?=$machine["CODE"]?>/" target="_blank">
        <?=$machine["NAME"]?>
        </a>
        </h4>
         <a href="/coffeem/kofemashiny-v-arendu-ot-<?=$arResult["VOLUME"][$arResult["MACHINE"][$machine["ID"]]["PROPERTY_VOLUME_ENUM_ID"]]["VALUE"]?>-kg/<?=$machine["CODE"]?>/" target="_blank">
        
        </a>
        <h5>����������� ����� ���� � ����� (��): <?=$machine["PROPERTY_VOLUME_VALUE"]?></h5>
        
    </td>
    </tr>
    </table>
    <?endforeach;?>
    <input type="hidden" name="machina_id" value="<?=$machina_id?>" id="machina_id" />
    <input type="hidden" name="location" value="<?=$location?>" />
	<input type="hidden" name="step" value="<?=$arResult["STEP"]?>" />
    <input type="submit" value="&larr;&nbsp;�����" name="back" />&nbsp;
	<input type="submit" value="����������&nbsp;&rarr;" id="next_step" disabled="disabled" />
</form>
<?else:?>
<h3>��� <?=$arResult["STEP"]?>: ����� ���������������</h3>
<form action="<?=$arResult["RESULT"]["FURM_URL"]?>" method="post">
<ul>
	<li><input type="radio" name="location" value="������" onchange="order_step()" /> ������</li> 
    <li><input type="radio" name="location" value="���������� �������" onchange="order_step()" /> �� ����</li>
</ul>
    <input type="submit" value="����������&nbsp;&rarr;" id="next_step" disabled="disabled" />
</form>
<?endif;?>
</div>
