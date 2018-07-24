jQuery.cookie = function(name, value, options){if (typeof value != 'undefined') {options = options || {};if (value === null) { value = ''; options.expires = -1; }var expires = '';if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {var date;if (typeof options.expires == 'number') {date = new Date();date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));} else {date = options.expires;}expires = '; expires=' + date.toUTCString();}var path = options.path ? '; path=' + (options.path) : '';var domain = options.domain ? '; domain=' + (options.domain) : '';var secure = options.secure ? '; secure' : '';document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');} else {var cookieValue = null;if (document.cookie && document.cookie != '') {var cookies = document.cookie.split(';');for (var i = 0; i < cookies.length; i++) {var cookie = jQuery.trim(cookies[i]);if (cookie.substring(0, name.length + 1) == (name + '=')) { cookieValue = decodeURIComponent(cookie.substring(name.length + 1)); break;}}}return cookieValue;}};
jQuery.fn.switchTab=function(settings){settings=jQuery.extend({defaultIndex:0,swid:"swi",titOnClassName:"on",titCell:"dt span",mainCell:"dd",delayTime:250,interTime:0,trigger:"click",effect:"",omitLinks:false,spcookies:true,debug:""},settings,{version:120});this.each(function(){var st;var curTagIndex=-1;var obj=jQuery(this);if(settings.omitLinks){settings.titCell=settings.titCell+"[href^='#']"}var oTit=obj.find(settings.titCell);var oMain=obj.find(settings.mainCell);var cellCount=oTit.length;var ShowSTCon=function(oi){if(oi!=curTagIndex){oTit.eq(curTagIndex).removeClass(settings.titOnClassName);oMain.hide();obj.find(settings.titCell+":eq("+oi+")").addClass(settings.titOnClassName);if(settings.delayTime<250&&settings.effect!="")settings.effect="";if(settings.effect=="fade"){obj.find(settings.mainCell+":eq("+oi+")").fadeIn({queue:false,duration:250})}else if(settings.effect=="slide"){obj.find(settings.mainCell+":eq("+oi+")").slideDown({queue:false,duration:250})}else{obj.find(settings.mainCell+":eq("+oi+")").show()}curTagIndex=oi}};var ShowNext=function(){oTit.eq(curTagIndex).removeClass(settings.titOnClassName);oMain.hide();if(++curTagIndex>=cellCount)curTagIndex=0;oTit.eq(curTagIndex).addClass(settings.titOnClassName);oMain.eq(curTagIndex).show()};if($.cookie(settings.swid)&&settings.spcookies==true){ShowSTCon($.cookie(settings.swid))}else{ShowSTCon(settings.defaultIndex)}if(settings.interTime>0){var sInterval=setInterval(function(){ShowNext()},settings.interTime)}oTit.each(function(i,ele){if(settings.trigger=="click"){jQuery(ele).click(function(){ShowSTCon(i);if(settings.spcookies){$.cookie(settings.swid,i,{expires:7})}return false})}else if(settings.delayTime>0){jQuery(ele).hover(function(){st=setTimeout(function(){ShowSTCon(i);if(settings.spcookies){$.cookie(settings.swid,i,{expires:7})}st=null},settings.delayTime)},function(){if(st!=null)clearTimeout(st)})}else{jQuery(ele).mouseover(function(){ShowSTCon(i);if(settings.spcookies){$.cookie(settings.swid,i,{expires:7})}})}})});if(settings.debug!="")alert(settings[settings.debug]);return this};

function SureDel(_link){
	if((confirm("是否确认删除？"))==true){
		window.location=_link;
	}
}
	
function addTr() {
	var oTr = document.createElement("tr");
	var oTd = new Array(2);
	for(var i=0;i<oTd.length;i++){
		oTd[i] = document.createElement("td");
	}
	var input;
	input = document.createElement("input");
	input.name="file[]";
	input.type="text";
	var linkButton = document.createElement("a");
	linkButton.name="删除";
	linkButton.innerHTML="删除";
	linkButton.href="#";
	linkButton.onclick=function() {
		oTr.parentNode.removeChild(oTr);
	}
	oTd[0].appendChild(input);
	oTd[0].style.width="80%";
	oTd[1].appendChild(linkButton);
	oTd[1].style.textAlign="center";
	for(var i = 0;i<oTd.length;i++){
		oTr.appendChild(oTd[i]);
	}
	document.getElementById("upload_file_table").appendChild(oTr);
}