function swf(src,w,h,wmode,idName,vals){
	html = '';
	html += '<object type="application/x-shockwave-flash" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" id="param" width="100%" height="100%">';
	html += '<param name="movie" value="'+src+'?str='+vals+'">';
	html += '<param name="quality" value="high">';
	html += '<param name="bgcolor" value="#ffffff">';
	html += '<param name="wmode" value="'+wmode+'">';
	html += '<param name="swliveconnect" value="true">';
	html += '<param name="allowScriptAccess" value="always">';
	html += '<embed src="'+src+'?'+vals+'" quality=high bgcolor="#ffffff" width="100%" height="100%" swliveconnect="true" id="'+idName+'" name="'+idName+'" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"><\/embed>';
	html += '<\/object>';
	document.write(html);
	
}
