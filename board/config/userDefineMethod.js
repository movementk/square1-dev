//문자열의 좌우공백 제거
String.prototype.trim = function(Obj) {
	var returnValue = this.replace(/(^ *)|( *$)/g, "");

	if(Obj)
		Obj.value = returnValue;

	return returnValue;
}

//숫자형체크 정규화 메쏘드
String.prototype.number = function() {
	var re = /[0-9]/g;
	
	if(this.replace(re,"") != "") return false;
	return true;
}

//숫자타입체크 정규화 메쏘드
String.prototype.onlyNumber = function() {
	
	if(this.number()) {
		var num = parseInt(this);
		var tmpnum = num.toString();

		if(tmpnum == this) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}