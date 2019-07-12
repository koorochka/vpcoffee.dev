/**
 * navbarInverse single object
 * @type {{navbar: string, width: null, itemsWidth: null, needAdditionally: boolean, items: Array, additionallyItems: Array, getWidth: navbarInverse.getWidth, setWidth: navbarInverse.setWidth, setItemsWidth: navbarInverse.setItemsWidth, getItemsWidth: navbarInverse.getItemsWidth, checkAdditionally: navbarInverse.checkAdditionally, setAdditionally: navbarInverse.setAdditionally, setDropdown: navbarInverse.setDropdown, init: navbarInverse.init, render: navbarInverse.render, d: navbarInverse.d, a: navbarInverse.a}}
 */
window.navbarInverse = {

    // object fields
    navbar: ".navbar-inverse",
    width: null,
    itemsWidth: null,
    needAdditionally: false,
    allItems:[],
    items:[],
    additionallyItems:[],
    // object methods
    getWidth: function () {
        return this.width;
    },
    setWidth: function () {
        this.width = $(".navbar-inverse").width();
    },
    setItemsWidth: function () {
        var width = 0;
        $(".navbar-nav").find("li").each(function () {
            width += $(this).width();
            navbarInverse.items.push($(this));
        });
        this.itemsWidth = width;
        this.allItems = this.items;
    },
    loaderItem: function () {
        return $("<li />", {
            html: $("<a />", {
                text: $(this.navbar).data("loader")
            })
        })
    },
    renderItems: function () {
        var ul = $(this.navbar).find(".navbar-nav"),
            width = 0,
            flag = true;
        ul.html(" ");
        for(var i = 0; i < this.allItems.length; i++)
        {
            ul.append(this.allItems[i]);
        }
        this.setWidth();
        this.items = [];
        this.additionallyItems = [];
        this.itemsWidth = 0;
        for(var i = 0; i < this.allItems.length; i++)
        {
            width += $(this.allItems[i]).width();
            this.itemsWidth += $(this.allItems[i]).width();
            if(width < navbarInverse.width){
                this.items.push(this.allItems[i]);
            }
            else{
                width = width - $(this.allItems[i]).width();
                /*
                if(flag)
                {
                    this.additionallyItems.push(this.items[this.items.length - 1]);
                    this.items.pop();
                    flag = false;
                }
                */
                this.additionallyItems.push(this.allItems[i]);
            }
        }

        this.checkAdditionally();
        if(this.needAdditionally){
            this.changeLast();
            this.setDropdown();
        }

    },
    getItemsWidth: function () {
        return this.itemsWidth;
    },
    // work with additionaly
    checkAdditionally: function () {
        if(this.getWidth() > this.getItemsWidth()){
            this.needAdditionally = false;
        }else{
            this.needAdditionally = true;
        }
    },
    setAdditionally: function () {

        if(this.needAdditionally){
            var width = 0,
                flag = true;
            this.items = [];
            $(".navbar-nav").find("li").each(function () {
                width += $(this).width();
                if(width < navbarInverse.width){
                    navbarInverse.items.push($(this));
                }
                else{
                    width = width - $(this).width();
                    /*
                    if(flag)
                    {
                        navbarInverse.additionallyItems.push(navbarInverse.items[navbarInverse.items.length - 1]);
                        navbarInverse.items.pop();
                        flag = false;
                    }
                    */
                    navbarInverse.additionallyItems.push($(this));
                }
            });
            this.itemsWidth = width;
            this.changeLast();
        }
    },

    /**
     * Перестановка последних пунктов
     */
    changeLast: function () {
        if(this.items.length > 4){
            var lastItem = this.items[this.items.length - 1],
                lastAdditionallyItem = this.additionallyItems[this.additionallyItems.length - 1];
            navbarInverse.items.pop();
            navbarInverse.additionallyItems.pop();
            this.items.push(lastAdditionallyItem);
            this.additionallyItems.push(lastItem);
        }
    },

    setDropdown: function () {
        if(this.needAdditionally){
            $(this.navbar).find(".navbar-nav").empty();
            for(var i=0; i<this.items.length; i++)
            {
                $(".navbar-nav").append(this.items[i]);
            }
            // dropdown
            var dropdown = $("<li />", {
                class: "dropdown pull-right",
                html: $("<a />", {
                    href:"#",
                    id: "menu-additionally",
                    html: $(this.navbar).data("additionally")
                })
            });
            dropdown.find("a")
                .attr("data-toggle", "dropdown")
                .attr("aria-haspopup", "true")
                .attr("aria-expanded", "false")
                .attr("data-toggle", "dropdown")
                .append($("<span />",{
                    class: "caret"
                }));
            dropdown.append($("<ul />",{
                class: "dropdown-menu"
            }));
            dropdown.find(".dropdown-menu").attr("aria-labelledby", "menu-additionally");
            for(var i=0; i < this.additionallyItems.length; i++)
            {
                dropdown.find(".dropdown-menu").append(this.additionallyItems[i]);
            }
            $(".navbar-nav").append(dropdown);
        }
    },
    removeDropdown: function () {
        $(this.navbar).find(".navbar-nav").find(".dropdown").remove();
    },
    // init
    init: function () {
        this.setWidth();
        this.setItemsWidth();
        this.checkAdditionally();
        this.setAdditionally();
        this.setDropdown();
    },
    render: function () {
        this.removeDropdown();
        this.renderItems();
    },
    // debug
    d: function (value) {
        console.info(value);
    },
    a: function (value) {
        alert(value);
    }
};

/**
 * Начальное состояние
 */
$(document).ready(function () {
    window.navbarInverse.init();
});

/**
 * При изменении ширины окна
 */
$(window).resize(function() {
    clearTimeout(window.resizedFinished);
    window.resizedFinished = setTimeout(function(){
        window.navbarInverse.render();
    }, 1000);
});

/**
 * При смене ориентации с портретной на пейзажную или обратно
window.onorientationchange = function() {
    navbarInverse.render();
};
 */