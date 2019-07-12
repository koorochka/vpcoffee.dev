/**
 * Modal Single object on page
 * @type {{id: string, jqueryId: string, header: null, body: null, footer: null, getContext: modal.getContext, setHeader: modal.setHeader, setBody: modal.setBody, setFooter: modal.setFooter, setLoader: modal.setLoader, clear: modal.clear, open: modal.open}}
 */
var modal = {
    id: "modal",
    jqueryId: "#modal",
    header: null,
    body: null,
    footer: null,

    getContext: function () {
        return $(this.jqueryId).find(".modal-content");
    },
    /**
     * Set header
     * @returns {boolean}
     */
    setHeader: function () {
        if(this.header == undefined){
            return false;
        }else{
            var header = $("<div />", {
                class: "modal-header",
                html: $("<div  />", {
                    class: "pull-right pointer text-20",
                    html: "&times;",
                    onclick: "return modal.hide()"
                })
            });

            header.append($("<h4 />",{
                class: "modal-title",
                id: this.id + "Label",
                text: this.header
            }));

            this.getContext().prepend(header)
        }
    },

    /**
     * Set body
     * @returns {*}
     */
    setBody: function () {
        if(this.body == undefined){
            return false;
        }else{
            this.getContext().prepend($("<div />",{
                class: "modal-body",
                html: this.body
            }));
        }
    },

    /**
     * Set footer
     * @returns {*}
     */
    setFooter: function () {
        if(this.footer == undefined){
            return false;
        }else{
            this.getContext().append(
                $("<div>", {
                    class: "modal-footer",
                    html: this.footer
                })
            );
        }
    },

    /**
     * Set full form to the context
     * @param form
     * @returns {boolean}
     */
    setFullForm: function (form) {
        if(form == undefined){
            return false;
        }else{
            this.getContext().append(form);
        }
    },

    setLoader: function () {
        this.getContext().prepend($("<div />", {
            html: "Loading ..."
        }));
    },

    setClass: function (cl){
        // modal-lg
        // modal-sm
        if(!$(this.jqueryId).find(".modal-dialog").hasClass(cl)) {
            $(this.jqueryId).find(".modal-dialog").addClass(cl);
        }
    },

    deleteClass: function (cl){
        $(this.jqueryId).find(".modal-dialog").removeClass(cl);
    },

    clear: function () {
        this.getContext().empty();
    },

    open: function () {
        this.clear();
        this.setBody();
        this.setHeader();
        this.setFooter();
        this.show();
        return false;
    },

    close: function () {
        this.setLoader();
        this.hide();
        return false;
    },

    show: function () {
        $(this.jqueryId).modal("show");
    },

    hide: function () {
        $(this.jqueryId).modal("hide");
    }
};