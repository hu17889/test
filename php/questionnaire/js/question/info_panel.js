
$(document).ready(function(){
    /*
    function INFO_PANEL(panelId) {
        this.id=panelId;
        this.instInfoContent=new INFO_PANEL_CONTENT(pannelId);
    };
    function INFO_PANEL_CONTENT(pannelId) {
        this.id=panelId+" td";
    }
    */

    // 信息版
    INFO_PANEL = {
        id : '#info',

        /**
         *  关闭信息版事件功能
         */
        disableEvent : function() {
            INFO_PANEL_CONTENT.disableEvent();
        },

        /**
         *  关闭信息版发送数据功能
         */
        disablePostData: function() {
            INFO_PANEL_CONTENT.disablePostData();
        },

        /**
         *  初始化 信息版展现，事件绑定
         */
        init : function(naireid) {
            INFO_PANEL_CONTENT.init(naireid);
        },
    };

    // 信息版内容块
    INFO_PANEL_CONTENT = {
        id : '#info td',
        eventfunc : {},

        disableEvent : function() {
            $(this.id).off();
        },

        disablePostData: function() {
            $(this.id).off("mousedown",this.eventfunc["downpost"]);
            $(this.id).off("mouseup",this.eventfunc["uppost"]);
        },

        init : function(naireid) {
            this.hideAll();
            // init html css
            this.eventfunc["show"] = function(e) {
                e.data.handle.show($(this));
            };
            this.eventfunc["hide"] = function(e) {
                e.data.handle.hideAll();
            };
            this.eventfunc["downpost"] = function(e) {
                $.post(
                    '/Stat/PointStat',
                    {
                        type : "down",
                        qid : e.data.id,
                        x : $(this).data("x"),
                        y : $(this).data("y")
                    },
                    function(data) {
                        console.log(data);
                    }
                );
            };
            this.eventfunc["uppost"] = function(e) {
                $.post(
                    '/Stat/PointStat',
                    {
                        type : "up",
                        qid : e.data.id,
                    },
                    function(data) {
                        console.log(data);
                    }
                );
            };

            $(this.id).on('mousedown',{ "handle":this,"id":naireid },this.eventfunc["show"]);
            $(this.id).on('mousedown',{ "handle":this,"id":naireid },this.eventfunc["downpost"]);
            $(this.id).on('mouseup',{ "handle":this,"id":naireid },this.eventfunc["hide"]);
            $(this.id).on('mouseup',{ "handle":this,"id":naireid },this.eventfunc["uppost"]);
        },

        /**
         *  隐藏所有内容块的文本
         */
        hideAll : function() {
            $("#info td p").hide();
            $(this.id).css('background-color','#808080');
        },

        /**
         *  展现一个内容块的文本
         */
        show : function(item) {
            item.css('background-color','white');
            item.children("p").show();
        }
    };
});
