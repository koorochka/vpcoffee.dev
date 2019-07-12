function order_step()
{
	var step = $("#next_step");
	if(step.attr("disabled"))
	{
		step.attr("disabled", false);
	}
}

function check_machine(id)
{
	order_step();
	$("#machina_id").val(id);
}
