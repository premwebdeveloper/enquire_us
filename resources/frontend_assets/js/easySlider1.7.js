!function(t){t.fn.easySlider=function(e){e=t.extend({prevId:"prevBtn",prevText:"",nextId:"nextBtn",nextText:"",controlsShow:!0,controlsBefore:"",controlsAfter:"",controlsFade:!0,firstId:"firstBtn",firstText:"First",firstShow:!1,lastId:"lastBtn",lastText:"Last",lastShow:!1,vertical:!1,speed:800,auto:!1,pause:2e3,continuous:!1,numeric:!1,numericId:"controls"},e);this.each(function(){var a=t(this),i=t("li",a).length,n=t("li",a).width(),r=362,s=!0;a.width(n),a.height(r),a.css("overflow","hidden");var o,c=i-1,l=0;if(t("ul",a).css("width",i*n),e.continuous&&(t("ul",a).prepend(t("ul li:last-child",a).clone().css("margin-left","-"+n+"px")),t("ul",a).append(t("ul li:nth-child(2)",a).clone()),t("ul",a).css("width",(i+1)*n)),e.vertical||t("li",a).css("float","left"),e.controlsShow){var d=e.controlsBefore;e.numeric?d+='<ol id="'+e.numericId+'"></ol>':(e.firstShow&&(d+='<span id="'+e.firstId+'"><a href="javascript:void(0);">'+e.firstText+"</a></span>"),d+=' <span id="'+e.prevId+'"><a href="javascript:void(0);">'+e.prevText+"</a></span>",d+=' <span id="'+e.nextId+'"><a href="javascript:void(0);">'+e.nextText+"</a></span>",e.lastShow&&(d+=' <span id="'+e.lastId+'"><a href="javascript:void(0);">'+e.lastText+"</a></span>")),d+=e.controlsAfter,t(a).after(d)}if(e.numeric)for(var u=0;u<i;u++)t(document.createElement("li")).attr("id",e.numericId+(u+1)).html("<a rel="+u+' href="javascript:void(0);">'+(u+1)+"</a>").appendTo(t("#"+e.numericId)).click(function(){v(t("a",t(this)).attr("rel"),!0)});else t("a","#"+e.nextId).click(function(){v("next",!0)}),t("a","#"+e.prevId).click(function(){v("prev",!0)}),t("a","#"+e.firstId).click(function(){v("first",!0)}),t("a","#"+e.lastId).click(function(){v("last",!0)});function f(a){a=parseInt(a)+1,t("li","#"+e.numericId).removeClass("current"),t("li#"+e.numericId+a).addClass("current")}function h(){l>c&&(l=0),l<0&&(l=c),e.vertical?t("ul",a).css("margin-left",l*r*-1):t("ul",a).css("margin-left",l*n*-1),s=!0,e.numeric&&f(l)}function v(i,d){if(s){s=!1;var u=l;switch(i){case"next":l=u>=c?e.continuous?l+1:c:l+1;break;case"prev":l=l<=0?e.continuous?l-1:0:l-1;break;case"first":l=0;break;case"last":l=c;break;default:l=i}var f=Math.abs(u-l),I=f*e.speed;e.vertical?(p=l*r*-1,t("ul",a).animate({marginTop:p},{queue:!1,duration:I,complete:h})):(p=l*n*-1,t("ul",a).animate({marginLeft:p},{queue:!1,duration:I,complete:h})),!e.continuous&&e.controlsFade&&(l==c?(t("a","#"+e.nextId).hide(),t("a","#"+e.lastId).hide()):(t("a","#"+e.nextId).show(),t("a","#"+e.lastId).show()),0==l?(t("a","#"+e.prevId).hide(),t("a","#"+e.firstId).hide()):(t("a","#"+e.prevId).show(),t("a","#"+e.firstId).show())),d&&clearTimeout(o),e.auto&&"next"==i&&!d&&(o=setTimeout(function(){v("next",!1)},f*e.speed+e.pause))}}e.auto&&(o=setTimeout(function(){v("next",!1)},e.pause)),e.numeric&&f(0),!e.continuous&&e.controlsFade&&(t("a","#"+e.prevId).hide(),t("a","#"+e.firstId).hide())})}}(jQuery);