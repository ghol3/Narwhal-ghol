function textres(objname, myfx_after){
	var o = $element(objname), minrows = o.rows;
	o.style.overflow = 'hidden';
	o.style.height = '';
	addEvent(o, 'keydown', function(){textrescb(o, minrows);if(myfx_after) myfx_after();});
	addEvent(o, 'keyup', function(){textrescb(o, minrows);if(myfx_after) myfx_after();}); // stisk backspace/enter zaregistruje az po UP
	textrescb(o, minrows);
}
function textrescb(o, minrows){
	var cols = 150, str = o.value, r = str.split("\n"), rows = r.length, rlen, chars = 0, i;
	
	for(i=0; i<rows; i++){ // s každým ENTEREM
		if(!r[i]) continue;
		rlen = r[i].length;
		chars+=rlen;
		if(rlen > cols+1){
			rows+= Math.ceil(r[i].length / cols)-1;
		}
	}
	rows++;
	o.rows = rows < minrows ? minrows : rows;
	
	while(o.scrollHeight > o.offsetHeight) o.rows++;
};




//------------------------------- TIMER, Martin Zvarik
var gtimer = {
	add : function(duration, type, fx, nStart, nEnd, donefx, uid, dontStart){
		var t=this;
		if(typeof t.actions=='undefined') t.actions = [];
		if(typeof t.starttime=='undefined') t.starttime = [];
		if(typeof t.done=='undefined') t.done = []; // uklada se sem done(id) nebo done(id,i)
		if(typeof t.uid2id=='undefined') t.uid2id = [];
		
		var act, ta = t.actions, id, i=0, nDiff = (nEnd > nStart) ? nEnd-nStart : nStart-nEnd;
		
		id = ta.length ? ta.length : 1;
		if(uid){
			if(t.uid2id[uid]){
				if(!dontStart) t.stopUID(uid);
				id = t.uid2id[uid];
			}
			else t.uid2id[uid] = id;
		}
		
		act = [duration, type, fx, nStart, nEnd, nDiff];
		if(ta[id]){
			i=ta[id].length;
			ta[id][i] = act;
		}else
			ta[id] = [act];
		
		if(donefx) t.done[id+','+i] = donefx;
		
		if(!dontStart) t.start(id);
		
		return id;
	},
	stopUID : function(uid, forceFinish){
		var t=this;
		if(typeof t.uid2id!='undefined' && t.uid2id[uid]) t.stop(t.uid2id[uid], forceFinish);
	},
	startUID : function(uid){
		var t=this;
		if(typeof t.uid2id!='undefined' && t.uid2id[uid]) t.start(t.uid2id[uid]);
	},
	stop : function(id, forceFinish){ // forceFinish TODO
		var t=this, i, ta=t.actions;
		if(ta[id]){
			if(forceFinish){
				for(i=0; i<ta[id].length; i++) t._finish_i(id,i);
			}
			ta[id]=0;
		}
	},
	start : function(id){
		var t=this, u;
		t.starttime[id] = new Date().getTime();
		if(!t.intID) t.intID = window.setInterval(function(){t._timer();}, 20);
	},
	_finish_i : function(id, i){
		var t=this, ta=t.actions;
		if(!ta[id][i]) return;
		movement = ta[id][i][4];
		ta[id][i][2](movement);
		ta[id][i] = 0;
		if(t.done[id+','+i]){
			t.done[id+','+i]();
			t.done[id+','+i] = 0;
		}
	},
	_timer : function(){
		var i, id, elapsed, progress, moved=0, movement=0, t=this, ta=t.actions;
		
		var now = new Date().getTime();
		
		for(id in ta){
			if(ta[id] === 0) continue;
			
			for(i=0; i<ta[id].length; i++){
				if(!ta[id][i]) continue;
				
				elapsed = now - t.starttime[id];
				if(ta[id][i][0] <= elapsed){ // uz sme meli skoncit
					t._finish_i(id, i);
				}else{
					moved=1;
					progress = ta[id][i][0] / elapsed;
					
					if(ta[id][i][1] == 'sqsin')
						movement = Math.sqrt(Math.cos((1-1/progress)*Math.PI/2)) * ta[id][i][5];
					else if(ta[id][i][1] == 'sin')
						movement = Math.cos((1-1/progress)*Math.PI/2) * ta[id][i][5]; // tady mam neco spatne
					else if(ta[id][i][1] == 'cos')
						movement = Math.sin((1/progress)*Math.PI/2) * ta[id][i][5];
					else
						movement = ta[id][i][5] / progress;
					
					movement = Math.round(movement*1000)/1000;
					movement = (ta[id][i][3] > ta[id][i][4]) ? ta[id][i][3] - movement : ta[id][i][3] + movement;
					
					ta[id][i][2](movement);
				}
			}
			if(!moved){
				ta[id] = 0; // tato skupina se uz nebude prochazet
				if(t.done[id]){
					t.done[id]();
					t.done[id] = 0;
				}
				moved = 1; // ukoncime to az priste, v uzivatelske funkci muze byt dalsi gtimer, a ted bysme ho zastavili
			}
		}
		if(!moved) t.die(); // pokud se nic nepohlo => koncime
	},
	/*isDone : function(uid){
	},
	onDone : function(uid, fn){
		var t=this;
		if(t.uid2id[uid]) t.done[t.uid2id[uid]] = fn;
	},*/
	die : function(){
		var t=this;
		window.clearInterval(t.intID);
		t.intID = 0;
		t.actions = [];
		t.starttime = [];
		t.done = [];
	}
}


function setOpacity(o,v){
	o.style.opacity = v/10;
	o.style.filter = 'alpha(opacity='+v*10+')';
}


function myurlquery(newpairs){
	var s=document.location+'';
	s = s.split('?');
	var name = s[0];
	var params = s[1] ? s[1].split('&') : [];
	var params2='', i, j, pair, v='', s='', newpair;
	newpairs = newpairs.split('&');
	for(i=0;i<params.length;i++){
		sk=params[i].split('=');
		for(j=0;j<newpairs.length;j++){
			newpair = newpairs[j].split('=');
			if(sk[0] == newpair[0]){
				sk[1]=newpair[1];
				newpair[1] = '';
				newpairs[j] = newpair.join('=');
				break;
			}
		}
		if (!sk[1]) continue;
		params2+=(params2?'&':'')+sk.join('=');
	}
	for(i=0;i<newpairs.length;i++){
		newpair = newpairs[i].split('=');
		if(newpair[1]) params2+=(params2?'&':'')+newpairs[i];
	}
	return name+'?'+params2;
}

function sw(el, i, fnCheck, class_on){
	if(!class_on) class_on = 'db';
	var o=$element(el), j, r, openIt = o.className.indexOf('dn')>-1 || (typeof i!='undefined' && i);
	
	if(fnCheck && typeof (r=fnCheck(openIt)) !='undefined'){
		if(openIt!=r) j=1;
		openIt=r;
	}
	
	o.className = o.className.replace(new RegExp('(^| )(dn|'+class_on+')($| )', 'g'), '$3');
	o.className+= openIt ? ' '+class_on : ' dn';
	
	return openIt;
}

function addOrder(o, orderID)
{
        var tmp = readCookie("export");
        var nc='', added = false;

        if(tmp) {
                var or = tmp.split(':');
                for(var i=0;i <= or.length;i++) {
                        if(or[i]) {
                        if(or[i]!=orderID) // pokud byl pridan, tak preskocime
                                nc=nc+":"+or[i];
                        else
                                added=true;
                        }
                }
        }
        if(added==false || !tmp) {
                o.style.border='#cc0000 3px solid';
				o.style.padding='3px';
                nc = nc+":"+orderID;
        }
        else {
                o.style.border='#aaa 1px solid';
				o.style.padding='5px';
        }
        createCookie(nc);
}

function createCookie(value)
{
        var date = new Date();
        date.setTime(date.getTime()+(1*24*60*60*1000));
        var expires = " expires="+date.toGMTString();
        document.cookie = "export="+value+";"+expires+"; path=/";
}

function readCookie(name)
{
        var nameEQ = name + "=";

        var ca = document.cookie.split(';');

        for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
}


/*---------- CLASSES -----------------------------*/
function hasClass(o,s){
	cn = o.className;
	if(cn) return cn.match(new RegExp('(^| )('+s+')($| )', 'i'));
	return 0;
}

function addClass(o, s){
	if(!hasClass(o,s)){
		o.className+= (o.className ? ' ' : '')+s;
		return true;
	}
	return false;
}

function removeClass(o,ss){
	var i, r;
	if(typeof ss!='object') ss=[ss];
	for(i=0; i<ss.length; i++){
		r = new RegExp('(^| )'+ss[i]+'($| )', 'g');
		o.className = o.className.replace(r, '$2');
	}
}
/*-------------------------------------------------*/


function url_add(s, sa){
	if(s.indexOf('?')>-1) return s+'&'+sa;
	return s+'?'+sa;
}

function my_ajax(o, fn){
	var i, objs;
	if(hasClass(o, 'tinypreloader')) return;
	addClass(o, 'tinypreloader');
	
	get(url_add(o.href, 'ajax=1'), function(s){
		removeClass(o, 'tinypreloader');
		if(fn) fn.call(o, s);
	});
	
	return false;
}

function get(uri, fx, msg, fullscreen){
	var A;
	if(window.XMLHttpRequest)
		A = new XMLHttpRequest();
	else if(window.ActiveXObject){
		try {
			A = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				A = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {}
		}
	}
	if(!A) return alert('Váš prohlížeč tuto funkci nepodporuje.');
	
	if(msg) message.show(msg, fullscreen);
	
	_g[uri]=0;
	
	A.open('GET', uri+'&'+Math.random(), true);
	A.onreadystatechange=function(){
		if(A.readyState==4 && _g[uri] == 0){
			_g[uri]=1;
			if(msg) message.hide();
			if(A.status==200){
				if(fx) fx(A.responseText);
				else if(A.responseText) alert(A.responseText);
			}
		}
	};
	A.send(null);
}


var _g=[];
function cancel(uri){
	_g[uri]=1;
}


function getParent(o, el, classval, level, deep){
	var i=0;
	el=el.toLowerCase();
	if(!level)level=0;
	while(o){
		if(i>=level && o.nodeName.toLowerCase()==el && (!classval || (o.className && o.className.indexOf(classval) > -1))) return o;
		if(i>=deep)break;
		i++;
		o=o.parentNode;
	}
	return;
}

//--------------------------------------------------------------


function AddText(str,el){
	if(!el) el = document.getElementById('code');
	if(el.setSelectionRange){
		el.value = el.value.substring(0,el.selectionStart) + str + el.value.substring(el.selectionEnd, el.value.length);
		el.setSelectionRange(el.selectionEnd+str.length, el.selectionEnd+str.length);   
		el.focus();
	}else{
		el.focus();
		var range = document.selection.createRange();
		range.text = str;
		el.focus();
	}
}


function wrapText(openTag, closeTag, rangeMove){
	if(rangeMove == undefined) rangeMove = -openTag.length;
	if(closeTag == undefined) closeTag=openTag;
	
	var el = document.getElementById('msg');
	
	if(el.setSelectionRange){ // W3C/Mozilla
		el.value = el.value.substring(0,el.selectionStart) + openTag + el.value.substring(el.selectionStart,el.selectionEnd) + closeTag + el.value.substring(el.selectionEnd, el.value.length);
		el.setSelectionRange(el.selectionEnd-rangeMove, el.selectionEnd-rangeMove);   
		el.focus();
	}
	else if(document.selection && document.selection.createRange){ // IE
		el.focus();
		var range = document.selection.createRange();
		if(!range.text) {
			range.text = openTag + closeTag;
			if(rangeMove != 0) range.move("character", rangeMove);   
			range.select();
			el.focus();
		}
		else{
			range.text = openTag + range.text + closeTag;
			range.select();
			el.focus();
		}
	}
}


//-------------------------------------------------------------- UPLOAD SLOTS

var nextid = 0;
function addUploadSlot(o){
	if(document.getElementById('uploadslots').style.display != 'block') {
		document.getElementById('uploadslots').style.display='block';
		o.innerHTML = 'Připojit další přílohu';
	}
	var li = document.createElement("li");
	var i = nextid++;
	li.id = 'uploadslotli'+i;
	li.innerHTML = '<input type="file" name="upfile[]" size="70" onChange="uploadSlotC(this,'+i+')" onKeypress="return handlekey(event)" />'
		+'<a href="#_ODSTRANIT" onclick="return delUploadSlot('+i+')"><img src="img/del.gif" width="16" height="16" alt="Odstranit" /></a>';
	document.getElementById('uploadslots').appendChild(li);
	lastSlot = li;
	lastSlotID = i;
}
function delUploadSlot(i){
	var obj = document.getElementById('uploadslotli'+i);
	obj.parentNode.removeChild(obj);
	nextid--;
	if(nextid == 0) document.getElementById('uploadslots').style.display='none';
	return false;
}
function handlekey(event){
	if(document.all){ if(window.event.keyCode == 13) return false; }
	else if(event && event.which == 13) return false;
}




//------------------------------------------------------------------------- BASIC

function findTop(obj){
	curtop=0;
	if(obj.offsetParent){
		curtop=obj.offsetTop;
		while(obj=obj.offsetParent){ curtop += obj.offsetTop }
	}
	return curtop;
}

function findPos(obj){
	var x = y = 0;
	while(obj = obj.offsetParent) {
		x += obj.offsetLeft;
		y += obj.offsetTop;
	}
	return [x,y];
}

function $element(o){
	return document.getElementById(o);
}

function addLoadEvent(func){
	var oldonload = window.onload;
	if (typeof window.onload != 'function'){
		window.onload = func;
	}
	else {
		window.onload = function(){
			oldonload();
			func();
		}
	}
}


Array.prototype.inArray = function (value) {
	var i;
	for (i=0; i < this.length; i++) {
		if (this[i] === value) {
			return true;
		}
	}
	return false;
};



function addEvent(obj, type, fn) {
	if(obj.attachEvent){
		obj['e'+type+fn] = fn;
		obj[type+fn] = function(){obj['e'+type+fn](window.event);}
		obj.attachEvent('on'+type, obj[type+fn]);
	}else
		obj.addEventListener(type, fn, false);
}

function removeEvent(obj, type, fn){
	if(obj.detachEvent){
		obj.detachEvent('on'+type, obj[type+fn]);
		obj[type+fn] = null;
	} else
		obj.removeEventListener(type, fn, false);
}



//------------------------------------------------------------------------- myHoverTitle
Array.prototype.in_array = function(search_term){
  var i = this.length - 1;
  if(i >= 0){
	 do{
		if(this[i] === search_term){
		   return true;
		}
	 } while(i--);
  }
  return false;
}


function myHoverTitle(tags,node){
	addLoadEvent(function(){myHoverTitleInit(tags,node);});
	var div=document.createElement('div');
	div.id='jsAlt';
	var div1=document.createElement('div');
	div1.id='jsAlt1';
	var div2=document.createElement('div');
	div2.id='jsAlt2';
	div.appendChild(div1);
	div.appendChild(div2);
	document.body.appendChild(div);
}

function myHoverTitleInit(tags,node){
	if(!node) node = document;
	for(i in tags){
		var els=node.getElementsByTagName(tags[i]);
		for(j in els){
			if(els[j].title){
				eval('addEvent(els[j], "mouseover", function(e){myHoverTitleOver(\''+els[j].title+'\',e);} );');
				addEvent(els[j], "mouseout", myHoverTitleOut);
				addEvent(els[j], "mousemove", myHoverTitleMove);
				els[j].title='';
			}
		}
	}
}


function myHoverTitleOver(s,e){
	e = e || window.event;
	var o = window.event ? e.srcElement : e.target;
	
	var ja1 = $element('jsAlt1');
	ja1.innerHTML = s;
	var w = (s.length>50) ? '280px' : 'auto';
	
	var ja = $element('jsAlt');
	if(typeof ja.setAttribute != 'function') {
		ja.style.width = w;
	} else {
		ja.setAttribute('style', 'width:'+w);
	}
	
	ja.style.height = ja1.offsetHeight+'px';
	var x = window.Event ? e.pageX : event.clientX;
  	var y = window.Event ? e.pageY : event.clientY;
	if(x+20+280 > document.body.clientWidth) x-=ja1.offsetWidth+20;
	ja.style.left = (x+10)+'px';
	ja.style.top = (y+10)+'px';
}


function myHoverTitleMove(e){
	e = e || window.event;
	var o = window.event ? e.srcElement : e.target;
	var ja = $element('jsAlt');
	var x = window.Event ? e.pageX : event.clientX;
  	var y = window.Event ? e.pageY : event.clientY;
	if(x+20+280 > document.body.clientWidth) x-=$element('jsAlt1').offsetWidth+20;
	ja.style.left = (x+10)+'px';
	ja.style.top = (y+10)+'px';
}


function myHoverTitleOut(){
	var ja = $element('jsAlt');
	ja.style.top='-999px';
	ja.style.left='-999px';
}


/*
function StayTop(o){
	addEvent(window, "scroll", function(e){StayTopMove(e,o)});
}

function StayTopMove(e,o){
	var y = document.body.scrollTop;
	//(window.pageYOffset)?(window.pageYOffset):(document.documentElement)?document.documentElement.scrollTop:document.body.scrollTop;
	o.style.top = y+'px';
}
*/

function scrollBottom(){
	if(document.body.scrollHeight){
		window.scrollTo(0, document.body.scrollHeight);
	} else if(screen.height) {
		window.scrollTo(0, screen.height);
	}
}

function scrollTop(){
	if(document.body.scrollHeight){
		window.scrollTo(0, 0);
	} else if(screen.height) {
		window.scrollTo(0, 0);
	}
}

/*
function IsNumeric(str) {
	var nums = "-0123456789"; // nefunguje s hacky
	if(str.length==0) return 0;
	for(var n=0; n < str.length; n++){
		if(nums.indexOf(str.charAt(n))==-1) return 0;
	}
	return 1;
}
function numonly(e){
	e = e || window.event;
	if(e.keyCode) {
		var ch = String.fromCharCode(e.keyCode);
		if(e.keyCode != 8 && !IsNumeric(ch)) return false;	
	}
	return true;
}*/


function fprice(obj, make_decimal)
{
	var price = "";
	if(typeof obj!="object") price=obj+"";
	else price = obj.value;
	
	if (typeof make_decimal!='undefined')
	{
		price = price.replace(' ', '');
		price = parseFloat(price);
		price = price.toFixed(make_decimal ? 2 : 0)+'';
		price = price.replace('.', ',');
	}
	
	var priceNew = "";
	var chars = "0123456789-,";
	var po = 0;
	var mark = "";
	var dot = price.indexOf(',') > -1;
	for(var i=price.length-1;i>=0;i--){
		if(chars.indexOf(price.charAt(i))>-1)
		{
			mark = "";
			if(dot && price.charAt(i)==','){
				dot = 0;
				po = -1;
			}
			if (po == 3 && !dot){
				mark=" ";
				po = 0;
			}
			po++;
			
			priceNew = price.charAt(i)+mark+priceNew;
		}
	}
	if(typeof obj!="object") return priceNew;
	else if(obj.value != priceNew) obj.value = priceNew;
}


//------------------------------------------------------------------------- showMyPopup

var pHideSelects = false;
var pRefresh = false;


var bst=0;
function showMyPopup(url,title,id,w,h){
	if(!id)id='';
	
	var mask = $element('popupMask');
	var inner = $element('popupInner'+id);
	
	var xbody = window.document.body;
	//var xbody = document.getElementsByTagName('BODY')[0];
	
	var brsVersion = parseInt(window.navigator.appVersion.charAt(0), 10);
	if (brsVersion <= 6 && window.navigator.userAgent.indexOf("MSIE") > -1) {
		pHideSelects = true;
	}
	
	if(pHideSelects) hideSelectBoxes();
		
	
		
	if(inner){
		if(1 || pRefresh == true) {
			var IFrameDoc;
			var IFrameObj = document.getElementById('popupFrame'+id);
			if(IFrameObj.contentDocument){
				IFrameDoc = IFrameObj.contentDocument; 
			}else if(IFrameObj.contentWindow){
				IFrameDoc = IFrameObj.contentWindow.document;
			}else if(IFrameObj.document){
				IFrameDoc = IFrameObj.document;
			}else{
				return true;
			}
			IFrameDoc.location.replace(url);
		}
		mask.style.display='block';
		inner.style.display='block';
	}
	else{
		var IE6 = false /*@cc_on || @_jscript_version < 5.7 @*/;
		
		if(mask){
			mask.style.display='block';
		}else{
			mask = document.createElement('div');
			mask.id = "popupMask";
			addEvent(mask, 'click', function(){hideMyPopup(id);});
			xbody.appendChild(mask);
		}

		inner = document.createElement('div');
		inner.id = "popupInner"+id;
		addEvent(inner, 'click', function(){hideMyPopup(id);});
		if(w){
			inner.style.width=w+'%';
			inner.style.left=(100-w)/2+'%';
		}
		if(h){
			inner.style.height=h+'%';
			inner.style.top=(100-h)/2+'%';
		}
		inner.className = "popupInner";
		inner.innerHTML = '<table cellpadding="0" cellspacing="0">'
			+'<tr><td class="popupControls">'
			+'<div style="background:url(http://www.antiradary.net/subModal/close2.gif) no-repeat;width:260px;height:15px;float:right;cursor:pointer">'
			+'</div>'+title+'</td></tr>'
			+'<tr><td><iframe scrolling="'+(IE6 ? 'yes' : 'auto')+'" frameborder="0" id="popupFrame'+id+'"></iframe></td></tr>'
			+'</table>';
		xbody.appendChild(inner);
		
		var IFrameDoc;
		var IFrameObj = document.getElementById('popupFrame'+id);
		if(IFrameObj.contentDocument){
			IFrameDoc = IFrameObj.contentDocument; 
		}else if(IFrameObj.contentWindow){
			IFrameDoc = IFrameObj.contentWindow.document;
		}else if(IFrameObj.document){
			IFrameDoc = IFrameObj.document;
		}else{
			return true;
		}
		IFrameDoc.location.replace(url);
	}
	
	
	xbody.style.overflow='hidden';
	addEvent(top.window,'scroll',noscroll);
	
	if(xbody.scrollTop != bst) {
		mask.style.top=xbody.scrollTop+'px';
		inner.style.top=(xbody.scrollTop+((xbody.offsetHeight-inner.offsetHeight)/2))+'px';
		bst=xbody.scrollTop;
	}
}


function noscroll(){window.scrollTo(0,bst);}

function hideMyPopup(id){
	if(!id)id='';
	
	var xbody = window.document.body;
	xbody.style.overflow='auto';
	removeEvent(top.window,'scroll',noscroll);
	
	var IFrameDoc;
	var IFrameObj = $element('popupFrame'+id);
	if(IFrameObj.contentDocument){
		IFrameDoc = IFrameObj.contentDocument; 
	}else if(IFrameObj.contentWindow){
		IFrameDoc = IFrameObj.contentWindow.document;
	}else if(IFrameObj.document){
		IFrameDoc = IFrameObj.document;
	}
	if(IFrameDoc) IFrameDoc.body.innerHTML = '';
	
	$element('popupMask').style.display='none';
	$element('popupInner'+id).style.display='none';
	if(pHideSelects) showSelectBoxes();
}

function hideSelectBoxes(){
	for(var i = 0; i < document.forms.length; i++){
		for(var e = 0; e < document.forms[i].length; e++){
			if(document.forms[i].elements[e].tagName == "SELECT"){
				document.forms[i].elements[e].style.visibility="hidden";
			}
		}
	}
}

function showSelectBoxes(){
	for(var i = 0; i < document.forms.length; i++){
		for(var e = 0; e < document.forms[i].length; e++){
			if(document.forms[i].elements[e].tagName == "SELECT"){
			document.forms[i].elements[e].style.visibility="visible";
			}
		}
	}
}


//------------------------------------------------------------------------- CopyInput

function str2url(s){
	var s=s.toLowerCase();
	s=s.replace(/[ě|é]/g,'e');
	s=s.replace(/š/g,'s');
	s=s.replace(/č/g,'c');
	s=s.replace(/ř/g,'r');
	s=s.replace(/ž/g,'z');
	s=s.replace(/ý/g,'y');
	s=s.replace(/á/g,'a');
	s=s.replace(/í/g,'i');
	return s.replace(/[\s\W]+/g, "-");
}

function copyInputs(source,dest){
	var os = $element(source), isUrl, startVal, od;
		
	for(var i=0;i<dest.length;i++){
		od = $element(dest[i]);
		isUrl = (od.id.substr(0,3) == 'url');
		startVal = od.value;
		if(od.hasChangedEvent!='1'){
			addEvent(od,'keyup',function(){this.hasChanged=this.value==''?0:1;});
			if(isUrl) eval("addEvent(od,'keyup',function(){checkUrl(this.value,this,'"+startVal+"');});");
			od.hasChangedEvent = '1';
		}
		eval("addEvent(os,'keyup',function(){copyInput(this,$element('"+od.id+"'),"+isUrl+",'"+startVal+"');});");
	}
}

var badURL=[];
function checkUrl(str,o,ignoreVal){
	str=str.replace("\/",'');
	if(ignoreVal == '' || str != ignoreVal){
		if(badURL.in_array(str)){
			o.style.backgroundColor = '#ffe6e6';
			return;
		}
	}
	o.style.backgroundColor = '#fff';
}

function copyInput(os,od,isUrl,startVal){
	if(od.hasChanged == '1') return;
	if(isUrl){
		od.value = str2url(os.value);
		checkUrl(od.value, od, startVal);
	}
	else{
		od.value = os.value;
	}
}


//----------------------------------------------------------------------------------------

function fullHeightNow(o){
	var h = window.innerHeight ? window.innerHeight : document.body.clientHeight;
	o.style.height = (h-findTop(o)-40) + 'px';
}

function fullHeight(o){
	addEvent(window, 'resize', function(){fullHeightNow(o);});
	addEvent(window, 'load', function(){fullHeightNow(o);});
	fullHeightNow(o);
}

function selectByValue(o, v)
{
	o=$element(o);
	for(var i = 0; i < o.options.length; i++) {
		 if(o.options[i].value == v){
		 	o.options[i].selected = true;
			break;
		}
	}
}