function count_up(t)
{
    var input = $(t).parent().find(".counter"),
        value = parseInt(input.val());
    value++;
    input.val(value);

    $(t).parent().find(".tea_checkbox").attr("checked", "checked");
}

function count_down(t)
{
    var input = $(t).parent().find(".counter"),
        value = parseInt(input.val());
    if(value > 0)
        value--;
    else
        value = 0;
    input.val(value);

    if(value <= 0)
        $(t).parent().find(".tea_checkbox").removeAttr("checked");
}

function count_input(t)
{
    var input = $(t).parent().find(".counter"),
        value = parseInt(input.val());
    if(!value)
        value = 0;
    input.val(value);

    if(value <= 0)
        $(t).parent().find(".tea_checkbox").removeAttr("checked");
    else
        $(t).parent().find(".tea_checkbox").attr("checked", "checked");
}

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

function nextStepTrigger() {

    // alert($(t).attr("value"));
    // alert($(t).parents("form").attr("action"));
    $("#next_step").click();
}

/* 4 шаг - контроль ввода */
$(document).ready(function() {

    /**
	 * count down
     */
	$(".count_down").click(function(){
		var t = $(this).next(), 
		coffe_count = parseInt($("input[name='coffe_count']").val()),
		count = coffe_count - marka_count(),
		input = parseInt(t.val()),
		informer = count;
		if(input)
		{
		input--;
		informer++;
		}
		t.val(input);
		/* informer */
		$(".informer").hide();

	if(informer > 1)
		var text = "Выберите еще " + informer + " кг";
	else if(informer < 1)
		var text = "Для оформления заказа нажмите <br>" + '<input class="btn btn-primary" value="Продолжить" onclick="nextStepTrigger()" type="submit">';
	else
		var text = "Выберите еще " + informer + " кг";
	var infoblock = $(t).parent().find(".informer");
	if(informer < 1)
		infoblock.css("margin-top", "-140px");
	else
		infoblock.css("margin-top", "-95px");
	infoblock.fadeIn(300).html(text);
		/* informer */

		 var result = informer + input;
		step4(result, informer);

	});

    /**
     * count up
     */
	$(".count_up").click(function(){
		var t = $(this).prev(),
		input = parseInt(t.val()),
		count = parseInt($("input[name='coffe_count']").val()) - marka_count(),
		informer = count - 1;
		if(!input)
			input = 0;
		if(count)
			input++;
		t.val(input);
		/* informer */
		$(".informer").hide();

		if(informer < 0)
			informer = 0;
		if(informer > 1)
			var text = "Выберите еще " + informer + " кг";
		else if(informer < 1)
			var text = "Для оформления заказа нажмите <br>" + '<input class="btn btn-primary" value="Продолжить" onclick="nextStepTrigger()" type="submit">';
		else
			var text = "Выберите еще " + informer + " кг";
		var infoblock = $(t).parent().find(".informer");
		if(informer < 1)
			infoblock.css("margin-top", "-140px");
		else
			infoblock.css("margin-top", "-95px");
		infoblock.fadeIn(300).html(text);
		/* informer */
		 var result = informer + input;
		step4(result, informer);
	});

    /**
     * checed checkbox in table strip
     */
    $(".table-striped").find("tr").click(function () {

        $(this).find("input:radio").prop( "checked", true ).change();

    });

});

/**
 * 
 * @param t
 */
function nextStepInformer(t) {
    $(t).find("input:radio").prop( "checked", true ).change();
    $(".informer").hide();
    var text = "Для оформления заказа нажмите <br>" + '<input class="btn btn-primary" value="Продолжить" onclick="nextStepTrigger()" type="submit">';
    var infoblock = $(t).find(".informer");
    infoblock.fadeIn(300).html(text);
}

/**
 * 
 * @param t
 * @param _event
 * @constructor
 */
function TextChanged(t, _event)
{
    var input = parseInt(t.value),
    count = parseInt($("input[name='coffe_count']").val()) - marka_count(),
    informer = count;
	
    if(!input)
    {
        input = 0;
    }
var result = count + input;

    if(count > 0)
    {
        $(t).val(input);
    }
    else
    {
        $(t).val(result);
        informer = 0;
    }
	/* informer */
	$(".informer").hide();
	if(informer > 1)
		var text = "Выберите еще " + informer + " кг";
	else if(informer < 1)
		var text = "Для оформления заказа нажмите <br>" + '<input class="btn btn-primary" value="Продолжить" onclick="nextStepTrigger()" type="submit">';
	else
		var text = "Выберите еще " + informer + " кг";
	var infoblock = $(t).parent().find(".informer");
	if(informer < 1)
		infoblock.css("margin-top", "-140px");
	else
		infoblock.css("margin-top", "-95px");
	infoblock.fadeIn(300).html(text);

	/* informer */
	step4(result, count);
}

function marka_count()
{
var count = 0;
$(".marka_count").each(
  function()
  {
	  var input = parseInt(this.value);
	  if(input)
		count = count + input;
  });
return count;
}
function step4(result, count)
{
//console.info("result = " + result);
//console.info("count = " + count);

	if(count <= 0)
		order_step();
	else
		$("#next_step").attr("disabled", true);
}

/* конец 4 шага */