/**
 *
 * @type {{action: string, loadModal: velesCalculator.loadModal, open: velesCalculator.open, d: velesCalculator.d}}
 */
var velesCalculator = {
    action: "/local/ajax/shopping.cart.php",
    ajax: "/local/ajax/shopping.cart.php",
    guest: "/order/guest_form.php",
    order: "/order/order_form.php",
    data: null,
    next: true,

    loadModal: function () {
        $.get(this.action, {}, function (result) {
            modal.setFullForm(result);
        });
    },

    open: function () {
        modal.clear();
        this.loadModal();
        modal.show();
    },

    step: function (step) {
        if(step == true)
            this.next = true;
        else
            this.next = false;
    },

    submit: function (t) {
        this.setData($(t).serializeArray());
        this.setAction();
        modal.setLoader();

        return this.send();
    },

    send: function(){
        if(this.action == this.ajax){
            $.ajax({
                type: "post",
                url: this.action,
                data: this.getData(),
                success: function(result){
                    $('#order_form').html(result);
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                }
            });
            return false;
        }
        else{
            return true;
        }
    },

    setData: function(data){
        this.data = data;
        if(this.next){
            this.data.push({
                name: "action",
                value: $('#modal').find("#next_step").val()
            });
        }else{
            this.data.push({
                name: "action",
                value: $('#modal').find("#back_step").val()
            });
        }
    },

    getData: function(){
        return this.data;
    },

    setAction: function(){
        this.action = this.ajax;
        // data analiz
        var i;
        for(i=0; i < this.getData().length; i++){
            // check client
            if(
                this.data[i].name == "client" &&
                this.data[i].value == "client"
            ){
                this.action = this.guest;
            }
            // check last step
            if(
                this.data[i].name == "step" &&
                this.data[i].value == "8" &&
                this.next
            ){
                this.action = this.order;
            }
            // check service
            if(
                this.data[i].name == "step" &&
                this.data[i].value == "5" &&
                this.data[i].name == "service" &&
                this.data[i].value == "without_coffee" &&
                this.next
            ){
                this.action = this.order;
            }
        }
    },

    getAction: function(){
        return this.action;
    },

    d: function (value) {
        console.info(value);
    }
};

/**
 * @param tr
 */
function tableStripedTr(tr) {
    $(tr).find("input:radio").prop( "checked", true ).change();
}

/**
 * @param obj
 */
function marka_count_up(obj){
    var t = $(obj).prev(),
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
        var text = '<div class="margin-bottom-20">Для оформления заказа нажмите</div>' + '<input class="btn btn-primary" value="Продолжить" onclick="nextStepTrigger()">';
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
}

/**
 * @param obj
 */
function marka_count_down(obj){
    var t = $(obj).next(),
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
        var text = '<div class="margin-bottom-20">Для оформления заказа нажмите</div>' + '<input class="btn btn-primary" value="Продолжить" onclick="nextStepTrigger()">';
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
}

/**
 * Functions for steps form
 */
function count_up(t)
{
    var input = $(t).parent().find(".marka_count"),
        value = parseInt(input.val());
    value++;
    input.val(value);
}

/**
 * @param t
 */
function count_down(t)
{
    var input = $(t).parent().find(".marka_count"),
        value = parseInt(input.val());
    if(value > 0)
        value--;
    else
        value = 0;
    input.val(value);
}

/**
 * @param t
 */
function count_input(t)
{
    var input = $(t).parent().find(".marka_count"),
        value = parseInt(input.val());
    if(!value)
        value = 0;
    input.val(value);
}

function order_step()
{
    var step = $("#next_step");
    if(step.attr("disabled"))
    {
        step.attr("disabled", false);
    }
}

function nextStepTrigger() {
    $("#next_step").click();
}

/**
 *
 * @param t
 */
function nextStepInformer(t) {
    $(t).find("input:radio").prop( "checked", true ).change();
    $(".informer").hide();
    var text = '<div class="margin-bottom-20">Для оформления заказа нажмите</div>' + '<input class="btn btn-primary" value="Продолжить" onclick="nextStepTrigger()">';
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
        var text = '<div class="margin-bottom-20">Для оформления заказа нажмите</div>' + '<input class="btn btn-primary" value="Продолжить" onclick="nextStepTrigger()">';
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
    if(count <= 0)
        order_step();
    else
        $("#next_step").attr("disabled", true);
}
