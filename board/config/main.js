
function setEmbed() 
{ 
  var obj = new String; 
  var parameter = new String; 
  var embed = new String; 
  var html = new String; 
  var allParameter = new String; 
  var clsid = new String; 
  var codebase = new String; 
  var pluginspace = new String; 
  var embedType = new String; 
  var src = new String; 
  var width = new String; 
  var height = new String; 

    
  this.init = function( getType , s ,w , h ) { 
      
      if ( getType == "flash") 
      { 

        clsid = "D27CDB6E-AE6D-11cf-96B8-444553540000";        
        codebase = "http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0"; 
        pluginspage = "http://www.macromedia.com/go/getflashplayer"; 
        embedType = "application/x-shockwave-flash"; 
      } 
      /* type Ãß°¡ 
      else if ( ) 
      { 
      } 
      */ 
            
      parameter += "<param name='movie' value='"+ s + "'>\n";  
      parameter += "<param name='quality' value='high'>\n";    
      
      src = s; 
      width = w; 
      height = h; 
  } 
  
  this.parameter = function( parm , value ) {      
      parameter += "<param name='"+parm +"' value='"+ value + "'>\n";        
      allParameter += " "+parm + "='"+ value+"'"; 
  }  
  
  this.show = function() { 
      if ( clsid ) 
      { 
        obj = "<object classid=\"clsid:"+ clsid +"\" codebase=\""+ codebase +"\" width='"+ width +"' height='"+ height +"'>\n"; 
      } 
      
      embed = "<embed src='" + src + "' pluginspage='"+ pluginspage + "' type='"+ embedType + "' width='"+ width + "' height='"+ height +"'"+ allParameter +" ></embed>\n"; 
      
      if ( obj ) 
      { 
        embed += "</object>\n"; 
      } 
      
      html = obj + parameter + embed; 
      
      document.write( html );  
  } 
  
} 


// byte check function
/*
function checkByte(value,tg){
	var val = escape(value);
	var s_index = 0;
	var e_index = 0;
	var temp_str = "";
	var cnt = 0;
	var target_id = eval("document.getElementById('"+tg+"')");

	while((e_index = temp_str.indexOf("%u",s_index)) >= 0){
		temp_str += temp_str.substring(s_index, e_index);
		s_index = e_index + 6;
		cnt ++;
	}

	temp_str += temp_str.substring(s_index);
	temp_str = unescape(temp_str);
	var ckbyte = ((cnt*2) + temp_str.length) + "";
	target_id.innerHTML = ckbyte;
}
*/
function calculate_msglen(message) {
	var nbytes = 0;

	for (i=0; i<message.length; i++) {
		var ch = message.charAt(i);
		
		if(escape(ch).length > 4) nbytes += 2;
		else if (ch == '\n') {
			if (message.charAt(i-1) != '\r') nbytes += 1;
		}
		else if (ch == '<' || ch == '>') nbytes += 4;
		else nbytes += 1;
	}

	return nbytes;
}

function assert_msglen(message, maximum,textlimit) {
	var inc = 0;
	var nbytes = 0;
	var msg = "";
	var msglen = message.length;

	for (i=0; i<msglen; i++) {
		var ch = message.charAt(i);

		if (escape(ch).length > 4) inc = 2;
		else if (ch == '\n') {
			if (message.charAt(i-1) != '\r') inc = 1;
		}
		else if (ch == '<' || ch == '>') inc = 4;
		else inc = 1;
		if ((nbytes + inc) > maximum) break;

		nbytes += inc;
		msg += ch;
	}
	textlimit.innerText = nbytes;
	return msg;
}

function checkByte(val,tg,length_limit) {
	var target_id = eval("document.all."+tg);
	var check_memo = val.value;
	var length = calculate_msglen(check_memo);
	target_id.innerText = length;

	if (length > length_limit) {
		val.value = val.value.replace(/\r\n$/, "");
		val.value = assert_msglen(val.value, length_limit, target_id);
		return false;
	}
}

function selSize(){
	var obj;
	var arr = document.getElementsByTagName('select');
	var w, h;
	for(var i=0; i < arr.length; i++){
		obj = arr[i];
		if(obj.getAttribute("auto") != null){
			if(obj.style.width == ""){
				alert("selectbox must define width at '"+obj.name+"' element");
			}

			w = parseInt(obj.style.width) - 1;
			h = obj.offsetHeight;

			obj.onmouseover = "if(this.ow==undefined){ this.ow = this.offsetWidth } if(this.n == undefined || this.n == false){ this.style.width=''; if(this.offsetWidth <= this.ow){ this.n = true; this.style.width = this.ow+'px'; this.onclick=null; } }";
			obj.onclick = "this.b = true; if(this.n == undefined || this.n == true){ this.style.width = ''; if(this.offsetWidth <= this.ow){ this.n = true; this.style.width = this.ow+'px'; this.onclick = null; } }";
			obj.onmouseout = "if(this.b == true){ return; } if(this.n == undefined || this.n == false){ this.style.width = this.ow+'px'; }";
			obj.onblur = "this.b = false; if(this.ow != undefined){ this.style.width = this.ow+'px'; } ";
			obj.outerHTML = "<span style='width:" + w + "; overflow:hidden;text-overflow:ellipsis;padding-top:0px;'>" + obj.outerHTML + "</span";
			obj.removeAttribute("auto");
		}
	}
}

function nextFocus(sFormName,sNow,sNext)
	{
		var sForm = 'document.'+ sFormName +'.'
		var oNow = eval(sForm + sNow);
	
		if (typeof oNow == 'object')
		{
			if ( oNow.value.length == oNow.maxLength)
			{
				var oNext = eval(sForm + sNext);
	
				if ((typeof oNext) == 'object')
					oNext.focus();
			}
		}
	}


function pop_cl(id){
	var pop = eval("document.getElementById('pop"+id+"')");
	/*
	$('#pop'+id).animate({
		opacity : 'toggle',
		height : 'toggle',
		width : 'toggle'
	}, 'slow');
	*/

	pop.style.display = 'none';
}

function getCookie(name){
	var nameOfCookie = name + "=";
	var x = 0;
	while( x <= document.cookie.length){
		var y = (x + nameOfCookie.length);
		if(document.cookie.substring(x,y) == nameOfCookie){
			if((endOfCookie = document.cookie.indexOf(";",y)) == -1){
				endOfCookie = document.cookie.length;
			}
			return unescape(document.cookie.substring(y, endOfCookie));
		}
		x = document.cookie.indexOf(" ",x) + 1;
		if(x == 0) break;
	}
	return "";
}

function setCookie(name,value,expirehours,domain){
	var todayDate = new Date();
	todayDate.setHours(todayDate.getHours() + expirehours);
	document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";";
	if(domain){
		document.cookie += "domain=" + domain + ";";
	}
}

function close_pop(val){
	var f = document.getElementById('view_yn'+val);
	if(f.checked == true){
		setCookie("popclose"+val,"SET",1);
	}
	document.getElementById('pop'+val).style.display = 'none';
}

function view_pop(val){
	var popcookie = getCookie("popclose"+val);
//	alert(popcookie);
	if(popcookie != "SET"){
		document.getElementById('pop'+val).style.display = 'block';
	}
}