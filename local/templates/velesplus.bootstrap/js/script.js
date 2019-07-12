var layoutSwipe = {
    mode: false,
    toggle: function () {
        if(this.mode){
            this.hide();
        }else{
            this.show();
        }
    },
    show: function () {
        $(".layout-swipe").addClass("mobile-mod-on");
        //$(".header-top").removeClass("hidden");
        this.mode = true;
    },
    hide: function () {
        $(".layout-swipe").removeClass("mobile-mod-on");
        //$(".header-top").addClass("hidden");
        this.mode = false;
    }
};

function costom_coffe(t)
{

    if(parseInt(t.value) >= parseInt($(t).data("min-count")))
    {
        order_step();
    }
    else
    {
        $("#next_step").attr("disabled", true);
    }
}