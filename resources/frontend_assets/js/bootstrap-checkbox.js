!function(e){var t=function(t,n,s){s&&(s.stopPropagation(),s.preventDefault()),this.$element=e(t),this.$newElement=null,this.button=null,this.label=null,this.labelPrepend=null,this.options=e.extend({},e.fn.checkbox.defaults,this.$element.data(),"object"==typeof n&&n),this.init()};t.prototype={constructor:t,init:function(e){this.$element.hide(),this.$element.attr("autocomplete","off"),this._createButtons()},_createButtons:function(){var e=void 0!==this.$element.attr("class")?this.$element.attr("class").split(/\s+/):"",t=this.getTemplate();this.$element.after(t),this.$newElement=this.$element.next(".bootstrap-checkbox"),this.button=this.$newElement.find("button"),this.label=this.$newElement.find("span.label-checkbox"),this.labelPrepend=this.$newElement.find("span.label-prepend-checkbox");for(var n=0;n<e.length;n++)"checkbox"!=e[n]&&this.$newElement.addClass(e[n]);this.button.addClass(this.options.buttonStyle),null!=this.$element.data("default-state")&&(this.options.defaultState=this.$element.data("default-state")),null!=this.$element.data("default-enabled")&&(this.options.defaultEnabled=this.$element.data("default-enabled")),null!=this.$element.data("display-as-button")&&(this.options.displayAsButton=this.$element.data("display-as-button")),this.options.indeterminate&&this.$element.prop("indeterminate",!0),this.checkEnabled(),this.checkChecked(),this.checkTabIndex(),this.clickListener()},getTemplate:function(){var e=this.options.displayAsButton?" displayAsButton":"",t=this.$element.data("label")?'<span class="label-checkbox">'+this.$element.data("label")+"</span>":"",n=this.$element.data("label-prepend")?'<span class="label-prepend-checkbox">'+this.$element.data("label-prepend")+"</span>":"",s='<span class="button-checkbox bootstrap-checkbox"><button type="button" class="btn clearfix'+e+'">'+(this.$element.data("label-prepend")&&this.options.displayAsButton?n:"")+'<span class="icon '+this.options.checkedClass+'" style="display:none;"></span><span class="icon '+this.options.uncheckedClass+'"></span><span class="icon '+this.options.indeterminateClass+'" style="display:none;"></span>'+(this.$element.data("label")&&this.options.displayAsButton?t:"")+"</button></span>";return this.options.displayAsButton||!this.$element.data("label")&&!this.$element.data("label-prepend")||(s='<label class="'+this.options.labelClass+'">'+n+s+t+"</label>"),s},checkEnabled:function(){this.button.attr("disabled",this.$element.is(":disabled")),this.$newElement.toggleClass("disabled",this.$element.is(":disabled"))},checkTabIndex:function(){if(this.$element.is("[tabindex]")){var e=this.$element.attr("tabindex");this.button.attr("tabindex",e)}},checkChecked:function(){var t=/\s/g;1==this.$element.prop("indeterminate")?(this.button.find("span."+this.options.checkedClass.replace(t,".")).hide(),this.button.find("span."+this.options.uncheckedClass.replace(t,".")).hide(),this.button.find("span."+this.options.indeterminateClass.replace(t,".")).show()):(this.$element.is(":checked")?(this.button.find("span."+this.options.checkedClass.replace(t,".")).show(),this.button.find("span."+this.options.uncheckedClass.replace(t,".")).hide()):(this.button.find("span."+this.options.checkedClass.replace(t,".")).hide(),this.button.find("span."+this.options.uncheckedClass.replace(t,".")).show()),this.button.find("span."+this.options.indeterminateClass.replace(t,".")).hide()),this.$element.is(":checked")?this.options.buttonStyleChecked&&(this.button.removeClass(this.options.buttonStyle),this.button.addClass(this.options.buttonStyleChecked)):this.options.buttonStyleChecked&&(this.button.removeClass(this.options.buttonStyleChecked),this.button.addClass(this.options.buttonStyle)),this.$element.is(":checked")?this.options.labelClassChecked&&e(this.$element).next("label").addClass(this.options.labelClassChecked):this.options.labelClassChecked&&e(this.$element).next("label").removeClass(this.options.labelClassChecked)},clickListener:function(){var e=this;this.button.on("click",function(t){t.preventDefault(),e.$element.prop("indeterminate",!1),e.$element[0].click(),e.checkChecked()}),this.$element.on("change",function(t){e.checkChecked()}),this.$element.parents("form").on("reset",function(t){null==e.options.defaultState?e.$element.prop("indeterminate",!0):e.$element.prop("checked",e.options.defaultState),e.$element.prop("disabled",!e.options.defaultEnabled),e.checkEnabled(),e.checkChecked(),t.preventDefault()})},setOptions:function(e,t){null!=e.checked&&this.setChecked(e.checked),null!=e.enabled&&this.setEnabled(e.enabled),null!=e.indeterminate&&this.setIndeterminate(e.indeterminate)},setChecked:function(e){this.$element.prop("checked",e),this.$element.prop("indeterminate",!1),this.checkChecked()},setIndeterminate:function(e){this.$element.prop("indeterminate",e),this.checkChecked()},click:function(e){this.$element.prop("indeterminate",!1),this.$element[0].click(),this.checkChecked()},change:function(e){this.$element.change()},setEnabled:function(e){this.$element.attr("disabled",!e),this.checkEnabled()},toggleEnabled:function(e){this.$element.attr("disabled",!this.$element.is(":disabled")),this.checkEnabled()},refresh:function(e){this.checkEnabled(),this.checkChecked()},update:function(t){this.$element.next().find(".bootstrap-checkbox")&&(this.options=e.extend({},this.options,t),this.$element.next().remove(),this._createButtons())}},e.fn.checkbox=function(n,s){return this.each(function(){var i=e(this),l=i.data("checkbox"),a="object"==typeof n&&n;l?"string"==typeof n?l[n](s):void 0!==n&&l.setOptions(n,s):(i.data("checkbox",l=new t(this,a,s)),null!=l.options.constructorCallback&&l.options.constructorCallback(l.$element,l.button,l.label,l.labelPrepend))})},e.fn.checkbox.defaults={displayAsButton:!1,indeterminate:!1,buttonStyle:"btn-link",buttonStyleChecked:null,checkedClass:"cb-icon-check",uncheckedClass:"cb-icon-check-empty",indeterminateClass:"cb-icon-check-indeterminate",defaultState:!1,defaultEnabled:!0,constructorCallback:null,labelClass:"checkbox bootstrap-checkbox",labelClassChecked:"active"}}(window.jQuery);