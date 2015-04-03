;
/* AGGREGATED JS FILE: files/cs_bluekai/bluekai.js */

if(typeof BKPL=="undefined"||!BKPL){var BKPL=(function(){var l="http://tags.bluekai.com/pl";var g=/msie/.test(navigator.userAgent.toLowerCase());var f=-1;var o=-1;var i=-1;var n=-1;var k=-1;var d=[];var b=null;var h=false;var c=0;var e={};var a=0;var j={timestamp:function(){var p=new Date();return p.getTime()},shouldBeacon:function(){var p=j.timestamp()-b;var q=Math.random();if(p<=n){return q<=f}else{if(p<=k){return q<=o}else{return q<=i}}}};var m={init:function(p){b=j.timestamp();f=p.gp;o=p.bp;i=p.up;n=p.bt;k=p.ut;if(p.url){l=p.url}var r=p.pids;c=r.length;for(var q=0;q<c;q++){e[r[q]]=false}setTimeout(function(){m.cancelLoadingPixels();m.beacon()},k)},mark:function(q,p){var r=p?b-1:j.timestamp();d.push([q,r])},beacon:function(){if(h){return}h=true;if(!j.shouldBeacon()){return}var u=[];var s=d.length;for(var r=0;r<s;r++){var t=d[r];var v=t[1]-b;u.push(encodeURIComponent(t[0])+"="+v)}var q=document.createElement("img");q.src=l+"?"+u.join("&");document.body.appendChild(q)},pl:function(r,q){if(g&&r.srcElement.readyState!="complete"){return}var p=q.getAttribute("pid");e[p]=true;m.mark(p);a++;if(a>=c){m.beacon()}},cancelLoadingPixels:function(){var t=document.getElementsByTagName("img");var s=t.length;for(var r=0;r<s;r++){var q=t[r];var p=q.getAttribute("pid");if(e[p]===false){q.src="";m.mark(p,true)}}}};return m})()}if(typeof BKTAG=="undefined"||!BKTAG){var BKTAG=(function(){var d=[];var b=false;var c={getKwds:function(){var h=document.getElementsByTagName("meta");var e=[];var g=h.length;for(var f=0;f<g;f++){if(h[f].name=="keywords"){e.push(h[f].content)}}return e.join(",")},addBkParam:function(f,e){a.addParam("phint","__bk_"+f,e)}};var a={_dest:null,doTag:function(h,f,g,j,e){if(b&&!(e===true)){return}b=true;var i=!(typeof j==="undefined"||j===null);if(!g){c.addBkParam("t",document.title);c.addBkParam("k",c.getKwds())}d.unshift("ret=html");if(i){d.unshift("partner="+j)}d.push("limit="+f);d.push("r="+parseInt(Math.random()*99999999));a._dest="http://tags.bluekai.com/"+(i?"psite":"site")+"/"+h+"?"+d.join("&");frames.__bkframe.location.replace(a._dest);d=[]},addParam:function(g,f,e){if(e){d.push(g+"="+encodeURIComponent(f+"="+e))}},_reset:function(){b=false;d=[]}};return a})();function bk_addPageCtx(b,a){BKTAG.addParam("phint",b,a)}function bk_addUserCtx(b,a){BKTAG.addParam("phint",b,a)}function bk_doJSTag(c,b,a){BKTAG.doTag(c,b,false,null,a)}function bk_doJSTag2(b,a){BKTAG.doTag(b,a)}function bk_doCarsJSTag(b,a){BKTAG.doTag(b,a,true)}function bk_doPartnerAltTag(b,a,c){if(typeof c==="undefined"||c===null){c=0}BKTAG.doTag(b,a,false,c)}};
;
/* AGGREGATED JS FILE: sites/all/modules/csearch/campaignmonitor/campaignmonitor_jgrowl.js */

$(document).ready(function(){$('div.jGrowl-notification div.close').click(function(){$("#campaignmonitor-general-form").show();});$('#campaignmonitor-general-form').submit(function(){$('#newsletterSubmitMsg').removeClass('jError');$('#newsletterSubmitMsg').removeClass('jWarning');$('#newsletterSubmitMsg').removeClass('jSuccess');var from=$("#campaignmonitor-general-form input[@name='email']").val();var hasError=false;var emailReg=/^((\w|\-|\_|\.|\+)+\@((\w|\-|\_)+\.)+[a-zA-Z]{2,})$/;if(from==''){$('#newsletterSubmitMsg').jGrowl("Please enter your email address.",{glue:'before',speed:'slow',life:5000}).addClass('jError');hasError=true;}
else if(!emailReg.test(from)){$('#newsletterSubmitMsg').jGrowl("Please enter a valid email address.",{glue:'before',speed:'slow',life:5000}).addClass('jError');hasError=true;}
if(hasError==false){$("#newsletterSubmitLoader").show();var str=$("form#campaignmonitor-general-form").serialize();$.ajax({url:"/_campaignmonitor_submit",dataType:"html",type:"POST",data:str,error:function(xhr,desc,e){$("#newsletterSubmitLoader").hide();$('#newsletterSubmitMsg').jGrowl(desc,{glue:'before',speed:'slow',life:10000}).addClass('jError');},success:function(r){var errReg=new RegExp("ERROR");if(!errReg.test(r)){var warReg=new RegExp("WARNING");if(!warReg.test(r)){$("#campaignmonitor-general-form").fadeTo("slow",0.5);$("#newsletterSubmitLoader").hide();$('#newsletterSubmitMsg').jGrowl(r,{glue:'before',speed:'slow',life:15000}).addClass('jSuccess');setInterval(function(){$("#campaignmonitor-general-form").fadeTo("slow",1);},16000);urchinTracker("/events/newsletter_subscribe");}
else{var warMsg=r.replace(/^WARNING: /,'');$("#newsletterSubmitLoader").hide();$('#newsletterSubmitMsg').jGrowl(warMsg,{glue:'before',speed:'slow',life:10000}).addClass('jWarning');}}
else{var errMsg=r.replace(/^ERROR: /,'');$("#newsletterSubmitLoader").hide();$('#newsletterSubmitMsg').jGrowl(errMsg,{glue:'before',speed:'slow',life:10000}).addClass('jError');}}});}
return false;});});
;
/* AGGREGATED JS FILE: sites/all/themes/zen/csnew/public/js/submenuToggle.js */

$(document).ready(function(){var config={sensitivity:7,interval:100,over:makeMenuShow,timeout:300,out:makeMenuHide};$('li.full_report').hoverIntent(config);});function makeMenuShow(){$("ul.submenu-flyout").show();}
function makeMenuHide(){$("ul.submenu-flyout").hide();}
;
/* AGGREGATED JS FILE: sites/all/themes/zen/csnew/public/js/submenuTogglePrimary.js */

$(document).ready(function(){var config={sensitivity:7,interval:100,over:makeSubMenuShow,timeout:200,out:makeSubMenuHide};$('ul.primary-links > li').hoverIntent(config);});$(window).load(function(){if($('body').hasClass('page-popup')){return;}
var pos=$('#header ul.primary-links').position();var adminoffset=20;var iphonehomeoffset=0;var pageoffset=0;if($('html').hasClass('iphone')){iphonehomeoffset=36;}
if($('html').hasClass('safari')){pageoffset=0;}
if($('html').hasClass('chrome')){pageoffset=0;}
$('div.primary-submenu-home').css({"display":"block","top":(pos.top+pageoffset)+"px"});$('div.primary-submenu-home-admin').css({"display":"block","top":(pos.top+adminoffset+iphonehomeoffset+pageoffset)+"px"});$('div.primary-submenu-inside').css({"display":"block","top":(pos.top+pageoffset)+"px"});$('div.primary-submenu-inside-admin').css({"display":"block","top":(pos.top+adminoffset+pageoffset)+"px"});});function makeSubMenuShow(){$(this).children('a').addClass('hover');$(this).children('div.submenu-flyout').css("display","block");}
function makeSubMenuHide(){$(this).children('a').removeClass('hover');$(this).children('div.submenu-flyout').css("display","none");}
;
/* AGGREGATED JS FILE: sites/all/themes/zen/csnew/public/js/breakwords.js */

$(document).ready(function(){$("div.adsense").find('span.site').breakWords();});
;
/* AGGREGATED JS FILE: sites/all/themes/zen/csnew/public/js/cs.js */

var share_tools_timeout;$(document).ready(function(){$(".full_story_intro .nestedright").next('p').addClass('justify');$(".full_story_intro .nestedright").next('p').next('p').addClass('justify');$('#share_tools_li,#share_tools').hover(function(){clearTimeout(share_tools_timeout);$('#share_tools').show();},function(){share_tools_timeout=setTimeout("$('#share_tools').fadeOut('fast');",100);});$('.review-sdc a.right-icon').click(function(){setTimeout(function(){window.close(self);},2000);});setTimeout(function(){$(".adsense style").each(function(i){$(this).html(this.innerHTML.replace(/<!--(.*)-->/g,""));});},200);});function launchdetailswindow(url){window.open(url,"Details","width=460,height=540,location=0,menubar=0,resizable=0,scrollbars=1,status=0,titlebar=1,toolbar=0");}
;
/* AGGREGATED JS FILE: sites/all/themes/zen/csnew/public/js/hitslink.js */

wa_account="consumersearch";wa_location=14;wa_pageName=location.pathname;document.cookie='__support_check=1; path=/';wa_hp='http';wa_rf=document.referrer;wa_sr=window.location.search;wa_tz=new Date();if(location.href.substr(0,6).toLowerCase()=='https:')
wa_hp='https';wa_data='&an='+escape(navigator.appName)+'&sr='+escape(wa_sr)+'&ck='+document.cookie.length+'&rf='+escape(wa_rf)+'&sl='+escape(navigator.systemLanguage)+'&av='+escape(navigator.appVersion)+'&l='+escape(navigator.language)+'&pf='+escape(navigator.platform)+'&pg='+escape(wa_pageName);wa_data=wa_data+'&cd='+
screen.colorDepth+'&rs='+escape(screen.width+' x '+screen.height)+'&tz='+wa_tz.getTimezoneOffset()+'&je='+navigator.javaEnabled();wa_img=new Image();wa_img.src=wa_hp+'://counter.hitslink.com/statistics.asp'+'?v=1&s='+wa_location+'&acct='+wa_account+wa_data+'&tks='+wa_tz.getTime();document.getElementById('wa_u').src=wa_hp+'://counter.hitslink.com/track.js';
;
/* AGGREGATED JS FILE: sites/all/themes/zen/csnew/public/js/adtracker.js */

var utProductPrefix="P_";var utCategoryPrefix="C_";var utRetailerPrefix="R_";var utAdPositionPrefix="S_";var utEcommPrefix="E_";var utVariableDelimiter="-ut";var utSpaceDelimiter="_";var utAdClassName="ad";if(typeof window.attachEvent!='undefined')
{window.attachEvent('onload',ut_ad_init);}
else if(typeof window.addEventListener!='undefined')
{window.addEventListener('load',ut_ad_init,false);}
else if(typeof document.addEventListener!='undefined')
{document.addEventListener('load',ut_ad_init,false);}
else
{if(typeof window.onload=='function')
{var ut_existing=onload;window.onload=function()
{ut_existing();ut_ad_init();};}
else
{window.onload=ut_ad_init;}}
function ut_ad_init(){if(document.all){var ut_el=document.getElementsByTagName("iframe");for(var i=0;i<ut_el.length;i++){ut_el[i].onfocus=ut_ad_click;}}
else{window.addEventListener('beforeunload',ut_doPageExit,false);window.addEventListener('mousemove',ut_getMouse,true);}
var ut_anchors=document.getElementsByTagName("a");for(var i=0;i<ut_anchors.length;i++){if(ut_anchors[i].parentNode.className.search(/^dsq-/)>-1)continue;if(ut_anchors[i].parentNode.parentNode.className.search(/^dsq-/)>-1)continue;if(ut_anchors[i].className.search(/^addthis/)>-1)continue;if(ut_anchors[i].parentNode.className.search(/^addthis_toolbox/)>-1)continue;if(ut_anchors[i].parentNode.parentNode.className.search(/^addthis/)>-1)continue;ut_anchors[i].onclick=ut_ad_click;}}
function ut_ad_click(e){var e=(e)?e:((window.event)?window.event:null);if(e){var ut_targ=(e.target)?e.target:e.srcElement;var ut_product;var ut_category;var ut_retailer;var ut_position;var ut_ecomm;var ut_adElement;var ut_productDivFound=false;var ut_curr=ut_targ;while(ut_productDivFound!=true){if(!(ut_adElement)&&(ut_curr.tagName=="A"||ut_curr.tagName=="IFRAME"||ut_curr.tagName=="a"||ut_curr.tagName=="iframe")){ut_adElement=ut_curr;}
if(typeof ut_curr.getAttribute!='undefined'){if(ut_curr.getAttribute("class")==utAdClassName||ut_curr.getAttribute("className")==utAdClassName){ut_productDivFound=true;break;}
else if(ut_curr.parentNode){ut_curr=ut_curr.parentNode;}
else{break;}}else{break;}}
if(ut_adElement.src){if(ut_adElement.src.indexOf('googleads.g.doubleclick.net')>-1){ut_retailer="adsense_AFC";}
else if(ut_adElement.src.indexOf('google.com/aclk')>-1){ut_retailer="adsense_AFS";}
else if(ut_adElement.src.indexOf('googlesyndication.com')>-1){ut_retailer="adsense";}
else if(ut_adElement.src.indexOf('rcm.amazon.com')>-1){ut_retailer="amazon";}
else if(ut_adElement.src.indexOf('shopping.com')>-1){ut_retailer="shopping";}
else if(ut_adElement.src.indexOf('nextag.com')>-1){ut_retailer="nextag";}
else if(ut_adElement.src.indexOf('chitika.net')>-1){ut_retailer="chitika";}
else if(ut_adElement.src.indexOf('sears')>-1){ut_retailer="sears.com";}
else if(ut_adElement.src.indexOf('smooth')>-1){ut_retailer="smooth_fitness";}
else if(ut_adElement.src.indexOf('alerg')>-1){ut_retailer="alerg.com";}
else if(ut_adElement.src.indexOf('aucourant')>-1){ut_retailer="aucourant.com";}
else if(ut_adElement.src.indexOf('bradard')>-1){ut_retailer="buyradardetectors.com";}
else if(ut_adElement.src.indexOf('discounttire')>-1){ut_retailer="discounttire.com";}
else if(ut_adElement.src.indexOf('usmattress')>-1){ut_retailer="usmattress.com";}
else if(ut_adElement.src.indexOf('blendersnet')>-1){ut_retailer="blenders.net";}
else if(ut_adElement.src.indexOf('amazonwtbtop')>-1){ut_retailer="amazonwtbtop";}
else if(ut_adElement.src.indexOf('tumri.net')>-1){ut_retailer="tumri";}
else if(ut_adElement.src.indexOf('overture.com')>-1){ut_retailer="yahoo";}
else{return;}}
else if(ut_adElement.href){if(ut_adElement.href.indexOf('shopping.com')>-1){ut_retailer="shopping";}
else if(ut_adElement.href.indexOf('googleads.g.doubleclick.net')>-1){ut_retailer="adsense_AFC";}
else if(ut_adElement.href.indexOf('google.com/aclk')>-1){ut_retailer="adsense_AFS";}
else if(ut_adElement.href.indexOf('googlesyndication.com')>-1){ut_retailer="adsense";}
else if(ut_adElement.href.indexOf('dealtime.com')>-1){ut_retailer="shopping";}
else if(ut_adElement.href.indexOf('qksrv.net')>-1){ut_retailer="ebay";}
else if(ut_adElement.href.indexOf('bizrate.com')>-1){ut_retailer="bizrate";}
else if(ut_adElement.href.indexOf('amazon.com')>-1){ut_retailer="amazon";}
else if(ut_adElement.href.indexOf('wPsMnBj7j')>-1&&ut_adElement.href.indexOf('64951')>-1){ut_retailer="walmart";}
else if(ut_adElement.href.indexOf('findwhat')>-1){ut_retailer="miva";}
else if(ut_adElement.href.indexOf('become.com')>-1){ut_retailer="become";}
else{return;}}
else{return;}
if(ut_productDivFound==true){var urchinTrackerString;var ut_adDivId;if(ut_curr.getAttribute("id")){ut_adDivId=ut_curr.getAttribute("id");}
else if(ut_curr.id!=null){ut_adDivId=ut_curr.id;}
var ut_varArray=ut_adDivId.split(utVariableDelimiter);for(i=0;i<ut_varArray.length;i++){var ut_tempVar=""+ut_varArray[i];if(ut_tempVar.indexOf(utProductPrefix)!=-1){ut_product=ut_tempVar.substring(ut_tempVar.indexOf(utProductPrefix)+utProductPrefix.length);}
else if(ut_tempVar.indexOf(utCategoryPrefix)!=-1){ut_category=ut_tempVar.substring(ut_tempVar.indexOf(utCategoryPrefix)+utCategoryPrefix.length);}
else if(ut_tempVar.indexOf(utRetailerPrefix)!=-1){ut_retailer=ut_tempVar.substring(ut_tempVar.indexOf(utRetailerPrefix)+utRetailerPrefix.length);}
else if(ut_tempVar.indexOf(utAdPositionPrefix)!=-1){ut_position=ut_tempVar.substring(ut_tempVar.indexOf(utAdPositionPrefix)+utAdPositionPrefix.length);}
else if(ut_tempVar.indexOf(utEcommPrefix)!=-1){ut_ecomm=ut_tempVar.substring(ut_tempVar.indexOf(utEcommPrefix)+utEcommPrefix.length);}}}
else{}
if(ut_retailer){urchinAdTracker(ut_retailer,ut_product,ut_position,ut_ecomm);}}}
function urchinAdTracker(ut_retailer,ut_product,ut_position,ut_ecomm){var utString="/ads"+escape(window.location.pathname)+"/";if(ut_retailer!=null&&ut_retailer!="undefined"&&ut_retailer!=""){utString+=""+ut_retailer+"/";}
if(ut_product!=null&&ut_product!="undefined"&&ut_product!=""){utString+=""+ut_product+"/";}
if(ut_position!=null&&ut_position!="undefined"&&ut_position!=""){utString+=""+ut_position+"/";}
if(ut_ecomm!=null&&ut_ecomm!="undefined"&&ut_ecomm!=""){urchinEcommTracker(ut_ecomm,ut_product,ut_retailer);}
urchinTracker(""+utString);}
function urchinEcommTracker(ut_ecomm,ut_product,ut_retailer){var dateObj=new Date();var transid=dateObj.getTime();var ecomm_val=(ut_ecomm/100);var ecommString="<form style=\"display:none\" name=\"utmform\">\n<textarea id=\"utmtrans\">\n"+"UTM:T|"+transid+"||"+ecomm_val+"|||||\n"+"UTM:I|"+transid+"||"+ut_product+"|"+ut_retailer+"|"+ecomm_val+"|1\n"+"</textarea></form>"
var contDiv=document.getElementById("topad");var newdiv=document.createElement('div');newdiv.innerHTML=ecommString;contDiv.appendChild(newdiv);__utmSetTrans();}
var ut_px;var ut_py;function ut_getMouse(e){ut_px=e.pageX;ut_py=e.clientY;}
function ut_findY(obj){var y=0;while(obj){y+=obj.offsetTop;obj=obj.offsetParent;}
return(y);}
function ut_findX(obj){var x=0;while(obj){x+=obj.offsetLeft;obj=obj.offsetParent;}
return(x);}
function ut_doPageExit(e){ut_ad=document.getElementsByTagName("iframe");for(i=0;i<ut_ad.length;i++){var ut_currentAd=ut_ad[i];var ut_adLeft=ut_findX(ut_currentAd);var ut_adTop=ut_findY(ut_currentAd);var ut_inFrameX=((ut_px>(parseInt(ut_adLeft)-10))&&(ut_px<(parseInt(ut_adLeft)+parseInt(ut_currentAd.width)+15)));var ut_inFrameY=((ut_py>(parseInt(ut_adTop)-10))&&(ut_py<(parseInt(ut_adTop)+parseInt(ut_currentAd.height)+10)));if(ut_inFrameY&&ut_inFrameX){if(ut_currentAd.src.indexOf('googlesyndication.com')>-1){urchinAdTracker('adsense',"","");}
else if(ut_currentAd.src.indexOf('nextag.com')>-1){urchinAdTracker("nextag","","");}
else if(ut_currentAd.src.indexOf('rcm.amazon.com')>-1){urchinAdTracker("amazon","","");}
else if(ut_currentAd.src.indexOf('chitika.net')>-1){urchinAdTracker("chitika","","");}
else if(ut_currentAd.src.indexOf('sears')>-1){urchinAdTracker("sears.com","","");}
else if(ut_currentAd.src.indexOf('smooth')>-1){urchinAdTracker("smooth_fitness","","");}
else if(ut_currentAd.src.indexOf('alerg')>-1){urchinAdTracker("alerg.com","","");}
else if(ut_currentAd.src.indexOf('aucourant')>-1){urchinAdTracker("aucourant.com","","");}
else if(ut_currentAd.src.indexOf('bradard')>-1){urchinAdTracker("buyradardetectors.com","","");}
else if(ut_currentAd.src.indexOf('discounttire')>-1){urchinAdTracker("discounttire.com","","");}
else if(ut_currentAd.src.indexOf('usamattress')>-1){urchinAdTracker("usamattress","","");}
else if(ut_currentAd.src.indexOf('blendersnet')>-1){urchinAdTracker("blenders.net","","");}
else if(ut_currentAd.src.indexOf('amazonwtbtop')>-1){urchinAdTracker("amazonwtbtop","","");}
else if(ut_currentAd.src.indexOf('tumri.net')>-1){urchinAdTracker("tumri","","");}
else if(ut_currentAd.src.indexOf('overture.com')>-1){urchinAdTracker("yahoo","","");}
else{urchinAdTracker("unknown","","");}}}}
;
/* AGGREGATED JS FILE: sites/all/themes/zen/csnew/public/js/ef-20090114.js */

var __ef_tracking_direct_list=[{domain_name:'adsense',track_url:'googleads.g.doubleclick.net'},{domain_name:'amazon',track_url:'www.amazon.com'},{domain_name:'ebay',track_url:'rover.ebay.com'},{domain_name:'shopping',track_url:'www.shopping.com'},]
var __ef_consumersearch_redirection_links=[{domain_name:'gl',track_url:'www.google.com'},{domain_name:'st',track_url:'stat.dealtime.com'},]
var __ef_pixel_url="http://pixel1953.everesttech.net/1953/p?";var __ef_click_out="1";function __ef_onPageLoad()
{var __ef_anchor_list=new Array();__ef_anchor_list=document.getElementsByTagName("a");for(var i=0;i<__ef_anchor_list.length;i++){try{if((__ef_search_for_domain(__ef_anchor_list[i],__ef_tracking_direct_list,false))!=null||(__ef_search_for_domain(__ef_anchor_list[i],__ef_consumersearch_redirection_links,true))!=null){if(__ef_anchor_list[i].addEventListener){__ef_anchor_list[i].addEventListener('click',__ef_createCallback(__ef_anchor_list[i],__ef_onLinkClick),false);}else if(__ef_anchor_list[i].attachEvent){__ef_anchor_list[i].attachEvent("on"+'click',__ef_createCallback(__ef_anchor_list[i],__ef_onLinkClick));}}}catch(err){}}
function __ef_createCallback(callbackObject,callbackFunction)
{return function()
{callbackFunction.apply(callbackObject,arguments);};}
function __ef_search_for_domain(anchor_item,__ef_track_list,hostname_search){try{if(hostname_search==false){for(var i=0;i<__ef_track_list.length;i++){if(anchor_item.href.search(__ef_track_list[i].track_url)!=-1){return(__ef_track_list[i].domain_name);}}}
else{for(var i=0;i<__ef_track_list.length;i++){if(anchor_item.hostname==__ef_track_list[i].track_url){return(__ef_track_list[i].domain_name);}}}}catch(err){return null;}
return null;}
function __ef_onLinkClick(){var __ef_pixelUrl;var d_name=null;try{var __ef_domain_name=__ef_search_for_domain(this,__ef_consumersearch_redirection_links,true);if(__ef_domain_name=='st')
{var __ef_redirect_domain=__ef_search_for_domain(this,__ef_tracking_direct_list,false);if(__ef_redirect_domain!=null)
{d_name=__ef_domain_name+"_"+__ef_redirect_domain;__ef_pixelUrl=__ef_create_pixel_url(d_name);}
else{d_name="shopping";__ef_pixelUrl=__ef_create_pixel_url(d_name);}}else if(__ef_domain_name=='gl'){d_name=__ef_domain_name;__ef_pixelUrl=__ef_create_pixel_url(d_name);}else{d_name=__ef_search_for_domain(this,__ef_tracking_direct_list,true);if(d_name){__ef_pixelUrl=__ef_create_pixel_url(d_name);}else{}}}catch(err){}
__ef_fire_pixel(__ef_pixelUrl);__ef_pause(500);}
function __ef_pause(numberMillis)
{var now=new Date();var exitTime=now.getTime()+numberMillis;while(true)
{now=new Date();if(now.getTime()>exitTime)
return;}}
function __ef_create_pixel_url(__ef_d_name)
{var __ef_ev_transid=__ef_get_ev_transid();return(__ef_pixel_url+__ef_ev_transid+"&ev_"+__ef_d_name+"_click_out="+__ef_click_out);}
function __ef_fire_pixel(ef_pixel_url){var pixel=document.createElement('img');pixel.width="1";pixel.height="1";pixel.src=ef_pixel_url;document.body.appendChild(pixel);}}
function __ef_addLoadEvent(func)
{var oldload=window.onload;if(typeof window.onload!='function')
{window.onload=func;}else{window.onload=function(){if(oldload)
{oldload();}
func();}}}
function __ef_get_ev_transid()
{function get_cur_datetime_str()
{var cur_date=new Date();var year=get_date_value(cur_date.getUTCFullYear());var month=get_date_value((cur_date.getUTCMonth()+1));var date=get_date_value(cur_date.getUTCDate());var hour=get_date_value(cur_date.getUTCHours());var min=get_date_value(cur_date.getUTCMinutes());var sec=get_date_value(cur_date.getUTCSeconds());var ms=get_date_value(cur_date.getUTCMilliseconds(),1);var date_str=''.concat(year,month,date,hour,min,sec,ms);return date_str;}
function get_date_value(date_int,three_digits)
{if(three_digits==null){three_digits=0;}
if(!date_int){return'';}
date_str=new String(date_int);if(date_str.length==1&&three_digits==0){date_str='0'+date_str;}
if(three_digits!=0&&date_str.length==1){date_str='00'+date_str;}
if(three_digits!=0&&date_str.length==2){date_str='0'+date_str;}
return date_str;}
var hexcase=0;var chrsz=8;function hex_md5(s){return binl2hex(core_md5(str2binl(s),s.length*chrsz));}
function core_md5(x,len)
{x[len>>5]|=0x80<<((len)%32);x[(((len+64)>>>9)<<4)+14]=len;var a=1732584193;var b=-271733879;var c=-1732584194;var d=271733878;for(var i=0;i<x.length;i+=16)
{var olda=a;var oldb=b;var oldc=c;var oldd=d;a=md5_ff(a,b,c,d,x[i+0],7,-680876936);d=md5_ff(d,a,b,c,x[i+1],12,-389564586);c=md5_ff(c,d,a,b,x[i+2],17,606105819);b=md5_ff(b,c,d,a,x[i+3],22,-1044525330);a=md5_ff(a,b,c,d,x[i+4],7,-176418897);d=md5_ff(d,a,b,c,x[i+5],12,1200080426);c=md5_ff(c,d,a,b,x[i+6],17,-1473231341);b=md5_ff(b,c,d,a,x[i+7],22,-45705983);a=md5_ff(a,b,c,d,x[i+8],7,1770035416);d=md5_ff(d,a,b,c,x[i+9],12,-1958414417);c=md5_ff(c,d,a,b,x[i+10],17,-42063);b=md5_ff(b,c,d,a,x[i+11],22,-1990404162);a=md5_ff(a,b,c,d,x[i+12],7,1804603682);d=md5_ff(d,a,b,c,x[i+13],12,-40341101);c=md5_ff(c,d,a,b,x[i+14],17,-1502002290);b=md5_ff(b,c,d,a,x[i+15],22,1236535329);a=md5_gg(a,b,c,d,x[i+1],5,-165796510);d=md5_gg(d,a,b,c,x[i+6],9,-1069501632);c=md5_gg(c,d,a,b,x[i+11],14,643717713);b=md5_gg(b,c,d,a,x[i+0],20,-373897302);a=md5_gg(a,b,c,d,x[i+5],5,-701558691);d=md5_gg(d,a,b,c,x[i+10],9,38016083);c=md5_gg(c,d,a,b,x[i+15],14,-660478335);b=md5_gg(b,c,d,a,x[i+4],20,-405537848);a=md5_gg(a,b,c,d,x[i+9],5,568446438);d=md5_gg(d,a,b,c,x[i+14],9,-1019803690);c=md5_gg(c,d,a,b,x[i+3],14,-187363961);b=md5_gg(b,c,d,a,x[i+8],20,1163531501);a=md5_gg(a,b,c,d,x[i+13],5,-1444681467);d=md5_gg(d,a,b,c,x[i+2],9,-51403784);c=md5_gg(c,d,a,b,x[i+7],14,1735328473);b=md5_gg(b,c,d,a,x[i+12],20,-1926607734);a=md5_hh(a,b,c,d,x[i+5],4,-378558);d=md5_hh(d,a,b,c,x[i+8],11,-2022574463);c=md5_hh(c,d,a,b,x[i+11],16,1839030562);b=md5_hh(b,c,d,a,x[i+14],23,-35309556);a=md5_hh(a,b,c,d,x[i+1],4,-1530992060);d=md5_hh(d,a,b,c,x[i+4],11,1272893353);c=md5_hh(c,d,a,b,x[i+7],16,-155497632);b=md5_hh(b,c,d,a,x[i+10],23,-1094730640);a=md5_hh(a,b,c,d,x[i+13],4,681279174);d=md5_hh(d,a,b,c,x[i+0],11,-358537222);c=md5_hh(c,d,a,b,x[i+3],16,-722521979);b=md5_hh(b,c,d,a,x[i+6],23,76029189);a=md5_hh(a,b,c,d,x[i+9],4,-640364487);d=md5_hh(d,a,b,c,x[i+12],11,-421815835);c=md5_hh(c,d,a,b,x[i+15],16,530742520);b=md5_hh(b,c,d,a,x[i+2],23,-995338651);a=md5_ii(a,b,c,d,x[i+0],6,-198630844);d=md5_ii(d,a,b,c,x[i+7],10,1126891415);c=md5_ii(c,d,a,b,x[i+14],15,-1416354905);b=md5_ii(b,c,d,a,x[i+5],21,-57434055);a=md5_ii(a,b,c,d,x[i+12],6,1700485571);d=md5_ii(d,a,b,c,x[i+3],10,-1894986606);c=md5_ii(c,d,a,b,x[i+10],15,-1051523);b=md5_ii(b,c,d,a,x[i+1],21,-2054922799);a=md5_ii(a,b,c,d,x[i+8],6,1873313359);d=md5_ii(d,a,b,c,x[i+15],10,-30611744);c=md5_ii(c,d,a,b,x[i+6],15,-1560198380);b=md5_ii(b,c,d,a,x[i+13],21,1309151649);a=md5_ii(a,b,c,d,x[i+4],6,-145523070);d=md5_ii(d,a,b,c,x[i+11],10,-1120210379);c=md5_ii(c,d,a,b,x[i+2],15,718787259);b=md5_ii(b,c,d,a,x[i+9],21,-343485551);a=safe_add(a,olda);b=safe_add(b,oldb);c=safe_add(c,oldc);d=safe_add(d,oldd);}
return Array(a,b,c,d);}
function md5_cmn(q,a,b,x,s,t)
{return safe_add(bit_rol(safe_add(safe_add(a,q),safe_add(x,t)),s),b);}
function md5_ff(a,b,c,d,x,s,t)
{return md5_cmn((b&c)|((~b)&d),a,b,x,s,t);}
function md5_gg(a,b,c,d,x,s,t)
{return md5_cmn((b&d)|(c&(~d)),a,b,x,s,t);}
function md5_hh(a,b,c,d,x,s,t)
{return md5_cmn(b^c^d,a,b,x,s,t);}
function md5_ii(a,b,c,d,x,s,t)
{return md5_cmn(c^(b|(~d)),a,b,x,s,t);}
function safe_add(x,y)
{var lsw=(x&0xFFFF)+(y&0xFFFF);var msw=(x>>16)+(y>>16)+(lsw>>16);return(msw<<16)|(lsw&0xFFFF);}
function bit_rol(num,cnt)
{return(num<<cnt)|(num>>>(32-cnt));}
function str2binl(str)
{var bin=Array();var mask=(1<<chrsz)-1;for(var i=0;i<str.length*chrsz;i+=chrsz)
bin[i>>5]|=(str.charCodeAt(i/chrsz)&mask)<<(i%32);return bin;}
function binl2hex(binarray)
{var hex_tab=hexcase?"0123456789ABCDEF":"0123456789abcdef";var str="ev_transid=";for(var i=0;i<binarray.length*4;i++)
{str+=hex_tab.charAt((binarray[i>>2]>>((i%4)*8+4))&0xF)+
hex_tab.charAt((binarray[i>>2]>>((i%4)*8))&0xF);}
return str;}
return(hex_md5(Math.random()+'')+get_cur_datetime_str());}
__ef_addLoadEvent(__ef_onPageLoad);
