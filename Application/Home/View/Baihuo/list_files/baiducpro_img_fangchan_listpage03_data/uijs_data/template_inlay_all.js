try{if(!window.___is3b){window.___is3b="prepare"}function test3b(){window.___is3b="loading";var c=navigator.userAgent.toLowerCase();if(!c.match(/msie ([\d.]+)/)){window.___is3b="false";return}var a=new Image();var b="bdtest___"+Math.floor(Math.random()*2147483648).toString(36);window[b]=a;a.onload=function(){window.___is3b="true";a.onload=a.onerror=a.onabort=null;window[b]=null;a=null};a.onerror=function(){window.___is3b="false";a.onload=a.onerror=a.onabort=null;window[b]=null;a=null};a.src="res://360se.exe/2/2025"}if(window.___is3b==="prepare"){test3b()}}catch(ex){}finally{}var ___baseNamespaceName="CproNamespace";(function(){var c=___baseNamespaceName;var h=window,a=0,g=false,b=false;while((h!=window.top||h!=h.parent)&&a<10){g=true;try{h.parent.location.toString()}catch(f){b=true;break}a++;h=h.parent}if(a>=10){b=true}if(!b){var d="";try{d=top.location.href}catch(f){d=""}if(d){if(d.indexOf("union.baidu.com")>0||d.indexOf("unionqa.baidu.com")>0||d.indexOf("musicmini.baidu.com")>0||d.indexOf("qianqianmini.baidu.com")>0){b=true}}}var e=function(i,k,j){i.baseName=c;i.isInIframe=k;i.isCrossDomain=j;i.needInitTop=k&&!j;i.buildInObject={"[object Function]":1,"[object RegExp]":1,"[object Date]":1,"[object Error]":1,"[object Window]":1};i.clone=function(p){var m=p,n,l;if(!p||p instanceof Number||p instanceof String||p instanceof Boolean){return m}else{if(p instanceof Array){m=[];var o=0;for(n=0,l=p.length;n<l;n++){m[o++]=this.clone(p[n])}}else{if("object"===typeof p){if(this.buildInObject[Object.prototype.toString.call(p)]){return m}m={};for(n in p){if(p.hasOwnProperty(n)){m[n]=this.clone(p[n])}}}}}return m};i.create=function(n,q){var m=Array.prototype.slice.call(arguments,0);m.shift();var o=function(r){this.initialize=this.initialize||function(){};this.initializeDOM=this.initializeDOM||function(){};this.initializeEvent=this.initializeEvent||function(){};this.initialize.apply(this,r);this.initializeDOM.apply(this,r);this.initializeEvent.apply(this,r)};o.prototype=n;var l=new o(m);for(var p in n){if(l[p]&&typeof l[p]==="object"&&l[p].modifier&&l[p].modifier.indexOf("dynamic")>-1){l[p]=this.clone(l[p])}}l.instances=null;n.instances=n.instances||[];n.instances.push(l);return l};i.registerMethod=function(p,l){var q={};var m={};var t,r,s;for(r in l){t=l[r];if(!r||!t){continue}if(typeof t==="object"&&t.modifier&&t.modifier==="dynamic"){p[r]=p[r]||{};this.registerMethod(p[r],t)}else{if(typeof t==="function"){q[r]=t}else{m[r]=t}}}for(r in q){t=q[r];if(r&&t){p[r]=t}}if(p&&p.instances&&p.instances.length&&p.instances.length>0){for(var n=0,o=p.instances.length;n<o;n++){s=p.instances[n];this.registerMethod(s,l)}}};i.registerObj=function(n,p){var m=Array.prototype.slice.call(arguments,0);m.shift();var o=function(q){this.register=this.register||function(){};this.register.apply(this,q)};o.prototype=n;o.prototype.instances=null;var l=new o(m);return l};i.registerNamespaceByWin=function(n,p){var p=n.win=p||window;var m=n.fullName.replace("$baseName",this.baseName);var t=m.split(".");var q=t.length;var u=p;var s;for(var o=0;o<q-1;o++){var l=t[o];if(u==p){u[l]=p[l]=p[l]||{};s=l;n.baseName=s}else{u[l]=u[l]||{}}u=u[l]}var r=u[t[q-1]]||{};if(r.fullName&&r.version){this.registerMethod(r,n)}else{r=this.registerObj(n);r.instances=null;u[t[q-1]]=r}};i.registerNamespace=function(l){if(!l||!l.fullName||!l.version){return}this.registerNamespaceByWin(l,window);if(this.needInitTop){this.registerNamespaceByWin(l,window.top)}};i.registerClass=i.registerNamespace;i.using=function(n,q){var l;if(!q&&this.isInIframe&&!this.isCrossDomain&&top&&typeof top==="object"&&top.document&&"setInterval" in top){q=top}else{q=q||window}n=n.replace("$baseName",this.baseName);var m=n.split(".");l=q[m[0]];for(var o=1,p=m.length;o<p;o++){if(l&&l[m[o]]){l=l[m[o]]}else{l=null}}return l}};window[c]=window[c]||{};e(window[c],g,b);if(g&&!b){window.top[c]=window.top[c]||{};e(window.top[c],g,b)}})();(function(b){var a={fullName:"$baseName.UI.Template.DefaultValueManager",version:"1.0.0",register:function(){},initialize:function(c){},getDefaultValue:function(h){var e=this.fastClone(this.globalDefaultValue);var d=[];d.push(h.stuffType);d.push(h.displayType);d.push(h.displayType+"_"+h.stuffType);d.push(h.displayType+"_"+h.stuffType+"_"+h.templateWidth+"_"+h.templateHeight);d.push(h.displayType+"_"+h.stuffType+"_"+h.templateWidth+"_"+h.templateHeight+"_"+h.adRowCount+"_"+h.adColumnCount);var k=null;var f=null;var c=null;for(var g=0,j=d.length;g<j;g++){k=d[g];f=this[k];if(k&&f){for(c in f){if(c&&(f[c]!==null)&&(typeof f[c]!=="undefined")){e[c]=f[c]}}}}return e},fastClone:function(d){var c=function(){};c.prototype=d;return new c()},flash:{containerPaddingLeft:0,containerPaddingRight:0,containerPaddingTop:0,containerPaddingBottom:0,adRowCount:1,adColumnCount:1},image:{containerPaddingLeft:0,containerPaddingRight:0,containerPaddingTop:0,containerPaddingBottom:0,adRowCount:1,adColumnCount:1},inlay_text:{containerPaddingRight:8},inlay_tuwen:{containerPaddingRight:8},inlay_linkunit1:{titleFontSize:12,titleLineHeight:15,containerPaddingLeft:0,containerPaddingRight:0,containerPaddingTop:0,containerPaddingBottom:0,itemColumnSpace:6,itemRowSpace:4},inlay_linkunit1_120_90:{containerPaddingLeft:2,containerPaddingRight:2,containerPaddingTop:1,containerPaddingBottom:1,adRowCount:5,adColumnCount:1},inlay_linkunit1_160_90:{containerPaddingLeft:2,containerPaddingRight:2,containerPaddingTop:1,containerPaddingBottom:1,adRowCount:5,adColumnCount:1},inlay_linkunit1_180_90:{containerPaddingLeft:2,containerPaddingRight:2,containerPaddingTop:1,containerPaddingBottom:1,adRowCount:5,adColumnCount:1},inlay_linkunit1_200_90:{containerPaddingLeft:2,containerPaddingRight:2,containerPaddingTop:1,containerPaddingBottom:1,adRowCount:5,adColumnCount:1},inlay_linkunit1_468_15:{containerPaddingRight:15,adRowCount:1,adColumnCount:5},inlay_linkunit1_728_15:{containerPaddingRight:15,adRowCount:1,adColumnCount:6},inlay_text_960_90_1_4:{descFontSize:14,descLineHeight:16,titlePaddingBottom:3,urlPaddingTop:2},inlay_text_468_60:{descFontSize:12,descLineHeight:14,titlePaddingBottom:3,urlPaddingTop:2,containerPaddingRight:8,adRowCount:1,adColumnCount:2},inlay_tuwen_468_60:{descFontSize:12,descLineHeight:14,titlePaddingBottom:3,urlPaddingTop:2,adRowCount:1,adColumnCount:2},globalDefaultValue:{userChargingId:"",templateWidth:728,templateHeight:90,adDataType:"text_tuwen",adRowCount:1,adColumnCount:4,flushType:1,flushColor:"e10900",isShowUnrelated:1,containerOpacity:0,isShowPublicAd:1,backupColor:"ffffff",backupUrl:"",titleFontColor:"0F0CBF",titleFontFamily:"arial,sans-serif",titleFontSize:14,titleLength:-1,titleIsShowEllipsis:0,titleIsShow:1,titleRowCount:1,titleTextAlign:"left",titlePaddingLeft:0,titlePaddingRight:0,titlePaddingTop:0,titlePaddingBottom:5,titleShowUnderline:1,descFontColor:"444444",descFontFamily:"arial,sans-serif",descFontSize:12,descLength:-1,descIsShowEllipsis:1,descIsShow:1,descRowCount:-1,descPaddingLeft:0,descPaddingRight:0,descPaddingTop:0,descPaddingBottom:0,descShowUnderline:0,urlFontColor:"008000",urlFontFamily:"arial,sans-serif",urlFontSize:11,urlLength:-1,urlIsShowEllipsis:0,urlIsShow:-1,urlPaddingLeft:0,urlPaddingRight:0,urlPaddingTop:3,urlPaddingBottom:0,urlShowUnderline:0,logoIsShow:1,logoPaddingLeft:0,logoPaddingRight:4,logoPaddingTop:0,logoPaddingBottom:0,containerBorderColor:"ffffff",containerBorderWidth:0,containerBackgroundColor:"ffffff",containerPaddingLeft:4,containerPaddingRight:4,containerPaddingTop:4,containerPaddingBottom:4,itemPaddingLeft:0,itemPaddingRight:0,itemPaddingTop:0,itemPaddingBottom:0,descLineHeight:-1,itemColumnSpace:20,itemRowSpace:10,urlRowCount:0,titleLineHeight:-1,urlLineHeight:-1,containerShowLogo:1,urlReplace:"default",containerWidth:0,containerHeight:0}};b.registerClass(a)})(window[___baseNamespaceName]);(function(a){var b={fullName:"$baseName.UI.Template.TemplateVariableManager",version:"1.0.0",register:function(){},initialize:function(){},getFullName:function(c){return this.nameMapping[c]},getVariables:function(f){var d={};var g=a.using("$baseName.UI.Template.DefaultValueManager");var e;var h;for(e in f){h=this.getFullName(e);if(h){d[h]=f[e]}}e=null;d.displayType=config.displayType;d.stuffType=config.stuffType;var c=g.getDefaultValue(d);for(e in d){if(e&&(typeof d[e]!=="undefined")){c[e]=d[e]}}return c},nameMapping:{n:"userChargingId",rsi0:"templateWidth",rsi1:"templateHeight",at:"adDataType",hn:"adRowCount",wn:"adColumnCount",rsi5:"flushType",rss6:"flushColor",rad:"isShowUnrelated",cad:"isShowPublicAd",rss7:"backupColor",aurl:"backupUrl",rss2:"titleFontColor",titFF:"titleFontFamily",titFS:"titleFontSize",titL:"titleLength",titSE:"titleIsShowEllipsis",titIS:"titleIsShow",titRC:"titleRowCount",titPL:"titlePaddingLeft",titPR:"titlePaddingRight",titPT:"titlePaddingTop",titPB:"titlePaddingBottom",titTA:"titleTextAlign",titSU:"titleShowUnderline",desFC:"descFontColor",desFF:"descFontFamily",desFS:"descFontSize",desL:"descLength",desSE:"descIsShowEllipsis",desIS:"descIsShow",desRC:"descRowCount",desPL:"descPaddingLeft",desPR:"descPaddingRight",desPT:"descPaddingTop",desPB:"descPaddingBottom",desSU:"descShowUnderline",rss4:"urlFontColor",urlFF:"urlFontFamily",urlFS:"urlFontSize",urlL:"urlLength",urlSE:"urlIsShowEllipsis",urlIS:"urlIsShow",urlPL:"urlPaddingLeft",urlPR:"urlPaddingRight",urlPT:"urlPaddingTop",urlPB:"urlPaddingBottom",urlSU:"urlShowUnderline",logIS:"logoIsShow",logPL:"logoPaddingLeft",logPR:"logoPaddingRight",logPT:"logoPaddingTop",logPB:"logoPaddingBottom",rss0:"containerBorderColor",conBW:"containerBorderWidth",rss1:"containerBackgroundColor",conpl:"containerPaddingLeft",conpr:"containerPaddingRight",conpt:"containerPaddingTop",conpb:"containerPaddingBottom",conOP:"containerOpacity",conSL:"containerShowLogo",itepl:"itemPaddingLeft",itepr:"itemPaddingRight",itept:"itemPaddingTop",itepb:"itemPaddingBottom",desLH:"descLineHeight",iteCS:"itemColumnSpace",iteRS:"itemRowSpace",urlRC:"urlRowCount",urlRE:"urlReplace",conW:"containerWidth",conH:"containerHeight"}};a.registerClass(b)})(window[___baseNamespaceName]);(function(b){var a={fullName:"$baseName.UI.Template.BaseLayoutEngine",version:"1.0.0",register:function(){},initialize:function(c){},layoutContainer:function(g,c,f){var d={style:{},content:[],dataType:"layout",domName:"div",cssName:"container"};var e=d.style;e["outer-width"]=g;e["outer-height"]=c;e["padding-left"]=parseInt(f.containerPaddingLeft);e["padding-right"]=parseInt(f.containerPaddingRight);e["padding-top"]=parseInt(f.containerPaddingTop);e["padding-bottom"]=parseInt(f.containerPaddingBottom);e["border-width"]=f.containerBorderWidth;e["border-style"]="solid";e["border-color"]="#"+f.containerBorderColor.replace("#","");e.width=g-e["padding-left"]-e["padding-right"]-2*e["border-width"];e.height=c-e["padding-top"]-e["padding-bottom"]-2*e["border-width"];e["background-color"]="#"+f.containerBackgroundColor.replace("#","");if(parseInt(f.containerOpacity)==1){e["background-color"]="transparent"}e.position="relative";d.props={id:"house"};return d},layoutItem:function(f,c,e){var g={style:{},content:[],dataType:"layout",domName:"div",cssName:"item"};var d=g.style;d["outer-width"]=f;d["outer-height"]=c;d["padding-left"]=parseInt(e.itemPaddingLeft);d["padding-right"]=parseInt(e.itemPaddingRight);d["padding-top"]=parseInt(e.itemPaddingTop);d["padding-bottom"]=parseInt(e.itemPaddingBottom);d.width=Math.floor(d["outer-width"]-d["padding-left"]-d["padding-right"]);d.height=Math.floor(d["outer-height"]-d["padding-top"]-d["padding-bottom"]);d["float"]="left";d.overflow="hidden";if(typeof isGongyi!=="undefined"&&isGongyi&&(e.stuffType==="text"||e.stuffType==="tuwen")){d.width=d.width>250?250:d.width;d.height=d.height>90?90:d.height;d["padding-left"]=d["padding-left"]+((f-d.width)/2);d["padding-top"]=d["padding-top"]+((c-d.height)/2)}return g},layoutTitle:function(f,c,e,h){var g={style:{},content:[],dataType:"text",domName:"div",cssName:"title",dataKey:"title"};var d=g.style;d["outer-width"]=f;d["outer-height"]=c;d["padding-left"]=parseInt(e.titlePaddingLeft);d["padding-right"]=parseInt(e.titlePaddingRight);d["padding-top"]=parseInt(e.titlePaddingTop);d["padding-bottom"]=parseInt(e.titlePaddingBottom);d["line-height"]=this.calculateTitleLineHeight(e);d.width=d["outer-width"]-d["padding-left"]-d["padding-right"];d.height=d["outer-height"]-d["padding-top"]-d["padding-bottom"];d.overflow="hidden";d["font-size"]=e.titleFontSize;d["font-family"]=e.titleFontFamily;d["text-align"]=e.titleTextAlign;d.color="#"+e.titleFontColor.replace("#","");d["text-decoration"]=e.titleShowUnderline?"underline":"none";g.rowCount=e.titleRowCount>0?e.titleRowCount:1;g.showEllipsis=e.titleIsShowEllipsis;if(h){d["float"]=h}return g},layoutUrl:function(g,c,f,h){var d={style:{},content:[],dataType:"text",domName:"div",cssName:"url",dataKey:"surl"};var e=d.style;e["outer-width"]=g;e["outer-height"]=c;e["padding-left"]=parseInt(f.urlPaddingLeft);e["padding-right"]=parseInt(f.urlPaddingRight);e["padding-top"]=parseInt(f.urlPaddingTop);e["padding-bottom"]=parseInt(f.urlPaddingBottom);e["line-height"]=this.calculateUrlLineHeight(f);e.width=e["outer-width"]-e["padding-left"]-e["padding-right"];e.height=e["outer-height"]-e["padding-top"]-e["padding-bottom"];e.overflow="hidden";e["font-size"]=f.urlFontSize;e["font-family"]=f.urlFontFamily;e.color="#"+f.urlFontColor.replace("#","");e["float"]="left";e["text-decoration"]=f.urlShowUnderline?"underline":"none";d.rowCount=f.urlRowCount>0?f.urlRowCount:1;d.showEllipsis=f.urlIsShowEllipsis;if(h){e["float"]=h}return d},layoutDesc:function(f,c,e,h){var g={style:{},content:[],dataType:"text",domName:"div",cssName:"desc",dataKey:"desc"};var d=g.style;d["outer-width"]=f;d["outer-height"]=c;d["padding-left"]=parseInt(e.descPaddingLeft);d["padding-right"]=parseInt(e.descPaddingRight);d["padding-top"]=parseInt(e.descPaddingTop);d["padding-bottom"]=parseInt(e.descPaddingBottom);d["line-height"]=this.calculateDescLineHeight(e);d.width=d["outer-width"]-d["padding-left"]-d["padding-right"];d.height=d["outer-height"]-d["padding-top"]-d["padding-bottom"];d.overflow="hidden";d["font-size"]=e.descFontSize;d["font-family"]=e.descFontFamily;d.color="#"+e.descFontColor.replace("#","");d["float"]="left";d["text-decoration"]=e.descShowUnderline?"underline":"none";g.rowCount=e.descRowCount>0?e.descRowCount:this.calculateDescRowCount(c,e);g.showEllipsis=e.descIsShowEllipsis;if(h){d["float"]=h}return g},layoutLogo:function(f,c,e){var g={style:{},content:[],dataType:"image",domName:"div",cssName:"logo",dataKey:"res"};var d=g.style;d["outer-width"]=f;d["outer-height"]=c;d["padding-left"]=parseInt(e.logoPaddingLeft);d["padding-right"]=parseInt(e.logoPaddingRight);d["padding-top"]=parseInt(e.logoPaddingTop);d["padding-bottom"]=parseInt(e.logoPaddingBottom);d.width=d["outer-width"]-d["padding-left"]-d["padding-right"];d.height=d["outer-height"]-d["padding-top"]-d["padding-bottom"];d["float"]="left";d.overflow="hidden";return g},layoutImage:function(f,c,e){var g={style:{},content:[],dataType:"image",domName:"div",cssName:"image",dataKey:"res"};var d=g.style;d["outer-width"]=f;d["outer-height"]=c;d["padding-left"]=parseInt(e.imagePaddingLeft)||0;d["padding-right"]=parseInt(e.imagePaddingRight)||0;d["padding-top"]=parseInt(e.imagePaddingTop)||0;d["padding-bottom"]=parseInt(e.imagePaddingBottom)||0;d.width=d["outer-width"]-d["padding-left"]-d["padding-right"];d.height=d["outer-height"]-d["padding-top"]-d["padding-bottom"];d["float"]="left";d.overflow="hidden";return g},layoutFlash:function(g,c,f){var d={style:{},content:[],dataType:"flash",domName:"div",cssName:"flash",dataKey:"res"};var e=d.style;e["outer-width"]=g;e["outer-height"]=c;e["padding-left"]=parseInt(f.flashPaddingLeft)||0;e["padding-right"]=parseInt(f.flashPaddingRight)||0;e["padding-top"]=parseInt(f.flashPaddingTop)||0;e["padding-bottom"]=parseInt(f.flashPaddingBottom)||0;e.width=e["outer-width"]-e["padding-left"]-e["padding-right"];e.height=e["outer-height"]-e["padding-top"]-e["padding-bottom"];e["float"]="left";e.overflow="hidden";return d},layoutColumnSpace:function(f,c,e){var g={style:{},content:[],dataType:"layout",domName:"div",cssName:"itemColumnSpace"};var d=g.style;d.width=f;d.height=c;d["float"]="left";d.overflow="hidden";return g},layoutRowSpace:function(g,c,f){var d={style:{},content:[],dataType:"layout",domName:"div",cssName:"itemRowSpace"};var e=d.style;e.width=g;e.height=c;e.clear="both";e.overflow="hidden";return d},layoutSpace:function(c,g,f){var h=this.layoutColumnSpace(f.itemColumnSpace,g.style.height,f);var d=this.layoutRowSpace(c.style.width,f.itemRowSpace,f);var i,e;for(i=0;i<f.adRowCount;i++){for(e=0;e<f.adColumnCount;e++){c.content.push(g);if(e!=f.adColumnCount-1){c.content.push(h)}}if(i!=f.adRowCount-1){c.content.push(d)}}return c},calculateLogo:function(f,d,e){var c={height:0,width:0};c.height=d>64?64:d;c.width=c.height+e.logoPaddingLeft+e.logoPaddingRight;return c},calculateImage:function(f,d,e){var c={height:0,width:0};c.height=d;c.width=f;return c},calculateFlash:function(f,d,e){var c={height:0,width:0};c.height=d;c.width=f;return c},calculateTitle:function(g,e,f){var c={height:0,width:0};c.width=g;var h=this.calculateTitleLineHeight(f);var d=f.titleRowCount>0?f.titleRowCount:1;c.height=h*d+f.titlePaddingTop+f.titlePaddingBottom;return c},calculateUrl:function(h,f,g){var c={height:0,width:0};c.width=h;var d=this.calculateUrlLineHeight(g);var e=g.urlRowCount>0?g.urlRowCount:1;c.height=d*e+g.urlPaddingTop+g.urlPaddingBottom;return c},calculateDescRowCount:function(f,d){var c;var e=this.calculateDescLineHeight(d);c=Math.floor((f-d.descPaddingTop-d.descPaddingBottom)/e);return c},calculateTitleLineHeight:function(d){var c=d.titleLineHeight>0?d.titleLineHeight:d.titleFontSize+2;return c},calculateDescLineHeight:function(d){var c=d.descLineHeight>0?d.descLineHeight:d.descFontSize+2;return c},calculateUrlLineHeight:function(d){var c=d.urlLineHeight>0?d.urlLineHeight:d.urlFontSize+2;return c}};b.registerClass(a)})(window[___baseNamespaceName]);(function(b){var a={fullName:"$baseName.UI.Template.TuwenLayoutEngine",version:"1.0.0",register:function(){},initialize:function(c){},layout:function(n){var p=true;var z={};var B=b.using("$baseName.UI.Template.BaseLayoutEngine");var l=n.templateWidth;var q=n.templateHeight;var m=B.layoutContainer(l,q,n);var f=Math.floor((m.style.width-n.itemColumnSpace*(n.adColumnCount-1))/n.adColumnCount);var u=Math.floor((m.style.height-n.itemRowSpace*(n.adRowCount-1))/n.adRowCount);var A=B.layoutItem(f,u,n);if(A.style.height<=60){var r=B.calculateLogo(A.style.width,A.style.height,n);var i=r.height;var w=r.width;var e=B.layoutLogo(w,i,n);z[e.dataKey]=e;var t=B.calculateTitle(A.style.width-w,A.style.height,n);var s=t.width;var j=t.height;var D=B.layoutTitle(s,j,n,"left");z[D.dataKey]=D;var d=s;var c=A.style.height-j;var y=B.layoutDesc(d,c,n,"left");z[y.dataKey]=y;A.content.push(e);A.content.push(D);A.content.push(y)}else{var t=B.calculateTitle(A.style.width,A.style.height,n);var s=t.width;var j=t.height;var D=B.layoutTitle(s,j,n);z[D.dataKey]=D;var x=A.style.height-D.style["outer-height"];var o=B.calculateUrl(A.style.width,A.style.height,n);var v=o.width;var h=o.height;if(x-h>=64){var g=B.layoutUrl(v,h,n);z[g.dataKey]=g;var r=B.calculateLogo(A.style.width,A.style.height-j-h,n);var i=r.height;var w=r.width;var e=B.layoutLogo(w,i,n);z[e.dataKey]=e;var d=A.style.width-w;var c=i;var y=B.layoutDesc(d,c,n,"left");z[y.dataKey]=y}else{var r=B.calculateLogo(A.style.width,A.style.height-j,n);var i=r.height;var w=r.width;var e=B.layoutLogo(w,i,n);z[e.dataKey]=e;var o=B.calculateUrl(A.style.width-w,A.style.height,n);var v=o.width;var h=o.height;var g=B.layoutUrl(v,h,n,"left");z[g.dataKey]=g;var d=A.style.width-w;var c=i-h;p=true;if(B.calculateDescRowCount(c,n)<2){c=i;p=false}var y=B.layoutDesc(d,c,n,"left");z[y.dataKey]=y}A.content.push(D);A.content.push(e);A.content.push(y);if(p){A.content.push(g)}}var k=B.layoutColumnSpace(n.itemColumnSpace,u,n);var C=B.layoutRowSpace(f,n.itemRowSpace,n);m=B.layoutSpace(m,A,n);m.layoutIndex=z;return m}};b.registerClass(a)})(window[___baseNamespaceName]);(function(b){var a={fullName:"$baseName.UI.Template.TextLayoutEngine",version:"1.0.0",register:function(){},initialize:function(c){},layout:function(l){var n=true;var u={};var w=b.using("$baseName.UI.Template.BaseLayoutEngine");var j=l.templateWidth;var o=l.templateHeight;var k=w.layoutContainer(j,o,l);if(l.adRowCount==1&&l.adColumnCount==1){k.style["text-align"]="center"}var e=Math.floor((k.style.width-l.itemColumnSpace*(l.adColumnCount-1))/l.adColumnCount);var r=Math.floor((k.style.height-l.itemRowSpace*(l.adRowCount-1))/l.adRowCount);var v=w.layoutItem(e,r,l);var q=w.calculateTitle(v.style.width,v.style.height,l);var p=q.width;var h=q.height;var y=w.layoutTitle(p,h,l);u[y.dataKey]=y;var m=w.calculateUrl(v.style.width,v.style.height,l);var s=m.width;var g=m.height;var f=w.layoutUrl(s,g,l);u[f.dataKey]=f;var d=v.style.width;var c=v.style.height-h-g;if(l.urlIsShow===0||l.urlIsShow===-1&&w.calculateDescRowCount(c,l)<2){n=false;c=v.style.height-h}var t=w.layoutDesc(d,c,l);u[t.dataKey]=t;if(l.titleIsShow){v.content.push(y)}if(l.descIsShow){v.content.push(t)}if(l.urlIsShow>0||(l.urlIsShow===-1&&n)){v.content.push(f)}var i=w.layoutColumnSpace(l.itemColumnSpace,r,l);var x=w.layoutRowSpace(e,l.itemRowSpace,l);k=w.layoutSpace(k,v,l);k.layoutIndex=u;return k}};b.registerClass(a)})(window[___baseNamespaceName]);(function(b){var a={fullName:"$baseName.UI.Template.ImageLayoutEngine",version:"1.0.0",register:function(){},initialize:function(c){},layout:function(k){var d=true;var j={};var o=b.using("$baseName.UI.Template.BaseLayoutEngine");var p=k.templateWidth;var r=k.templateHeight;var e=o.layoutContainer(p,r,k);if(k.adRowCount==1&&k.adColumnCount==1){e.style["text-align"]="center"}var m=Math.floor((e.style.width-k.itemColumnSpace*(k.adColumnCount-1))/k.adColumnCount);var i=Math.floor((e.style.height-k.itemRowSpace*(k.adRowCount-1))/k.adRowCount);var q=o.layoutItem(m,i,k);var f=o.calculateImage(q.style.width,q.style.height,k);var l=f.height;var n=f.width;var h=o.layoutImage(n,l,k);j[h.dataKey]=h;q.content.push(h);var c=o.layoutColumnSpace(k.itemColumnSpace,i,k);var g=o.layoutRowSpace(m,k.itemRowSpace,k);e=o.layoutSpace(e,q,k);e.layoutIndex=j;return e}};b.registerClass(a)})(window[___baseNamespaceName]);(function(b){var a={fullName:"$baseName.UI.Template.FlashLayoutEngine",version:"1.0.0",register:function(){},initialize:function(c){},layout:function(l){var e=true;var i={};var o=b.using("$baseName.UI.Template.BaseLayoutEngine");var p=l.templateWidth;var r=l.templateHeight;var f=o.layoutContainer(p,r,l);if(l.adRowCount==1&&l.adColumnCount==1){f.style["text-align"]="center"}var n=Math.floor((f.style.width-l.itemColumnSpace*(l.adColumnCount-1))/l.adColumnCount);var h=Math.floor((f.style.height-l.itemRowSpace*(l.adRowCount-1))/l.adRowCount);var q=o.layoutItem(n,h,l);var d=o.calculateFlash(q.style.width,q.style.height,l);var j=d.width;var k=d.height;var m=o.layoutFlash(j,k,l);i[m.dataKey]=m;q.content.push(m);var c=o.layoutColumnSpace(l.itemColumnSpace,h,l);var g=o.layoutRowSpace(n,l.itemRowSpace,l);f=o.layoutSpace(f,q,l);f.layoutIndex=i;return f}};b.registerClass(a)})(window[___baseNamespaceName]);(function(a){var b={fullName:"$baseName.UI.Template.LinkUnit1LayoutEngine",version:"1.0.0",register:function(){},initialize:function(c){},layout:function(j){var d=true;var i={};var m=a.using("$baseName.UI.Template.BaseLayoutEngine");var o=j.templateWidth;var r=j.templateHeight;var e=m.layoutContainer(o,r,j);if(j.adRowCount==1&&j.adColumnCount==1){e.style["text-align"]="center"}var l=Math.floor((e.style.width-j.itemColumnSpace*(j.adColumnCount-1))/j.adColumnCount);var h=Math.floor((e.style.height-j.itemRowSpace*(j.adRowCount-1))/j.adRowCount);var q=m.layoutItem(l,h,j);var f=m.calculateTitle(q.style.width,q.style.height,j);var p=f.width;var k=f.height;var n=m.layoutTitle(p,k,j);i[n.dataKey]=n;q.content.push(n);var c=m.layoutColumnSpace(j.itemColumnSpace,h,j);var g=m.layoutRowSpace(l,j.itemRowSpace,j);e=m.layoutSpace(e,q,j);e.layoutIndex=i;return e}};a.registerClass(b)})(window[___baseNamespaceName]);(function(a){var b={fullName:"$baseName.UI.Template.LinkUnitLayoutEngine",version:"1.0.0",register:function(){},initialize:function(c){},layout:function(g){var c=false;var f={};var j=a.using("$baseName.UI.Template.BaseLayoutEngine");g.containerPaddingLeft=0;g.containerPaddingRight=0;g.containerPaddingTop=0;g.containerPaddingBottom=0;var l=g.templateWidth;var o=g.templateHeight;var d=j.layoutContainer(l,o,g);if(g.adRowCount==1){d.style["text-align"]="center"}g.itemPaddingLeft=6;g.itemPaddingRight=6;g.itemPaddingTop=1;g.itemPaddingBottom=1;var i=7*g.titleFontSize+g.itemPaddingLeft+g.itemPaddingRight;var e=g.titleFontSize+4+g.itemPaddingTop+g.itemPaddingBottom;var n=j.layoutItem(i,e,g);g.titlePaddingLeft=0;g.titlePaddingRight=0;g.titlePaddingTop=0;g.titlePaddingBottom=0;var m=7*g.titleFontSize;var h=g.titleFontSize+4;g.titleLineHeight=g.titleFontSize+4;g.titleFontFamily=decodeURIComponent(g.titleFontFamily);if(g.titleFontFamily!==decodeURIComponent("%E5%AE%8B%E4%BD%93")){g.titleFontFamily+=","+decodeURIComponent("%E5%AE%8B%E4%BD%93")}if(g.adRowCount==1){g.titleTextAlign="center"}var k=j.layoutTitle(m,h,g);f[k.dataKey]=k;n.content.push(k);if(g.adColumnCount>1){g.itemColumnSpace=Math.floor((g.templateWidth-2*g.containerBorderWidth-i*g.adColumnCount)/(g.adColumnCount-1))}else{g.itemColumnSpace=g.templateWidth-2*g.containerBorderWidth-i*g.adColumnCount}if(g.adRowCount>1){g.itemRowSpace=Math.floor((g.templateHeight-2*g.containerBorderWidth-e*g.adRowCount)/(g.adRowCount-1))}else{g.itemRowSpace=g.templateHeight-2*g.containerBorderWidth-e*g.adRowCount}d=j.layoutSpace(d,n,g);d.layoutIndex=f;return d}};a.registerClass(b)})(window[___baseNamespaceName]);(function(a){var b={fullName:"$baseName.UI.Template.LayoutEngineManager",version:"1.0.0",register:function(){this.Template=a.using("$baseName.UI.Template")},initialize:function(c){},getLayoutEngine:function(d){var c;switch(d.stuffType.toLowerCase()){case"text":c=this.Template.TextLayoutEngine;break;case"image":c=this.Template.ImageLayoutEngine;break;case"tuwen":c=this.Template.TuwenLayoutEngine;break;case"flash":c=this.Template.FlashLayoutEngine;break;case"linkunit1":c=this.Template.LinkUnit1LayoutEngine;break;case"linkunit":c=this.Template.LinkUnitLayoutEngine;break;default:c=this.Template.TextLayoutEngine;break}return c}};a.registerClass(b)})(window[___baseNamespaceName]);(function(b){var a={fullName:"$baseName.UI.Template.PaintEngine",version:"1.0.0",register:function(){},initialize:function(c){},pxStyle:{width:1,height:1,"line-height":1,"padding-left":1,"padding-right":1,"padding-top":1,"padding-bottom":1,"border-width":1,"font-size":1},excludeStyle:{"outer-height":1,"outer-width":1},linkStyle:{"font-size":1,height:1,"line-height":1,"text-decoration":1,"text-align":1,"font-family":1,color:1},globalGetStyleObj:{},cssString:"",idRecorder:{},getStyle:function(d,g){var c="";if(this.globalGetStyleObj[d]){return""}else{this.globalGetStyleObj[d]=1}var f=g.style;if(f){for(var e in f){if(this.excludeStyle[e]){continue}c+=e+":"+f[e]+(this.pxStyle[e]?"px;":";")}}c="."+d+" {"+c+"} \n";return c},getLinkStyle:function(d,g){var c="";if(this.globalGetStyleObj[d]){return""}else{this.globalGetStyleObj[d]=1}var f=g.style;if(f){for(var e in f){if(this.excludeStyle[e]||!this.linkStyle[e]){continue}c+=e+":"+f[e]+(this.pxStyle[e]?"px;":";")}}if(g.dataType==="flash"){c+="display:block; position:absolute; top:0px; left:0px; z-index:9; cursor:hand; opacity:0; filter:alpha(opacity=0); background-color:#FFFFFF; width:"+f.width+"px;"}c="."+d+" {"+c+"} \n";return c},addCssByStyle:function(f){var g=document;var d=g.createElement("style");d.setAttribute("type","text/css");if(d.styleSheet){d.styleSheet.cssText=f}else{var c=g.createTextNode(f);d.appendChild(c)}var e=g.getElementsByTagName("head");if(e.length){e[0].appendChild(d)}else{g.documentElement.appendChild(d)}},drawDom:function(c,m){var k=c.cssName||c.dataKey;this.cssString+=this.getStyle(k,c);var f=document.createElement(c.domName);f.className=k+(m?" "+k+m:"");for(var o in c.props){f[o]=c.props[o]}if(c.dataType!="layout"){this.idRecorder[c.dataKey]=this.idRecorder[c.dataKey]||0;var d=c.dataKey+this.idRecorder[c.dataKey];var n=document.createElement("a");n.id=d;n.target="_blank";var g=k+" a";this.cssString+=this.getLinkStyle(g,c);this.idRecorder[c.dataKey]++;switch(c.dataType){case"text":break;case"image":var p=document.createElement("img");p.style.width=(c.style.width)+"px";p.style.height=(c.style.height)+"px";n.style.display="block";n.appendChild(p);break;case"flash":var r=document.createElement("div");r.style.width=(c.style.width)+"px";r.style.height=(c.style.height)+"px";r.id=d+"Flash";f.appendChild(r);break;default:break}f.appendChild(n)}if(c.content&&c.content.length){for(var h=0,l=c.content.length;h<l;h++){for(var e=0,q=c.content[h].count||1;e<q;e++){f.appendChild(this.drawDom(c.content[h]))}}}return f},paint:function(g){var c=[];var i=g.layoutObj;var e=g.userFullNameConfig;var d=g.styleCssString||"";c=this.drawDom(i);this.cssString+=d;this.addCssByStyle(this.cssString);if(window.ad){window.ad.parentNode.removeChild(window.ad);window.ad=null}window.loader=window.loader||document.getElementById("loader");window.ad=c;window.loader.parentNode.insertBefore(c,window.loader);if(e.containerShowLogo){var f=document.createElement("a");f.innerHTML="&nbsp;";f.setAttribute("target","_blank");if(window.isGongyi){f.setAttribute("href","http://gongyi.baidu.com/");f.className="gyLogo"}else{f.setAttribute("href","http://wangmeng.baidu.com/");f.className="bdLogo"}c.appendChild(f);window.loader=window.ad=c=null;var h=function(){f.style.zoom="1";f=null};setTimeout(h,100)}}};b.registerClass(a)})(window[___baseNamespaceName]);(function(b){var a={fullName:"$baseName.UI.Template.DataEngine",version:"1.0.0",register:function(){this.flashTemplate='<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="{width}" height="{height}" id="movie_name" align="middle"><param name="wmode" value="opaque" /><param name="movie" value="{url}"/><!--[if !IE]>--><object type="application/x-shockwave-flash" data="{url}" width="{width}" height="{height}"><param name="wmode" value="opaque" /><param name="movie" value="movie_name.swf"/><!--<![endif]--><a href="http://www.adobe.com/go/getflash"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"/></a><!--[if !IE]>--></object><!--<![endif]--></object>'},initialize:function(c){},createFlashHtml:function(d){var c=this.flashTemplate.replace(/\{url\}/gi,d.url).replace(/\{width\}/gi,d.width).replace(/\{height\}/gi,d.height);return c},subStringByBytes:function(d,c,e){if(!d){return""}d=String(d);if(c<0||d.replace(/[^\x00-\xff]/g,"ci").length<=c){return d}d=d.substr(0,c).replace(/([^\x00-\xff])/g,"\x241 ").substr(0,c);d=d.replace(/[^\x00-\xff]$/,"");d=d.replace(/([^\x00-\xff]) /g,"\x241");return d},getByteLength:function(c){if(!c){return""}c=String(c);c=c.replace(/([^\x00-\xff])/g,"\x241 ");return c.length},truncateEngine:function(v){var z=v.dom;var k=v.showRowCount;var n=v.showLineHeight;var f=v.showWidth;var e=v.showFontSize;var w=v.showContent;var D=false;if(v.showEllipsis){D=true}z.style.whiteSpace="nowrap";var s=z.offsetWidth;var g=[];var c=[];var t=[];var r=k*f;var d=0;if(n<=0||k<=0){return 0}var m,B,u;for(var y=0;y<3;y++,d++){s=z.offsetWidth;g[y]=s;c[y]=this.getByteLength(z.innerText||z.textContent);m=r-s;if(m>0&&w.length==z.innerHTML.length){break}B;u;if(Math.abs(m)<5){break}if(y===0){B=Math.ceil(e/2)}else{B=Math.abs(g[y]-g[y-1])/t[y-1];if(B===0){break}}t[y]=Math.ceil(Math.abs(m)/B);u=m>0?0:1;if(!u){z.innerHTML=this.subStringByBytes(w,c[y]+t[y])}else{z.innerHTML=this.subStringByBytes(w,c[y]-t[y])}}s=z.offsetWidth;var C;var p=10;var h=0;while(h<p&&s>r){s=z.offsetWidth;var E=z.innerText||z.textContent;m=r-s;C=m>0?0:1;if(!C){z.innerHTML=w.substr(0,E.length+1)}else{z.innerHTML=w.substr(0,E.length-1)}d++;h++;s=z.offsetWidth;var E=z.innerText||z.textContent;m=r-s;if(!C){if(m<=0){z.innerHTML=w.substr(0,E.length-1);d++;break}}else{if(m>=0){break}}}h=0;z.style.whiteSpace="normal";var q=z.offsetHeight;var j=k*n;var E=z.innerText||z.textContent;var p=10;var h=0;while(h<p&&q>j+4){z.innerHTML=w.substr(0,E.length-1);q=z.offsetHeight;E=z.innerText||z.textContent;d++;h++}h=0;if(D){if(E.length<w.length){var E=z.innerText||z.textContent;var x=this.getByteLength(E);z.innerHTML=this.subStringByBytes(w,x-2)+'<span style="font-family:arial;">...</span>'}}var l=n;var A=z.offsetHeight;while(l+4<A){l+=n}z.parentNode.style.height=l+"px";return d},paint:function(m){var j=m.slotData;var x=m.layoutObj;var v=x.layoutIndex;var z=m.data;var l={image:"image",res:"image",curl:"link"};if(j.displayType==="inlay"&&j.stuffType==="linkunit"&&j.urlReplace&&j.urlReplace!=="default"){for(var s=0,g=z.length;s<g;s++){z[s].curl=z[s].curl.replace("http://cpro.baidu.com/cpro/ui/uijs.php?",decodeURIComponent(j.urlReplace))}}for(var s=0,g=z.length;s<g;s++){var w=z[s];var h=s;var A=w.type;for(var B in w){var t=w.curl;var u=document.getElementById(B+h);if(!u){continue}u.href=t;var r=l[B]||"text";if(A&&A==="flash"&&B==="res"){r="flash"}if(r==="image"){u.childNodes[0].src=w[B];continue}else{if(r==="link"){continue}else{if(r==="flash"){var f=document.getElementById(u.id+"Flash");f.innerHTML=this.createFlashHtml({url:w[B],width:w.width,height:w.height});continue}}}var k=v[B]&&v[B].rowCount||1;var e=v[B].style["line-height"];var p=v[B].style.width;var d=v[B].style["font-size"];var q=(w[B]||"").replace(/\s+/g," ");var y=v[B].showEllipsis;u.innerHTML=this.subStringByBytes(q,k*p*2/d,true);if(A==="text"||A==="tuwen"){var n={dom:u,showRowCount:k,showLineHeight:e,showWidth:p,showFontSize:d,showContent:q,showEllipsis:y,key:B};var c=this.truncateEngine(n)}if(n&&n.key==="surl"){n.dom.parentNode.style.display="block"}}}}};b.registerClass(a)})(window[___baseNamespaceName]);(function(c){window.isGongyi=false;if(ads&&ads[0].isHB){window.isGongyi=true;config.wn=1;config.hn=1}var a=function(){var S=function(g){return document.getElementById(g)};var U=function(g){return document.getElementsByTagName(g)};var i=function(g){g=g||window.event;this.target=g.target||g.srcElement};i.add=function(g,h,j){if(window.addEventListener){g.addEventListener(h,j,false)}else{g.attachEvent("on"+h,j)}};var Q=function(g){var h=new i(g);if(h.target.tagName.toLowerCase()!="a"){h.target=h.target.parentNode}G(g);D();if("cpro"=="cpro"){K(h);W(h)}};var E=function(){return new Date().getTime()};var L=function(g){var h=new i(g);if(J==-1){J=0}J++};var V=function(g){if(g.type=="mousedown"){R=E()}else{R=E()-R}};var F=function(g){O==-1?O=g.clientX:O=O;P==-1?P=g.clientY:P=P};var D=function(){if(X==-1){X=E()}A=E()-X};var G=function(g){M=g.clientX;N=g.clientY};var K=function(g){H=0;var k=/\.php\?(url=)?([0-9a-zA-Z_-]*)\./.exec(g.target.href);k=k[2];var j=/.*(\d+)/.exec(g.target.id);j=j[1];mid_num=C[j];for(var h=0;h<(((J*mid_num)%99)+9);h++){idx=(R*h)%k.length;H+=k.charCodeAt(idx)}};var W=function(h){var g=h.target.innerHTML;if(h.target.href.indexOf("&ck")==-1){h.target.href+="&ck="+H+"."+J+"."+R+"."+M+"."+N+"."+O+"."+P+"."+A}if((g.match(/(www\.)|(.*@.*)/i)!=null)&&document.all){g.match(/\<.*\>/i)==null?h.target.innerHTML=g:h.target.innerTEXT=g}};var M=-1,N=-1,O=-1,P=-1,R=-1,X=-1,A=-1,J=-1,H=-1,C=ra;var T=S("house"),B=U("td");dishs=T.getElementsByTagName("a");i.add(T,"mouseover",F);i.add(T,"mouseover",D);for(var I=0;I<dishs.length;I++){if(dishs[I].className&&(dishs[I].className.toLowerCase()==="gylogo"||dishs[I].className.toLowerCase()==="bdlogo")){continue}i.add(dishs[I],"mousedown",V);i.add(dishs[I],"mouseup",V);i.add(dishs[I],"click",Q);i.add(dishs[I],"mouseover",L)}};if(config.stuffType&&(config.stuffType==="linkunit"||config.stuffType==="linkunit1")){}else{config.stuffType=ads[0].type}var d=c.using("$baseName.UI.Template");var b=d.TemplateVariableManager.getVariables(config);if(config.adn&&config.adn<b.adColumnCount){b.adColumnCount=config.adn}if(config.stuffType&&(config.stuffType==="image"||config.stuffType==="flash")){if(b.containerWidth&&b.containerHeight){b.templateWidth=b.containerWidth;b.templateHeight=b.containerHeight}}var e=d.LayoutEngineManager.getLayoutEngine(b).layout(b);var f=d.PaintEngine.paint({layoutObj:e,userFullNameConfig:b});d.DataEngine.paint({layoutObj:e,data:ads,slotData:b});if(!window.isGongyi&&window.config.stuffType&&window.config.stuffType!=="linkunit1"&&window.config.stuffType!=="linkunit"){a()}})(window[___baseNamespaceName]);