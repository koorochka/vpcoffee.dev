<?
function step_3($type)
{	
	if($type == 1)
	{
	?>
		<table class="content_table" width="100%">
		<tr>
			<td width="20"></td>
			<td>���������� ������� � �����</td>
			<td>���������� ����, ��</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="1" onchange="order_step()" /></td>
			<td>�� 3</td>
			<td>1</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="2" onchange="order_step()" /></td>
			<td>�� 3 �� 5</td>
			<td>2</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="3" onchange="order_step()" /></td>
			<td>�� 6 �� 9</td>
			<td>3</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="4" onchange="order_step()" /></td>
			<td>�� 10 �� 13</td>
			<td>4</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="5" onchange="order_step()" /></td>
			<td>�� 14 �� 17</td>
			<td>5</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="6" onchange="order_step()"></td>
			<td>�� 17 �� 20</td>
			<td>6</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="12" onchange="order_step()"></td>
			<td>�� 20</td>
			<td>12</td>
		</tr>
		<tr>
		<td colspan="2">���� ������� ����������� ���������� ����:</td>
		<td><input type="text" name="costom_coffe_count" onblur="costom_coffe(this)" data-min-count="1" onkeyup="costom_coffe(this)" /></td>
		</tr>
		</table><br>
	<?
	}
	elseif($type == 3)
	{
	?>
		<table class="content_table" width="100%">
		<tr>
			<td width="20"></td>
			<td>���������� ������� � �����</td>
			<td>���������� ����, ��</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="3" onchange="order_step()" /></td>
			<td>�� 6 �� 9</td>
			<td>3</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="4" onchange="order_step()" /></td>
			<td>�� 10 �� 13</td>
			<td>4</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="5" onchange="order_step()" /></td>
			<td>�� 14 �� 17</td>
			<td>5</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="6" onchange="order_step()"></td>
			<td>�� 17 �� 20</td>
			<td>6</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="12" onchange="order_step()"></td>
			<td>�� 20</td>
			<td>12</td>
		</tr>
		<tr>
		<td colspan="2">���� ������� ����������� ���������� ����:</td>
		<td><input type="text" name="costom_coffe_count" onblur="costom_coffe(this)" data-min-count="3" onkeyup="costom_coffe(this)" /></td>
		</tr>
		</table><br>
	<?
	
	}	
	else
	{
	?>
		<table class="content_table" width="100%">
		<tr>
			<td width="20"></td>
			<td>���������� ������� � �����</td>
			<td>���������� ����, ��</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="6" onchange="order_step()"></td>
			<td>�� 17 �� 20</td>
			<td>6</td>
		</tr>
		<tr>
			<td><input type="radio" name="coffe_count" value="12" onchange="order_step()"></td>
			<td>�� 20</td>
			<td>12</td>
		</tr>
		<tr>
		<td colspan="2">���� ������� ����������� ���������� ����:</td>
		<td><input type="text" name="costom_coffe_count" onblur="costom_coffe(this)" data-min-count="6" onkeyup="costom_coffe(this)" /></td>
		</tr>
		</table><br>

    <?	
	}

}
?>
