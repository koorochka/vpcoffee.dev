
var tablePrice = {
    tabs: "#table-price-tabs",
    controls: "#table-price-controls",
    control: ".table-price-control",
    tab: ".table-price-tab",
    active: "active",
    deactivateTabs: function () {
        $(this.tabs).find(this.tab).removeClass(this.active);
    },
    deactivateControls: function () {
        $(this.controls).find(this.control).removeClass(this.active);
    },
    showTab: function (tab, index) {
        this.deactivateTabs();
        this.deactivateControls();
        $(tab).addClass(this.active);
        $($(this.tabs).find(this.tab)[index]).addClass(this.active);


    }
};