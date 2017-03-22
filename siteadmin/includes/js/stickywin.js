function showPopup(editid, divid, params){
    var p = $merge({width: 600, title:'', cornerHandle: true}, params||{});
    if ($(editid)) var position = 'bottomleft';
    else var position = 'center';
    var stickywin = $merge({
        relativeTo: $(editid),
        position: position,
        offset:{x:-10},
        allowMultiple: false,
        draggable: true
      }, params);

    var content = $(divid);
    if (content) content.show();
    else content = divid;
    //xd(stickywin);
    p["baseHref"] = '/cnet/html/rb/assets/global/stickyWinHTML/';
    popups["_last_"] = new StickyWin.Modal($merge(stickywin, {
      'content': StickyWin.ui(p["title"], content, p)
    }));
    var win = popups["_last_"].win;
    var delta = window.getScroll()['y']-win.getCoordinates()['top'];
    if (delta>0) win.setStyle('top', window.getScroll()['y']+10);
    return popups["_last_"];
}

function popupImg(el, src, params){
  if (!(params instanceof Object))
    params ={title: src};
  //params["width"] =
  var img = new Asset.image(src, {onload: function(){
    params['width']=this.get('width').toInt()+50;
    showPopup(el, img, params);
  }});
  //var img = new Element("img", {src:src})
  //el.popup.defaultSize(el.popup.content.firstChild.width, el.popup.content.firstChild.height);
}
/*
Script: StyleWriter.js

Provides a simple method for injecting a css style element into the DOM if it's not already present.

License:
    http://www.clientcide.com/wiki/cnet-libraries#license
*/

var StyleWriter = new Class({
    createStyle: function(css, id) {
        window.addEvent('domready', function(){
            try {
                if (document.id(id) && id) return;
                var style = new Element('style', {id: id||''}).inject($$('head')[0]);
                if (Browser.Engine.trident) style.styleSheet.cssText = css;
                else style.set('text', css);
            }catch(e){if (dbug && dbug["log"]) dbug.log('error: %s',e);}
        }.bind(this));
    }
});/*
Script: modalizer.js
    Defines Modalizer: functionality to overlay the window contents with a semi-transparent layer that prevents interaction with page content until it is removed

License:
    http://www.clientcide.com/wiki/cnet-libraries#license
*/
var Modalizer = new Class({
    defaultModalStyle: {
        display:'block',
        position:'fixed',
        top:0,
        left:0, 
        'z-index':5000,
        'background-color':'#333',
        opacity:0.8
    },
    setModalOptions: function(options){
        this.modalOptions = $merge({
            width:(window.getScrollSize().x),
            height:(window.getScrollSize().y),
            elementsToHide: 'select, embed' + (Browser.Engine.trident ? '': ', object'),
            hideOnClick: true,
            modalStyle: {},
            updateOnResize: true,
            layerId: 'modalOverlay',
            onModalHide: $empty,
            onModalShow: $empty
        }, this.modalOptions, options);
        return this;
    },
    layer: function(){
        if (!this.modalOptions.layerId) this.setModalOptions();
        return document.id(this.modalOptions.layerId) || new Element('div', {id: this.modalOptions.layerId}).inject(document.body);
    },
    resize: function(){
        if (this.layer()) {
            this.layer().setStyles({
                width:(window.getScrollSize().x),
                height:(window.getScrollSize().y)
            });
        }
    },
    setModalStyle: function (styleObject){
        this.modalOptions.modalStyle = styleObject;
        this.modalStyle = $merge(this.defaultModalStyle, {
            width:this.modalOptions.width,
            height:this.modalOptions.height
        }, styleObject);
        if (this.layer()) this.layer().setStyles(this.modalStyle);
        return(this.modalStyle);
    },
    modalShow: function(options){
        this.setModalOptions(options);
        this.layer().setStyles(this.setModalStyle(this.modalOptions.modalStyle));
        if (Browser.Engine.trident4) this.layer().setStyle('position','absolute');
        this.layer().removeEvents('click').addEvent('click', function(){
            this.modalHide(this.modalOptions.hideOnClick);
        }.bind(this));
        this.bound = this.bound||{};
        if (!this.bound.resize && this.modalOptions.updateOnResize) {
            this.bound.resize = this.resize.bind(this);
            window.addEvent('resize', this.bound.resize);
        }
        if ($type(this.modalOptions.onModalShow)  == "function") this.modalOptions.onModalShow();
        this.togglePopThroughElements(0);
        this.layer().setStyle('display','block');
        return this;
    },
    modalHide: function(override, force){
        if (override === false) return false; //this is internal, you don't need to pass in an argument
        this.togglePopThroughElements(1);
        if ($type(this.modalOptions.onModalHide) == "function") this.modalOptions.onModalHide();
        this.layer().setStyle('display','none');
        if (this.modalOptions.updateOnResize) {
            this.bound = this.bound||{};
            if (!this.bound.resize) this.bound.resize = this.resize.bind(this);
            window.removeEvent('resize', this.bound.resize);
        }
        return this;
    },
    togglePopThroughElements: function(opacity){
        if (Browser.Engine.trident4 || (Browser.Engine.gecko && Browser.Platform.mac)) {
            $$(this.modalOptions.elementsToHide).each(function(sel){
                sel.setStyle('opacity', opacity);
            });
        }
    }
});/*
Script: StickyWin.js

Creates a div within the page with the specified contents at the location relative to the element you specify; basically an in-page popup maker.

License:
    http://www.clientcide.com/wiki/cnet-libraries#license
*/

var StickyWin = new Class({
    Binds: ['destroy', 'hide', 'togglepin', 'esc'],
    Implements: [Options, Events, StyleWriter, Class.ToElement],
    options: {
//      onDisplay: $empty,
//      onClose: $empty,
//      onDestroy: $empty,
        closeClassName: 'closeSticky',
        pinClassName: 'pinSticky',
        content: '',
        zIndex: 10000,
        className: '',
//      id: ... set above in initialize function
/*      these are the defaults for Element.position anyway
        ************************************************
        edge: false, //see Element.position
        position: 'center', //center, corner == upperLeft, upperRight, bottomLeft, bottomRight
        offset: {x:0,y:0},
        relativeTo: document.body, */
        width: false,
        height: false,
        timeout: -1,
        allowMultipleByClass: true,
        allowMultiple: true,
        showNow: true,
        useIframeShim: true,
        iframeShimSelector: '',
        destroyOnClose: false,
        closeOnClickOut: false,
        closeOnEsc: false
    },

    css: '.SWclearfix:after {content: "."; display: block; height: 0; clear: both; visibility: hidden;}'+
         '.SWclearfix {display: inline-table;} * html .SWclearfix {height: 1%;} .SWclearfix {display: block;}',
    
    initialize: function(options){
        this.options.inject = this.options.inject || {
            target: document.body,
            where: 'bottom' 
        };
        this.setOptions(options);
        this.id = this.options.id || 'StickyWin_'+new Date().getTime();
        this.makeWindow();

        if (this.options.content) this.setContent(this.options.content);
        if (this.options.timeout > 0) {
            this.addEvent('onDisplay', function(){
                this.hide.delay(this.options.timeout, this)
            }.bind(this));
        }
        //add css for clearfix
        this.createStyle(this.css, 'StickyWinClearFix');
        if (this.options.closeOnClickOut || this.options.closeOnEsc) this.attach();
        if (this.options.destroyOnClose) this.addEvent('close', this.destroy);
        if (this.options.showNow) this.show();
    },
    attach: function(attach){
        var method = $pick(attach, true) ? 'addEvents' : 'removeEvents';
        var events = {};
        if (this.options.closeOnClickOut) events.click = this.esc;
        if (this.options.closeOnEsc) events.keyup = this.esc;
        document[method](events);
    },
    esc: function(e) {
        if (e.key == "esc") this.hide();
        if (e.type == "click" && this.element != e.target && !this.element.hasChild(e.target)) this.hide();
    },
    makeWindow: function(){
        this.destroyOthers();
        if (!document.id(this.id)) {
            this.win = new Element('div', {
                id:     this.id
            }).addClass(this.options.className).addClass('StickyWinInstance').addClass('SWclearfix').setStyles({
                display:'none',
                position:'absolute',
                zIndex:this.options.zIndex
            }).inject(this.options.inject.target, this.options.inject.where).store('StickyWin', this);          
        } else this.win = document.id(this.id);
        this.element = this.win;
        if (this.options.width && $type(this.options.width.toInt())=="number") this.win.setStyle('width', this.options.width.toInt());
        if (this.options.height && $type(this.options.height.toInt())=="number") this.win.setStyle('height', this.options.height.toInt());
        return this;
    },
    show: function(suppressEvent){
        this.showWin();
        if (!suppressEvent) this.fireEvent('display');
        if (this.options.useIframeShim) this.showIframeShim();
        this.visible = true;
        return this;
    },
    showWin: function(){
        if (!this.positioned) this.position();
        this.win.show();
    },
    hide: function(suppressEvent){
        if ($type(suppressEvent) == "event" || !suppressEvent) this.fireEvent('close');
        this.hideWin();
        if (this.options.useIframeShim) this.hideIframeShim();
        this.visible = false;
        return this;
    },
    hideWin: function(){
        this.win.setStyle('display','none');
    },
    destroyOthers: function() {
        if (!this.options.allowMultipleByClass || !this.options.allowMultiple) {
            $$('div.StickyWinInstance').each(function(sw) {
                if (!this.options.allowMultiple || (!this.options.allowMultipleByClass && sw.hasClass(this.options.className))) 
                    sw.retrieve('StickyWin').destroy();
            }, this);
        }
    },
    setContent: function(html) {
        if (this.win.getChildren().length>0) this.win.empty();
        if ($type(html) == "string") this.win.set('html', html);
        else if (document.id(html)) this.win.adopt(html);
        this.win.getElements('.'+this.options.closeClassName).each(function(el){
            el.addEvent('click', this.hide);
        }, this);
        this.win.getElements('.'+this.options.pinClassName).each(function(el){
            el.addEvent('click', this.togglepin);
        }, this);
        return this;
    },
    position: function(options){
        this.positioned = true;
        this.setOptions(options);
        this.win.position({
            allowNegative: $pick(this.options.allowNegative, this.options.relativeTo != document.body),
            relativeTo: this.options.relativeTo,
            position: this.options.position,
            offset: this.options.offset,
            edge: this.options.edge
        });
        if (this.shim) this.shim.position();
        return this;
    },
    pin: function(pin) {
        if (!this.win.pin) {
            dbug.log('you must include element.pin.js!');
            return this;
        }
        this.pinned = $pick(pin, true);
        this.win.pin(pin);
        return this;
    },
    unpin: function(){
        return this.pin(false);
    },
    togglepin: function(){
        return this.pin(!this.pinned);
    },
    makeIframeShim: function(){
        if (!this.shim){
            var el = (this.options.iframeShimSelector)?this.win.getElement(this.options.iframeShimSelector):this.win;
            this.shim = new IframeShim(el, {
                display: false,
                name: 'StickyWinShim'
            });
        }
    },
    showIframeShim: function(){
        if (this.options.useIframeShim) {
            this.makeIframeShim();
            this.shim.show();
        }
    },
    hideIframeShim: function(){
        if (this.shim) this.shim.hide();
    },
    destroy: function(){
        if (this.win) this.win.destroy();
        if (this.options.useIframeShim && this.shim) this.shim.destroy();
        if (document.id('modalOverlay')) document.id('modalOverlay').destroy();
        this.fireEvent('destroy');
    }
});
/*
Script: StickyWin.Fx.js

    Extends StickyWin to create popups that fade in and out.

    License:
        MIT-style license.

    Authors:
        Aaron Newton
*/

/*
Script: StickyWin.Fx.js

Extends StickyWin to create popups that fade in and out and can be dragged and resized (requires StickyWin.Fx.Drag.js).

License:
    http://www.clientcide.com/wiki/cnet-libraries#license
*/
StickyWin = Class.refactor(StickyWin, {
    options: {
        //fadeTransition: 'sine:in:out',
        fade: true,
        fadeDuration: 150
    },
    hideWin: function(){
        if (this.options.fade) this.fade(0);
        else this.previous();
    },
    showWin: function(){
        if (this.options.fade) this.fade(1);
        else this.previous();
    },
    hide: function(){
        this.previous(this.options.fade);
    },
    show: function(){
        this.previous(this.options.fade);
    },
    fade: function(to){
        if (!this.fadeFx) {
            this.win.setStyles({
                opacity: 0,
                display: 'block'
            });
            var opts = {
                property: 'opacity',
                duration: this.options.fadeDuration
            };
            if (this.options.fadeTransition) opts.transition = this.options.fadeTransition;
            this.fadeFx = new Fx.Tween(this.win, opts);
        }
        if (to > 0) {
            this.win.setStyle('display','block');
            this.position();
        }
        this.fadeFx.clearChain();
        this.fadeFx.start(to).chain(function (){
            if (to == 0) {
                this.win.setStyle('display', 'none');
                this.fireEvent('onClose');
            } else {
                this.fireEvent('onDisplay');
            }
        }.bind(this));
        return this;
    }
});
StickyWin.Fx = StickyWin;/*
Script: StickyWin.Drag.js

Implements drag and resize functionaity into StickyWin.Fx. See StickyWin.Fx for the options.

License:
    http://www.clientcide.com/wiki/cnet-libraries#license
*/
StickyWin = Class.refactor(StickyWin, {
    options: {
        draggable: false,
        dragOptions: {},
        dragHandleSelector: '.dragHandle',
        resizable: false,
        resizeOptions: {},
        resizeHandleSelector: ''
    },
    setCaption: function(){
        if (this.options.draggable) this.makeDraggable();
    },
    setContent: function(){
        this.previous.apply(this, arguments);
        if (this.options.draggable) this.makeDraggable();
        if (this.options.resizable) this.makeResizable();
        return this;
    },
    makeDraggable: function(){
        var toggled = this.toggleVisible(true);
        if (this.options.useIframeShim) {
            this.makeIframeShim();
            var onComplete = (this.options.dragOptions.onComplete || $empty);
            this.options.dragOptions.onComplete = function(){
                onComplete();
                this.shim.position();
            }.bind(this);
        }
        if (this.options.dragHandleSelector) {
            var handle = this.win.getElement(this.options.dragHandleSelector);
            if (handle) {
                handle.setStyle('cursor','move');
                this.options.dragOptions.handle = handle;
            }
        }
        this.win.makeDraggable(this.options.dragOptions);
        if (toggled) this.toggleVisible(false);
    }, 
    makeResizable: function(){
        var toggled = this.toggleVisible(true);
        if (this.options.useIframeShim) {
            this.makeIframeShim();
            var onComplete = (this.options.resizeOptions.onComplete || $empty);
            this.options.resizeOptions.onComplete = function(){
                onComplete();
                this.shim.position();
            }.bind(this);
        }
        if (this.options.resizeHandleSelector) {
            var handle = this.win.getElement(this.options.resizeHandleSelector);
            if (handle) this.options.resizeOptions.handle = this.win.getElement(this.options.resizeHandleSelector);
        }
        this.win.makeResizable(this.options.resizeOptions);
        if (toggled) this.toggleVisible(false);
    },
    toggleVisible: function(show){
        if (!this.visible && Browser.Engine.webkit && $pick(show, true)) {
            this.win.setStyles({
                display: 'block',
                opacity: 0
            });
            return true;
        } else if (!$pick(show, false)){
            this.win.setStyles({
                display: 'none',
                opacity: 1
            });
            return false;
        }
        return false;
    }
});
StickyWin.Fx = StickyWin;/*
Script: StickyWin.Modal.js

This script extends StickyWin and StickyWin.Fx classes to add Modalizer functionality.

License:
    http://www.clientcide.com/wiki/cnet-libraries#license
*/
StickyWin.Modal = new Class({

    Extends: StickyWin,

    Implements: Modalizer,
    
    options: {
        modalize: true
    },

    initialize: function(options){
        options = options||{};
        this.setModalOptions($merge(options.modalOptions||{}, {
            onModalHide: function(){
                    this.hide(false);
                }.bind(this)
            }));
        this.parent(options);
    },

    show: function(showModal){
        if ($pick(showModal, this.options.modalize)) {
            this.modalShow();
            if (this.modalOptions.elementsToHide) this.win.getElements(this.modalOptions.elementsToHide).setStyle('opacity', 1);
        }
        this.parent();
    },

    hide: function(hideModal){
        if ($pick(hideModal, true)) this.modalHide();
        else this.parent();
    }

});
if (StickyWin.Fx) StickyWin.Fx.Modal = StickyWin.Modal;/*
Script: StickyWin.Alert.js
    Defines StickyWin.Alert, a simple little alert box with a close button.

License:
    http://www.clientcide.com/wiki/cnet-libraries#license
*/
StickyWin.Alert = new Class({
    Implements: Options,
    Extends: StickyWin.Modal,
    options: {
        baseHref: "http://www.cnet.com/html/rb/assets/global/simple.error.popup",
        destroyOnClose: true,
        modalOptions: {
            modalStyle: {
                zIndex: 11000
            }
        },
        zIndex: 110001,
        uiOptions: {
            width: 250,
            buttons: [
                {text: 'Ok'}
            ]
        }
    },
    initialize: function(caption, message, options) {
        this.message = message;
        this.caption = caption;
        this.setOptions(options);
        this.setOptions({
            content: this.build()
        });
        this.parent(options);
    },
    makeMessage: function() {
        return new Element('p', {
            'class': 'errorMsg SWclearfix',
            styles: {
                margin: 0,
                minHeight: 10
            },
            html: this.message
        });
    },
    build: function(){
        return StickyWin.ui(this.caption, this.makeMessage(), this.options.uiOptions);
    }
});

StickyWin.Error = new Class({
    Extends: StickyWin.Alert, 
    makeMessage: function(){
        var message = this.parent();
        new Element('img', {
            src: this.options.baseHref + '/icon_problems_sm.gif',
            'class': 'bang clearfix',
            styles: {
                'float': 'left',
                width: 30,
                height: 30,
                margin: '3px 5px 5px 0px'
            }
        }).inject(message, 'top');
        return message;
    }
});

StickyWin.alert = function(caption, message, options) {
    if ($type(options) == "string") options = {baseHref: options};
    return new StickyWin.Alert(caption, message, options);
};

StickyWin.error = function(caption, message, options) {
    return new StickyWin.Error(caption, message, options);
}; /*
Script: StickyWin.ui.js

Creates an html holder for in-page popups using a default style.

License:
    http://www.clientcide.com/wiki/cnet-libraries#license
*/
StickyWin.UI = new Class({
    Implements: [Options, Class.ToElement, StyleWriter],
    options: {
        width: 300,
        css: "div.DefaultStickyWin {font-family:Arial, Helvetica, sans-serif; font-size:12px;}"+
            "div.DefaultStickyWin div.top_ul{background:url(/static/v4/images/full.png) top left no-repeat; height:30px; width:15px; float:left}"+
            "div.DefaultStickyWin div.top_ur{position:relative; left:0px !important; left:-4px; background:url(/static/v4/images/full.png) top right !important; height:30px; margin:0px 0px 0px 15px !important; margin-right:-4px; padding:0px}"+
            "div.DefaultStickyWin h1.caption{clear: none !important; margin:0px !important; overflow: hidden; padding:0 !important; font-weight:bold; color:#fff; font-size:14px !important; position:relative; top:8px !important; left:5px !important; float: left; height: 22px !important;}"+
            "div.DefaultStickyWin div.middle, div.DefaultStickyWin div.closeBody {background:url(/static/v4/images/body.png) top left repeat-y; margin:0px 20px 0px 0px !important; margin-bottom: -3px; position: relative;    top: 0px !important; top: -3px;}"+
            "div.DefaultStickyWin div.body{background:url(/static/v4/images/body.png) top right repeat-y; padding:8px 23px 8px 0px !important; margin-left:5px !important; position:relative; right:-20px !important; z-index: 1;}"+
            "div.DefaultStickyWin div.bottom{clear:both;}"+
            "div.DefaultStickyWin div.bottom_ll{background:url(/static/v4/images/full.png) bottom left no-repeat; width:15px; height:15px; float:left}"+
            "div.DefaultStickyWin div.bottom_lr{background:url(/static/v4/images/full.png) bottom right; position:relative; left:0px !important; left:-4px; margin:0px 0px 0px 15px !important; margin-right:-4px; height:15px}"+
            "div.DefaultStickyWin div.closeButtons{text-align: center; background:url(/static/v4/images/body.png) top right repeat-y; padding: 4px 30px 8px 0px; margin-left:5px; position:relative; right:-20px}"+
            "div.DefaultStickyWin a.button:hover{background:url(/static/v4/images/big_button_over.gif) repeat-x}"+
            "div.DefaultStickyWin a.button {background:url(/static/v4/images/big_button.gif) repeat-x; margin: 2px 8px 2px 8px; padding: 2px 12px; cursor:pointer; border: 1px solid #999 !important; text-decoration:none; color: #000 !important;}"+
            "div.DefaultStickyWin div.closeButton{width:13px; height:13px; background:url(/static/v4/images/closebtn.gif) no-repeat; position: absolute; right: 0px; margin:10px 15px 0px 0px !important; cursor:pointer;top:0px}"+
            "div.DefaultStickyWin div.dragHandle {  width: 11px;    height: 25px;   position: relative; top: 5px;   left: -3px; cursor: move;   background: url(/static/v4/images/drag_corner.gif); float: left;}",
        cornerHandle: false,
        cssClass: '',
        baseHref: 'http://www.cnet.com/html/rb/assets/global/stickyWinHTML/',
        buttons: [],
        cssId: 'defaultStickyWinStyle',
        cssClassName: 'DefaultStickyWin',
        closeButton: true
/*  These options are deprecated:
        closeTxt: false,
        onClose: $empty,
        confirmTxt: false,
        onConfirm: $empty   */
    },
    initialize: function() {
        var args = this.getArgs(arguments);
        this.setOptions(args.options);
        this.legacy();
        var css = this.options.css.substitute({baseHref: this.options.baseHref}, /\\?\{%([^}]+)%\}/g);
        if (Browser.Engine.trident4) css = css.replace(/png/g, 'gif');
        this.createStyle(css, this.options.cssId);
        this.build();
        if (args.caption || args.body) this.setContent(args.caption, args.body);
    },
    getArgs: function(){
        return StickyWin.UI.getArgs.apply(this, arguments);
    },
    legacy: function(){
        var opt = this.options; //saving bytes
        //legacy support
        if (opt.confirmTxt) opt.buttons.push({text: opt.confirmTxt, onClick: opt.onConfirm || $empty});
        if (opt.closeTxt) opt.buttons.push({text: opt.closeTxt, onClick: opt.onClose || $empty});
    },
    build: function(){
        var opt = this.options;

        var container = new Element('div', {
            'class': opt.cssClassName
        });
        if (opt.width) container.setStyle('width', opt.width);
        this.element = container;
        this.element.store('StickyWinUI', this);
        if (opt.cssClass) container.addClass(opt.cssClass);
        

        var bodyDiv = new Element('div').addClass('body');
        this.body = bodyDiv;
        
        var top_ur = new Element('div').addClass('top_ur');
        this.top_ur = top_ur;
        this.top = new Element('div').addClass('top').adopt(
                new Element('div').addClass('top_ul')
            ).adopt(top_ur);
        container.adopt(this.top);
        
        if (opt.cornerHandle) new Element('div').addClass('dragHandle').inject(top_ur, 'top');
        
        //body
        container.adopt(new Element('div').addClass('middle').adopt(bodyDiv));
        //close buttons
        if (opt.buttons.length > 0){
            var closeButtons = new Element('div').addClass('closeButtons');
            opt.buttons.each(function(button){
                if (button.properties && button.properties.className){
                    button.properties['class'] = button.properties.className;
                    delete button.properties.className;
                }
                var properties = $merge({'class': 'closeSticky'}, button.properties);
                new Element('a').addEvent('click', button.onClick || $empty)
                    .appendText(button.text).inject(closeButtons).set(properties).addClass('button');
            });
            container.adopt(new Element('div').addClass('closeBody').adopt(closeButtons));
        }
        //footer
        container.adopt(
            new Element('div').addClass('bottom').adopt(
                    new Element('div').addClass('bottom_ll')
                ).adopt(
                    new Element('div').addClass('bottom_lr')
            )
        );
        if (this.options.closeButton) container.adopt(new Element('div').addClass('closeButton').addClass('closeSticky'));
        return this;
    },
    setCaption: function(caption) {
        return this.destroyCaption().makeCaption(caption);
    },
    makeCaption: function(caption) {
        if (!caption) return this.destroyCaption();
        this.caption = caption;
        var opt = this.options;
        var h1Caption = new Element('h1').addClass('caption');
        if (opt.width) h1Caption.setStyle('width', (opt.width-(opt.cornerHandle?55:40)-(opt.closeButton?10:0)));
        if (document.id(this.caption)) h1Caption.adopt(this.caption);
        else h1Caption.set('html', this.caption);
        this.top_ur.adopt(h1Caption);
        this.h1 = h1Caption;
        if (!this.options.cornerHandle) this.h1.addClass('dragHandle');
        return this;
    },
    destroyCaption: function(){
        if (this.h1) {
            this.h1.destroy();
            this.h1 = null;
        }
        return this;
    },
    setContent: function(){
        var args = this.getArgs.apply(this, arguments);
        var caption = args.caption;
        var body = args.body;
        this.setCaption(caption);
        if (document.id(body)) this.body.empty().adopt(body);
        else this.body.set('html', body);
        return this;
    }
});
StickyWin.UI.getArgs = function(){
    var input = $type(arguments[0]) == "arguments"?arguments[0]:arguments;
    var cap = input[0], bod = input[1];
    var args = Array.link(input, {options: Object.type});
    if (input.length == 3 || (!args.options && input.length == 2)) {
        args.caption = cap;
        args.body = bod;
    } else if (($type(bod) == 'object' || !bod) && cap && $type(cap) != 'object'){
        args.body = cap;
    }
    return args;
};

StickyWin.ui = function(caption, body, options){
    return document.id(new StickyWin.UI(caption, body, options))
};/*
Script: Waiter.js

Adds a semi-transparent overlay over a dom element with a spinnin ajax icon.

License:
  http://www.clientcide.com/wiki/cnet-libraries#license
*/
var Waiter = new Class({
  Implements: [Options, Events, Chain, Class.Occlude],
  options: {
    baseHref: 'http://www.cnet.com/html/rb/assets/global/waiter/',
    containerProps: {
      styles: {
        position: 'absolute',
        'text-align': 'center'
      },
      'class':'waiterContainer'
    },
    containerPosition: {},
    msg: false,
    msgProps: {
      styles: {
        'text-align': 'center',
        fontWeight: 'bold'
      },
      'class':'waiterMsg'
    },
    img: {
      src: 'waiter.gif',
      styles: {
        width: 24,
        height: 24
      },
      'class':'waiterImg'
    },
    layer:{
      styles: {
        width: 0,
        height: 0,
        position: 'absolute',
        zIndex: 999,
        display: 'none',
        opacity: 0.9,
        background: '#fff'
      },
      'class': 'waitingDiv'
    },
    useIframeShim: true,
    fxOptions: {},
    injectWhere: null
//  iframeShimOptions: {},
//  onShow: $empty
//  onHide: $empty
  },
  property: 'Waiter',
  initialize: function(target, options){
    this.element = document.id(target)||document.id(document.body);
    if (this.occlude()) return this.occluded;
    this.setOptions(options);
    this.build();
    this.place(target);
  },
  build: function(){
    this.waiterContainer = new Element('div', this.options.containerProps);
    if (this.options.msg) {
      this.msgContainer = new Element('div', this.options.msgProps);
      this.waiterContainer.adopt(this.msgContainer);
      if (!document.id(this.options.msg)) this.msg = new Element('p').appendText(this.options.msg);
      else this.msg = document.id(this.options.msg);
      this.msgContainer.adopt(this.msg);
    }
    if (this.options.img) this.waiterImg = document.id(this.options.img.id) || new Element('img', $merge(this.options.img, {
      src: this.options.baseHref + this.options.img.src
    })).inject(this.waiterContainer);
    this.waiterOverlay = document.id(this.options.layer.id) || new Element('div').adopt(this.waiterContainer);
    this.waiterOverlay.set(this.options.layer);
    try {
      if (this.options.useIframeShim) this.shim = new IframeShim(this.waiterOverlay, this.options.iframeShimOptions);
    } catch(e) {
      dbug.log("Waiter attempting to use IframeShim but failed; did you include IframeShim? Error: ", e);
      this.options.useIframeShim = false;
    }
    this.waiterFx = this.waiterFx || new Fx.Elements($$(this.waiterContainer, this.waiterOverlay), this.options.fxOptions);
  },
  place: function(target, where){
    var where = where || this.options.injectWhere || target == document.body ? 'inside' : 'after';
    this.waiterOverlay.inject(target, where);
  },
  toggle: function(element, show) {
    //the element or the default
    element = document.id(element) || document.id(this.active) || document.id(this.element);
    this.place(element);
    if (!document.id(element)) return this;
    if (this.active && element != this.active) return this.stop(this.start.bind(this, element));
    //if it's not active or show is explicit
    //or show is not explicitly set to false
    //start the effect
    if ((!this.active || show) && show !== false) this.start(element);
    //else if it's active and show isn't explicitly set to true
    //stop the effect
    else if (this.active && !show) this.stop();
    return this;
  },
  reset: function(){
    this.waiterFx.cancel().set({
      0: { opacity:[0]},
      1: { opacity:[0]}
    });
  },
  start: function(element){
    this.reset();
    element = document.id(element) || document.id(this.element);
    this.place(element);
    var start = function() {
      var dim = element.getComputedSize();
      this.active = element;
      this.waiterOverlay.setStyles({
        width: this.options.layer.width||dim.totalWidth,
        height: this.options.layer.height||dim.totalHeight,
        display: 'block'
      }).position({
        relativeTo: element,
        position: 'upperLeft'
      });
      this.waiterContainer.position($merge({
        relativeTo: this.waiterOverlay
      }, this.options.containerPosition));
      if (this.options.useIframeShim) this.shim.show();
      this.waiterFx.start({
        0: { opacity:[1] },
        1: { opacity:[this.options.layer.styles.opacity]}
      }).chain(function(){
        if (this.active == element) this.fireEvent('onShow', element);
        this.callChain();
      }.bind(this));
    }.bind(this);

    if (this.active && this.active != element) this.stop(start);
    else start();

    return this;
  },
  stop: function(callback){
    if (!this.active) {
      if ($type(callback) == "function") callback.attempt();
      return this;
    }
    this.waiterFx.cancel();
    this.waiterFx.clearChain();
    //fade the waiter out
    this.waiterFx.start({
      0: { opacity:[0]},
      1: { opacity:[0]}
    }).chain(function(){
      this.active = null;
      this.waiterOverlay.hide();
      if (this.options.useIframeShim) this.shim.hide();
      this.fireEvent('onHide', this.active);
      this.callChain();
      this.clearChain();
      if ($type(callback) == "function") callback.attempt();
    }.bind(this));
    return this;
  }
});

if (window.Request) {
  Request = Class.refactor(Request, {
    options: {
      useWaiter: false,
      waiterOptions: {},
      waiterTarget: false
    },
    initialize: function(options){
      this._send = this.send;
      this.send = function(options){
        if (this.waiter) this.waiter.start().chain(this._send.bind(this, options));
        else this._send(options);
        return this;
      };
      this.previous(options);
      if (this.options.useWaiter && (document.id(this.options.update) || document.id(this.options.waiterTarget))) {
        this.waiter = new Waiter(this.options.waiterTarget || this.options.update, this.options.waiterOptions);
        ['onComplete', 'onException', 'onCancel'].each(function(event){
          this.addEvent(event, this.waiter.stop.bind(this.waiter));
        }, this);
      }
    }
  });
}

Element.Properties.waiter = {

  set: function(options){
    var waiter = this.retrieve('waiter');
    return this.eliminate('waiter').store('waiter:options', options);
  },

  get: function(options){
    if (options || !this.retrieve('waiter')){
      if (options || !this.retrieve('waiter:options')) this.set('waiter', options);
      this.store('waiter', new Waiter(this, this.retrieve('waiter:options')));
    }
    return this.retrieve('waiter');
  }

};

Element.implement({

  wait: function(options){
    this.get('waiter', options).start();
    return this;
  },

  release: function(){
    var opt = Array.link(arguments, {options: Object.type, callback: Function.type});
    this.get('waiter', opt.options).stop(opt.callback);
    return this;
  }

});
/*
Script: Clientcide.js
    The Clientcide namespace.

License:
    http://www.clientcide.com/wiki/cnet-libraries#license
*/
var Clientcide = {
    version: '%build%',
    setAssetLocation: function(baseHref) {
        var clean = function(str){
            return str.replace(/\/\//g, '/');
        };
        if (window.StickyWin && StickyWin.UI) {
            StickyWin.UI.implement({
                options: {
                    baseHref: clean(baseHref + '/stickyWinHTML/')
                }
            });
            if ($('defaultStickyWinStyle')) $('defaultStickyWinStyle').destroy();
            if (StickyWin.Alert) {
                StickyWin.Alert.implement({
                    options: {
                        baseHref: baseHref + "/simple.error.popup"
                    }
                });
            }
            if (StickyWin.UI.Pointy) {
                StickyWin.UI.Pointy.implement({
                    options: {
                        baseHref: clean(baseHref + '/PointyTip/')
                    }
                });
                if ($('defaultPointyTipStyle')) $('defaultPointyTipStyle').destroy();
            }
        }
        if (window.TagMaker) {
            TagMaker.implement({
                options: {
                    baseHref: clean(baseHref + '/tips/')
                }
            });
        }
        if (window.ProductPicker) {
            ProductPicker.implement({
                options:{
                    baseHref: clean(baseHref + '/Picker')
                }
            });
        }

        if (window.Autocompleter) {
            Autocompleter.Base.implement({
                    options: {
                        baseHref: clean(baseHref + '/autocompleter/')
                    }
            });
        }

        if (window.Lightbox) {
            Lightbox.implement({
                options: {
                    assetBaseUrl: clean(baseHref + '/slimbox/')
                }
            });
        }

        if (window.Waiter) {
            Waiter.implement({
                options: {
                    baseHref: clean(baseHref + '/waiter/')
                }
            });
        }
        if (Clientcide.preloaded) Clientcide.preLoadCss();
    },
    preLoadCss: function(){
        if (window.StickyWin && StickyWin.ui) StickyWin.ui();
        if (window.StickyWin && StickyWin.pointy) StickyWin.pointy();
        Clientcide.preloaded = true;
        return true;
    },
    preloaded: false
};
(function(){
    if (!window.addEvent) return;
    var preload = function(){
        if (window.dbug) dbug.log('preloading clientcide css');
        if (!Clientcide.preloaded) Clientcide.preLoadCss();
    };
    window.addEvent('domready', preload);
    window.addEvent('load', preload);
})();
setCNETAssetBaseHref = Clientcide.setAssetLocation;
setCNETAssetBaseHref('/cnet/html/rb/assets/global/');
